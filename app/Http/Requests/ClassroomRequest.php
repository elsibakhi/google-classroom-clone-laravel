<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClassroomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // if user has access to this request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
       return [ 
            "name"=> "required|string|max:255",
            "section"=> "nullable|string|max:255",
            "subject"=> "nullable|string|max:255",
            "room"=> ["nullable","string","max:255"], // another way
            "cover_image"=> ["nullable","image",
           Rule::dimensions([
            'min_width'=>200,
            'min_height'=>200,
            'max_width'=>1000,
            'max_height'=>1000
           ]),
            // "dimentions:min_width=200,min_height=200,max_width=1000,max_height=1000"  // another way
        ],
        
        
    ];
    }

// if i need to customize error messages
    // public function messages(): array{
    //     return [
    //         'required' => ':attribute is importent', //  :attribute return the name of input
    //         'name.required'=>"the name is required", // if i need a specific input like name
    //         'cover_image.max'=>"Image size is greater than ... ",
            
    //     ];
    // }
}
