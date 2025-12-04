<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class UserExport implements FromCollection, WithHeadings, WithMapping
{
    private $key = 0;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::orderBy('role', 'ASC')->get();
    }


    public function headings(): array{
        return ['No', 'Nama', 'Nik', 'Position', 'Gaji', 'No telephone', 'Awal masuk', 'Email', 'Role'];
    }

    public function map($user): array{
        return [
            ++$this->key,
            $user->name,
            $user->nik,
            $user->position,
            $user->wages,
            $user->numberphone,
            $user->created_at->format('d-m-Y'),
            $user->email,
            $user->role
        ];
    }
}
