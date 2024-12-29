@php
$fullStars = floor($rating);
$halfStar = $rating - $fullStars >= 0.5;
$emptyStars = 5 - ceil($rating);
@endphp

<div class="flex items-center">

    @for ($i = 0; $i < $fullStars; $i++) <i class="fas fa-star text-yellow-400"></i>
        @endfor


        @if ($halfStar)
        <i class="fas fa-star-half-alt text-yellow-400"></i>
        @endif


        @for ($i = 0; $i < $emptyStars; $i++) <i class="far fa-star text-yellow-400"></i>
            @endfor
</div>