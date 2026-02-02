@extends('layouts.app')

@section('content')
  <h1 class="mb-10 text-2xl">Books</h1>

  <form method="GET" class="mb-6 flex flex-wrap gap-2 items-center">
  <input
    type="text"
    name="title"
    placeholder="Search by title..."
    value="{{ request('title') }}"
    class="px-3 py-2 border rounded shadow-sm w-full sm:w-auto"
  >

  <button
    type="submit"
    class="px-4 py-2 bg-blue-500 text-white rounded"
  >Search</button>

  @if(request()->has('title') && request('title') !== '')
    <a
      href="{{ route('books.index') }}"
      class="px-4 py-2 bg-gray-300 text-gray-800 rounded"
    >Clear</a>
  @endif
</form>

 @php
$filters = [
    '' => 'Latest',
    'popular_last_month' => 'Popular Last Month',
    'popular_last_6months' => 'Popular Last 6 Months',
    'highest_rated_last_month' => 'Highest Rated Last Month',
    'highest_rated_last_6months' => 'Highest Rated Last 6 Months'
];
$currentSort = request('sort');
@endphp

<div class="filter-container mb-4 flex flex-wrap gap-2">
  @foreach ($filters as $key => $label)
    <a
      href="{{ route('books.index', array_merge(request()->except('page'), ['sort' => $key])) }}"
      class="px-3 py-2 rounded
            {{ $currentSort === $key ? 'bg-white text-gray-900 shadow' : 'text-gray-500 hover:text-gray-700' }}
            text-sm font-medium transition"
    >
      {{ $label }}
    </a>
  @endforeach
</div>

  <ul>
    @forelse ($books as $book)
      <li class="mb-4">
        <div class="book-item p-4 bg-white rounded shadow">
          <div class="flex flex-wrap justify-between items-center">
            <div>
              <a href="{{ route('books.show', $book) }}" class="text-lg font-semibold text-blue-700">{{ $book->title }}</a>
              <p class="text-gray-500">by {{ $book->author }}</p>
            </div>
            <div class="text-right">
              <div class="text-yellow-500 font-bold">
                 <x-star-rating :rating="$book->reviews_avg_rating ?? 0" />
                    <span class="text-sm text-gray-400">
                        {{ number_format($book->reviews_avg_rating ?? 0, 1) }} / 5
                    </span>
                </div>

              <div class="text-sm text-gray-400">
                out of {{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }}
              </div>
            </div>
          </div>
        </div>
      </li>
    @empty
      <li>No books found.</li>
    @endforelse
  </ul>
@endsection
