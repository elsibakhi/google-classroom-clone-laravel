<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Classroom extends Model
{
    use HasFactory;
public static string $disk = "public";
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



public static function uploadCoverImage($file){
    $path=$file->store("/",Self::$disk); // there is public desk and local desk and s3(remote , amazon desk) desk to store files// default desk is local  (public and local is local desks)
    // we can use storeAs() to determine the name of file

    return $path;
}
public static function deleteCoverImage($path){


    return   Storage::disk(Self::$disk)->delete($path);;
}


}
