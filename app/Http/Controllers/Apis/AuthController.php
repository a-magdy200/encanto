<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\LoginRequest;
use App\Http\Requests\Apis\RegisterRequest;
use App\Models\Client;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use App\Notifications\EmailVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function show(){
        $clients=User::all();

        return response()->json($clients);
    }
    public function register(RegisterRequest $request){

        $inputImage=$request->file('avatar');
        $name = $inputImage->getClientOriginalName();
        $image = str_replace(' ', '_', $name);
        $request->file('avatar')->storeAs('public/ClientsImages/',$image);
        $user=User::firstOrCreate([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>bcrypt($request->input('password')),
            'avatar'=>'storage/ClientsImages/'.$image,
        ]);
        $user->client()->create([
            'date_of_birth'=>$request->input('date_of_birth'),
            'gender'=>$request->input('gender')
        ]);
        event(new Registered($user));

        $delay = now()->addMinutes(1);
        $user->notify((new EmailVerify())->delay($delay));


        $token=$user->createToken('myapptoken')->plainTextToken;

        return response()->json(["message"=>"Client is added successfully",'User'=>$user->client,"Token"=>$token],201);


    }

    public function login(LoginRequest $request){
        $client=User::where("email",$request->input('email'))->first();

        if(!$client | !Hash::check($request->input('password'),$client['password'])){
            return response(['message'=>'Password is invalid '],401);
        }
        $token=$client->createToken('myapptoken')->plainTextToken;
        $user_id=$client->id;
        $last_login=Client::where('user_id',$user_id)->update([

            'last_login'=>$request->input('last_login')
        ]);
        return response(['Client'=>$client->client,'Token'=>$token],201);
    }
    // public function logout(Request $request){
    //     auth()->user()->tokens()->delete();
    //     return response(['message'=>"Logged out"]);
    // }
}
