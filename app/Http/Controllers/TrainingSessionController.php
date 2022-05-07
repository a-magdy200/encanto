<?php

namespace App\Http\Controllers;

use App\Events\AppNotificationEvent;
use Illuminate\Http\Request;
use App\Models\TrainingSession;
use App\Models\Attendance;
use App\Models\TrainingSessionCoach;
use App\Http\Requests\StoreSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Models\User;
use App\Models\Gym;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

//use Yajra\DataTables\DataTables;

class TrainingSessionController extends Controller
{
    public function ajax(Request $request)
    {
        $user = auth()->user();
        if ($user->hasRole('City Manager')) {
            $cityId = $user->manager->city_id;
            $trainingSessionsid = DB::table('training_sessions')->select('training_sessions.id')->join('gyms', 'gyms.id', 'gym_id')->join('cities', 'cities.id', 'city_id')->where('city_id', $cityId)->get()->pluck('id')->toArray();
            $trainingSessions = TrainingSession::whereIn('id', $trainingSessionsid);
        } elseif ($user->hasRole('Super Admin')) {
            $trainingSessions = TrainingSession::all();
        } elseif ($user->hasRole('Gym Manager')) {
            $gym_id = $user->manager->gym_id;
            $trainingSessions = TrainingSession::where('gym_id', '=', $gym_id)->get();
        }
        return DataTables::of($trainingSessions)
            ->addIndexColumn()
            ->addColumn('Gym Name', function ($row) {
                $gymName = $row->gym->name;
                return $gymName;
            })

            ->addColumn('action', function ($row) {
                $show = route('training-sessions.show', ['trainingSession' => $row]);
                $edit = route('training-sessions.edit', ['trainingSession' => $row]);
                $delete = route('training-sessions.delete', ['trainingSession' => $row]);

                $btn = "<a href='$show' class='btn btn-info'><i class='fa fa-eye'></i></a>
                    <a href='$edit' class='btn btn-warning mx-2'><i class='fa fa-edit'></i></a>
                    <a href='$delete' class='btn btn-danger delete-btn' data-toggle='modal' data-target='#delete-modal'><i class='fa fa-times'></i></a>";
                return $btn;
            })
            ->rawColumns(['Gym Name', 'action'])
            ->make(true);
    }

    public function index()
    {
        $Headings = ['ID', 'Name', 'Day', 'Start Time', 'Finish Time', 'Gym'];
        $Title = 'Training Sessions';
        return view('training-sessions.index')->with(['title' => $Title, 'headings' => $Headings]);
    }
    public function create()
    {
        $users = User::role("Coach")->get(); //TODO choose coaches only based on role_id
        $gyms = Gym::all();
        return view('training-sessions.create', [
            'users' => $users, 'gyms' => $gyms
        ]);
    }
    public function store(StoreSessionRequest $request)
    {
        if (auth()->user()->hasAnyRole(['Super Admin', 'City Manager'])) {
            $gymId = $request->get('gym_id');
        } elseif (auth()->user()->hasRole('Gym Manager')) {
            $gymId = auth()->user()->manager->gym_id;
        }
        $findSessions = TrainingSession::where('day', '=', $request->get('day'))
            ->where('gym_id', '=', $gymId)
            ->whereBetween('start_time', [$request->get('start_time'), $request->get('finish_time')])
            ->orWhereBetween('finish_time', [$request->get('start_time'), $request->get('finish_time')])
            ->count();

        if ($findSessions == 0) {
            $session = TrainingSession::create([
                'name' => $request->get('SessionName'),
                'day' => $request->get('day'),
                'start_time' => $request->get('start_time'),
                'finish_time' => $request->get('finish_time'),
                'gym_id' => $request->get('gym_id'),
            ]);
            $session->coaches()->sync($request->get('users'));
            broadcast(new AppNotificationEvent("A training session has been added"));
            session()->flash("success", "Session added successfully");
            return to_route('training-sessions.index');
        } else {

            session()->flash("fail", "Failed to create session");
            return redirect()->back()->with([
                'error' => 'session time overlap',
                'name' => $request->get('SessionName'),
                'day' => $request->get('day'),
                'start_time' => $request->get('start_time'),
                'finish_time' => $request->get('finish_time'),
                'gym_id' =>  $gymId,
                'users' => $request->get('users'),
            ]);
        }
    }
    public function show(TrainingSession $trainingSession)
    {
        return view('training-sessions.view', ['trainingSession' => $trainingSession]);
    }
    public function edit(TrainingSession $trainingSession)
    {
        $coaches = User::role("Coach")->get(); //TODO choose coaches only based on role_id
        $gyms = Gym::all();
        return view('training-sessions.edit', [
            'trainingSession' => $trainingSession, 'coaches' => $coaches, 'gyms' => $gyms
        ]);
    }
    public function update(UpdateSessionRequest $request, TrainingSession $trainingSession)
    {
        $findSession = Attendance::where('training_session_id', '=', $trainingSession->id)->count();
        if ($findSession == 0) {

            $findOverlappingSession = TrainingSession::where('day', '=', $request->get('day'))
                ->whereNot("id", $trainingSession->id)
                ->where('gym_id', '=', $trainingSession->gym_id)
                ->whereBetween('start_time', [$request->get('start_time'), $request->get('finish_time')])
                ->orWhereBetween('finish_time', [$request->get('start_time'), $request->get('finish_time')])
                ->count();
            if ($findOverlappingSession == 0) {
                $trainingSession->day = $request->get('day');
                $trainingSession->start_time = $request->get('start_time');
                $trainingSession->finish_time = $request->get('finish_time');
                $trainingSession->update();
                broadcast(new AppNotificationEvent("A training session has been updated"));
                session()->flash("success", "Session updated successfully");
            } else {
                session()->flash("fail", "Failed to create session");
                return redirect()->back()->with([
                    'error' => 'session time overlap',
                    'name' => $request->get('SessionName'),
                    'day' => $request->get('day'),
                    'start_time' => $request->get('start_time'),
                    'finish_time' => $request->get('finish_time'),
                    'gym_id' =>  $gymId,
                    'users' => $request->get('users'),
                ]);
            }
        } else {
            session()->flash("fail", "Failed to update session");
            return redirect()->back()->withErrors([
                'error' => 'invalid session time',
                'day' => $request->get('day'),
                'start_time' => $request->get('start_time'),
                'finish_time' => $request->get('finish_time'),
            ]);
        }

        return to_route("training-sessions.index");
    }
    public function delete(TrainingSession $trainingSession)
    {
        $findSession = Attendance::where('training_session_id', '=', $trainingSession->id)->count();
        if ($findSession == 0) {
            $trainingSession->delete();
            broadcast(new AppNotificationEvent("A training session has been deleted"));
            return response()->json([], status: 200);
        } else
            return response()->json(['error' => "can't delete session"], status: 200);
    }
}
