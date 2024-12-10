@extends('layouts.Layout')
@section('title'|'edit comment')
@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold text-indigo-600 mb-4">Edit Your Review</h2>
    @if(session('success'))
    <div class="bg-green-500 text-white p-4 rounded-md mb-4">
        <strong>{{ session('success') }}</strong>
    </div>
    @endif
    <form action="{{
    isset($course)
        ? route('review.update', ['course', $course->id, $review->id])
        : route('review.update', ['instructor', $instructor->id, $review->id])
}}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
        @csrf
        @method('PUT')

        <!-- Review Textarea -->
        <div class="mb-4">
            <textarea name="review" rows="5" class="w-full p-3 border border-gray-300 rounded-md"
                placeholder="Write your review..." ">{{ $review->comment }}</textarea>
                @error('review')
                <div class=" text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
        </div>

        <!-- Rating Stars -->
        <div class=" mt-4">
            <label for="rating" class="block text-gray-700 font-semibold mb-2">Rating:</label>
            <div class="flex items-center space-x-2">
                @for ($i = 1; $i <= 5; $i++) <input type="radio" id="rating-{{ $i }}" name="rating" value="{{ $i }}"
                    class="hidden rating-radio" {{ $i==$review->rating ? 'checked' : '' }} required>
                    <label for="rating-{{ $i }}" class="cursor-pointer text-2xl star-label">
                        <i class="fas fa-star"></i>
                    </label>
                    @endfor
            </div>
            @error('rating')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="mt-4 bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 focus:outline-none">Update
            Review</button>
    </form>

<div class="mt-6">
    @if(isset($course))
    <a href="{{ route('courses.show', $course->id) }}" class="text-blue-500">Back to course details</a>
    @elseif(isset($instructor))
    <a href="{{ route('instructor.review', $instructor->id) }}" class="text-blue-500">Back to instructor details</a>
    @endif
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