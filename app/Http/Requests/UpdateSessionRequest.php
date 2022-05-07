<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = auth()->user();
        if (!$user->hasRole(['City Manager','Super Admin'])) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'day'=>['required'],
            'start_time'=>['required'],
            'finish_time'=>'required|after:start_time',
        ];
    }
    public function messages()
    {
        return [
           'day.required'=>'you should add session day',
           'day.integer'=>'day should be integer',
           'start_time.required'=>'you should add start_time',
           'finish_time.required'=>'you should add finish_time',
           'finish_time.after'=>'finish_time must be greater than start_time',

        ];
    }
}
