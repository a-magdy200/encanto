<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingSession;
use App\Models\TrainingSessionCoach;
use App\Http\Requests\StoreSessionRequest;
use App\Models\User;
use App\Models\Gym;

class TrainingSessionController extends Controller
{
    public function index()
    {
        $trainingSessions = TrainingSession::all();
        $Headings = ['id', 'name', 'day', 'start_time', 'finish_time', 'gym_name'];
        $Title = 'TrainingSessions';
        return view('trainingSessions.index')->with(['items' => $trainingSessions, 'title' => $Title, 'headings' => $Headings]);
    }
    public function create()
    {
        $users = User::all(); //TODO choose coaches only based on role_id
        $gyms = Gym::all();
        return view('trainingSessions.create', [
            'users' => $users, 'gyms' => $gyms
        ]);
    }
    public function store(StoreSessionRequest $request)
    {
        $session = TrainingSession::create([
            'name' => $request->get('SessionName'),
            'day' => $request->get('day'),
            'start_time' => $request->get('starttime'),
            'finish_time' => $request->get('endtime'),
            'gym_id' => $request->get('gymid'),


        ]);
        $session->coaches()->sync($request->get('users'));
        return to_route('trainingSessions.index');
    }
    public function show($id)
    {
        $trainingSession = TrainingSession::find($id);
        return view('trainingSessions.view', ['trainingSession' => $trainingSession]);
    }
    public function edit($sessionid)
    {
        $coaches = User::all(); //TODO choose coaches only based on role_id
        $gyms = Gym::all();
        $trainingSession = TrainingSession::find($sessionid);
        return view('trainingSessions.edit', [
            'trainingSession' => $trainingSession, 'coaches' => $coaches, 'gyms' => $gyms
        ]);
    }
    public function update(StoreSessionRequest $request, $sessionid)
    {
        $Session = TrainingSession::find($sessionid);
        $Session->name = $request->get('SessionName');
        $Session->day = $request->get('day');
        $Session->start_time = $request->get('starttime');
        $Session->finish_time = $request->get('finishtime');
        $Session->gym_id = $request->get('gymid');
        $Session->update();
        return to_route("trainingSessions.index");
    }
    public function delete($sessionid)
    {
        TrainingSession::find($sessionid);
        return response()->json([], status: 200);
    }
}