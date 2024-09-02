<?php

namespace App\Jobs;

use App\Models\Backup;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process as Process;

class BackupJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
{
    // Create a new backup record with status 'pending'
    $backup = Backup::create([
        'status' => 'pending',
        // Include other fields if necessary
    ]);

      // Define the root path of your Laravel project
      $projectRoot = base_path(); // Gets the root path of your Laravel project

      // Prepare the process to run the backup command
      $process = new Process(['php', 'artisan', 'backup:run'], $projectRoot);
    
    
    try {
        // Run the backup process and ensure it completes successfully
        $process->mustRun();

        // Update the backup record status to 'success'
        $backup->status = 'success';
        $backup->save();

        
    } catch (ProcessFailedException $exception) {
        // Update the backup record status to 'failed'
        $backup->status = 'failed';
        $backup->save();
        
        Log::error('Failed to dispatch backup job: ' . $exception->getMessage());
        
        // Optionally, you can also send an error response if needed
        return response()->json(['status' => 'error', 'message' => 'Backup failed: ' . $exception->getMessage()], 500);
    }
}

}
