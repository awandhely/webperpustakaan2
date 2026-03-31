<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

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
            'borrow_date' => request('borrow_date', now()->toDateString()),
            'return_date' => request('return_date', now()->addDays(7)->toDateString()),
        ]);

        return back()->with('success', 'Permintaan peminjaman berhasil dikirim! Silakan tunggu konfirmasi dari petugas.');
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

    /**
     * HISTORY PEMINJAMAN (USER)
     */
    public function history()
    {
        $query = Borrowing::with('book')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc');

        if (request('status')) {
            $query->where('status', request('status'));
        }

        $borrowings = $query->get();

        return view('user.borrowings.history', compact('borrowings'));
    }

    /**
     * DOWNLOAD BUKTI PEMINJAMAN (PDF)
     */
    public function downloadReceipt(Borrowing $borrowing)
    {
        // Pastikan peminjaman milik user yang login
        if ($borrowing->user_id !== Auth::id()) {
            abort(403);
        }

        $borrowing->load(['user', 'book.category']);

        $pdf = Pdf::loadView('user.borrowings.receipt', compact('borrowing'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('bukti-peminjaman-' . $borrowing->id . '.pdf');
    }
}
