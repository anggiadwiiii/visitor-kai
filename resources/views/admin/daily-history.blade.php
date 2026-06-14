<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Kunjungan Harian - Visitor Management</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #5b3fd3 0%, #2d1b4e 100%);
            min-height: 100vh;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .header h1 {
            color: white;
            font-size: 28px;
            font-weight: 600;
        }

        .back-link {
            color: white;
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            transition: 0.3s;
        }

        .back-link:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .filter-section {
            display: flex;
            gap: 12px;
            margin-bottom: 25px;
            align-items: center;
            flex-wrap: wrap;
        }

        .date-picker {
            padding: 10px 16px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            width: 180px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: 0.3s;
            font-weight: 500;
        }

        .btn-primary {
            background: linear-gradient(135deg, #5b3fd3 0%, #7e57c2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(91, 63, 211, 0.3);
        }

        .btn-success {
            background: #14ae5c;
            color: white;
        }

        .btn-success:hover {
            background: #0d8a47;
            transform: translateY(-2px);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-left: 4px solid #5b3fd3;
        }

        .stat-card.masuk {
            border-left-color: #14ae5c;
        }

        .stat-card.keluar {
            border-left-color: #e54000;
        }

        .stat-card.aktif {
            border-left-color: #ffc107;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #5b3fd3;
            margin: 10px 0;
        }

        .stat-card.masuk .stat-value {
            color: #14ae5c;
        }

        .stat-card.keluar .stat-value {
            color: #e54000;
        }

        .stat-card.aktif .stat-value {
            color: #ffc107;
        }

        .stat-label {
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: linear-gradient(135deg, #5b3fd3 0%, #7e57c2 100%);
            color: white;
            padding: 16px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 13px;
        }

        tr:hover {
            background: #f9f9f9;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-checkout {
            background: #d4edda;
            color: #155724;
        }

        .status-checkin {
            background: #cce5ff;
            color: #004085;
        }

        .status-belum {
            background: #f5f5f5;
            color: #666;
        }

        .visitor-name {
            font-weight: 600;
            color: #333;
        }

        .visitor-info {
            font-size: 12px;
            color: #999;
            margin-top: 2px;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }

        .summary-section {
            margin-top: 20px;
            padding: 16px;
            background: #f5f5f5;
            border-radius: 8px;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }

        .summary-item {
            text-align: center;
        }

        .summary-item-value {
            font-size: 20px;
            font-weight: 700;
            color: #5b3fd3;
        }

        .summary-item-label {
            font-size: 12px;
            color: #999;
            margin-top: 4px;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header h1 {
                font-size: 22px;
            }

            .filter-section {
                width: 100%;
                flex-direction: column;
            }

            .date-picker {
                width: 100%;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            table {
                font-size: 12px;
            }

            td, th {
                padding: 10px 12px;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>📊 History Kunjungan Harian</h1>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="back-link">
                ← Kembali ke Dashboard
            </a>
        </div>

        <div class="filter-section">
            <form method="GET" action="{{ route('admin.daily-history') }}" style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                <label style="color: white; font-weight: 500;">Pilih Tanggal:</label>
                <input type="date" name="tanggal" class="date-picker" value="{{ $selectedDate->format('Y-m-d') }}" required>
                <button type="submit" class="btn btn-primary">🔍 Lihat</button>
            </form>
            @if($visitors->count() > 0)
                <a href="{{ route('admin.daily-history.export', ['tanggal' => $selectedDate->format('Y-m-d')]) }}" class="btn btn-success">📥 Export CSV</a>
            @endif
        </div>

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Total Kunjungan</div>
                <div class="stat-value">{{ $totalKunjungan }}</div>
            </div>
            <div class="stat-card masuk">
                <div class="stat-label">Check-In</div>
                <div class="stat-value">{{ $totalMasuk }}</div>
            </div>
            <div class="stat-card keluar">
                <div class="stat-label">Check-Out</div>
                <div class="stat-value">{{ $totalKeluar }}</div>
            </div>
            <div class="stat-card aktif">
                <div class="stat-label">Aktif Sekarang</div>
                <div class="stat-value">{{ $aktifSekarang }}</div>
            </div>
            @if($avgDuration > 0)
                <div class="stat-card">
                    <div class="stat-label">Rata-rata Durasi</div>
                    <div class="stat-value">{{ $avgDuration }}m</div>
                </div>
            @endif
        </div>

        <!-- Data Table -->
        <div class="table-container">
            @if($visitors->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengunjung</th>
                            <th>Instansi</th>
                            <th>Tipe Visitor</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Durasi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visitors as $index => $visitor)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="visitor-name">{{ $visitor['nama'] }}</div>
                                    <div class="visitor-info">{{ $visitor['qr_token'] }}</div>
                                </td>
                                <td>{{ $visitor['instansi'] }}</td>
                                <td>{{ $visitor['tipe_visitor'] }}</td>
                                <td><strong>{{ $visitor['jam_masuk'] }}</strong></td>
                                <td><strong>{{ $visitor['jam_keluar'] }}</strong></td>
                                <td>{{ $visitor['durasi'] }}</td>
                                <td>
                                    <span class="status-badge status-{{ strtolower(str_replace('-', '', $visitor['status'])) }}">
                                        {{ $visitor['status'] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="summary-section">
                    <div class="summary-item">
                        <div class="summary-item-value">{{ $selectedDate->translatedFormat('d F Y') }}</div>
                        <div class="summary-item-label">Tanggal</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-item-value">{{ $totalMasuk }} / {{ $totalKunjungan }}</div>
                        <div class="summary-item-label">Persentase Check-in</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-item-value">{{ $totalKeluar }} / {{ $totalKunjungan }}</div>
                        <div class="summary-item-label">Persentase Check-out</div>
                    </div>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">📭</div>
                    <h3>Tidak ada data kunjungan</h3>
                    <p style="font-size: 13px; margin-top: 8px;">Tidak ada visitor yang check-in pada tanggal {{ $selectedDate->translatedFormat('d F Y') }}</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
