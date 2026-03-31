<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Exports\BorrowingsExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'book.category'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('petugas.reports.index', compact('borrowings'));
    }

    public function export()
    {
        return Excel::download(new BorrowingsExport, 'laporan-peminjaman-' . now()->format('Y-m-d') . '.xlsx');
    }
}
