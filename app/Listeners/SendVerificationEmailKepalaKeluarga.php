<?php

namespace App\Listeners;

use App\Mail\VerifyEmailNotification;
use App\Models\KepalaKeluarga;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendVerificationEmailKepalaKeluarga implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        // Check if this is a KepalaKeluarga registration
        if ($event->user instanceof KepalaKeluarga) {
            Mail::send(new VerifyEmailNotification($event->user));
        }
    }
}
