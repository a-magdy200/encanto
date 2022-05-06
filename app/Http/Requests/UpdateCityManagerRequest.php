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
    {  $email = CityManager::find($this->citymanager)->user->email;
        $userId = User::find((int) request()->segment(3));

        return [
            'name' => ['required','regex:/^[\pL\s\-]+$/u'],
            'email' => [ 'required',Rule::unique('users')->ignore($email,'email'),  'email', 'max:255' ],
            'old_password' => ['required'],
            'new_password' => ['required', 'min:6'],
            'confirm_password' => ['required_with:new_password','same:new_password'],
            'city' => ['required'],
            'avatar' => ['image', 'mimes:jpg,png'],
        ];
    }
}
