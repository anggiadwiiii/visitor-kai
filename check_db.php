<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Visitor;
use Illuminate\Support\Facades\DB;

echo "=== Check Visitor ID 8 ===\n";
$v = Visitor::find(8);
if ($v) {
    echo "Visitor found!\n";
    echo "ID: {$v->id}\n";
    echo "Nama: {$v->nama_pengunjung}\n";
    echo "waktu_masuk value: " . var_export($v->waktu_masuk, true) . "\n";
    echo "waktu_masuk type: " . gettype($v->waktu_masuk) . "\n";
    echo "waktu_masuk is null: " . (is_null($v->waktu_masuk) ? 'YES' : 'NO') . "\n";
} else {
    echo "Visitor not found!\n";
}

echo "\n=== Raw Database Check ===\n";
$raw = DB::table('visitors')->find(8);
if ($raw) {
    echo "Found in raw query\n";
    echo json_encode($raw, JSON_PRETTY_PRINT) . "\n";
} else {
    echo "Not found in raw query\n";
}

echo "\n=== All visitors where waktu_masuk is NULL (raw SQL) ===\n";
$nullMasuk = DB::table('visitors')->whereNull('waktu_masuk')->get();
echo "Count: " . $nullMasuk->count() . "\n";
foreach($nullMasuk as $item) {
    echo "ID: {$item->id} | Nama: {$item->nama_pengunjung}\n";
}

echo "\n=== ALL visitors ===\n";
$all = DB::table('visitors')->get();
echo "Total: " . $all->count() . "\n";
