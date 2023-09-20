<?php

namespace App\Models;

use App\Traits\HasPrice;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plan extends Model
{
    use HasFactory,HasPrice;

    protected $fillable = ["name","description","price","status","featured"];
    public function features(): BelongsToMany{
        return $this->belongsToMany( Feature::class,"plan_feature")->withPivot("feature_value");
    }
    public function users(): BelongsToMany{
        return $this->belongsToMany( Feature::class,"subscriptions");
    }


    public function name (): Attribute{
        return new Attribute(
            get:fn($name)=>ucfirst($name),

        );
    }


}

