@extends('layouts.app')

@section('content')
  <h1 class="text-2xl font-bold mb-4">{{ $book->title }}</h1>
  <p class="text-gray-600 mb-2">Author: {{ $book->author }}</p>

  <hr class="my-4">

  <h2 class="text-xl font-semibold mb-2">Reviews:</h2>

    <a
    href="{{ route('reviews.create', $book) }}"
    class="inline-block mb-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition"
>
    Add a Review
</a>


  @forelse ($book->reviews as $review)
    <div class="mb-4 p-4 bg-white shadow rounded">
      <p class="text-gray-800 mb-2">{{ $review->review }}</p>

      <div class="flex items-center space-x-2 mb-1">
        <x-star-rating :rating="$review->rating" />
        <span class="text-sm text-gray-500">{{ number_format($review->rating, 1) }}/5</span>
      </div>

      <div class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</div>
    </div>
  @empty
    <p class="text-gray-500">No reviews yet.</p>
  @endforelse
@endsection
