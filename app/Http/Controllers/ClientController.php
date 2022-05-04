<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {

        $clients = Client::all();
        $headings = ['username', 'email','date of birth','gender'];
        $title = 'clients';
        return view('clients.index', ['clients' => $clients,])->with(['title' => $title, 'headings' => $headings]);
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $data = request()->all();
        $path = Storage::putFile('avatars/clients', $request->file('avatar'));
       $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role_id' => 4,
            'avatar'=>$path,

        ]);
        Client::create([
         'birth_date'=> $data['date'],
         'gender' =>$data['gender'] ,
            'user_id'=>$user->id,

        ]);
        return to_route('clients.index');


    }

    public function edit($clientId)
    {

        $client = Client::find($clientId);
        return view('clients.edit', [
            "client" => $client]);
    }

    public function update($clientId,Request $request)
    {
        $data = request()->all();
        $path = Storage::putFile('avatars/clients', $request->file('avatar'));
      $user =User::where('id', $clientId)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role_id' => 4,
            'avatar'=>$path,
        ]);
        Client::where('id', $clientId)->update([
            'birth_date'=> $data['date'],
            'gender' =>$data['gender'] ,
            'user_id'=>$user->id,

        ]);
        return to_route('clients.index');
    }

    public function delete($clientId)
    {
     $client= Client ::find($clientId)->delete();
       User ::find($client->user_id)->delete();
        return response()->json([], 200);

    }

    public function show($clientId)
    {  $client = Client::find($clientId);
        return view('coaches.show',['client'=>$client]);


    }


}
