<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $role;

    public function __construct($role = null)
    {
        $this->role = $role;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = User::query();

        if ($this->role) {
            $query->where('role', $this->role);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Email',
            'Role',
            'Alamat',
            'Tanggal Terdaftar',
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            ucfirst($user->role),
            $user->alamat ?? '-',
            $user->created_at->format('d-m-Y'),
        ];
    }
}
