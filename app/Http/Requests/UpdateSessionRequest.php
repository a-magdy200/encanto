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
        if (!$user->hasRole(['city_manager','admin'])) {
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
            'starttime'=>['required'],
            'endtime'=>'required|after:starttime',
        ];
    }
    public function messages()
    {
        return [
           'day.required'=>'you should add session day',
           'starttime.required'=>'you should add start_time',
           'endtime.required'=>'you should add finish_time',
           'endtime.after'=>'finish_time must be greater than start_time',

        ];
    }
}
