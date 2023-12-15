<?php

namespace App\Console\Commands;
use App\Models\Event;
use Illuminate\Console\Command;

class Backup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
     $event = new Event();
     $event->event_name = " Back up complete";
     $event->save();
      exec('php artisan backup:run');
    }
}
