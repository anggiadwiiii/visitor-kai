<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(): View
    {
        $today = Carbon::today();
        $admin = Auth::user();

        $pengajuanBaru = Pengajuan::where('status', 'Menunggu')->count();
        $disetujui = Pengajuan::where('status', 'Disetujui')->count();
        $ditolak = Pengajuan::where('status', 'Ditolak')->count();
        $selesai = Pengajuan::where('status', 'Selesai')->count();

        $pengunjungHariIni = Visitor::whereDate('waktu_masuk', $today)->count();
        $pengunjungAktif = Visitor::whereNotNull('waktu_masuk')
            ->whereNull('waktu_keluar')
            ->count();

        $totalPengajuan = Pengajuan::count();
        $totalKunjungan = Visitor::count();

        $stats = [
            'pengajuan_baru' => $pengajuanBaru,
            'disetujui' => $disetujui,
            'pengunjung_hari_ini' => $pengunjungHariIni,
            'pengunjung_aktif' => $pengunjungAktif,
        ];

        $aktivitasTerbaru = collect();

        $pengajuanList = Pengajuan::latest()->take(5)->get();
        foreach ($pengajuanList as $item) {
            $aktivitasTerbaru->push([
                'title' => match ($item->status) {
                    'Disetujui' => 'Pengajuan disetujui: ' . $item->nama_pengunjung,
                    'Ditolak' => 'Pengajuan ditolak: ' . $item->nama_pengunjung,
                    'Selesai' => 'Kunjungan selesai: ' . $item->nama_pengunjung,
                    default => 'Pengajuan baru dari ' . $item->nama_pengunjung,
                },
                'time' => optional($item->updated_at ?? $item->created_at)?->diffForHumans() ?? 'Baru saja',
                'sort_time' => $item->updated_at ?? $item->created_at,
            ]);
        }

        $visitorMasuk = Visitor::whereNotNull('waktu_masuk')
            ->latest('waktu_masuk')
            ->take(5)
            ->get();

        foreach ($visitorMasuk as $item) {
            $aktivitasTerbaru->push([
                'title' => 'Pengunjung masuk: ' . $item->nama_pengunjung,
                'time' => optional($item->waktu_masuk)?->diffForHumans() ?? 'Baru saja',
                'sort_time' => $item->waktu_masuk,
            ]);
        }

        $visitorKeluar = Visitor::whereNotNull('waktu_keluar')
            ->latest('waktu_keluar')
            ->take(5)
            ->get();

        foreach ($visitorKeluar as $item) {
            $aktivitasTerbaru->push([
                'title' => 'Pengunjung keluar: ' . $item->nama_pengunjung,
                'time' => optional($item->waktu_keluar)?->diffForHumans() ?? 'Baru saja',
                'sort_time' => $item->waktu_keluar,
            ]);
        }

        $aktivitasTerbaru = $aktivitasTerbaru
            ->sortByDesc('sort_time')
            ->take(6)
            ->values()
            ->map(function ($item) {
                return [
                    'title' => $item['title'],
                    'time' => $item['time'],
                ];
            })
            ->toArray();

        $approvalRate = $totalPengajuan > 0
            ? round(($disetujui / $totalPengajuan) * 100)
            : 0;

        $quickActions = [
            [
                'label' => 'Lihat Pengajuan',
                'route' => route('admin.pengajuan'),
                'count' => $pengajuanBaru,
            ],
            [
                'label' => 'Rekap Data',
                'route' => route('admin.rekap'),
                'count' => $pengunjungHariIni,
            ],
            [
                'label' => 'Kelola Admin',
                'route' => route('admin.users'),
                'count' => null,
            ],
            [
                'label' => 'Refresh',
                'route' => route('admin.dashboard'),
                'count' => null,
            ],
        ];

        $insight = [
            [
                'label' => 'Approval Rate',
                'value' => $approvalRate . '%',
                'change' => $totalPengajuan . ' total pengajuan',
            ],
            [
                'label' => 'Pengajuan Ditolak',
                'value' => $ditolak,
                'change' => 'Status ditolak',
            ],
            [
                'label' => 'Total Kunjung',
                'value' => $totalKunjungan,
                'change' => 'Semua data visitor',
            ],
            [
                'label' => 'Kunjungan Selesai',
                'value' => $selesai,
                'change' => 'Status selesai',
            ],
        ];

        $chartRaw = collect(range(6, 0))->map(function ($dayOffset) {
            $date = now()->subDays($dayOffset);

            return [
                'label' => $date->translatedFormat('D'),
                'total' => Visitor::whereDate('waktu_masuk', $date->toDateString())->count(),
            ];
        });

        $maxTotal = $chartRaw->max('total') ?: 1;

        $chartData = $chartRaw->map(function ($item) use ($maxTotal) {
            return [
                'label' => $item['label'],
                'total' => $item['total'],
                'width' => max(8, round(($item['total'] / $maxTotal) * 100)),
            ];
        })->toArray();

        return view('admin.dashboard', [
            'adminName' => $admin?->name ?? 'Admin',
            'pengajuanCount' => $pengajuanBaru,
            'stats' => $stats,
            'aktivitasTerbaru' => $aktivitasTerbaru,
            'quickActions' => $quickActions,
            'insight' => $insight,
            'chartData' => $chartData,
        ]);
    }
}