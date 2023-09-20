<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

// << implements MustVerifyEmail >> to enable email verification
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable , TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


// many to many with classroom
    public function classrooms(): BelongsToMany
    {
        return $this->belongsToMany(
            Classroom::class, //related model
        "classroom_user", // pivot table (middle)
        "user_id",// FK foreign key for  current model in pivot table
        "classroom_id", // FK foreign key for  related model in pivot table
        "id", // PK for current model
        "id")  // PK for related model
        ->withPivot(["role","submitted_at","created_at"])
        ->as('join') // to get pivot elements by using join instead of pivot

       ;
    }
    public function teachers()
    {
        return $this->classrooms()
        ->wherePivot("role","=","teacher");
    }
    public function students()
    {
        return $this->classrooms()
        ->wherePivot("role","=","student");
    }

    // there is two relations  with classroom

// one to many with classroom
    public function createdClassrooms (){
        return $this->hasMany(Classroom::class);
    }




    public function classworks():BelongsToMany {
        return $this->belongsToMany(Classwork::class,'classwork_user')->withPivot(["grade","submitted_at","status","created_at"])
        ->using(ClassworkUser::class);


    }




    public function validSubscription() : HasOne{
        return $this->HasOne(Subscription::class)->where("expires_at", ">=", now());
    }
    public function subscriptions() : HasMany {
        return $this->hasMany(Subscription::class);
    }
    public function ownedClassrooms() : HasMany {
        return $this->hasMany(Classroom::class);
    }
    public function comments() : HasMany {
        return $this->hasMany(Comment::class)/*->latest()*/; // if i need to modify query on the relation (latest)
    }


    public function profile():HasOne {
      return  $this->hasOne(Profile::class)->withDefault();
    }

public function routeNotificationForHadara(){
        // return $user->profile->phone;
        return "970599177600";
}

  public function routeNotificationForVonage(Notification $notification): string
    {
        return '972567302408';
    }

}
