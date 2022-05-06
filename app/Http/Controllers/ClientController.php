<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Requests\StoreClientRequest;
use App\Models\Attendance;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    public function index(Request $request)
    {


        $headings = ['username', 'email',"date_of_birth",'gender'];
        $title = 'clients';

        if ($request->ajax()) {
            $clients = Client::all();

            return Datatables::of($clients)

                ->addColumn('action', function($row){
                    $showUrl=route('clients.show',['client'=>$row->id]);
                    $editUrl= route('clients.edit',['client'=>$row->id]);
                    $deleteUrl=route('clients.delete',['client'=>$row->id]);
                    $btn="<a href='$showUrl' class='btn btn-info'><i class='fa fa-eye'></i></a>
                      <a href='$editUrl' class='btn btn-warning mx-2'><i class='fa fa-edit'></i></a>
                            <a href='$deleteUrl' class='btn btn-danger delete-btn' data-toggle='modal'
                               data-target='#delete-modal'><i class='fa fa-times'></i></a>";

                    return $btn;
                })
                ->addColumn('name', function($row){
                   $name= $row->user->name;
                    return $name;
                })
                ->addColumn('email', function($row){
                    $email= $row->user->email;
                    return $email;
                })

                ->rawColumns(['action','name','email'])
                ->make(true);
        }
        return view('clients.index')->with(['title' => $title, 'headings' => $headings]);
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
            'role_id' => 5,
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

    public function update($clientId,UpdateClientRequest $request)
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
            'role_id' => 5,
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
