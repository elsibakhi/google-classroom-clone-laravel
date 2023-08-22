<?php

namespace App\Models;

use App\Enums\ClassworkType;
use App\Models\Scopes\UserClassworkScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classwork extends Model
{
    use HasFactory;




const STATUS_PUBLISHED="published";
const STATUS_DRAFT="draft";

protected $fillable =["classroom_id","user_id","topic_id","title","description","type","status","published_at","options"];

protected $casts =[
"options" => "json",
"classrooom_id" => "integer",
 "published_at" => "datetime",
 "type" => ClassworkType::class,

];


public function classroom() : BelongsTo
{
return $this->belongsTo(Classroom::class,"classroom_id","id");
}
public function topic() : BelongsTo
{
return $this->belongsTo(Topic::class,"topic_id","id");
}



public static function booted(){

static::addGlobalScope(new UserClassworkScope());
 static::creating(function(Classwork $classwork){
          if(!$classwork->published_at){
  $classwork->published_at= now();
          }
 } ) ;    
}




// many to many with classroom
public function users(): BelongsToMany
{
    return $this->belongsToMany(
        User::class, //related model
    "classwork_user")  
    ->withPivot(["grade","submitted_at","status","created_at"])
->using(ClassworkUser::class) // the model of pivot table

   ;
}



public function comments (){
    return $this->morphMany(Comment::class,"commentable")/*->latest()*/; // if i need to modify query on the relation (latest)
}

public function getPublishedDateAttribute(){

if($this->published_at){
    return $this->published_at->format("Y-m-d");
}

}


public function submissions () : HasMany{
    return $this->hasMany(Submission::class);
}


}
