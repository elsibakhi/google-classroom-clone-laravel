<?php

namespace App\Models;

use App\Traits\HasPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory,HasPrice;

    protected $casts = [
        "data"=>"json"
    ];


    public function subscription (): BelongsTo{
        return $this->belongsTo(Subscription::class);
    }
}
