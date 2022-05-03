<?php

namespace App\Http\Controllers;

use App\Http\Resources\AttendanceResource;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
      $attendances=Attendance::all()->toArray();
      foreach($attendances as $attendance)
      { dd($attendance->user->name);
//         //$item= $items = ['user name' => $attendance->user->name, 'email'=>$attendance->user->email, 'training session name' => $attendance->training_session->name,'gym'=>"5555",'city'=>"5555"] ;

       // array_push($items,$item);
      }
       // $items=AttendanceResource::collection($attendances);

        $headings = ['user name', 'email ','attendance time', 'training seesion name','gym','city'];
        $title='attendance';
        return view('table')->with(['items'=> $items, 'title'=>$title, 'headings' => $headings]);


    }
}
