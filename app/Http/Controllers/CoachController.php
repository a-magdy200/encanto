<?php

    namespace App\Http\Controllers;

    use App\Events\AppNotificationEvent;
    use App\Http\Requests\StoreCoachRequest;
    use App\Http\Requests\UpdateCoachRequest;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;
    use Yajra\DataTables\DataTables;

    class CoachController extends Controller
    {
        public function index(Request $request)
        {
            $headings = ['username', 'email'];
            $title = 'coaches';
            if ($request->ajax()) {
                $coaches = User::role('Coach')->get();
                return Datatables::of($coaches)
                    ->addColumn('action', function ($row) {
                        $showUrl = route('coaches.show', ['coach' => $row->id]);
                        $editUrl = route('coaches.edit', ['coach' => $row->id]);
                        $deleteUrl = route('coaches.delete', ['coach' => $row->id]);
                        $btn = "<a href='$showUrl' class='btn btn-info'><i class='fa fa-eye'></i></a>
                      <a href='$editUrl' class='btn btn-warning mx-2'><i class='fa fa-edit'></i></a>";
                        if (auth()->user()->hasRole('Super Admin')) {
                            $btn .= "<a href='$deleteUrl' class='btn btn-danger delete-btn' data-toggle='modal'
                               data-target='#delete-modal'><i class='fa fa-times'></i></a>";
                        }
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }


            return view('coaches.index')->with(['title' => $title, 'headings' => $headings]);
        }

        public function store(StoreCoachRequest $request)
        {
            $data = request()->all();
            if ($request->file('avatar')) {
                $path = Storage::putFile('public/avatars/coaches', $request->file('avatar'));
            } else {
                $path = env('DEFAULT_IMAGE');
            }
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'avatar' => $path,
            ]);
            $user->assignRole('Coach');
            session()->flash("success", "A new coach has been added successfully");
            broadcast(new AppNotificationEvent("A new coach has joined the platform"));
            return to_route('coaches.index');
        }

        public function create()
        {
            return view('coaches.create');
        }

        public function edit($coachId)
        {

            $coach = User::find($coachId);
            return view('coaches.edit', [
                "coach" => $coach]);
        }

        public function update($coachId, UpdateCoachRequest $request)
        {
            $data = request()->all();
            $user = User::find($coachId);
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);
            if ($request->file('avatar')) {
                $path = Storage::putFile('public/avatars/coaches', $request->file('avatar'));
                $user->avatar = $path;
                $user->save();
            }
            if($request->has('password') && strlen($request->get('password'))> 0) {
                $user->password = $data['password'];
                $user->save();
            }
            session()->flash("success", "Coach information has been updated successfully");
            return to_route('coaches.index');
        }

        public function delete($coach)
        {
            User::find($coach)->delete();
            return response()->json([], 200);

        }

        public function show($coachId)
        {
            $coach = User::find($coachId);
            return view('coaches.show', ['coach' => $coach]);
        }


    }
