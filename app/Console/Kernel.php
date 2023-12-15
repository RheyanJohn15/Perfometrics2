<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Admin;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected $commands = [
        Commands\Backup::class,
        Commands\EvaluationSchedule::class,
         ];
    
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:evaluation-schedule')
            ->everySecond()->when(function () {
                $admin = Admin::where('admin_type', 'Super Admin')->first();
                if ($admin->admin_evaluation_status === 1) {
                    // Parse the admin_evaluation_schedule from the database
                    $evaluationSchedule = \Carbon\Carbon::parse($admin->admin_evaluation_schedule);
                    $currentDateTime = \Carbon\Carbon::now();
                  
                    // Check if the evaluation time has passed
                    if ($currentDateTime->greaterThanOrEqualTo($evaluationSchedule)) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            });

            $schedule->command('app:backup')->daily()->at('2:00')->when(function () {
              
                $admin = Admin::where('admin_type', 'Super Admin')->first();
            
                if (!$admin || $admin->backup !== 1) {
                 
                    return false; 
                } else {
                   
                    return true; 
                }
            });;
    }
    
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
