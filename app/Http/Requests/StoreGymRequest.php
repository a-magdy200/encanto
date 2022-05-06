<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGymRequest extends FormRequest
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
            'gymName'=>['required','min:3'],
            'gymCoverImg' => ['required','image','mimes:jpg,png'],
            'gym_city'=>['required','exists:cities,id']
        ];
    }
    public function messages()
    {
        return [
            'gymName.required'=>'Gym name field is required',
            'gymName.min'=>'Gym name should be at least 3 character',
            'gymCoverImg.required'=>'Image is required',
            'gymCoverImg.mimes'=>'The image must be jpg or png file only',
            'gym_city.required'=>'gym city is required',
            'gym_city.exists'=>'gym city is invalid',
        ];
    }
}
