<?php

namespace App\Listeners;

use App\Notifications\ClassworkEventNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class ClassworkNotificationPublisher
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
    public function handle(object $event): void
    {
        Notification::send($event->classwork->users, new ClassworkEventNotification($event->classwork, $event->action_type));
    }
}
