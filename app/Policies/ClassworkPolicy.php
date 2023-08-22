<?php

namespace App\Policies;

use App\Models\Classroom;
use App\Models\Classwork;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClassworkPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //this i check it in scope
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user,  $classwork): bool
    {
        //the same as viewAny but i need to do it again




      $isAssgined = $classwork->users()->where("id",$user->id)->exists();

      $isTeacher= $classwork->classroom->users()
      ->wherePivot("user_id",$user->id )
      ->wherePivot( "role","teacher")
      ->exists();


        return ($isAssgined || $isTeacher);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user , $classroom): bool
    {



         return $classroom->users()
            ->wherePivot("user_id", $user->id)
            ->wherePivot("role", "teacher")
            ->exists();

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user,$classroom): bool
    {




        return $classroom->users()
            ->wherePivot("user_id", $user->id)
            ->wherePivot("role", "teacher")
            ->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user,  $classwork): bool
    {

        if ($classwork == null) { //filter from scope (check if user in the classroom and classwork )
            return false;
        }
        return $classwork->where("user_id",$user->id)
            ->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user,  $classwork): bool
    {
        if ($classwork == null) { //filter from scope (check if user in the classroom and classwork )
            return false;
        }
        return $classwork->where("user_id", $user->id)
            ->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user,  $classwork): bool
    {
        if ($classwork == null) { //filter from scope (check if user in the classroom and classwork )
            return false;
        }
        return $classwork->where("user_id", $user->id)
            ->exists();
    }
}
