<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;
use App\Models\Event;

class EvaluationSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:evaluation-schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Close The Evaluation Form';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $admin= Admin::where('admin_type', 'Super Admin')->first();
        $admin->update([
          'admin_evaluation_status'=> '0',
          'admin_evaluation_schedule'=> 'none',
        ]);
        $event= new Event();
        $event->event_name = "Evaluation Closed(Time Expiration)";
        $event->save();
    }
}
