<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Pengajuan;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Admin\LoginPageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengajuanController;
use App\Http\Controllers\Admin\DetailPengajuanController;
use App\Http\Controllers\Admin\RekapKunjunganController;
use App\Http\Controllers\Admin\DetailRekapController;
use App\Http\Controllers\Admin\KelolaPenggunaController;
use App\Http\Controllers\Admin\DailyHistoryController;
use App\Http\Controllers\Petugas\LoginPetugasController;
use App\Http\Controllers\Petugas\DashboardPetugasController;
use App\Http\Controllers\Petugas\ScanPetugasController;
use App\Http\Controllers\Petugas\RiwayatPetugasController;

use App\Http\Controllers\CancelApplicationController;

// ================= HALAMAN AWAL =================
Route::get('/', function () {
    return view('visitor');
});

// alias login untuk middleware auth
Route::get('/login', function () {
    return redirect()->route('petugas.login');
})->name('login');

// ================= STEP 1 =================
Route::get('/step1', function () {
    return view('step1');
});

// ================= STEP 2 =================
Route::get('/step2', function (Request $request) {
    return view('step2', ['data' => $request->all()]);
});

Route::post('/step2', function (Request $request) {
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'instansi' => 'required|string|max:255',
        'nama_pic' => 'required|string|max:255',
        'jabatan_pic' => 'required|string|max:255',
        'no_hp' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'tanggal_kunjungan' => 'required|date',
        'stasiun_kunjungan' => 'required|string|max:255',
        'layanan_pendampingan' => 'required|string|max:255',
    ], [
        'nama.required' => 'Nama lengkap wajib diisi.',
        'instansi.required' => 'Instansi / Perusahaan wajib diisi.',
        'nama_pic.required' => 'Nama PIC wajib diisi.',
        'jabatan_pic.required' => 'Jabatan PIC wajib diisi.',
        'no_hp.required' => 'Nomor Handphone wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'tanggal_kunjungan.required' => 'Tanggal Kunjungan wajib diisi.',
        'stasiun_kunjungan.required' => 'Stasiun Kunjungan wajib dipilih.',
        'layanan_pendampingan.required' => 'Layanan Pendampingan wajib dipilih.',
    ]);

    return redirect('/step3?' . http_build_query($request->all()));
});

// ================= STEP 3 =================
Route::get('/step3', function (Request $request) {
    return view('step3', ['data' => $request->all()]);
});

Route::post('/step3', function (Request $request) {
    return redirect('/step4?' . http_build_query($request->all()));
});

// ================= STEP 4 =================
Route::get('/step4', function (Request $request) {
    return view('step4', ['data' => $request->all()]);
});

Route::post('/step4', function (Request $request) {
    $data = $request->except('document');

    if ($request->hasFile('document')) {
        $data['document'] = $request->file('document')->store('documents', 'public');
    }

    return redirect('/step5?' . http_build_query($data));
});

// ================= STEP 5 =================
Route::get('/step5', function (Request $request) {
    return view('step5', ['data' => $request->all()]);
});

