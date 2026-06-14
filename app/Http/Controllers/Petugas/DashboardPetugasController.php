<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\View\View;

class DashboardPetugasController extends Controller
{
    public function index(): View
    {
        $petugasName = auth()->user()->nama ?? auth()->user()->name ?? 'Petugas';

        $checkinCount = Visitor::whereNotNull('waktu_masuk')->count();
        $checkoutCount = Visitor::whereNotNull('waktu_keluar')->count();
        $activeVisitors = Visitor::whereNotNull('waktu_masuk')->whereNull('waktu_keluar')->count();
        $totalVisitors = Visitor::count();

        // Get today's check-ins
        $todayCheckin = Visitor::whereDate('waktu_masuk', today())->whereNotNull('waktu_masuk')->count();
        
        // Get recent activity
        $recentActivity = Visitor::orderBy('waktu_masuk', 'desc')
            ->take(5)
            ->get()
            ->map(function($visitor) {
                return [
                    'nama' => $visitor->nama_pengunjung,
                    'waktu' => $visitor->waktu_masuk ? $visitor->waktu_masuk->format('H:i') : '-',
                    'type' => $visitor->waktu_keluar ? 'checkout' : 'checkin'
                ];
            });

        return view('petugas.dashboard', [
            'petugasName' => $petugasName,
            'checkinCount' => $checkinCount,
            'checkoutCount' => $checkoutCount,
            'activeVisitors' => $activeVisitors,
            'totalVisitors' => $totalVisitors,
            'todayCheckin' => $todayCheckin,
            'recentActivity' => $recentActivity,
        ]);
    }
}