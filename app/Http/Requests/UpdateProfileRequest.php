<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
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
            'userName'=>['required','min:3'],
            'userEmail'=>['required','email'],
            'national_id' => [Rule::requiredIf(fn () => Auth::user()->role_id === 2),'min:16' ],
            'cityid' => [Rule::requiredIf(fn () => Auth::user()->role_id === 2),'exists:cities,id'],
            'national_id' => [Rule::requiredIf(fn () => Auth::user()->role_id === 3),'min:16' ],
            'gym_id' => [Rule::requiredIf(fn () => Auth::user()->role_id === 3),'exists:gyms,id'],
            'date_of_birth' => [Rule::requiredIf(fn () => Auth::user()->role_id === 5), 'date', 'before:today'],


        ];
    }
}
