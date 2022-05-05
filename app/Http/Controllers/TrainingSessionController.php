<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingSession;
use App\Models\Attendance;
use App\Models\TrainingSessionCoach;
use App\Http\Requests\StoreSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Models\User;
use App\Models\Gym;
use DataTables;

class TrainingSessionController extends Controller
{
    public function index(Request $request)
    {
        $TrainingSessions = TrainingSession::select('*');
        $headings = ['id', 'name', 'day', 'start_time', 'finish_time', 'gym_name'];
        $title="Training Sessions";
        if ($request->ajax()) {
            return DataTables::of($TrainingSessions)
                ->addIndexColumn()
                ->addColumn('Gym Name', function ($row) {
                    $gymName=$row->gym->name;
                    return $gymName;
                })
                
                ->addColumn('action', function ($row) {
                    $show=route('trainingSessions.show',['id'=>$row->id]);
                    $edit=route('trainingSessions.edit',['id'=>$row->id]);
                    $delete=route('trainingSessions.delete',['id'=>$row->id]);

                    $btn = "<a href='$show' class='btn btn-info'><i class='fa fa-eye'></i></a>
                    <a href='$edit' class='btn btn-warning mx-2'><i class='fa fa-edit'></i></a>
                    <a href='$delete' class='btn btn-danger delete-btn' data-toggle='modal' data-target='#delete-modal'><i class='fa fa-times'></i></a>";
                    return $btn;
                })
                ->rawColumns(['Gym Name','action'])
                ->make(true);
        }

        return view('trainingSessions.index')->with(['title' => $title, 'headings' => $headings]);
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
        $findSessions = TrainingSession::where('day', '=', $request->get('day'))
            ->where('gym_id', '=', $request->get('gymid'))
            ->whereBetween('start_time', [$request->get('starttime'), $request->get('endtime')])
            ->orWhereBetween('finish_time', [$request->get('starttime'), $request->get('endtime')])
            ->count();
        if ($findSessions == 0) {
            $session = TrainingSession::create([
                'name' => $request->get('SessionName'),
                'day' => $request->get('day'),
                'start_time' => $request->get('starttime'),
                'finish_time' => $request->get('endtime'),
                'gym_id' => $request->get('gymid'),
            ]);
            $session->coaches()->sync($request->get('users'));
            return to_route('trainingSessions.index');
        } else {
            return Redirect()->back()->with([
                'error' => 'session time overlap',
                'name' => $request->get('SessionName'),
                'day' => $request->get('day'),
                'start_time' => $request->get('starttime'),
                'finish_time' => $request->get('endtime'),
                'gym_id' => $request->get('gymid'),
                'users' => $request->get('users'),

        ]);
                
        }
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
    public function update(UpdateSessionRequest $request, $sessionid)
    {
        $Session = TrainingSession::find($sessionid);
        $findSession = Attendance::where('training_session_id', '=', $sessionid)->count();
        if ($findSession == 0) {
            $Session->day = $request->get('day');
            $Session->start_time = $request->get('starttime');
            $Session->finish_time = $request->get('finishtime');
            $Session->update();
        } else {
            return redirect()->back()->withErrors([
                'error' => 'invalid session time',
                'day' => $request->get('day'),
                'start_time' => $request->get('starttime'),
                'finish_time' => $request->get('endtime'),
            ]);
        }

        return to_route("trainingSessions.index");
    }
    public function delete($id)
    {
        $session = TrainingSession::find($id);
        $findSession = Attendance::where('training_session_id', '=', $id)->count();
        if ($findSession == 0) {
            $session->delete();
            return response()->json([], status: 200);
        } else
            return response()->json(['error' => "can't delete session"], status: 200);
    }
}
