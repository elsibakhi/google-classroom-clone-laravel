<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stream extends Model
{
    use HasFactory , HasUuids;


     public function getUpdatedAtColumn(){
        
     }
    protected $fillable = ["user_id", "classroom_id", "classwork_id", "content"];


    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function classroom() : BelongsTo {
        return $this->belongsTo(Classroom::class);
    }

}
