<?php

namespace App\Console\Commands;

use App\Models\Visitor;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class RegenerateQrTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qr:regenerate {--force : Force regeneration even if already generated today}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate QR tokens for multi-day visitors that are still within their visit period';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $today = now()->toDateString();
        $force = $this->option('force');

        $this->info('🔄 Starting QR token regeneration...');
        $this->newLine();

        // Find multi-day visitors that still have active or future visit periods
        $visitors = Visitor::with('pengajuan')
            ->whereHas('pengajuan', function ($query) {
                $query->where('status', 'Disetujui')
                    ->where(function ($subquery) {
                        $subquery->whereDate('tanggal_selesai', '>=', now())
                            ->orWhereNull('tanggal_selesai');
                    });
            })
            ->get();

        $regeneratedCount = 0;
        $skippedCount = 0;

        foreach ($visitors as $visitor) {
            // Check if it's a multi-day visitor type
            if (!$visitor->isMultiDayVisitor()) {
                $skippedCount++;
                continue;
            }

            // Check if already regenerated today (unless forced)
            if (!$force && $visitor->last_qr_generated_date && $visitor->last_qr_generated_date->toDateString() === $today) {
                $skippedCount++;
                continue;
            }

            // Generate new QR token
            $newQrToken = 'VIS-' . $visitor->pengajuan_id . '-' . $today . '-' . Str::random(8);

            $visitor->update([
                'qr_token' => $newQrToken,
                'last_qr_generated_date' => now(),
                // Reset checkout to allow next day check-in
                'waktu_keluar' => null,
            ]);

            $this->line("✅ ID: {$visitor->id} | Nama: {$visitor->nama_pengunjung} | QR Baru: {$newQrToken}");
            $regeneratedCount++;
        }

        $this->newLine();
        $this->info("📊 Hasil: {$regeneratedCount} QR di-regenerate, {$skippedCount} di-skip");

        return Command::SUCCESS;
    }
}
