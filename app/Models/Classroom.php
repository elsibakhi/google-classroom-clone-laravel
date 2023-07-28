<?php

namespace App\Models;

use App\Models\Scopes\UserClassroomScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Classroom extends Model
{
    use HasFactory , SoftDeletes;
public static string $disk = "public";
    protected $fillable =[
        "name","code","section","subject","room","theme","cover_img_path","user_id"
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




// this method to bootstap this model 
// one of functiolty of it is define globle scope
// i use booted instead boot becaues boot called before booted  so i grantee that the model is completed  // i can put this code in boot instead booted but we can faced some errors
protected static function booted(){
    // this globle scope to check that classroom owend by this user
    //  globle scope appled automaticlly to all classroom model query but local appled to query that i need to apply it  (لازم استدعيها عشان تتنفذ)
    //
    // static::addGlobalScope("user",function (Builder $query){
    //     return  $query->where("user_id","=",Auth::id());
    // });
    static::addGlobalScope(new UserClassroomScope);
}



// i can use this <<local>> scopes to modify or customize  the query by model //// like latest() 
public static function scopeActive(Builder $query){


    return  $query->where("status","=","active");
}
public static function scopeStatus(Builder $query,$status){


    return  $query->where("status","=",$status);
}
public static function scopeRecent(Builder $query){


    return  $query->orderBy("updated_at","desc");
}




//---------------- join classroom with users

public function join($user_id,$role="student"){
DB::table("classroom_user")->insert([
    "classroom_id"=> $this->id,  
    "user_id"=> $user_id,
    "role"=>$role,
    "created_at"=> now(),
]);
}


}