<?php

namespace App\Models;

use App\Traits\HasPrice;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    use HasFactory,HasPrice;

    protected $fillable=["user_id","plan_id","price","status","expires_at","period"];


        public function plan (): BelongsTo{
        return $this->belongsTo(Plan::class);
    }

       public function payments():HasMany{
        return $this->hasMany(Payment::class);
       }
}
