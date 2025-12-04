<?php

namespace App\Exports;

use App\Models\Precense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PrecenseExport implements FromCollection, WithHeadings, WithMapping
{
    private $key = 0;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Precense::get();
    }


      public function headings(): array{
        return ['No', 'Nama', 'Nik', 'Position', 'Tanggal', 'Status', 'Keterangan'];
    }

      public function map($user): array{
        return [
            ++$this->key,
            $user->name,
            $user->nik,
            $user->position,
             $user->date,   
            $user->status,
            $user->reason
        ];
    }


}
