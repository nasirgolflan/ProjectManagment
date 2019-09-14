<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \App\Project;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'name'=>'required',
'description'=>'required',
'release_date'=>'required',

        ];
    }


   

public function messages()
{
 	   return [
        //'first_name.required' => 'A first name is required by message',
        //'email.email'=>'invalid email'
    ];
}

public function attributes()
{
    return [
        'name' => 'Name',
'description' => 'Description',
'release_date' => 'Release Date',

    ];
}

  
}
