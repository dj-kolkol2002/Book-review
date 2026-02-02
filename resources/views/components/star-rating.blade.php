@props(['rating' => 0, 'max' => 5])

@php
    $fullStars = floor($rating);
    $halfStar = ($rating - $fullStars) >= 0.25 && ($rating - $fullStars) < 0.75;
    $emptyStars = $max - $fullStars - ($halfStar ? 1 : 0);
@endphp

<div class="flex items-center space-x-0.5">
    @for ($i = 0; $i < $fullStars; $i++)
        <svg class="w-5 h-5 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09 1.122-6.545L0 6.91l6.561-.955L10 0l3.439 5.955 6.561.955-4.744 4.635 1.122 6.545z"/>
        </svg>
    @endfor

    @if ($halfStar)
        <svg class="w-5 h-5 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <defs>
                <linearGradient id="half">
                    <stop offset="50%" stop-color="currentColor"/>
                    <stop offset="50%" stop-color="transparent"/>
                </linearGradient>
            </defs>
            <path fill="url(#half)" d="M10 15l-5.878 3.09 1.122-6.545L0 6.91l6.561-.955L10 0l3.439 5.955 6.561.955-4.744 4.635 1.122 6.545z"/>
        </svg>
    @endif

    @for ($i = 0; $i < $emptyStars; $i++)
        <svg class="w-5 h-5 text-gray-300 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09 1.122-6.545L0 6.91l6.561-.955L10 0l3.439 5.955 6.561.955-4.744 4.635 1.122 6.545z"/>
        </svg>
    @endfor
</div>
