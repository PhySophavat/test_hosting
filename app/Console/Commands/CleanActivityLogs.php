<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ActivityLog;
use Carbon\Carbon;

class CleanActivityLogs extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'activitylog:clean {--days=30 : Number of days to keep logs}';

    /**
     * The console command description.
     */
    protected $description = 'Delete activity logs older than a specific number of days';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $days = (int) $this->option('days');
        $cutoffDate = Carbon::now()->subDays($days);

        $deleted = ActivityLog::where('created_at', '<', $cutoffDate)->delete();

        $this->info("✅ Deleted {$deleted} activity log(s) older than {$days} days.");
    }
}
