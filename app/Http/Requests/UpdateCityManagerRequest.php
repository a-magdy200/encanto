<?php

namespace App\Http\Requests;

use App\Models\CityManager;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class UpdateCityManagerRequest extends FormRequest
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
    {  $email = User::where('email', $this->email)->first()->email;

        return [
            'name' => ['required','regex:/^[\pL\s\-]+$/u'],
            'email' => [ 'required',Rule::unique('users')->ignore($email,'email'),  'email', 'max:255' ],
            'city' => ['required', 'exists:cities,id'],
            'avatar' => ['image', 'mimes:jpg,jpeg'],
        ];
    }
}
