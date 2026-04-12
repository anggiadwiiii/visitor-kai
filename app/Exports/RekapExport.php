<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekapExport implements FromCollection, WithHeadings
{
    protected Collection $data;

    public function __construct($data)
    {
        $this->data = collect($data);
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            return [
                'Nama' => $item['nama'] ?? '-',
                'Tanggal' => $item['tanggal'] ?? '-',
                'Status' => $item['keterangan'] ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Tanggal Kunjungan',
            'Status',
        ];
    }
}