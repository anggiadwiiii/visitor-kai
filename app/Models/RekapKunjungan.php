<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapKunjungan extends Model
{
    use HasFactory;

    protected $table = 'rekap_kunjungan';

    protected $fillable = [
        'tanggal',
        'total_kunjungan',
        'kunjungan_masuk',
        'kunjungan_keluar',
        'kunjungan_aktif',
        'catatan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
