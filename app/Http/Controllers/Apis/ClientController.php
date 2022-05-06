<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index($id){
        $client=DB::table('users')->where('users.id',$id)->join('clients','users.id','=','clients.user_id')->select('users.name','users.email','users.password','users.avatar','clients.gender','clients.date_of_birth')->get();
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

}
