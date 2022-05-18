<?php

namespace App\Listeners;

use App\Events\NewFormRequestEvent;
use App\Mail\NewFormRequest as NewFormRequestMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NewFormRequestNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewFormRequestEvent  $event
     * @return void
     */
    public function handle(NewFormRequestEvent $event)
    {
        $allManagerEmails = User::query()
            ->where('role_id', config('auth.user_roles.manager'))
            ->pluck('email')
            ->toArray();

        Mail::bcc($allManagerEmails)->send(new NewFormRequestMail($event->formRequest));
    }
}
