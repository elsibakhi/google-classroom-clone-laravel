<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

trait SetLocale {

    public static function get(Request $request){

          $locale=$request->header("accept-language");

        $acceptedLanguages=["ar","en"];
        if($locale){
            $locale=  explode(',', $locale);

            foreach ($locale as $value) {
         if(stripos($value,";")){

             $value=substr($value,0, stripos($value,";")??strlen($value));

         }
                if(in_array($value,$acceptedLanguages)){
                    $locale = $value;
                    break;
                }
            }
        }

         if(!in_array($locale,$acceptedLanguages)){
                    $locale = App::getLocale();

                }
        return $locale;
    }
}


