<?php

namespace App\Events\Classwork;

use App\Models\Classwork;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Create implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $action_type = "created";
    public  $content ;
    public function __construct(public Classwork $classwork)
    {
      $this->content = __(':user :actionType :classworkType (:title)', [
            "user"=>$classwork->user->name,
            "actionType"=>__($this->action_type),
            "classworkType"=>__($classwork->classworkType),
            "title"=>$classwork->title,
        ]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('classroom.'.$this->classwork->classroom_id),
        ];
    }


  public function broadcastAs()
  {
      return 'create-classwork';
  }
}
