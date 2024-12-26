<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\Payment;
use App\Notifications\CourseRegistrationNotification;
use App\Notifications\NewCourseEnrolled;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;

class CheckoutRepository
{
    public function checkout()
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $userId = auth()->id();
            $cartItems = session()->get("cart.$userId", []);

            $lineItems = [];
            $courseIds = [];

            foreach ($cartItems as $item) {
                $price = (float) $item['price'];


                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $item['name'],
                        ],
                        'unit_amount' => round($price * 100),
                    ],
                    'quantity' => 1,
                ];

                $courseIds[] = $item['id'];
            }

            $checkoutSession = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('checkout.success', [
                    'course_ids' => implode(',', $courseIds),
                    'payment_intent' => '{PAYMENT_INTENT}',
                    'amount' => array_sum(array_column($cartItems, 'price')),
                ]),
                'cancel_url' => route('checkout.cancel'),
            ]);

            return redirect()->away($checkoutSession->url);
        } catch (ApiErrorException $e) {
            \Log::error('Stripe API error: ' . $e->getMessage());
            return redirect()->route('checkout.cancel')->with('error', 'Something went wrong during the checkout process.');
        }
    }

    public function success(Request $request)
    {
        $user = auth()->user();
        $courseIds = explode(',', $request->query('course_ids'));
        $paymentIntent = $request->query('payment_intent');
        $amount = $request->query('amount');
        foreach ($courseIds as $courseId) {
            $course = Course::find($courseId);
            if ($course) {
                $registrationDate = now();
                $expiredDate = $registrationDate->copy()->addHours($course->duration_hours);

                $user->student->courses()->syncWithoutDetaching([
                    $courseId => [
                        'progress_percentage' => 0,
                        'expired_date' => $expiredDate,
                        'registration_date' => $registrationDate,
                    ]
                ]);
            }
            if ($course->instructor) {
                $course->instructor->user->notify(new CourseRegistrationNotification([
                    'course_name' => $course->title,
                    'instructor_id' => $course->instructor->id,
                    'student_name' => $user->name,
                    'registration_date' => $registrationDate->toFormattedDateString(),
                ]));
            }
            if ($user) {
                $user->notify(new NewCourseEnrolled([
                    'course_title' => $course->title,
                    'course_id' => $course->id,
                ]));
            }
        }
        Payment::create([
            'user_id' => $user->id,
            'payment_id' => $paymentIntent,
            'amount' => $amount,
            'payment_method' => 'card',
            'status' => 'completed',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session()->forget("cart." . $user->id);

        return redirect()->route('checkout.success')->with('message', 'Checkout successful. Courses have been registered.');
    }
}
