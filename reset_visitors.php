<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Visitor;

echo "Truncating visitors table...\n";
Visitor::truncate();
echo "Done!\n";

echo "\nRunning VisitorSeeder...\n";
$seeder = new \Database\Seeders\VisitorSeeder();
$seeder->run();
echo "Seeder completed!\n";

echo "\n=== Fresh Visitors (belum check-in) ===\n";
$visitors = Visitor::where('waktu_masuk', null)->get();
echo "Total: " . $visitors->count() . "\n";
foreach($visitors as $v) {
    echo "ID: {$v->id} | Nama: {$v->nama_pengunjung} | QR: {$v->qr_token}\n";
}
