<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClassworkUser extends Pivot
{
    use HasFactory;

    const UPDATED_AT = null;
    // public function getUpdatedAt()
    // {
    //     return null;
    // }
    public function setUpdatedAt($value)
    {
        return $this;
    }
}
