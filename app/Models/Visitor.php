<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visitor extends Model
{
    use HasFactory;

    protected $table = 'visitors';

    protected $fillable = [
        'pengajuan_id',
        'qr_token',
        'nomor',
        'status',
        'nama_pengunjung',
        'email_pengunjung',
        'no_identitas',
        'jenis_identitas',
        'waktu_masuk',
        'waktu_keluar',
        'asal_institusi',
        'keterangan',
        'tujuan_kunjungan',
        'pintu',
        'waktu_akses',
        'tujuan_akses',
        'jumlah_kendaraan',
        'nomor_polisi',
        'document',
        'last_qr_generated_date',
    ];

    protected $casts = [
        'waktu_masuk' => 'datetime',
        'waktu_keluar' => 'datetime',
        'last_qr_generated_date' => 'date',
    ];

    public function pengajuan(): BelongsTo
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }

    public function isActive(): bool
    {
        return !is_null($this->waktu_masuk) && is_null($this->waktu_keluar);
    }

    public function isCompleted(): bool
    {
        return !is_null($this->waktu_keluar);
    }

    public function getStatus(): string
    {
        // Check jika pengajuan dibatalkan
        if (strpos(strtolower($this->keterangan ?? ''), 'dibatalkan') !== false) {
            return 'Dibatalkan';
        }

        if ($this->isCompleted()) {
            return 'Check-out';
        }

        if ($this->isActive()) {
            return 'Check-in';
        }

        return 'Belum Masuk';
    }

    /**
     * Check if this is a multi-day visitor type that needs daily QR regeneration
     */
    public function isMultiDayVisitor(): bool
    {
        if (!$this->pengajuan) {
            return false;
        }

        $tipeVisitor = $this->pengajuan->tipe_visitor;
        $multiDayTypes = ['Vendor/Kontraktor', 'Pelajar/Magang', 'VIP'];

        return in_array($tipeVisitor, $multiDayTypes);
    }

    /**
     * Check if QR needs to be regenerated today
     */
    public function needsQrRegeneration(): bool
    {
        if (!$this->isMultiDayVisitor()) {
            return false;
        }

        $today = now()->toDateString();
        
        // If never generated today, needs regeneration
        if (!$this->last_qr_generated_date) {
            return true;
        }

        // If last generated today, doesn't need regeneration
        return $this->last_qr_generated_date->toDateString() !== $today;
    }
}