Route::post('/step5', function (Request $request) {
    $requestData = $request->validate([
        'nama' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'no_hp' => ['required', 'string', 'max:20'],
        'instansi' => ['required', 'string', 'max:255'],
        'accessPurpose' => ['required', 'string'],
        'nama_pic' => ['nullable', 'string', 'max:255'],
        'jabatan_pic' => ['nullable', 'string', 'max:255'],
        'tanggal_kunjungan' => ['required', 'date'],
        'tanggal_selesai' => ['nullable', 'date'],
        'stasiun_kunjungan' => ['nullable', 'string', 'max:255'],
        'layanan_pendampingan' => ['nullable', 'string', 'max:255'],
        'accessTime' => ['nullable', 'date_format:H:i'],
        'document' => ['nullable', 'string'],
    ], [
        'nama.required' => 'Nama wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'no_hp.required' => 'Nomor HP wajib diisi.',
        'instansi.required' => 'Instansi wajib diisi.',
        'accessPurpose.required' => 'Tujuan kunjungan wajib diisi.',
        'tanggal_kunjungan.required' => 'Tanggal kunjungan wajib diisi.',
        'accessTime.date_format' => 'Format jam kunjungan harus HH:MM.',
    ]);

    $jamKunjungan = $requestData['accessTime'] ?? '08:00:00';

    if (strlen($jamKunjungan) === 5) {
        $jamKunjungan .= ':00';
    }

    $jumlahPengunjung = (int) ($request->input('jumlah_pengunjung') ?? 1);

    if ($jumlahPengunjung < 1) {
        $jumlahPengunjung = 1;
    }

    $pengajuan = Pengajuan::create([
        'user_id' => auth()->id() ?? 1,
        'nama_pengunjung' => $requestData['nama'],
        'email_pengunjung' => $requestData['email'],
        'no_telepon' => $requestData['no_hp'],
        'asal_institusi' => $requestData['instansi'],
        'tujuan_kunjungan' => $requestData['accessPurpose'],
        'nama_pic' => $requestData['nama_pic'] ?? null,
        'jabatan_pic' => $requestData['jabatan_pic'] ?? null,
        'tanggal_kunjungan' => $requestData['tanggal_kunjungan'],
        'tanggal_selesai' => $requestData['tanggal_selesai'] ?? null,
        'jam_kunjungan' => $jamKunjungan,
        'jumlah_pengunjung' => $jumlahPengunjung,
        'stasiun_kunjungan' => $requestData['stasiun_kunjungan'] ?? null,
        'layanan_pendampingan' => $requestData['layanan_pendampingan'] ?? null,
        'dokumen' => $requestData['document'] ?? null,
        'pintu' => $request->input('accessDoor'),
        'tujuan_akses' => $request->input('accessPurpose'),
        'jumlah_pendamping_protokoler' => $request->input('protocolCount'),
        'jumlah_jenis_kendaraan' => $request->input('vehicle'),
        'nomor_polisi_kendaraan' => $request->input('plate'),
        'butuh_pendampingan_protokoler' => $request->input('needProtocol'),
        'status' => 'Menunggu',
        'catatan_admin' => null,
        'tanggal_disetujui' => null,
        'tanggal_ditolak' => null,
        'disetujui_oleh' => null,
    ]);

    $nomorPengajuan = 'PGJ-' . date('Y') . '-' . $pengajuan->id;

    return redirect('/step6?nomor=' . urlencode($nomorPengajuan));
});

// ================= STEP 6 =================
Route::get('/step6', function (Request $request) {
    return view('step6', [
        'nomor' => $request->get('nomor')
    ]);
});

// ================= CEK STATUS =================
Route::get('/cek-status', function () {
    return view('cek-status');
})->name('cek.status');

Route::post('/cek-status', function (Request $request) {
    $inputNomor = trim((string) $request->input('nomor'));

    if ($inputNomor === '') {
        return back()->with('error', 'Nomor pengajuan wajib diisi.');
    }

    $id = null;

    if (preg_match('/PGJ-\d{4}-(\d+)/', $inputNomor, $matches)) {
        $id = (int) $matches[1];
    } elseif (ctype_digit($inputNomor)) {
        $id = (int) $inputNomor;
    }

    if (!$id) {
        return back()->with('error', 'Format nomor pengajuan tidak valid.');
    }

    $pengajuan = Pengajuan::find($id);

    if (!$pengajuan) {
        return back()->with('error', 'Nomor tidak ditemukan.');
    }

    return redirect()->route('hasil.cek', [
        'nomor' => $inputNomor,
    ]);
});

// ================= CANCEL APPLICATION =================
Route::post('/cancel-application', [CancelApplicationController::class, 'cancel'])->name('cancel.application');

