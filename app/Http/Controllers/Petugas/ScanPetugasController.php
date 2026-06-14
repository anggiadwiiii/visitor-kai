<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ScanPetugasController extends Controller
{
    public function scan(): View
    {
        return view('petugas.scan');
    }

    public function process(Request $request): RedirectResponse
    {
        $request->validate([
            'qr_token' => ['required', 'string'],
        ], [
            'qr_token.required' => 'QR token wajib diisi.',
        ]);

        $visitor = Visitor::with('pengajuan')
            ->where('qr_token', $request->qr_token)
            ->first();

        if (!$visitor) {
            return back()->withErrors([
                'scan' => 'QR Code tidak valid atau visitor tidak ditemukan.',
            ])->withInput();
        }

        if (!$visitor->pengajuan || $visitor->pengajuan->status !== 'Disetujui') {
            return back()->withErrors([
                'scan' => 'Visitor belum disetujui, tidak bisa diproses.',
            ])->withInput();
        }

        // Handle multi-day visitors - auto-regenerate QR for next day
        if ($visitor->isMultiDayVisitor() && $visitor->isCompleted()) {
            $checkoutDate = $visitor->waktu_keluar->toDateString();
            $today = now()->toDateString();

            // If checked out on a previous day, regenerate QR and reset checkout
            if ($checkoutDate !== $today) {
                $newQrToken = 'VIS-' . $visitor->pengajuan_id . '-' . $today . '-' . Str::random(8);
                
                $visitor->update([
                    'qr_token' => $newQrToken,
                    'waktu_keluar' => null, // Reset checkout to allow new check-in
                    'last_qr_generated_date' => now(),
                ]);

                // Continue with check-in process
            } else {
                // Same day, already checked out - cannot check-in again
                return back()->withErrors([
                    'scan' => 'Visitor ini sudah check-out hari ini. Silakan check-out terlebih dahulu untuk besok.',
                ])->withInput();
            }
        }

        if (is_null($visitor->waktu_masuk)) {
            $visitor->update([
                'waktu_masuk' => now(),
            ]);

            return redirect()->route('petugas.scan.result', [
                'id' => $visitor->id,
                'mode' => 'checkin',
            ]);
        }

        if (is_null($visitor->waktu_keluar)) {
            $visitor->update([
                'waktu_keluar' => now(),
            ]);

            return redirect()->route('petugas.scan.result', [
                'id' => $visitor->id,
                'mode' => 'checkout',
            ]);
        }

        return back()->withErrors([
            'scan' => 'Visitor ini sudah check-out sebelumnya.',
        ])->withInput();
    }

    public function result(Request $request, $id): View
    {
        $visitor = Visitor::with('pengajuan')->findOrFail($id);
        $mode = $request->get('mode', 'checkin');

        return view('petugas.scan-success', [
            'visitor' => [
                'nama' => $visitor->nama_pengunjung ?? '-',
                'instansi' => $visitor->asal_institusi ?? '-',
                'jenis_visitor' => $visitor->pengajuan?->asal_institusi ? 'Visitor' : 'Visitor',
                'waktu' => $mode === 'checkout'
                    ? ($visitor->waktu_keluar ? $visitor->waktu_keluar->translatedFormat('H.i') . ' WIB' : '-')
                    : ($visitor->waktu_masuk ? $visitor->waktu_masuk->translatedFormat('H.i') . ' WIB' : '-'),
            ],
            'mode' => $mode,
        ]);
    }
}