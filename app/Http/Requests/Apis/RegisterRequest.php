<?php

namespace App\Http\Requests\Apis;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:50',
            'email' => ['required','string','email',Rule::unique('users', 'email')->ignore($this->user)
            ],
            'password'=>'required|min:6|string|confirmed',
            'avatar'=>'required|image|mimes:png,jpg',
            'date_of_birth'=>'required|date',
            'gender'=>'required'
        ];
    }
}
