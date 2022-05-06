<?php

namespace App\Http\Requests;

use App\Models\CityManager;
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
        $user = auth()->user();
        if (!$user->hasRole('city_manager')) {
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
            'name' => ['required','regex:/^[\pL\s\-]+$/u'],
            'email'=> ['required','unique:users,email'],
            'national_id'=>['required','unique:city_managers,national_id','min:16','max:16'],
            'password'=>['required','min:6'],
            'confirm_password' => ['required_with:password','same:password'],
            'city'=>['required','unique:city_managers,city_id'],
            'avatar' => ['image','mimes:jpg,png'],
        ];
    }
}
