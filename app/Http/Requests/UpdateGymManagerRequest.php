<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateGymManagerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = auth()->user();
        if (!$user->hasAnyRole(['City Manager','Super Admin'])) {
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
        $id = User::where('email', $this->email)->first()->id;
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', Rule::unique('users')->ignore($id)],
            'avatar' => ['image|mimes:jpg,png|max:2048'],

        ];
    }
}
