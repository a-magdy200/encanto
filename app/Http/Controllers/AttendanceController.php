<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\StoreCoachRequest;
use App\Models\Attendance;
use App\Models\Client;
use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;


class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role_id === 2) {
            $headings = ['username', 'email ', 'attendance date', 'attendance time', 'training session name', 'gym'];
        }
        $headings = ['username', 'email ', 'attendance date', 'attendance time', 'training session name', 'gym', 'city'];
        $title = 'attendance';
        if ($request->ajax()) {
            if (auth()->user()->role_id === 1) {
                $attendances = Attendance::all();
            }
            if (auth()->user()->role_id === 2) {

                $cityId = auth()->user()->manager->city->id;

                $attendanceIds = DB::table('attendances')->select('attendances.id')->join('training_sessions', 'training_sessions.id', 'training_session_id')
                    ->join('gyms', 'gyms.id', 'gym_id')->join('cities', 'cities.id', 'city_id')->where('city_id', $cityId)->get()->pluck('id')->toArray();
                $attendances = Attendance::whereIn('id', $attendanceIds)->get();

            }
            if (auth()->user->role_id=3){
                $gymId = auth()->user()->gymManager->gym->id;
                $attendanceIds = DB::table('attendances')->select('attendances.id')->join('training_sessions', 'training_sessions.id', 'training_session_id')
                ->join('gyms', 'gyms.id', 'gym_id')->where('gym_id', $gymId)->get()->pluck('id')->toArray();
                $attendances = Attendance::whereIn('id', $attendanceIds)->get();


            }
            return Datatables::of($attendances)

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
                })
                ->addColumn('gym', function ($row) {
                    $gym = $row->training_session->gym->name;
                    return $gym;
                })
                ->addColumn('city', function ($row) {
                    $city = $row->training_session->gym->city->name;
                    return $city;
                })

                ->rawColumns(['action', 'name', 'email', 'date', 'time', 'gym', 'city', 'training_session'])
                ->make(true);
        }
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
