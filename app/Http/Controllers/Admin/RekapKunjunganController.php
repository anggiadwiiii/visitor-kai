<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RekapKunjunganController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->get('search', ''));
        $tanggal = trim((string) $request->get('tanggal', ''));
        $dateFrom = trim((string) $request->get('date_from', ''));
        $dateTo = trim((string) $request->get('date_to', ''));
        $status = trim((string) $request->get('status', ''));

        $query = Visitor::with('pengajuan');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama_pengunjung', 'like', "%{$search}%")
                    ->orWhere('email_pengunjung', 'like', "%{$search}%")
                    ->orWhere('asal_institusi', 'like', "%{$search}%")
                    ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        if ($tanggal !== '') {
            $query->whereDate('created_at', $tanggal);
        }

        if ($dateFrom !== '') {
            $query->whereDate('created_at', '>=', $dateFrom);
        }

        if ($dateTo !== '') {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        if ($status !== '') {
            if ($status === 'checkin') {
                $query->whereNotNull('waktu_masuk');
            } elseif ($status === 'checkout') {
                $query->whereNotNull('waktu_keluar');
            } elseif ($status === 'aktif') {
                $query->whereNotNull('waktu_masuk')->whereNull('waktu_keluar');
            }
        }

        $rows = $query->latest()->get();

        $kunjungan = $rows->map(function (Visitor $item) {
            return [
                'id' => $item->id,
                'nama' => $item->nama_pengunjung ?? '-',
                'tanggal' => $item->created_at
                    ? $item->created_at->translatedFormat('d F Y')
                    : '-',
                'keterangan' => $item->getStatus(),
            ];
        });

        $summaryQuery = Visitor::query();

        if ($search !== '') {
            $summaryQuery->where(function ($q) use ($search) {
                $q->where('nama_pengunjung', 'like', "%{$search}%")
                    ->orWhere('email_pengunjung', 'like', "%{$search}%")
                    ->orWhere('asal_institusi', 'like', "%{$search}%")
                    ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        if ($tanggal !== '') {
            $summaryQuery->whereDate('created_at', $tanggal);
        }

        if ($dateFrom !== '') {
            $summaryQuery->whereDate('created_at', '>=', $dateFrom);
        }

        if ($dateTo !== '') {
            $summaryQuery->whereDate('created_at', '<=', $dateTo);
        }

        $summary = [
            'total' => (clone $summaryQuery)->count(),
            'checkin' => (clone $summaryQuery)->whereNotNull('waktu_masuk')->count(),
            'checkout' => (clone $summaryQuery)->whereNotNull('waktu_keluar')->count(),
        ];

        $adminName = auth()->user()->nama ?? auth()->user()->name ?? session('admin_username', 'Admin');
        $pengajuanCount = Pengajuan::where('status', 'Menunggu')->count();

        return view('admin.rekap', [
            'adminName' => $adminName,
            'pengajuanCount' => $pengajuanCount,
            'summary' => $summary,
            'search' => $search,
            'tanggal' => $tanggal,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'status' => $status,
            'kunjungan' => $kunjungan,
        ]);
    }

    public function export(Request $request): StreamedResponse
    {
        $search = trim((string) $request->get('search', ''));
        $tanggal = trim((string) $request->get('tanggal', ''));
        $dateFrom = trim((string) $request->get('date_from', ''));
        $dateTo = trim((string) $request->get('date_to', ''));
        $status = trim((string) $request->get('status', ''));

        $query = Visitor::with('pengajuan');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama_pengunjung', 'like', "%{$search}%")
                    ->orWhere('email_pengunjung', 'like', "%{$search}%")
                    ->orWhere('asal_institusi', 'like', "%{$search}%")
                    ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        if ($tanggal !== '') {
            $query->whereDate('created_at', $tanggal);
        }

        if ($dateFrom !== '') {
            $query->whereDate('created_at', '>=', $dateFrom);
        }

        if ($dateTo !== '') {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        if ($status !== '') {
            if ($status === 'checkin') {
                $query->whereNotNull('waktu_masuk');
            } elseif ($status === 'checkout') {
                $query->whereNotNull('waktu_keluar');
            } elseif ($status === 'aktif') {
                $query->whereNotNull('waktu_masuk')->whereNull('waktu_keluar');
            }
        }

        $rows = $query->latest()->get();

        $filename = 'rekap_kunjungan_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($rows) {
            $handle = fopen('php://output', 'w');

            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($handle, [
                'Nama',
                'Email',
                'Instansi',
                'Tanggal Dibuat',
                'Waktu Masuk',
                'Waktu Keluar',
                'Status',
                'Keterangan',
            ]);

            foreach ($rows as $item) {
                fputcsv($handle, [
                    $item->nama_pengunjung,
                    $item->email_pengunjung,
                    $item->asal_institusi,
                    optional($item->created_at)->format('d-m-Y H:i'),
                    optional($item->waktu_masuk)->format('d-m-Y H:i'),
                    optional($item->waktu_keluar)->format('d-m-Y H:i'),
                    $item->getStatus(),
                    $item->keterangan,
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}