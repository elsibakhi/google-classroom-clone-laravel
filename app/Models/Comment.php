<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory;

protected $fillable =["user_id","commentable_id","commentable_type","ip","user_agent","content"];


// اذا انا دايما بدي اعمل ايقر لود لليوزر
// protected $with =[
//     "user"
// ];

public function user() :BelongsTo {
    return $this->belongsTo(User::class)->withDefault([
        'name' => 'Deleted user',
    ]); // if i need to return deleted user as name of user if the user is deleted


}


public function commentable() :MorphTo {
    return $this->morphTo();
}


 protected function content(): Attribute
    {
        return Attribute::make(
            get: fn( $value) => $value,
            set: function ( $value) {

             $value=   preg_replace('/<script.*?<\/script>|<\?.*?\?>/', '', $value);



                return $value;
            }
        );
    }

}
