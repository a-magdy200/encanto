<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Client;


class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        //
        $email = Client::find($this->client)->user->email;
   
        return [
            'name'=>['required','regex:/^[\pL\s\-]+$/u','min:3'],
            'email' =>['required','email',Rule::unique('users')->ignore( $email, 'email')],
            'password'=>['required','string','min:8'],
            'gender'=>['required'],
            'date'=>['required','before:today'],
            'avatar'=>['image','mimes:jpg,png'],

        ];
    }
}