// ================= HASIL CEK =================
Route::get('/hasil-cek', function (Request $request) {
    $inputNomor = trim((string) $request->get('nomor'));
    $id = null;

    if (preg_match('/PGJ-\d{4}-(\d+)/', $inputNomor, $matches)) {
        $id = (int) $matches[1];
    } elseif (ctype_digit($inputNomor)) {
        $id = (int) $inputNomor;
    }

    abort_if(!$id, 404);

    $pengajuan = Pengajuan::find($id);

    if (!$pengajuan) {
        abort(404);
    }

    $status = $pengajuan->status;
    $isApproved = $status === 'Disetujui';
    $qrToken = null;

    // Generate QR Token untuk pengajuan yang disetujui
    if ($isApproved) {
        $visitor = Visitor::where('pengajuan_id', $pengajuan->id)->first();
        
        if (!$visitor) {
            $qrToken = 'VIS-' . $pengajuan->id . '-' . Str::random(12);
            $visitor = Visitor::create([
                'pengajuan_id' => $pengajuan->id,
                'qr_token' => $qrToken,
                'nama_pengunjung' => $pengajuan->nama_pengunjung,
                'email_pengunjung' => $pengajuan->email_pengunjung,
                'asal_institusi' => $pengajuan->asal_institusi,
                'nomor' => $inputNomor,
            ]);
        } else {
            $qrToken = $visitor->qr_token;
        }
    }

    // Generate QR code dengan qr_token (atau inputNomor jika belum disetujui)
    $qrCodeHtml = QrCode::size(200)->generate($qrToken ?? $inputNomor);

    $isRejected = $status === 'Ditolak';
    $isCancelled = $status === 'Dibatalkan';
    $isProcessing = $status === 'Menunggu';

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
        return view('status_proses', compact(
            'pengajuan',
            'qrCodeHtml',
            'statusText',
            'currentColor',
            'inputNomor'
        ));
    }

    if ($isApproved) {
        return view('hasil-cek', compact(
            'pengajuan',
            'qrCodeHtml',
            'statusText',
            'currentColor',
            'inputNomor',
            'qrToken',
            'isApproved',
            'isRejected',
            'isCancelled'
        ));
    }

    if ($isRejected || $isCancelled) {
        return view('status-ditolak', compact(
            'pengajuan',
            'statusText',
            'currentColor',
            'inputNomor',
            'isRejected',
            'isCancelled'
        ));
    }

    return view('status_proses', compact(
        'pengajuan',
        'qrCodeHtml',
        'statusText',
        'currentColor',
        'inputNomor'
    ));
})->name('hasil.cek');

// ================= ADMIN =================
Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginPageController::class, 'index'])->name('admin.login');
    Route::post('/login', [LoginPageController::class, 'login'])->name('admin.login.submit');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/logout', [LoginPageController::class, 'logout'])->name('admin.logout');

        Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('admin.pengajuan');
        Route::get('/pengajuan/{id}', [DetailPengajuanController::class, 'show'])
            ->whereNumber('id')
            ->name('admin.pengajuan.detail');
        Route::post('/pengajuan/{id}/verifikasi', [PengajuanController::class, 'verifikasi'])
            ->whereNumber('id')
            ->name('admin.pengajuan.verifikasi');

        Route::get('/rekap-kunjungan', [RekapKunjunganController::class, 'index'])->name('admin.rekap');
        Route::get('/rekap-kunjungan/export', [RekapKunjunganController::class, 'export'])->name('admin.rekap.export');
        Route::get('/rekap-kunjungan/{id}', [DetailRekapController::class, 'show'])
            ->whereNumber('id')
            ->name('admin.rekap-detail');

        Route::get('/history-harian', [DailyHistoryController::class, 'index'])->name('admin.daily-history');
        Route::get('/history-harian/export', [DailyHistoryController::class, 'export'])->name('admin.daily-history.export');

        Route::get('/kelola-pengguna', [KelolaPenggunaController::class, 'index'])->name('admin.users');
        Route::post('/kelola-pengguna', [KelolaPenggunaController::class, 'store'])->name('admin.users.store');
        Route::put('/kelola-pengguna/{id}', [KelolaPenggunaController::class, 'update'])->name('admin.users.update');
        Route::delete('/kelola-pengguna/{id}', [KelolaPenggunaController::class, 'destroy'])->name('admin.users.destroy');
    });
});

// ================= PETUGAS =================
Route::prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/login', [LoginPetugasController::class, 'index'])->name('login');
    Route::post('/login', [LoginPetugasController::class, 'login'])->name('login.submit');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardPetugasController::class, 'index'])->name('dashboard');
        Route::post('/logout', [LoginPetugasController::class, 'logout'])->name('logout');

        Route::get('/scan', [ScanPetugasController::class, 'scan'])->name('scan');
        Route::post('/scan/process', [ScanPetugasController::class, 'process'])->name('scan.process');
        Route::get('/scan/result/{id}', [ScanPetugasController::class, 'result'])
            ->whereNumber('id')
            ->name('scan.result');

        Route::get('/riwayat', [RiwayatPetugasController::class, 'index'])->name('riwayat');
    });
});