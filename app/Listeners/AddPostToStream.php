<?php

namespace App\Listeners;

use App\Models\Stream;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddPostToStream
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
        $classwork=$event->classwork;


        Stream::create([
            "user_id"=>$classwork->user_id,
            "classroom_id"=>$classwork->classroom_id,
            "classwork_id"=>$classwork->id,
            "content"=>$event->content,
        ]);
    }





}
