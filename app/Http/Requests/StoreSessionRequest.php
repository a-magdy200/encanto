<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = auth()->user();
        if (!$user->hasAnyRole(['city_manager','admin'])) {
            return false;
        }else{
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'SessionName'=>['required','min:5','string'],
            'day'=>['required'],
            'starttime'=>['required'],
            'endtime'=>'required|after:starttime',
            'users' => 'required|array',
            'users.*' => 'exists:users,id',
            'gymid'=>['required','exists:gyms,id'],

        ];
    }
    public function messages()
    {
        return [
           'SessionName.required'=>'you should add session name',
           'SessionNme.min'=>'session name should not be less than 5 char',
           'day.required'=>'you should add session day',
           'starttime.required'=>'you should add start_time',
           'endtime.required'=>'you should add finish_time',
           'endtime.after'=>'finish_time must be greater than start_time',


        ];
    }
}
