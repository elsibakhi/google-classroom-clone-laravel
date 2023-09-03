<?php
namespace App\Notifications\Channels;

use App\Services\HadaraSmsService;
use Illuminate\Notifications\Notification;

class  HadaraChannel {

    public function send(object $notifiable ,Notification $notification){

        $service = new HadaraSmsService(config("services.hadara.key"));
        $service->sendSMS(
            "sendmessage",
            $notifiable->routeNotificationForHadara(),
            $notification->toHadara($notifiable),

        );
    }
}
