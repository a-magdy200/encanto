<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Client;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CoachController extends Controller
{
    public function index()
    {
        $roleID = 5;
        $coaches = User::where('role_id', "=", $roleID)->get();
        $headings = ['username', 'email'];
        $title = 'coaches';
        return view('coaches.index', ['coaches' => $coaches,])->with(['title' => $title, 'headings' => $headings]);
    }

    public function create()
    {
        return view('coaches.create');
    }

    public function store(Request $request)
    {
        $data = request()->all();
        $path = Storage::putFile('avatars/coaches', $request->file('avatar'));
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role_id' => 5,
            'avatar'=>$path,

        ]);
        return to_route('coaches.index');


    }

    public function edit($coachId)
    {

        $coach = User::find($coachId);
        return view('coaches.edit', [
            "coach" => $coach]);
    }

    public function update($coachId,Request $request)
    {
        $data = request()->all();
        $path = Storage::putFile('avatars/coaches', $request->file('avatar'));
        User::where('id', $coachId)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role_id' => 5,
            'avatar'=>$path,
        ]);
        return to_route('coaches.index');
    }

    public function delete($coach)
    {  dd('jdndcbdnc');
        User::find($coach)->delete();
        return response()->json([], 200);

    }

    public function show($coachId)
    {  $coach = User::find($coachId);
        return view('coaches.show',['coach'=>$coach]);
    }


}
