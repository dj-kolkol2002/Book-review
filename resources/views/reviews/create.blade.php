@extends('layouts.app')

@section('content')
  <h1 class="text-2xl font-bold mb-4">Add Review for "{{ $book->title }}"</h1>

  <form action="{{ route('reviews.store', $book) }}" method="POST" class="space-y-6 max-w-xl">
    @csrf

    {{-- Rating --}}
    <div>
      <label for="rating" class="block text-sm font-medium text-gray-700">Rating (1–5)</label>
      <input
        type="number"
        name="rating"
        id="rating"
        min="1"
        max="5"
        step="1"
        value="{{ old('rating', 5) }}"
        class="mt-1 block w-full border rounded shadow-sm px-3 py-2 focus:ring focus:ring-blue-200"
        required
      >
      @error('rating')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- Review --}}
    <div>
      <label for="review" class="block text-sm font-medium text-gray-700">Your Review</label>
      <textarea
        name="review"
        id="review"
        rows="4"
        class="mt-1 block w-full border rounded shadow-sm px-3 py-2 focus:ring focus:ring-blue-200"
        required
      >{{ old('review') }}</textarea>
      @error('review')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <button type="submit" class="bg-blue-600 text-white font-semibold px-4 py-2 rounded hover:bg-blue-700">
        Submit Review
      </button>
      <a href="{{ route('books.show', $book) }}" class="ml-3 text-gray-600 hover:underline">Cancel</a>
    </div>
  </form>
@endsection
