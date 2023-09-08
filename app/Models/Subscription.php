<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable=["user_id","plan_id","price","status","expires_at","period"];

    public function price(): Attribute
    {
        return new Attribute(
            get: fn($price) => $price / 100,
            set: fn($price) => $price * 100,
        );
    }
        public function plan (): BelongsTo{
        return $this->belongsTo(Plan::class);
    }
}
