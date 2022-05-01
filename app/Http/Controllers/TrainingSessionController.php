<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingSession;
use App\Models\TrainingSessionCoach;
use App\Models\User;
use App\Models\Gym;

class TrainingSessionController extends Controller
{
    public function index()
    {
        $trainingSessions = TrainingSession::all();
        $items = [];
        foreach ($trainingSessions as $trainingSession) {
            $gymName = Gym::find($trainingSession->gym_id)->name;
            $item = ['id' => $trainingSession->id, 'name' => $trainingSession->name, 'day' => $trainingSession->day, 'start_time' => $trainingSession->start_time, 'finish_time' => $trainingSession->finish_time, 'gym_name' => $gymName];
            array_push($items, $item);
        }
        $Headings = ['id', 'name', 'day', 'start_time', 'finish_time', 'gym_name'];
        $Title = 'TrainingSessions';
        return view('trainingSessions.index')->with(['items' => $items, 'title' => $Title, 'headings' => $Headings]);
    }
    public function create()
    {
        $users = User::all(); //TODO choose coaches only based on role_id
        $gyms = Gym::all();
        return view('trainingSessions.create', [
            'users' => $users, 'gyms' => $gyms
        ]);
    }
    public function store(Request $request)
    {
        $session = TrainingSession::create([
            'name' => $request->get('SessionName'),
            'day' => $request->get('day'),
            'start_time' => $request->get('starttime'),
            'finish_time' => $request->get('endtime'),
            'gym_id' => $request->get('gymid'),


        ]);

        TrainingSessionCoach::create([
            'training_session_id' => $session->id,
            'coach_id' => $request->get('userid'),

        ]);
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
    public function update(Request $request, $sessionid)
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
}
