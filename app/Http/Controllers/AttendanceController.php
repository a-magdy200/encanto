<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\StoreCoachRequest;
use App\Models\Attendance;
use App\Models\Client;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;


class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $manager=User::with('manager')->find($user->id)->manager;

        $title = 'attendance';
        if ($user->hasRole('Super Admin')) {

            $attendances = Attendance::all();
            $headings = ['username', 'email ', 'attendance date', 'attendance time', 'training session name', 'gym', 'city'];
        } elseif ($user->hasRole('City Manager')) {

            $headings = ['username', 'email ', 'attendance date', 'attendance time', 'training session name', 'gym'];
            if($manager->city){

            $cityId = $manager->city->id;


            $attendanceIds = DB::table('attendances')->select('attendances.id')->join('training_sessions', 'training_sessions.id', 'training_session_id')
                ->join('gyms', 'gyms.id', 'gym_id')->join('cities', 'cities.id', 'city_id')->where('city_id', $cityId)->get()->pluck('id')->toArray();
            $attendances = Attendance::whereIn('id', $attendanceIds)->get();}
            else
                $attendances=[];


        } elseif ($user->hasRole('Gym Manager')) {
            $headings = ['username', 'email ', 'attendance date', 'attendance time', 'training session name'];
            $gymId = $manager->gym->id;
            $attendanceIds = DB::table('attendances')->select('attendances.id')->join('training_sessions', 'training_sessions.id', 'training_session_id')
                ->join('gyms', 'gyms.id', 'gym_id')->where('gym_id', $gymId)->get()->pluck('id')->toArray();
            $attendances = Attendance::whereIn('id', $attendanceIds)->get();


        }
        dd($request->ajax());
        if ($request->ajax()) {


            $dataTables = Datatables::of($attendances)
                ->addColumn('action', function ($row) {

                    $editUrl = route('attendance.edit', ['attendance' => $row->id]);
                    $deleteUrl = route('attendance.delete', ['attendance' => $row->id]);
                    $btn = "<a href='$editUrl' class='btn btn-warning mx-2'><i class='fa fa-edit'></i></a>
                            <a href='$deleteUrl' class='btn btn-danger delete-btn' data-toggle='modal'
                               data-target='#delete-modal'><i class='fa fa-times'></i></a>";

                    return $btn;
                })
                ->addColumn('name', function ($row) {
                    $name = $row->client->user->name;
                    return $name;
                })
                ->addColumn('email', function ($row) {
                    $email = $row->client->user->email;
                    return $email;
                })
                ->addColumn('date', function ($row) {
                    $date = \Illuminate\Support\Carbon::parse($row->attended_at)->format('Y-m-d');
                    return $date;
                })
                ->addColumn('time', function ($row) {
                    $time = \Illuminate\Support\Carbon::parse($row->attended_at)->format('H:i:s');
                    return $time;
                })
                ->addColumn('training_session', function ($row) {
                    $training_session = $row->training_session->name;
                    return $training_session;
                });

            if ($user->hasRole('Super Admin')) {
                $dataTables->addColumn('gym', function ($row) {
                    $gym = $row->training_session->gym->name;
                    return $gym;
                });
                $dataTables->addColumn('city', function ($row) {
                    $city = $row->training_session->gym->city->name;
                    return $city;
                });

                $dataTables->rawColumns(['action', 'name', 'email', 'date', 'time', 'gym', 'city', 'training_session']);
                return $dataTables->make(true);
            } elseif ($user->hasRole('City Manager')) {

                if($manager->city)
                {
                    $dataTables->addColumn('gym', function ($row) {
                    $gym = $row->training_session->gym->name;

                    return $gym;

                });


                $dataTables->rawColumns(['action', 'name', 'email', 'date', 'time', 'gym', 'training_session']);
                return $dataTables->make(true);}
                else
                    return  $dataTables->make(true);

            } elseif ($user->hasRole('Gym Manager')) {


                $dataTables->rawColumns(['action', 'name', 'email', 'date', 'time', 'training_session']);
                return $dataTables->make(true);

            }}
            return view('attendance.index')->with(['title' => $title, 'headings' => $headings]);

    }

    public function create()
    {
        $trainingSessions = TrainingSession::all();
        $clients = Client::all();

        return view('attendance.create', [
            "clients" => $clients,
            "trainingSessions" => $trainingSessions
        ]);
    }

    public function store(StoreAttendanceRequest $request)
    {
        $data = request()->all();
        Attendance::create([
            'training_session_id' => $data['training_session_id'],
            'client_id' => $data['client_id'],
            'attended_at' => $data['date'],

        ]);
        return to_route('attendance.index');
    }

    public function edit($attendanceId)
    {

        $attendance = Attendance::find($attendanceId);
        $trainingSessions = TrainingSession::all();
        $clients = Client::all();

        return view('attendance.edit', [
            "clients" => $clients,
            "trainingSessions" => $trainingSessions,
            "attendance" => $attendance
        ]);
    }

    public function update($attendanceId, StoreAttendanceRequest $request)
    {
        $data = request()->all();
        Attendance::where('id', $attendanceId)->update([
            'training_session_id' => $data['training_session_id'],
            'client_id' => $data['client_id'],
            'attended_at' => $data['date'],
        ]);
        return to_route('attendance.index');
    }

    public function delete($attendanceId)
    {
        Attendance::find($attendanceId)->delete();
        return response()->json([], 200);
    }
}
