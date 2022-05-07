<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\RegisterRequest;
use App\Http\Requests\StoreAttendanceRequest;
use App\Mail\NotifyEmail;
use App\Models\Attendance;
use App\Models\Client;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index($id){
        $client=DB::table('users')->where('users.id',$id)
        ->join('clients','users.id','=','clients.user_id')
        ->select('users.name','users.email','users.password','users.avatar','clients.gender','clients.date_of_birth')
        ->get();
        return Response()->json(['Client Profile'=>$client]);
    }

    public function edit(RegisterRequest $request,$id){
        $user=User::find($id);
        if ($request->hasFile('avatar')) {
            $inputImage = $request->file('avatar');
            Storage::disk('public')->delete('UserImages/' . $user['avatar']);
            $imageName = $inputImage->getClientOriginalName();
            $image = str_replace(' ', '_', $imageName);
            $request->file('avatar')->storeAs('public/ClientsImages/', $image);
            $user->update([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'password'=>$request->input('password'),
                'avatar'=>'storage/ClientsImages/'.$image
            ]);
            $user->client->update([
                'date_of_birth'=>$request->input('date_of_birth'),
                'gender'=>$request->input('gender')
            ]);

            if($user){
                return response()->json(["message"=>"Profile is updated successfully"],201);

            }
        }else{
            $user->update([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'password'=>$request->input('password'),
            ]);
            $user->client->update([
                'date_of_birth'=>$request->input('date_of_birth'),
                'gender'=>$request->input('gender')
            ]);
            return response()->json(["message"=>"Profile is updated successfully"],201);

        }

        return response()->json(["message"=>"Profile is failed to update"],400);

    }

    public function attend(Request $request,$id){
        $request->validate([
            'date'=>'required|date|date_equals:today'
        ]);


        $userId=Auth::user()->id;
        $clientId=Client::where('user_id',$userId)->first()->id;
        $orders=Order::where('client_id',$clientId)->count();
        if($orders >0){
            Attendance::create([
                'training_session_id' => $id,
                'client_id' => $clientId,
                'attended_at' => $request->get('date'),

            ]);
            return response()->json(["message"=>"Attend session is created successfully"],201);
        }

        return response()->json(["message"=>"You need to buy training sessions in order to attend"],400);

    }

    public function attendHistory(){
        $userId=Auth::user()->id;
        $clientId=Client::where('user_id',$userId)->first()->id;
        $data=DB::table('attendances AS att')->where('client_id',$clientId)
                            ->join('training_sessions AS session','session.id','att.training_session_id')
                            ->join('gyms','gyms.id','session.gym_id')
                            ->select('session.name AS Training Session Name','gyms.name AS Gym Name','att.attended_at')
                            ->get();

        return response()->json(["Attendance History"=>$data]);
    }
    public function remainingSessions(){
        $userId=Auth::user()->id;
        $clientId=Client::where('user_id',$userId)->first()->id;
        $orders=Order::where('client_id',$clientId)->get();
        $attendedSessions=Attendance::where('client_id',$clientId)->count();

        // $remaining_sessions=(int)$orders-(int)$attendedSessions;


        return response()->json(["total_training_sessions"=>$orders]);
    }



}
