<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CancelApplicationController extends Controller
{
    public function cancel(Request $request): JsonResponse
    {
        try {
            $inputNomor = trim((string) $request->input('nomor'));
            $id = null;

            if (preg_match('/PGJ-\d{4}-(\d+)/', $inputNomor, $matches)) {
                $id = (int) $matches[1];
            } elseif (ctype_digit($inputNomor)) {
                $id = (int) $inputNomor;
            }

            if (!$id) {
                return response()->json(
                    ['success' => false, 'message' => 'Nomor pengajuan tidak valid'],
                    400
                );
            }

            $pengajuan = Pengajuan::find($id);
            if (!$pengajuan) {
                return response()->json(
                    ['success' => false, 'message' => 'Pengajuan tidak ditemukan'],
                    404
                );
            }

            // Hanya status Menunggu yang bisa dibatalkan
            if ($pengajuan->status !== 'Menunggu') {
                return response()->json(
                    ['success' => false, 'message' => 'Hanya pengajuan yang sedang menunggu yang bisa dibatalkan'],
                    400
                );
            }

            // Update status pengajuan
            $pengajuan->update([
                'status' => 'Dibatalkan',
                'tanggal_ditolak' => now(),
            ]);

            // Create visitor record dengan status Dibatalkan
            try {
                $uniqueId = 'BATAL-' . time() . '-' . $pengajuan->id;
                Visitor::create([
                    'pengajuan_id' => $pengajuan->id,
                    'nama_pengunjung' => $pengajuan->nama_pengunjung,
                    'email_pengunjung' => $pengajuan->email_pengunjung,
                    'no_identitas' => $uniqueId,
                    'jenis_identitas' => 'Lainnya',
                    'waktu_masuk' => now(),
                    'asal_institusi' => $pengajuan->asal_institusi,
                    'keterangan' => 'Pengajuan dibatalkan oleh pemohon',
                ]);
            } catch (\Exception $e) {
                \Log::error('Error creating visitor record: ' . $e->getMessage());
                // Continue - pembatalan pengajuan tetap berhasil
            }

            return response()->json(
                ['success' => true, 'message' => 'Pengajuan berhasil dibatalkan'],
                200
            );
        } catch (\Exception $e) {
            \Log::error('Cancel application error: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            return response()->json(
                ['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()],
                500
            );
        }
    }
}
