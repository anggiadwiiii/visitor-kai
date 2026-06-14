<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Riwayat Kunjungan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Allow scrolling */
        html, body {
            height: auto;
            width: 100%;
            overflow: auto;
            background: #efefef;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            color: #1f2937;
            margin: 0;
            padding: 0;
        }

        .phone {
            width: 100%;
            max-width: 100%; /* Full width on mobile */
            height: auto;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: visible;
        }

        @media (min-width: 641px) {
            .phone {
                max-width: 420px;
                height: auto;
                min-height: 100vh;
                border-radius: 24px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            }
        }

        .topbar {
            min-height: 56px;
            background: linear-gradient(90deg, #5b3fd3, #d83f93);
            color: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 14px;
            flex-shrink: 0;
        }

        .back {
            font-size: 24px;
            text-decoration: none;
            color: #fff;
            font-weight: 700;
            line-height: 1;
            cursor: pointer;
            position: relative;
            z-index: 10;
        }

        .topbar-title {
            font-size: 16px;
            font-weight: 700;
        }

        /* Area ini yang bisa di-scroll */
        .content {
            flex: 1;
            padding: 16px;
            padding-bottom: max(16px, calc(16px + env(safe-area-inset-bottom)));
            overflow-y: auto;
            overflow-x: hidden;
            background: #fff;
        }

        .content::-webkit-scrollbar { width: 0px; }
        .content::-webkit-scrollbar-track { background: transparent; }

        .tabs {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 14px;
        }

        .tab {
            height: 46px;
            border-radius: 14px;
            border: 1px solid #d1d5db;
            background: #f9fafb;
            color: #4b5563;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .tab.active {
            background: #4f86d9;
            color: #fff;
            border-color: #4f86d9;
            box-shadow: 0 6px 14px rgba(79, 134, 217, 0.22);
        }

        .search-box {
            position: relative;
            margin-bottom: 18px;
        }

        .search-input {
            width: 100%;
            height: 46px;
            border: 1px solid #d1d5db;
            border-radius: 14px;
            padding: 0 44px 0 14px;
            font-size: 14px;
            font-family: inherit;
            outline: none;
            background: #f9fafb;
        }

        .search-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #6b7280;
        }

        .table-wrap {
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        thead th {
            text-align: left;
            font-size: 13px;
            font-weight: 700;
            color: #111827;
            padding: 0 12px 6px;
        }

        tbody tr { background: #f3f4f6; }

        tbody td {
            padding: 14px 12px;
            font-size: 13px;
            vertical-align: middle;
            font-weight: 600;
        }

        tbody tr td:first-child { border-top-left-radius: 14px; border-bottom-left-radius: 14px; width: 40%; }
        tbody tr td:last-child { border-top-right-radius: 14px; border-bottom-right-radius: 14px; width: 30%; }

        .nama { font-weight: 700; word-break: break-word; }
        .tanggal { color: #6b7280; font-size: 11px; display: block; }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 34px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .badge-in { background: #e4d45a; color: #6a5b00; }
        .badge-out { background: #ff6b6b; color: #fff; }

        .empty-state {
            text-align: center;
            padding: 22px 14px;
            color: #6b7280;
            background: #f9fafb;
            border-radius: 14px;
        }
    </style>
</head>
<body>
    <div class="phone">
        <div class="topbar">
            <a href="{{ route('petugas.dashboard') }}" class="back">‹</a>
            <div class="topbar-title">Riwayat Kunjungan</div>
        </div>

        <div class="content">
            <div class="tabs">
                <a href="{{ route('petugas.riwayat', ['filter' => 'semua', 'search' => $search]) }}"
                   class="tab {{ $filter === 'semua' ? 'active' : '' }}">Semua</a>
                <a href="{{ route('petugas.riwayat', ['filter' => 'checkin', 'search' => $search]) }}"
                   class="tab {{ $filter === 'checkin' ? 'active' : '' }}">Check-in</a>
                <a href="{{ route('petugas.riwayat', ['filter' => 'checkout', 'search' => $search]) }}"
                   class="tab {{ $filter === 'checkout' ? 'active' : '' }}">Check-out</a>
            </div>

            <form method="GET" action="{{ route('petugas.riwayat') }}" class="search-box">
                <input type="hidden" name="filter" value="{{ $filter }}">
                <input type="text" name="search" class="search-input" placeholder="Cari nama visitor..." value="{{ $search }}">
                <span class="search-icon">⌕</span>
            </form>

            @if(count($riwayat) > 0)
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayat as $item)
                                <tr>
                                    <td class="nama">{{ $item['nama'] }}</td>
                                    <td class="tanggal">{{ $item['tanggal'] }}</td>
                                    <td>
                                        <span class="badge {{ $item['keterangan'] === 'Check-in' ? 'badge-in' : 'badge-out' }}">
                                            {{ $item['keterangan'] }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">Belum ada data riwayat.</div>
            @endif
        </div>
    </div>
</body>
</html>