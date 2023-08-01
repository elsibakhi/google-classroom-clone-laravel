<?php

namespace App\Models;

use App\Models\Scopes\ClassroomTopicScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use HasFactory , SoftDeletes;


const CREATED_AT='created_at';
const UPDATED_AT='updated_at';



    // i can change these attribtes
    // this is defualt values 
    
protected $connection ='mysql';
protected $table ='topics';
protected $priamryKey ='id';
protected $keyType ='int';



public $incrementing = true;
// if we support timestamps
public $timestamps =false;


protected $fillable =[
    "name","classroom_id","user_id"
]; 


protected static function booted(){

    static::addGlobalScope(new ClassroomTopicScope);

}

public function classworks():HasMany{
    return $this->hasMany(Classwork::class,"topics_id","id"); 

}
}
