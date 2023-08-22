<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class excludedFiles implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

protected $types=[];

public function __construct(...$types) {
    $this->types = $types;
}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
    
    if(in_array($value->getMimeType(),$this->types)){

        $fail("invalid file type");

    }


    }
    }
