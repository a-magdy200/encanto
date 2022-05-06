<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = auth()->user();
        if (!$user->hasAnyRole(['City Manager', 'Super Admin'])) {
            return false;
        }
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', Rule::unique('users')->ignore($this->gymmanagerid)],
            'password' => ['required', 'string', 'min:8'],
            'avatar' => ['image|mimes:jpg,png|max:2048'],
            'national_id' => ['integer', 'digits:16'],
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'name field is required',
            'name.max'=>'name shouldn\'t exceed 255 charachter',
            'email.required'=>'email field is required',
            'email.unique' => 'this user already exists',
            'password.required'=>'password field is required',
            'avatar.image'=>'image should be jpg or png only',


        ];
    }
}
