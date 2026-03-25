<?php

namespace App\Listeners;

use App\Events\ParentCreated;
use App\Mail\ParentWelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendParentWelcomeEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ParentCreated $event): void
    {
        Mail::to($event->parent->email)->send(new ParentWelcomeMail($event->parent));
    }
}
