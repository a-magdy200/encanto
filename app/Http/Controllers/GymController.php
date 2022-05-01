<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class GymController extends Controller
{
    public function index(){
        $users = User::all();
        return view(
            'gyms.index',
            [
                'users' => $users,
            ]
        );

    }
    public function show($userid){
        $user = User::find($userid);
        return view('gyms.show', [
            'user' => $user,
        ]);
    }

    public function edit($userid)
    {
        $user = User::where('id', $userid)->first();
        return view('gyms.edit', [
            'user' => $user,
        ]);
    }
    public function destory($userid)
    {
        $user = User::find($userid);
        $user->delete();
        return to_route('gyms.index');
    }
    public function create(){
        return view('gyms.create');
    }
    public function store(){
        dd('dtore');
        // $path = $request->file('image')->store('images');
        $data = request()->all();
        User::create([
            'name' => $data['title'],
            'email' => $data['description'],
            'user_id' => $data['user_id'],
            // 'path' => $path,
            'password'=>'123',
            'avatar'=>'avatar',
            'role_id'=>'1',

        ]);

    }
}
