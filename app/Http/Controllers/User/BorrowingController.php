<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    /**
     * DAFTAR BUKU (USER)
     */
    public function index()
    {
        $books = Book::where('stock', '>', 0)->get();

        return view('user.books.index', compact('books'));
    }

    /**
     * AKSI PINJAM BUKU
     */
    public function store(Book $book)
    {
        // 1. cek stok
        if ($book->stock < 1) {
            return back()->with('error', 'Stok buku habis');
        }

        // 2. cegah pinjam buku yang sama
        $alreadyBorrowed = Borrowing::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->whereIn('status', ['menunggu', 'dipinjam'])
            ->exists();

        if ($alreadyBorrowed) {
            return back()->with('error', 'Kamu sudah meminjam buku ini');
        }

        // 3. simpan peminjaman
        Borrowing::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'status' => 'menunggu',
        ]);

        return back()->with('success', 'Permintaan peminjaman berhasil dikirim');
    }

    public function create(Book $book)
    {
        return view('user.books.borrow', compact('book'));
    }

    /**
     * DETAIL BUKU (USER)
     */
    public function show(Book $book)
    {
        $book->load('category');
        return view('user.books.show', compact('book'));
    }
}
