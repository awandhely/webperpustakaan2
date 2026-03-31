<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookRating;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookRatingController extends Controller
{
    public function store(Request $request, Book $book)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        // Pastikan user pernah meminjam dan sudah mengembalikan buku ini
        $hasBorrowed = Borrowing::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->where('status', 'dikembalikan')
            ->exists();

        if (!$hasBorrowed) {
            return back()->with('error', 'Anda hanya dapat memberikan rating pada buku yang sudah Anda pinjam dan kembalikan.');
        }

        // Simpan atau update rating
        BookRating::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'book_id' => $book->id,
            ],
            [
                'rating' => $request->rating,
                'review' => $request->review,
            ]
        );

        return back()->with('success', 'Terima kasih atas rating dan ulasan Anda!');
    }
}
