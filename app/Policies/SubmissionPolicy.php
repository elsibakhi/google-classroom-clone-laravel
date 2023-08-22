<?php

namespace App\Policies;

use App\Models\Classwork;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SubmissionPolicy
{
    /**
     * Determine whether the user can view any models.
     */


    /**
     * Determine whether the user can create models.
     */
    public function view(User $user ,Submission $submission, $classwork): bool
    {

         if($classwork==null){ //filter from scope (check if user in the classroom and classwork)
            return false;
         }



            $isAssgined = $classwork->users()
            ->where("id",$user->id)
            ->exists();

        $hasSubmission = $submission->user()->where("id", $user->id);



        $isTeacher = $classwork->classroom->users()
                        ->wherePivot("role", "teacher")
                        ->wherePivot("user_id", $user->id)->exists();

        return ( ( $isAssgined && $hasSubmission) || $isTeacher);


    }
    public function create(User $user , $classwork): bool
    {

        if ($classwork == null) { //filter from scope (check if user in the classroom and classwork)
            return false;
        }
        $studentInClassroom = $classwork->classroom->users()
            ->wherePivot("role", "student")
            ->wherePivot("user_id", $user->id)->exists();

        $isAssgined = $classwork->users()
        ->where("id",$user->id)
        ->exists();


        return ($isAssgined && $studentInClassroom);


    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Submission $submission): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Submission $submission): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Submission $submission): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Submission $submission): bool
    {
        //
    }
}
