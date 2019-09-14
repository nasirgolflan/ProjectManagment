<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \App\Task;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
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
'start_date'=>'required',
'end_date'=>'required',
'project_id'=>'required',
'user_id'=>'required',
'task_type_id'=>'required',
'status'=>'required',

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
'start_date' => 'Start Date',
'end_date' => 'End Date',
'project_id' => 'Project Id',
'user_id' => 'User Id',
'task_type_id' => 'Task Type Id',
'status' => 'Status',

    ];
}

  
}
