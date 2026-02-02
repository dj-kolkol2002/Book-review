<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request)
{
    $title = $request->input('title');
    $sort = $request->input('sort');

    $cacheKey = 'books_' . md5($title . '_' . $sort);

    $books = Cache::remember($cacheKey, now()->addMinutes(5), function () use ($title, $sort) {
        return Book::when($title, fn ($query, $title) =>
                $query->where('title', 'like', '%' . $title . '%')
            )
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->when($sort === 'popular_last_month', fn ($query) =>
                $query->orderByDesc('reviews_count')
            )
            ->when($sort === 'highest_rated_last_month', fn ($query) =>
                $query->orderByDesc('reviews_avg_rating')
            )
            ->latest()
            ->get();
    });

    $filters = [
        '' => 'Latest',
        'popular_last_month' => 'Popular Last Month',
        'popular_last_6months' => 'Popular Last 6 Months',
        'highest_rated_last_month' => 'Highest Rated Last Month',
        'highest_rated_last_6months' => 'Highest Rated Last 6 Months',
    ];

    return view('books.index', compact('books', 'filters'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
     public function show(Book $book)
{
    $book->load('reviews');

    return view('books.show', compact('book'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
