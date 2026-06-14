<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DailyHistoryController extends Controller
{
    public function index(Request $request): View
    {
        $selectedDate = $request->get('tanggal') 
            ? Carbon::createFromFormat('Y-m-d', $request->get('tanggal'))
            : Carbon::today();

        $visitors = Visitor::whereDate('waktu_masuk', $selectedDate)
            ->with('pengajuan')
            ->orderBy('waktu_masuk', 'asc')
            ->get();

        // Calculate statistics
        $totalKunjungan = $visitors->count();
        $totalMasuk = $visitors->whereNotNull('waktu_masuk')->count();
        $totalKeluar = $visitors->whereNotNull('waktu_keluar')->count();
        $aktifSekarang = $visitors->whereNotNull('waktu_masuk')->whereNull('waktu_keluar')->count();

        // Average duration for completed visitors
        $completedVisitors = $visitors->filter(function ($v) {
            return $v->waktu_masuk && $v->waktu_keluar;
        });

        $avgDuration = 0;
        if ($completedVisitors->count() > 0) {
            $totalDuration = 0;
            foreach ($completedVisitors as $v) {
                $totalDuration += $v->waktu_keluar->diffInMinutes($v->waktu_masuk);
            }
            $avgDuration = round($totalDuration / $completedVisitors->count());
        }

        // Format visitors data for display
        $visitorList = $visitors->map(function ($v) {
            $masuk = $v->waktu_masuk ? $v->waktu_masuk->format('H:i:s') : '-';
            $keluar = $v->waktu_keluar ? $v->waktu_keluar->format('H:i:s') : '-';
            
            $durasi = '-';
            if ($v->waktu_masuk && $v->waktu_keluar) {
                $minutes = $v->waktu_keluar->diffInMinutes($v->waktu_masuk);
                $hours = intdiv($minutes, 60);
                $mins = $minutes % 60;
                $durasi = sprintf('%dj %dm', $hours, $mins);
            }

            $status = 'Belum Masuk';
            if ($v->waktu_keluar) {
                $status = 'Check-out';
            } elseif ($v->waktu_masuk) {
                $status = 'Check-in';
            }

            return [
                'id' => $v->id,
                'nama' => $v->nama_pengunjung,
                'instansi' => $v->asal_institusi ?? '-',
                'qr_token' => $v->qr_token,
                'jam_masuk' => $masuk,
                'jam_keluar' => $keluar,
                'durasi' => $durasi,
                'status' => $status,
                'status_color' => $v->waktu_keluar ? 'success' : ($v->waktu_masuk ? 'primary' : 'secondary'),
                'tipe_visitor' => $v->pengajuan?->tipe_visitor ?? '-',
            ];
        });

        return view('admin.daily-history', [
            'selectedDate' => $selectedDate,
            'visitors' => $visitorList,
            'totalKunjungan' => $totalKunjungan,
            'totalMasuk' => $totalMasuk,
            'totalKeluar' => $totalKeluar,
            'aktifSekarang' => $aktifSekarang,
            'avgDuration' => $avgDuration,
        ]);
    }

    public function export(Request $request)
    {
        $selectedDate = $request->get('tanggal')
            ? Carbon::createFromFormat('Y-m-d', $request->get('tanggal'))
            : Carbon::today();

        $visitors = Visitor::whereDate('waktu_masuk', $selectedDate)
            ->with('pengajuan')
            ->orderBy('waktu_masuk', 'asc')
            ->get();

        // Create CSV
        $filename = 'history-kunjungan-' . $selectedDate->format('Y-m-d') . '.csv';
        $handle = fopen('php://memory', 'r+');

        // Header
        fputcsv($handle, ['No', 'Nama Pengunjung', 'Instansi', 'Jam Masuk', 'Jam Keluar', 'Durasi', 'QR Token', 'Tipe Visitor']);

        // Data
        $no = 1;
        foreach ($visitors as $v) {
            $masuk = $v->waktu_masuk ? $v->waktu_masuk->format('H:i:s') : '-';
            $keluar = $v->waktu_keluar ? $v->waktu_keluar->format('H:i:s') : '-';
            
            $durasi = '-';
            if ($v->waktu_masuk && $v->waktu_keluar) {
                $minutes = $v->waktu_keluar->diffInMinutes($v->waktu_masuk);
                $hours = intdiv($minutes, 60);
                $mins = $minutes % 60;
                $durasi = sprintf('%dj %dm', $hours, $mins);
            }

            fputcsv($handle, [
                $no++,
                $v->nama_pengunjung,
                $v->asal_institusi ?? '-',
                $masuk,
                $keluar,
                $durasi,
                $v->qr_token,
                $v->pengajuan?->tipe_visitor ?? '-',
            ]);
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', "attachment; filename=\"$filename\"");
    }
}
