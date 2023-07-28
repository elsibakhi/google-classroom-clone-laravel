<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class UserClassroomScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
// to check user is authentected
        if($id=Auth::id()){

        $builder->where("user_id","=",$id)
        ->orWhereRaw("classrooms.id in (select classroom_id from classroom_user where user_id=$id)");
      //  ->orWhereRaw("classrooms.id  exists('classrooms.id in (select classroom_id from classroom_user where user_id=?)')")//another way
//         ->orWhereExists(function ($query){ // way 3
// $query->select(DB::raw('1'))->from("classroom_user")
// ->whereColumn("classroom_id","=","classrooms.id") // to compare two columns with each other not column and value
// ->where("user_id","=",$id)        
//     });
        }
    }
}
