<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable =[
        "name","code","section","subject","room","theme","cover_img_path"
    ]; // whightlist


 // if i need to prvent to add some column  -- not recommnded
 // protected $guarded =["id"]; // blacklist
 public function topics(): HasMany
 {
     return $this->hasMany(Topic::class);
 }



 // if i need if i send parameter in resouce route , i need laravel to find record by another column instead of id like 'code' 
// public function getRouteKeyName(){
//     return 'code';
// }


}
