<?php

namespace App\Models\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class UserClassworkScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $id = Auth::id();
        $builder->whereRaw(
            " classroom_id in (
                  SELECT id FROM classrooms WHERE classrooms.id=classworks.classroom_id AND EXISTS (
                    SELECT 1 FROM classroom_user WHERE classrooms.id=classroom_user.classroom_id AND classroom_user.user_id=$id AND classroom_user.role='teacher'

                    )
                ) "
        )->orwhereHas("users",function (Builder $query) use($id){
        $query->where("id","=",$id);
       });
    }
}
