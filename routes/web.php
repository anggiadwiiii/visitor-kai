<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Visitor;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Admin\LoginPageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengajuanController;
use App\Http\Controllers\Admin\DetailPengajuanController;
use App\Http\Controllers\Admin\RekapKunjunganController;
use App\Http\Controllers\Admin\DetailRekapController;
use App\Http\Controllers\Admin\KelolaPenggunaController;

// ================= HALAMAN AWAL =================
Route::get('/', function () {
    return view('visitor');
});

// ================= STEP 1 =================
Route::get('/step1', function () {
    return view('step1');
});

// ================= STEP 2 =================
Route::get('/step2', function (Request $r) {
    return view('step2', ['data' => $r->all()]);
});

Route::post('/step2', function (Request $r) {
    return redirect('/step3?' . http_build_query($r->all()));
});

// ================= STEP 3 =================
Route::get('/step3', function (Request $r) {
    return view('step3', ['data' => $r->all()]);
});

Route::post('/step3', function (Request $r) {
    return redirect('/step4?' . http_build_query($r->all()));
});

// ================= STEP 4 =================
Route::get('/step4', function (Request $r) {
    return view('step4', ['data' => $r->all()]);
});

Route::post('/step4', function (Request $r) {
    $data = $r->except('document');

    if ($r->hasFile('document')) {
        $data['document'] = $r->file('document')->store('documents', 'public');
    }

    return redirect('/step5?' . http_build_query($data));
});

// ================= STEP 5 =================
Route::get('/step5', function (Request $r) {
    return view('step5', ['data' => $r->all()]);
});

Route::post('/step5', function (Request $r) {
    $nomor = 'VST-' . date('Y') . '-' . strtoupper(Str::random(6));

    $data = $r->all();
    $data['nomor'] = $nomor;
    $data['status'] = 'processing';

    $data['pintu'] = $data['accessDoor'] ?? null;
    $data['waktu_akses'] = $data['accessTime'] ?? null;
    $data['tujuan_akses'] = $data['accessPurpose'] ?? null;
    $data['jumlah_kendaraan'] = $data['vehicle'] ?? null;
    $data['nomor_polisi'] = $data['plate'] ?? null;

    unset(
        $data['accessDoor'],
        $data['accessTime'],
        $data['accessPurpose'],
        $data['vehicle'],
        $data['plate']
    );

    Visitor::create($data);

    return redirect('/step6?nomor=' . $nomor);
});

// ================= STEP 6 =================
Route::get('/step6', function () {
    return view('step6', [
        'nomor' => request('nomor')
    ]);
});

// ================= CEK STATUS =================
Route::get('/cek-status', function () {
    return view('cek-status');
})->name('cek.status');

Route::post('/cek-status', function (Request $r) {
    $visitor = Visitor::where('nomor', $r->nomor)->first();

    if (!$visitor) {
        return back()->with('error', 'Nomor tidak ditemukan');
    }

    return redirect()->route('hasil.cek', [
        'nomor' => $visitor->nomor
    ]);
});

// ================= HASIL CEK =================
Route::get('/hasil-cek', function () {
    $visitor = Visitor::where('nomor', request('nomor'))->first();

    if (!$visitor) {
        abort(404);
    }

    $qrCodeHtml = QrCode::size(200)->generate($visitor->nomor);

    $status = $visitor->status;

    $isApproved = $status === 'approved';
    $isRejected = $status === 'rejected';
    $isCancelled = $status === 'cancelled';
    $isProcessing = $status === 'processing';

    $currentColor = $isCancelled
        ? '#7A7A7A'
        : ($isApproved ? '#14AE5C' : ($isRejected ? '#E54000' : '#FFC107'));

    $statusText = $isApproved
        ? 'Permohonan Disetujui'
        : ($isRejected
            ? 'Permohonan Ditolak'
            : ($isCancelled
                ? 'Permohonan Dibatalkan'
                : 'Permohonan Sedang Diproses'));

    if ($isProcessing) {
        return view('status_proses', compact('visitor', 'qrCodeHtml', 'statusText', 'currentColor'));
    } elseif ($isApproved) {
        return view('hasil-cek', compact('visitor', 'qrCodeHtml', 'statusText', 'currentColor'));
    } elseif ($isRejected || $isCancelled) {
        return view('status-ditolak', compact('visitor', 'statusText'));
    }

    return view('status_proses', compact('visitor', 'qrCodeHtml', 'statusText', 'currentColor'));
})->name('hasil.cek');

// ================= ADMIN =================
Route::prefix('admin')->group(function () {
    // Login (tidak perlu auth)
    Route::get('/login', [LoginPageController::class, 'index'])->name('admin.login');
    Route::post('/login', [LoginPageController::class, 'login'])->name('admin.login.submit');

    // Route yang butuh auth
    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/logout', [LoginPageController::class, 'logout'])->name('admin.logout');

        // Pengajuan
        Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('admin.pengajuan');
        Route::get('/pengajuan/{id}', [DetailPengajuanController::class, 'show'])
            ->whereNumber('id')
            ->name('admin.pengajuan.detail');
        Route::post('/pengajuan/{id}/verifikasi', [DetailPengajuanController::class, 'verifikasi'])
            ->whereNumber('id')
            ->name('admin.pengajuan.verifikasi');

        // Rekap kunjungan
        Route::get('/rekap-kunjungan', [RekapKunjunganController::class, 'index'])->name('admin.rekap');
        Route::get('/rekap-kunjungan/export', [RekapKunjunganController::class, 'export'])->name('admin.rekap.export');
        Route::get('/rekap-kunjungan/{id}', [DetailRekapController::class, 'show'])
            ->whereNumber('id')
            ->name('admin.rekap.detail');

        // Kelola pengguna
        Route::get('/kelola-pengguna', [KelolaPenggunaController::class, 'index'])->name('admin.users');
        Route::post('/kelola-pengguna', [KelolaPenggunaController::class, 'store'])->name('admin.users.store');
        Route::put('/kelola-pengguna/{id}', [KelolaPenggunaController::class, 'update'])->name('admin.users.update');
        Route::delete('/kelola-pengguna/{id}', [KelolaPenggunaController::class, 'destroy'])->name('admin.users.destroy');
    });
});