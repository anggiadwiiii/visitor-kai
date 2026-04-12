<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $table = 'visitors';

    protected $fillable = [
        'pengajuan_id',
        'nama_pengunjung',
        'email_pengunjung',
        'no_identitas',
        'jenis_identitas',
        'waktu_masuk',
        'waktu_keluar',
        'asal_institusi',
        'keterangan',
    ];

    protected $casts = [
        'waktu_masuk' => 'datetime',
        'waktu_keluar' => 'datetime',
    ];

    // Relationships
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    // Status Helpers
    public function isActive()
    {
        return is_null($this->waktu_keluar);
    }

    public function getStatus()
    {
        return $this->isActive() ? 'Aktif' : 'Keluar';
    }
}