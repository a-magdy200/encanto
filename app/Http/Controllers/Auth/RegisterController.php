<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CityManager;
use App\Models\Client;
use App\Models\GymManager;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
//            'role_id' => ['required','exists:roles,id'],
            'national_id' => [Rule::requiredIf(fn () => $data['role_id'] !== 1 && $data['role_id'] !== 5), 'integer', 'digits:16'],
            'gender' => [Rule::requiredIf(fn () => $data['role_id'] === 5), 'in:male,female'],
            'date_of_birth' => [Rule::requiredIf(fn () => $data['role_id'] === 5), 'date', 'before:today'],
            'avatar' => [Rule::requiredIf(fn () => $data['role_id'] === 5), 'image'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id']
        ]);
        switch($user->role_id) {
            case 2:
                CityManager::create([
                    'user_id'=>$user->id,
                    'national_id' => $data['national_id']
                ]);
                $user->assignRole('City Manager');

                break;
            case 3:
                GymManager::create([
                    'user_id'=>$user->id,
                    'national_id' => $data['national_id']
                ]);
                $user->assignRole('gym_manager');

                break;
            case 4:
                // Coach
                $user->assignRole('coach');

                break;
            case 5:
                $avatarUrl = $data['avatar']->store();
                Client::create([
                    'user_id' =>  $user->id,
                    'gender' => $data['gender'],
                    'date_of_birth' => $data['date_of_birth'],
                    'avatar' => $avatarUrl
                ]);
                $user->assignRole('client');

                break;
            default:
                break;
        }
        return $user;
    }
}
