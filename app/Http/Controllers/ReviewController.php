<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Show the form for creating a new review.
     */
    public function create(Book $book)
    {
        return view('reviews.create', compact('book'));
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request, Book $book)
    {
        $validated = $request->validate([
            'review' => ['required', 'string', 'max:1000'],
            'rating' => ['required', 'integer', 'between:1,5'],
        ]);

        $book->reviews()->create($validated);

        return redirect()
            ->route('books.show', $book)
            ->with('success', 'Review added successfully.');
    }
}
