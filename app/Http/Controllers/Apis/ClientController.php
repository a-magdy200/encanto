<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\ClientRequest;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function show(){
        $clients=User::where('role_id',5)->with('client')->get();

        return response()->json($clients);
    }
    public function register(ClientRequest $request){
        $inputImage=$request->file('avatar');
        $name = $inputImage->getClientOriginalName();
        $image = str_replace(' ', '_', $name);
        $request->file('avatar')->storeAs('public/ClientsImages/',$image);
        $user=User::firstOrCreate([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>Hash::make($request->input('password')),
            'avatar'=>'storage/ClientsImages/'.$image,
        ]);
        $result=$user->client()->create([
            'date_of_birth'=>$request->input('date_of_birth'),
            'gender'=>$request->input('gender')
        ]);
        if($result){
            event(new Registered($user));
            return response()->json(["message"=>"Client is added successfully"],200);

        }else{
            return response()->json(["message"=>"user failed to add"],400);

        }
    }
}
