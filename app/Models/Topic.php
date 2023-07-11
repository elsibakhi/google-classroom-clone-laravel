<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;


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

}
