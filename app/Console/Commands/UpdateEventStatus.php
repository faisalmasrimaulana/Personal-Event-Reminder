<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;

class UpdateEventStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-event-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Otomatis menandai event yang telah lewat waktunya';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $updated = Event::where('is_done', false)->where('tanggal_event', '<', now()->subHours(12))->update(['is_done' => true]);
    }
}
