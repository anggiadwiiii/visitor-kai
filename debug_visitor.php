<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Visitor;
use App\Models\Pengajuan;

echo "=== Checking Pengajuan Status ===\n";
$approved = Pengajuan::where('status', 'Disetujui')->get();
echo "Total Pengajuan Disetujui: " . $approved->count() . "\n";
foreach($approved as $p) {
    echo "ID: {$p->id} | Nama: {$p->nama_pengunjung} | Status: {$p->status}\n";
}

echo "\n=== Creating Fresh Visitor Manually ===\n";
if ($approved->count() > 0) {
    $freshPengajuan = $approved->first();
    echo "Using Pengajuan ID: {$freshPengajuan->id}\n";
    
    $freshVisitor = Visitor::create([
        'pengajuan_id' => $freshPengajuan->id,
        'qr_token' => 'VIS-FRESH-' . rand(1000, 9999),
        'nama_pengunjung' => 'Test Fresh Visitor ' . now()->timestamp,
        'email_pengunjung' => 'test.fresh' . rand(1,9999) . '@example.com',
        'no_identitas' => '3201' . str_pad(rand(10000, 99999), 5, '0', STR_PAD_LEFT),
        'jenis_identitas' => 'KTP',
        'waktu_masuk' => null,
        'waktu_keluar' => null,
        'asal_institusi' => $freshPengajuan->asal_institusi,
        'keterangan' => 'Belum check-in',
    ]);
    
    echo "Fresh Visitor Created!\n";
    echo "ID: {$freshVisitor->id} | QR Token: {$freshVisitor->qr_token}\n";
    echo "Waktu Masuk: " . ($freshVisitor->waktu_masuk ? $freshVisitor->waktu_masuk->format('Y-m-d H:i') : 'NULL') . "\n";
} else {
    echo "Tidak ada pengajuan yang disetujui!\n";
}

echo "\n=== All Fresh Visitors ===\n";
$fresh = Visitor::where('waktu_masuk', null)->get();
echo "Total: " . $fresh->count() . "\n";
foreach($fresh as $v) {
    echo "ID: {$v->id} | Nama: {$v->nama_pengunjung} | QR: {$v->qr_token}\n";
}
