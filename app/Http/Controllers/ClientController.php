<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
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

    public function store(StoreClientRequest $request)
    {
        $data = request()->all();
        if($request->file('avatar'))
        {$path = Storage::putFile('avatars/clients', $request->file('avatar'));}
        else
            $path=env('DEFAULTIMAGE');
       $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role_id' => 4,
            'avatar'=>$path,

        ]);
        Client::create([
         'date_of_birth'=> $data['date'],
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

    public function update($clientId,StoreClientRequest $request)
    {
        $data = request()->all();
        if($request->file('avatar'))
        {$path = Storage::putFile('avatars/clients', $request->file('avatar'));}
        else
            $path=env('DEFAULTIMAGE');
        $client=Client::find($clientId);
      $user =User::where('id', $client->user_id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role_id' => 4,
            'avatar'=>$path,
        ]);
        Client::where('id', $clientId)->update([
            'date_of_birth'=> $data['date'],
            'gender' =>$data['gender'] ,


        ]);
        return to_route('clients.index');
    }

    public function delete($clientId)
    {
        return response()->json([], 200);

    }

    public function show($clientId)
    {  $client = Client::find($clientId);
        return view('clients.show',['client'=>$client]);


    }


}
