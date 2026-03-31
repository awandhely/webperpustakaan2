<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'book'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('petugas.borrowings.index', compact('borrowings'));
    }

    public function confirm(Borrowing $borrowing)
    {
        if ($borrowing->book->stock < 1) {
            return back()->with('error', 'Stok buku habis');
        }

        $borrowing->update([
            'status' => 'dipinjam',
        ]);

        $borrowing->book->decrement('stock');

        return back()->with('success', 'Peminjaman berhasil dikonfirmasi');
    }

    public function reject(Borrowing $borrowing)
    {
        $borrowing->update([
            'status' => 'ditolak',
        ]);

        return back()->with('success', 'Peminjaman ditolak');
    }

    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'dipinjam') {
            return back()->with('error', 'Buku belum dipinjam atau sudah dikembalikan.');
        }

        $borrowing->update([
            'status' => 'dikembalikan',
            'return_date' => now(),
        ]);

        $borrowing->book->increment('stock');

        return back()->with('success', 'Buku "' . $borrowing->book->title . '" berhasil dikembalikan!');
    }
}
