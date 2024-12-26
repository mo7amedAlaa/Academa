@extends('layouts.Layout')

@section('title', 'Course Details | ' . $course->title)

@section('content')
<div class="container mx-auto my-10 px-6">
    @if(session('error'))
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            Toastify({
                text: "{{ session('error') }}",
                backgroundColor: "linear-gradient(to right, #FF5F6D, #FFC371)",
                close: true,
                duration: 3000
            }).showToast();
        });
    </script>
    @endif

    @if(session('success'))
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            Toastify({
                text: "{{ session('success') }}",
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                close: true,
                duration: 3000
            }).showToast();
        });
    </script>
    @endif
    <h1 class="text-4xl font-extrabold text-indigo-700 mb-6">{{ $course->title }}</h1>
    <div class="flex flex-wrap md:flex-nowrap gap-8">

        <div class="w-full md:w-2/3">
            <img src="{{ asset($course->cover_image) }}" alt="{{ $course->title }}"
                class="rounded-lg shadow-lg w-full h-80 object-cover mb-6">

            <p class="text-lg text-gray-700 mb-6">{{ $course->description }}</p>


            <div class="flex items-center mb-6">
                <img src="{{ asset(  $course->instructor->user->avatar) }}" alt="{{ $course->instructor->user->name }}"
                    class="w-16 h-16 rounded-full shadow-md mr-4">
                <div>
                    <h4 class="text-xl font-semibold text-gray-800">Instructor: {{ $course->instructor->user->name }}
                    </h4>
                    <p class="text-gray-600 text-sm">Rating: {{intval($course->instructor->averageRating()) }} /5</p>
                </div>
            </div>


            <div class="bg-gray-100 rounded-lg shadow p-6 mb-6">
                <h3 class="text-2xl font-semibold text-indigo-600 mb-4">Course Details</h3>
                <ul class="text-gray-700 text-lg list-disc pl-5">
                    <li>Duration: {{ $course->duration_hours }} hours</li>
                    <li>Level: {{ $course->level->name }}</li>
                    <li>Category: {{ $course->category->name }}</li>
                    @if($course->isFree)
                    <li>Price: <span class="text-lg font-semibold text-green-600">This course is free!</span></li>
                    @else
                    <li>
                        <span>Price:</span>
                        @if($course->discount > 0)
                        <span class="text-lg font-semibold text-red-500 line-through mr-2">
                            ${{ number_format($course->price, 2) }}
                        </span>
                        <span class="text-lg font-semibold text-green-600">
                            ${{ number_format($course->price - ($course->price * $course->discount) / 100, 2) }}
                        </span>
                        @else
                        <span class="text-lg ">
                            ${{ number_format($course->price, 2) }}
                        </span>
                        @endif
                    </li>
                    @endif

                </ul>
            </div>


            <div>
                @auth
                @if(auth()->user()->hasRole('student'))
                @if (Auth::check() && !$hasReviewed)
                <form action="{{ route('review.store', ['entityType' => 'course' , 'entityId' => $course->id]) }}"
                    method="POST" class="mt-4 bg-white p-6 rounded-lg shadow-lg">
                    @csrf
                    <textarea name="review" rows="5" placeholder="Write your review..."
                        class="w-full p-3 border border-gray-300 rounded-md" required></textarea>

                    <div class="mt-4">
                        <label for="rating" class="block text-gray-700 font-semibold mb-2">Rating:</label>
                        <div class="flex items-center space-x-2">
                            @for ($i = 1; $i <= 5; $i++) <input type="radio" id="rating-{{ $i }}" name="rating"
                                value="{{ $i }}" class="hidden rating-radio" required>
                                <label for="rating-{{ $i }}" class="cursor-pointer text-2xl star-label">
                                    <i class="fas fa-star"></i>
                                </label>
                                @endfor
                        </div>
                    </div>

                    <button type="submit"
                        class="mt-4 bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 focus:outline-none">Submit
                        Review</button>
                </form>
                @elseif (Auth::check() && $hasReviewed)
                <p class="mt-4 text-gray-600">Your Review:</p>
                <div class="bg-white p-4 rounded-lg shadow-lg mt-2  ">

                    <div class="flex space-x-4 items-center   justify-end  mb-4  ">
                        <a href="{{ route('review.edit', ['entityType' => 'course','entityId'=>$course->id, 'reviewId' => $userReview->id]) }}"
                            class="flex items-center justify-center bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            <i class="fas fa-edit  "></i>
                        </a>

                        <form action="{{ route('reviews.destroy', [$course->id, $userReview->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center justify-center bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                                <i class="fas fa-trash-alt  "></i>
                            </button>
                        </form>
                    </div>


                    <div class="border-t border-gray-200 py-4">
                        <p class="text-yellow-500">
                            @for ($i = 0; $i < $userReview->rating; $i++)
                                <i class="fas fa-star"></i>
                                @endfor
                                @for ($i = $userReview->rating; $i < 5; $i++) <i class="far fa-star"></i>
                                    @endfor
                        </p>

                        <p class="text-gray-600">{{ $userReview->comment }}</p>
                        <p class="text-gray-400 text-sm">{{ $userReview->created_at->format('d M, Y') }}</p>
                    </div>

                </div>
                @endif
                @endif
                @endauth
                <h3 class="text-2xl font-semibold text-indigo-600 mb-4">Reviews</h3>
                @if($course->reviews->isEmpty())
                <p class="text-gray-600">No reviews yet. Be the first to review this course!</p>
                @else
                @foreach ($course->reviews as $review)
                <div class="border-t border-gray-200 py-4">
                    <h4 class="text-lg font-semibold">{{ $review->user->name }}</h4>
                    <p class="text-yellow-500">
                        @for ($i = 0; $i < $review->rating; $i++)
                            <i class="fas fa-star"></i>
                            @endfor
                            @for ($i = $review->rating; $i < 5; $i++) <i class="far fa-star"></i>
                                @endfor
                    </p>
                    <p class="text-gray-600">{{ $review->comment }}</p>
                    <p class="text-gray-400 text-sm">{{ $review->created_at->format('d M, Y') }}</p>
                </div>
                @endforeach
                @endif
            </div>

        </div>

        <div class="w-full md:w-1/3">
            @auth
            @if(auth()->user()->hasRole('student'))
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h3 class="text-2xl font-semibold text-indigo-600 mb-4">Enroll Now</h3>
                @if($course->isFree)
                <p class="text-lg   mb-4 font-semibold text-green-600">This course is free!</p>
                <form action="{{ route('learning.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <button type="submit"
                        class="bg-indigo-500 hover:bg-indigo-600 text-white py-3 px-6 rounded-lg text-lg font-semibold capitalize w-full">
                        Add to My Learning
                    </button>
                </form>
                @else
                <p class="text-lg text-gray-700 mb-4">
                    Price:
                    @if($course->discount > 0)
                    <span class="text-lg font-semibold text-red-500 line-through mr-2">
                        ${{ number_format($course->price, 2) }}
                    </span>
                    <span class="text-lg font-semibold text-green-600">
                        ${{ number_format($course->price - ($course->price * $course->discount) / 100, 2) }}
                    </span>
                    @else
                    <span class="font-semibold text-lg">
                        ${{ number_format($course->price, 2) }}
                    </span>
                    @endif
                </p>
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $course->id }}">
                    <input type="hidden" name="name" value="{{ $course->title }}">
                    <input type="hidden" name="price"
                        value="{{ $course->price - ($course->price * $course->discount) / 100 }}">
                    <input type="hidden" name="cover_image" value="{{ $course->cover_image }}">
                    <button type="submit"
                        class="bg-indigo-500 hover:bg-indigo-600 text-white py-3 px-6 rounded-lg text-lg font-semibold capitalize w-full">
                        Add to Cart
                    </button>
                </form>
                @endif
            </div>
            @endif
            @endauth
            <!-- Related Courses -->
            <div class="bg-gray-100 rounded-lg shadow-lg p-6">
                <h3 class="text-2xl font-semibold text-indigo-600 mb-4">Related Courses</h3>
                @foreach ($relatedCourses as $relatedCourse)
                <div class="flex items-center mb-4">
                    <img src="{{ asset($relatedCourse->cover_image) }}" alt="{{ $relatedCourse->title }}"
                        class="w-16 h-16 rounded-lg mr-4 object-cover">
                    <div>
                        <h4 class="text-lg font-semibold">
                            <a href="{{ route('courses.show', $relatedCourse->id) }}"
                                class="text-indigo-600 hover:underline">
                                {{ $relatedCourse->title }}
                            </a>
                        </h4>
                        @if($relatedCourse->isFree)
                        <p class="text-lg   mb-4 font-semibold text-green-600">This course is free!</p>
                        @else
                        <p class="text-gray-600 text-sm">Price: ${{ $relatedCourse->price }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const starLabels = document.querySelectorAll('.star-label');
        const ratingRadios = document.querySelectorAll('.rating-radio');

        starLabels.forEach((starLabel, index) => {
            starLabel.addEventListener('mouseover', function () {
                updateStars(index + 1);
            });
            starLabel.addEventListener('mouseout', function () {
                resetStars();
            });
            starLabel.addEventListener('click', function () {
                document.querySelector('input[name="rating"][value="' + (index + 1) + '"]').checked = true;
            });
        });


        function updateStars(rating) {
            starLabels.forEach((starLabel, index) => {
                if (index < rating) {
                    starLabel.querySelector('i').classList.remove('far');
                    starLabel.querySelector('i').classList.add('fas');
                } else {
                    starLabel.querySelector('i').classList.remove('fas');
                    starLabel.querySelector('i').classList.add('far');
                }
            });
        }

        function resetStars() {
            const selectedRating = document.querySelector('input[name="rating"]:checked') ? document.querySelector('input[name="rating"]:checked').value : 0;
            updateStars(selectedRating);
        }

        resetStars();
    });
</script>
@endsection