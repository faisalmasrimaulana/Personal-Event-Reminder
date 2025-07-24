<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\EventReminder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class SendEventReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-event-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengirim Email Pengingat Acara Yang Akan Berlangsung';

    /**
     * Execute the console command.
     */
    
    public function handle()
    {

        $eventsHour = Event::whereBetween('tanggal_event', [now(), now()->addHour()])
                    ->get();

        foreach ($eventsHour as $event) {
            Mail::to($event->user->email)->send(new EventReminder($event));
        }

        $eventsDay = Event::whereBetween('tanggal_event', [now()->addDay(), now()->addDay()->addMinute()])->get();
        foreach ($eventsDay as $event) {
            Mail::to($event->user->email)->send(new EventReminder($event, '24 jam'));
        }
        $this->info('Reminder dikirim!');
    }
}
