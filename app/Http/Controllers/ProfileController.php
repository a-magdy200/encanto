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

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('index');
    }
    public function index()
    {
        return view('profile.info');
    }
    public function edit()
    {
        if (Auth::user()->role_id == 2) {
            $cities = City::all();
            return view('profile.edit', ['cities' => $cities]);
        } else if (Auth::user()->role_id == 3) {
            $gyms = Gym::all();
            return view('profile.edit', ['gyms' => $gyms]);
        } else {
            return view('profile.edit');
        }
    }
    public function update(Request $request)
    {
        $userid=Auth::user()->id;

        $user = User::find($userid);
        $user->name = $request->get('userName');
        $user->email = $request->get('userEmail');
        $user->password = $request->get('userPassword');
        $user->update();

        if ($userid == 2) {
            $citymanager = CityManager::where('user_id','=',$userid)->first();
            $citymanager->city_id=$request->get('cityid');
            $citymanager->national_id=$request->get('nationalid');
            $citymanager->update();

        } else if ($userid == 3) {
            $gymmanager = GymManager::where('user_id','=',$userid)->first();
            $gymmanager->gym_id=$request->get('gymid');
            $gymmanager->national_id=$request->get('nationalid');
            $gymmanager->update();
        } else if ($userid == 5) {
            $client = Client::where('user_id','=',$userid)->first();
            $client->date_of_birth=$request->get('dateofbirth');
            $client->update();
        }
      

        return view('profile.info');
    }
}
