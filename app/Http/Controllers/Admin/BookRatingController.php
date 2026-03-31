<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookRating;
use Illuminate\Http\Request;

class BookRatingController extends Controller
{
    /**
     * Display a listing of the book ratings.
     */
    public function index()
    {
        $ratings = BookRating::with(['user', 'book'])
            ->latest()
            ->paginate(10);

        return view('admin.ratings.index', compact('ratings'));
    }

    /**
     * Remove the specified rating from storage.
     */
    public function destroy(BookRating $rating)
    {
        $rating->delete();

        return back()->with('success', 'Ulasan berhasil dihapus.');
    }
}
