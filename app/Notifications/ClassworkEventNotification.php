<?php

namespace App\Notifications;

use App\Models\Classwork;
use App\Models\User;
use App\Notifications\Channels\HadaraChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\VonageMessage;
class ClassworkEventNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $header, $body;
    public function __construct(protected Classwork $classwork,protected string $actionType)
    {


        $this->body = __(':user :actionType :classworkType (:title)', [
            "user"=>$classwork->user->name,
            "actionType"=>__($actionType),
            "classworkType"=>__($classwork->classworkType),
            "title"=>$classwork->title,
        ]);
        $this->header=$classwork->type->value." ".$this->actionType;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','broadcast','mail','vonage'
    //    ,HadaraChannel::class
    ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $classwork=$this->classwork;
        return (new MailMessage)
            ->subject(__($this->header))
            ->greeting(__("Hello") . $notifiable->name)
            ->line($this->body)
            ->action(__('Go to classwork now'), route("classrooms.classworks.show", [$classwork->classroom_id, $classwork->id]))
            ->line('Thank you for your attention 😊');


    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */


    public function toDatabase(object $notifiable): DatabaseMessage
    {
        $classwork=$this->classwork;
        return new DatabaseMessage($this->getMessage());
    }


    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        $classwork=$this->classwork;
        return new BroadcastMessage($this->getMessage());
    }
    public function toHadara(object $notifiable)
    {

        return $this->body;
    }

public function toVonage(object $notifiable): VonageMessage
{
    return (new VonageMessage)
                ->content('Hello hazoola from baraa website');
}


protected function getMessage():array{
        return [
            "header" => $this->header,
            "body" => $this->body,
            "image" => '',
            "link"=> route("classrooms.classworks.show",[$this->classwork->classroom_id,$this->classwork->id]) ,
            "classwork_id" => $this->classwork->id,
        ];
}

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
