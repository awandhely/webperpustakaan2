<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    /**
     * Tampilkan semua data peminjaman
     */
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'book'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.borrowings.index', compact('borrowings'));
    }

    /**
     * Konfirmasi peminjaman
     */
    public function confirm(Borrowing $borrowing)
    {
        // Cek stok buku
        if ($borrowing->book->stock < 1) {
            return back()->with('error', 'Stok buku habis');
        }

        // Update status peminjaman (borrow_date sudah diisi user dari form)
        $borrowing->update([
            'status' => 'dipinjam',
        ]);

        // Kurangi stok buku
        $borrowing->book->decrement('stock');

        return back()->with('success', 'Peminjaman berhasil dikonfirmasi');
    }

    /**
     * Tolak peminjaman
     */
    public function reject(Borrowing $borrowing)
    {
        $borrowing->update([
            'status' => 'ditolak',
        ]);

        return back()->with('success', 'Peminjaman ditolak');
    }

    /**
     * Selesaikan pengembalian buku
     */
    public function returnBook(Borrowing $borrowing)
    {
        // Cegah jika status bukan dipinjam
        if ($borrowing->status !== 'dipinjam') {
            return back()->with('error', 'Buku belum dipinjam atau sudah dikembalikan.');
        }

        // Update status peminjaman
        $borrowing->update([
            'status' => 'dikembalikan',
            'return_date' => now(),
        ]);

        // Tambah stok buku
        $borrowing->book->increment('stock');

        return back()->with('success', 'Buku "' . $borrowing->book->title . '" berhasil dikembalikan!');
    }
}
