<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCityManagerRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'email'=> ['required','unique:users,email'],
            'national_id'=>['required','unique:city_managers,national_id','min:10','max:10'],
            'password'=>['required','min:6'],
            'confirm_password' => ['required_with:password','same:password'],
            'city'=>['required','unique:city_managers,city_id'],
            'avatar' => ['image','mimes:jpg,png'],
        ];
    }
}
