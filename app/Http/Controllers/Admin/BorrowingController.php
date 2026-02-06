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

        // Update status peminjaman
        $borrowing->update([
            'status' => 'dipinjam',
            'borrow_date' => now(),
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

    public function returnBook(Borrowing $borrowing)
{
    // Cegah double return
    if ($borrowing->status !== 'dipinjam') {
        return back()->with('error', 'Buku belum dipinjam atau sudah dikembalikan');
    }

    // Update status peminjaman
    $borrowing->update([
        'status' => 'dikembalikan',
        'return_date' => now(),
    ]);

    // Tambah stok buku
    $borrowing->book->increment('stock');

    return back()->with('success', 'Buku berhasil dikembalikan');
}

}
