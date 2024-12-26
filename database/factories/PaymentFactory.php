<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' =>
            User::inRandomOrder()->first()->id,
            'payment_id' =>
            $this->faker->uuid,
            'amount' =>
            $this->faker->randomFloat(2, 50, 500),
            'payment_method' =>
            $this->faker->randomElement(['credit_card', 'paypal', 'bank_transfer']),
            'status' =>  $this->faker->randomElement(['completed', 'pending', 'failed']),
            'created_at' =>  $this->faker->dateTimeThisYear,
            'updated_at' => now(),
        ];
    }
}
