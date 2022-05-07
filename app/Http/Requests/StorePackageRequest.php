<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePackageRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'package_name'=>['required','min:3'],
            'number_of_sessions'=>['required','integer'],
            'gym_id' => [Rule::requiredIf(fn () => auth()->user()->hasAnyRole(['City Manager', 'Super Admin'])), 'exists:gyms,id'],
            'price'=>['required','integer'],
        ];
    }
}
