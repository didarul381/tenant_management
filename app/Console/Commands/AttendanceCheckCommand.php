<?php

namespace App\Console\Commands;

use App\Jobs\AttendanceJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AttendanceCheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check attendance and mark absent users who did not check in/out';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting attendance check job...');
        
        try {
            // Dispatch the job to the queue
            AttendanceJob::dispatch();
            
            $this->info('Attendance check job has been dispatched successfully!');
            
        } catch (\Exception $e) {
            Log::error('Error dispatching attendance job: ' . $e->getMessage());
            $this->error('Failed to dispatch attendance job: ' . $e->getMessage());
        }
    }
}
