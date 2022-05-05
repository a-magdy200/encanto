<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\StoreCoachRequest;
use App\Models\Attendance;
use App\Models\Client;
use App\Models\TrainingSession;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::all();
        $headings = ['username', 'email ','attendance date','attendance time','training session name', 'gym', 'city'];
        $title = 'attendance';
        return view('attendance.index',['attendances'=>$attendances,])->with([ 'title' => $title, 'headings' => $headings]);

    }

    public function create()
    {
      $trainingSessions=TrainingSession::all();
      $clients=Client::all();

        return view('attendance.create',["clients"=>$clients,
            "trainingSessions"=>$trainingSessions]);
    }
 public function store(StoreAttendanceRequest $request)
 {
    $data=request()->all();
    Attendance::create([
        'training_session_id' =>$data['training_session_id'],
            'client_id'=>$data['client_id'],
        'attended_at'=>$data['date'],

            ]);
     return to_route('attendance.index');
 }
    public function edit($attendanceId)
    {

        $attendance=Attendance::find($attendanceId);
        $trainingSessions=TrainingSession::all();
        $clients=Client::all();

        return view('attendance.edit',["clients"=>$clients,
            "trainingSessions"=>$trainingSessions,
            "attendance"=>$attendance]);
    }
    public function update($attendanceId,StoreAttendanceRequest $request)
    {
        $data=request()->all();
        Attendance::where('id', $attendanceId)->update([
                'training_session_id' =>$data['training_session_id'],
                'client_id'=>$data['client_id'],
                'attended_at'=>$data['date'],
                ]);
        return to_route('attendance.index');

    }
    public function delete ($attendanceId)
    {
       Attendance::find($attendanceId)->delete();
        return response()->json([], 200);

    }


}
