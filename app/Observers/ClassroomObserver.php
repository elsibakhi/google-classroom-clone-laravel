<?php

namespace App\Observers;

use App\Models\Classroom;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class ClassroomObserver
{
    /**
     * Handle the Classroom "created" event.
     */

     // i can edit function name from created to creating
    public function creating(Classroom $classroom): void
    {
        if(!isset($classroom["code"])){
            $classroom->code=Str::random(8);
        }
        $classroom->user_id=Auth::id();
    }

    /**
     * Handle the Classroom "updated" event.
     */
    public function updated(Classroom $classroom): void
    {
        //
    }

    /**
     * Handle the Classroom "deleted" event.
     */
    public function deleted(Classroom $classroom): void
    {
       if( $classroom->isForceDeleting()){ // because when force delete classroom laravel trager the two events (deleted,forceDeleted)
        return ;
       }
        $classroom->status="deleted";
        $classroom->save(); // after force delete classroom  this line will insert a new classroom with same values of deleted classroom so the force deleation will not work
    }

    /**
     * Handle the Classroom "restored" event.
     */
    public function restored(Classroom $classroom): void
    {
        $classroom->status="active";
$classroom->save();
    }

    /**
     * Handle the Classroom "force deleted" event.
     */
    public function forceDeleted(Classroom $classroom): void
    {
    //        if($classroom->cover_img_path != null){
    //     Classroom::deleteCoverImage($classroom->cover_img_path);
          
    //   } 
    }
}
