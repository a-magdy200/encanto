<?php

namespace App\Http\Controllers;
use Database\Seeders\RoleSeeder;

use App\Models\GymManager;
use App\Models\User;
use App\Models\Gym;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateGymManagerRequest;




class GymManagerController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (!$user->hasAnyRole(['city_manager','admin'])) {
            return view('errors.401');
        }
        $items=GymManager::all();
        $headings = ['name', 'email', 'avatar', 'national_id', 'is_banned', 'id'];
        $title = 'gymmanager';
        return view('gymmanagers.index')->with(['items' => $items, 'title' => $title, 'headings' => $headings]);
    }
    public function destroy($gymmanagerid)
    {
        $gymmanager = GymManager::find($gymmanagerid);
        $user_id=$gymmanager->user_id;
        $gymmanager->delete();
        User::find($user_id)->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
     }

    public function show($gymmanagerid)
    {
        $gymmanager = GymManager::find($gymmanagerid);
        $user_id=$gymmanager->user_id;
        $user = User::where('id', $user_id)->first();
        $gymmanager = GymManager::where('id', $gymmanagerid)->first();
        $gym = Gym::where('id', $gymmanager->gym_id)->first();
        $headings = ['name', 'email', 'avatar', 'national_id', 'is_banned',];
        $title = 'gymmanager';
        return view('gymmanagers.show', [
            'gymmanager' => $gymmanager,
            'user' => $user,
            'gym' => $gym,
        ]);
    }

    public function edit($gymmanagerid)
    {
        $gymmanager = GymManager::find($gymmanagerid);
        $user_id=$gymmanager->user_id;
        $user = User::where('id', $user_id)->first();
        $gymmanager = GymManager::where('id', $gymmanagerid)->first();
        $gyms = Gym::all();
        return view('gymmanagers.edit', [
            'gymmanager' => $gymmanager,
            'user' => $user,
            'gyms' => $gyms,
        ]);
    }
    public function update(UpdateGymManagerRequest $request , $gymmanagerid)
    {
        $data = request()->all();
        $path=Storage::putFile('avatars',$request->file('image'));
        $gym = Gym::where('name', $data['gym'])->first();
        User::where('id', $gymmanagerid)
            ->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'avatar'=>$path,
            ]);
        GymManager::where('user_id', $gymmanagerid)
            ->update([
                'is_banned' => '0',
                'gym_id' => $gym->id,
            ]);

        return to_route('gymmanagers.index');
    }
    public function create()
    {
        $gyms = Gym::all();
        return view('gymmanagers.create', [
            'gyms' => $gyms,
        ]);
    }
    public function store(StoreUserRequest $request)
    {

        $data = request()->all();
        $path=Storage::putFile('avatars',$request->file('image'));
        $user=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
           'role_id'=>'3',
            'avatar'=>$path,
        ]);
        $user->assignRole('gym_manager');

        $gymmanager=GymManager::create([
            'national_id' => $data['nationalid'],
            'is_banned' => '0',
            'user_id'=>$user->id,
            'gym_id'=>$data['gym'],

        ]);
        return to_route('gymmanagers.index');
    }
}
