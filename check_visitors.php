<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Visitor;

echo "=== Fresh Visitors (belum check-in) ===\n";
$visitors = Visitor::where('waktu_masuk', null)->get();
foreach($visitors as $v) {
    echo "ID: {$v->id} | Nama: {$v->nama_pengunjung} | QR: {$v->qr_token} | Masuk: {$v->waktu_masuk}\n";
}

echo "\n=== All Visitors ===\n";
$all = Visitor::limit(20)->get();
foreach($all as $v) {
    echo "ID: {$v->id} | Nama: {$v->nama_pengunjung} | Masuk: " . ($v->waktu_masuk ? $v->waktu_masuk->format('Y-m-d H:i') : 'null') . "\n";
}
