<?php

namespace App\Models;

use App\Models\Scopes\UserClassroomScope;
use App\Observers\ClassroomObserver;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    // this way to bind the model with observer
static::observe(ClassroomObserver::class);


    // this globle scope to check that classroom owend by this user
    //  globle scope appled automaticlly to all classroom model query but local appled to query that i need to apply it  (لازم استدعيها عشان تتنفذ)
    //
    // static::addGlobalScope("user",function (Builder $query){
    //     return  $query->where("user_id","=",Auth::id());
    // });
    static::addGlobalScope(new UserClassroomScope);


// static::creating(function (Classroom $classroom){
//     if(!isset($classroom["code"])){
//         $classroom->code=Str::random(8);
//     }
//     $classroom->user_id=Auth::id();
// });


// i need to ensure that cover image is not from default imaged
// static::forceDeleted(function (Classroom $classroom){
//     if($classroom->cover_img_path != null){
//         self::deleteCoverImage($classroom->cover_img_path);
          
//       } 
      
// });


// deleting fire before deleting done 
// static::deleting(function (Classroom $classroom){
// $classroom->status="deleted";
// });
// deleted fire after deleting done 
// static::deleted(function (Classroom $classroom){
// $classroom->status="deleted";
// $classroom->save();
// });
// static::restored(function (Classroom $classroom){
// $classroom->status="active";
// $classroom->save();
// });

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


// get(attributename)Attribute --> naming way
// this method will use to modify any attribute returned from database 
// classroom object contain attributes object that contain record values
// this thing the name of it is ACCESSOR
public function getNameAttribute($value){
    return strtolower($value); // if i call $classroom->name the name value will converted to lowercase 
}

// IF I NEED TO RETURN DEFAULT IMAGE IF THERE IS NO IMAGE DEFINED
// public function getCoverImgPathAttribute($value){
//     if($value){
//         return Storage::url("$value");

//     }else{
//         return asset('default.png');
//     }
// }



//becaues brevious way will throws error  ==> if $value is null laravel deal with it as undefied 
//>> the solution is to define addintionl attribute that get imgpath value and deal with it
// public function getCoverImgUrlAttribute(){
//     if($this->cover_img_path){
//         return Storage::url("$this->cover_img_path");

//     }else{
//         return asset('default.png');
//     }
// }



// I CAN MAKE ACCESSOR TO ROUTE 

// public function getShowUrl(){
//     return route("classrooms.show",$this->id);
//     // i can access it by $classroom->show_url
// }




// i can use mutators to modify column value before create record and put it in database >> not when get value just


// public function setNameAttribute($value){
//     $this->attributes["name"]=strtolower($value);
// }





// I CAN DEFINE ACCESSOR AND MUTATOR IN ONE WAY 


// name without set or get
// protected function name() : Attribute
//{

//     return Attribute::make(
//         get: fn ($value) => strtoupper($value),
//         set: fn ($value) => strtolower($value)
//     );
// }









public function classworks():HasMany{
    return $this->hasMany(Classwork::class,"classroom_id","id"); // laravel will add "classroom_id" as forgien key by default (modelname_id) and add "id" as primary key

}

public function topics(): HasMany
{
    return $this->hasMany(Topic::class);
}







}