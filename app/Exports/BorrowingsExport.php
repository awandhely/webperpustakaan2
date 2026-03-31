<?php

namespace App\Exports;

use App\Models\Borrowing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BorrowingsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Borrowing::with(['user', 'book.category'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Peminjam',
            'Email Peminjam',
            'Judul Buku',
            'Kategori',
            'Penulis',
            'Tanggal Pinjam',
            'Batas Kembali (7 Hari)',
            'Tanggal Dikembalikan',
            'Status'
        ];
    }

    public function map($borrowing): array
    {
        static $no = 1;
        
        $borrowDate = \Carbon\Carbon::parse($borrowing->borrow_date);
        $dueDate = $borrowDate->copy()->addDays(7);
        $returnDate = $borrowing->return_date ? \Carbon\Carbon::parse($borrowing->return_date)->format('d M Y') : '-';

        return [
            $no++,
            $borrowing->user->name ?? '-',
            $borrowing->user->email ?? '-',
            $borrowing->book->title ?? '-',
            $borrowing->book->category->name ?? '-',
            $borrowing->book->author ?? '-',
            $borrowDate->format('d M Y'),
            $dueDate->format('d M Y'),
            $returnDate,
            strtoupper($borrowing->status)
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Bold the first row (headings)
            1    => ['font' => ['bold' => true]],
        ];
    }
}
