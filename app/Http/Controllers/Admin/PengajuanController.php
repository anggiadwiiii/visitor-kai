<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PengajuanController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->get('search', ''));

        $query = Pengajuan::with(['user', 'approvedBy'])
            ->where('status', 'Menunggu');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama_pengunjung', 'like', "%{$search}%")
                    ->orWhere('email_pengunjung', 'like', "%{$search}%")
                    ->orWhere('asal_institusi', 'like', "%{$search}%")
                    ->orWhere('tujuan_kunjungan', 'like', "%{$search}%");
            });
        }

        $pengajuan = $query->latest()->get();

        $adminName = auth()->user()->nama ?? auth()->user()->name ?? session('admin_username', 'Admin');
        $pengajuanCount = Pengajuan::where('status', 'Menunggu')->count();

        return view('admin.index', compact(
            'pengajuan',
            'search',
            'adminName',
            'pengajuanCount'
        ));
    }

    public function show($id): View
    {
        $pengajuan = Pengajuan::with(['user', 'visitors', 'approvedBy'])->findOrFail($id);

        $adminName = auth()->user()->nama ?? auth()->user()->name ?? 'Admin';
        $pengajuanCount = Pengajuan::where('status', 'Menunggu')->count();

        $data = [
            'id' => $pengajuan->id,
            'nama' => $pengajuan->nama_pengunjung ?? '-',
            'jenis' => 'Pemohon Kunjungan',
            'instansi' => $pengajuan->asal_institusi ?? '-',
            'nomor' => 'PGJ-' . str_pad((string) $pengajuan->id, 5, '0', STR_PAD_LEFT),
            'penanggung_jawab' => $pengajuan->nama_pengunjung ?? '-',
            'jabatan_pic' => $pengajuan->jabatan_pic ?? 'Tidak tersedia',
            'stasiun_kunjungan' => $pengajuan->stasiun_kunjungan ?? 'Tidak tersedia',
            'dokumen' => $pengajuan->dokumen ?? 'Tidak tersedia',
            'tanggal_mulai' => $pengajuan->tanggal_kunjungan
                ? $pengajuan->tanggal_kunjungan->translatedFormat('d F Y')
                : '-',
            'tanggal_selesai' => $pengajuan->tanggal_kunjungan
                ? $pengajuan->tanggal_kunjungan->translatedFormat('d F Y')
                : '-',
            'tujuan' => $pengajuan->tujuan_kunjungan ?? '-',
            'status' => $this->mapStatusToBlade($pengajuan->status),
            'catatan' => $pengajuan->catatan_admin,
        ];

        return view('admin.detail', compact(
            'data',
            'adminName',
            'pengajuanCount'
        ));
    }

    public function verifikasi(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'aksi' => ['required', 'in:approved,rejected'],
            'catatan' => ['nullable', 'string', 'max:1000'],
        ], [
            'aksi.required' => 'Aksi verifikasi wajib dipilih.',
            'aksi.in' => 'Aksi verifikasi tidak valid.',
            'catatan.string' => 'Catatan harus berupa teks.',
            'catatan.max' => 'Catatan maksimal 1000 karakter.',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);

        if ($pengajuan->status !== 'Menunggu') {
            return redirect()
                ->back()
                ->with('error', 'Pengajuan sudah diproses sebelumnya.');
        }

        if ($request->aksi === 'approved') {
            DB::transaction(function () use ($pengajuan, $request) {
                $pengajuan->update([
                    'status' => 'Disetujui',
                    'disetujui_oleh' => auth()->id(),
                    'tanggal_disetujui' => now(),
                    'tanggal_ditolak' => null,
                    'catatan_admin' => $request->catatan,
                ]);
            });

            return redirect()
                ->route('admin.pengajuan.detail', $pengajuan->id)
                ->with('success', 'Pengajuan berhasil disetujui.');
        }

        if (blank($request->catatan)) {
            return redirect()
                ->back()
                ->withErrors([
                    'catatan' => 'Catatan admin wajib diisi saat menolak pengajuan.',
                ])
                ->withInput();
        }

        DB::transaction(function () use ($pengajuan, $request) {
            $pengajuan->update([
                'status' => 'Ditolak',
                'disetujui_oleh' => auth()->id(),
                'tanggal_ditolak' => now(),
                'tanggal_disetujui' => null,
                'catatan_admin' => $request->catatan,
            ]);
        });

        return redirect()
            ->route('admin.pengajuan.detail', $pengajuan->id)
            ->with('success', 'Pengajuan berhasil ditolak.');
    }

    public function approve(Request $request, $id): RedirectResponse
    {
        $request->merge([
            'aksi' => 'approved',
            'catatan' => $request->catatan_admin,
        ]);

        return $this->verifikasi($request, $id);
    }

    public function reject(Request $request, $id): RedirectResponse
    {
        $request->merge([
            'aksi' => 'rejected',
            'catatan' => $request->catatan_admin,
        ]);

        return $this->verifikasi($request, $id);
    }

    private function mapStatusToBlade(?string $status): string
    {
        return match ($status) {
            'Disetujui' => 'approved',
            'Ditolak' => 'rejected',
            default => 'processing',
        };
    }
}