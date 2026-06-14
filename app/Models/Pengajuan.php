<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';

    protected $fillable = [
        'user_id',
        'tipe_visitor',
        'nama_pengunjung',
        'email_pengunjung',
        'no_telepon',
        'asal_institusi',
        'tujuan_kunjungan',
        'nama_pic',
        'jabatan_pic',
        'tanggal_kunjungan',
        'tanggal_selesai',
        'jam_kunjungan',
        'jumlah_pengunjung',
        'stasiun_kunjungan',
        'layanan_pendampingan',
        'dokumen',
        'pintu',
        'tujuan_akses',
        'jumlah_pendamping_protokoler',
        'jumlah_jenis_kendaraan',
        'nomor_polisi_kendaraan',
        'butuh_pendampingan_protokoler',
        'status',
        'catatan_admin',
        'tanggal_disetujui',
        'tanggal_ditolak',
        'disetujui_oleh',
];

    protected $casts = [
    'tanggal_kunjungan' => 'date',
    'tanggal_selesai' => 'date',
    'jam_kunjungan' => 'string',
    'tanggal_disetujui' => 'datetime',
    'tanggal_ditolak' => 'datetime',
];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }

    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }

    // Status Helpers
    public function isWaiting()
    {
        return $this->status === 'Menunggu';
    }

    public function isApproved()
    {
        return $this->status === 'Disetujui';
    }

    public function isRejected()
    {
        return $this->status === 'Ditolak';
    }

    public function isCompleted()
    {
        return $this->status === 'Selesai';
    }
}
