<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\City;
use App\Models\Gym;
use App\Models\User;
use App\Models\CityManager;
use App\Models\GymManager;
use App\Models\Client;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdatePasswordRequest;


class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.info');
    }
    public function edit()
    {
        return view('profile.edit');
    }
    public function update(UpdateProfileRequest $request)
    {
        $userid=Auth::user()->id;

        $user = User::find($userid);
        $user->name = $request->get('userName');
        $user->email = $request->get('userEmail');
        $user->update();

        if ($user->hasRole('City Manager')) {
//            $citymanager = CityManager::where('user_id','=',$userid)->first();
//            $citymanager->city_id=$request->get('cityid');
//            $citymanager->national_id=$request->get('national_id');
//            $citymanager->update();

        } else if ($user->hasRole('Gym Manager')) {
//            $gymmanager = GymManager::where('user_id','=',$userid)->first();
//            $gymmanager->gym_id=$request->get('gym_id');
//            $gymmanager->national_id=$request->get('national_id');
//            $gymmanager->update();
        } else if ($user->hasRole('Client')) {
            $client = Client::where('user_id','=',$userid)->first();
            $client->date_of_birth=$request->get('dateofbirth');
            $client->update();
        }
        session()->flash("success", "Profile info updated successfully");
        return to_route('profile.info');
    }
    public function editPassword()
    {
       return view('profile.edit-pass');
    }
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $userid=Auth::user()->id;
        $user = User::find($userid);
        $user->password = $request->get('password');
        $user->update();
        session()->flash("success", "Password updated successfully");
        return to_route('profile.info');
    }
}
