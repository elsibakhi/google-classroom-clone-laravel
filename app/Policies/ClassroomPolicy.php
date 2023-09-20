<?php

namespace App\Policies;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class ClassroomPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Classroom $classroom): bool
    {
       return $classroom->users()->where("id", $user->id)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {


                $allowed_classrooms_number=$user
                ->subscriptions()
                ->where("expires_at", ">=", now())
                ->first()
                ->plan->features()->where("name","Classroom #")->first()->pivot->feature_value;



 if($user->ownedClassrooms()->count()>=$allowed_classrooms_number){
                 return Response::deny('You have used the full number of classrooms allowed.');
            }

            return Response::allow();


    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Classroom $classroom): bool
    {

        return $classroom->where("user_id", $user->id)->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Classroom $classroom): bool
    {
        return $classroom->where("user_id", $user->id)->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Classroom $classroom)
    {

                $allowed_classrooms_number=$user
                ->subscriptions()
                ->where("expires_at", ">=", now())
                ->first()
                ->plan->features()->where("name","Classroom #")->first()->pivot->feature_value;



 if($user->ownedClassrooms()->count()>=$allowed_classrooms_number){
                 return Response::deny('You have used the full number of classrooms allowed.');
            }

            return Response::allow();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Classroom $classroom): bool
    {
        return $classroom->where("user_id", $user->id)->exists();
    }
}
