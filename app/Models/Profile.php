<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
            "user_id",
            "first_name",
            "last_name",
            "gender",
            "birthday",
            "locale",
            "timezone",
    ];


    protected $casts = [
        "birthday"=>"date",
    ];




    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }



    public function getBirthDateAttribute()  {
        return $this->birthday?->format("Y-m-d");
    }


}
