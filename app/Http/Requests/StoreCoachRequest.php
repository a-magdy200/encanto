<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCoachRequest extends FormRequest
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
            'name'=>['required','regex:/^[\pL\s\-]+$/u','min:3'],
            'email' =>['required','email',Rule::unique('users')->ignore($this->coach)],
            'password'=>['required','string','min:8', 'confirmed'],
            'avatar'=>['image','mimes:jpg,jpeg'],

        ];
    }
}
