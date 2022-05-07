<?php

    namespace App\Http\Controllers;

    use App\Events\AppNotificationEvent;
    use App\Http\Requests\StoreClientRequest;
    use App\Http\Requests\UpdateClientRequest;
    use App\Models\Client;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;
    use Yajra\DataTables\DataTables;

    class ClientController extends Controller
    {
        public function index(Request $request)
        {


            $headings = ['username', 'email', "date_of_birth", 'gender'];
            $title = 'clients';

            if ($request->ajax()) {
                $clients = Client::all();

                return Datatables::of($clients)
                    ->addColumn('action', function ($row) {
                        $showUrl = route('clients.show', ['client' => $row->id]);
                        $editUrl = route('clients.edit', ['client' => $row->id]);
                        $deleteUrl = route('clients.delete', ['client' => $row->id]);
                        $btn = "<a href='$showUrl' class='btn btn-info'><i class='fa fa-eye'></i></a>
                      <a href='$editUrl' class='btn btn-warning mx-2'><i class='fa fa-edit'></i></a>
                            <a href='$deleteUrl' class='btn btn-danger delete-btn' data-toggle='modal'
                               data-target='#delete-modal'><i class='fa fa-times'></i></a>";

                        return $btn;
                    })
                    ->addColumn('name', function ($row) {
                        $name = $row->user->name;
                        return $name;
                    })
                    ->addColumn('email', function ($row) {
                        $email = $row->user->email;
                        return $email;
                    })
                    ->rawColumns(['action', 'name', 'email'])
                    ->make(true);
            }
            return view('clients.index')->with(['title' => $title, 'headings' => $headings]);
        }

        public function store(StoreClientRequest $request)
        {
            $data = request()->all();
            if ($request->file('avatar')) {
                $path = Storage::putFile('public/avatars/clients', $request->file('avatar'));
            } else {
                $path = env('DEFAULT_IMAGE');
            }
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'avatar' => $path,
            ]);
            $user->assignRole('Client');
            Client::create([
                'date_of_birth' => $data['date'],
                'gender' => $data['gender'],
                'user_id' => $user->id,
            ]);
            session()->flash("success", "A new client has been added successfully");
            broadcast(new AppNotificationEvent("A new client has joined the platform"));
            return to_route('clients.index');
        }

        public function create()
        {
            return view('clients.create');
        }

        public function edit($clientId)
        {

            $client = Client::find($clientId);
            return view('clients.edit', [
                "client" => $client]);
        }

        public function update($clientId, UpdateClientRequest $request)
        {
            $data = request()->all();
            $client = Client::find($clientId);
            $user = User::find($client->user_id);
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);
            if ($request->file('avatar')) {
                $path = Storage::putFile('public/avatars/clients', $request->file('avatar'));
                $user->avatar = $path;
                $user->save();
            }
            $client->update([
                'date_of_birth' => $data['date'],
            ]);
            session()->flash("success", "Client information updated successfully");
            return to_route('clients.index');
        }

        public function delete($clientId)
        {
            $client = Client::find($clientId);
            $userId = $client->user_id;
            $client->delete();
            User::find($userId)->delete();
            broadcast(new AppNotificationEvent("A client has been removed"));
            return response()->json([], 200);

        }

        public function show($clientId)
        {
            $client = Client::find($clientId);
            return view('clients.show', ['client' => $client]);


        }


    }
