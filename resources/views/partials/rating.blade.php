@php
$fullStars = floor($rating);
$halfStar = $rating - $fullStars >= 0.5;
$emptyStars = 5 - ceil($rating);
@endphp

@for ($i = 0; $i < $fullStars; $i++) <i class="fas fa-star"></i> @endfor
    @if ($halfStar) <i class="fas fa-star-half-alt"></i> @endif
    @for ($i = 0; $i < $emptyStars; $i++) <i class="far fa-star"></i> @endfor