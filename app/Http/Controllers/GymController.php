<?php

    namespace App\Http\Controllers;

    use App\Events\AppNotificationEvent;
    use App\Http\Requests\StoreGymRequest;
    use App\Http\Requests\UpdateGymRequest;
    use App\Models\City;
    use App\Models\CityManager;
    use App\Models\Gym;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Storage;
    use Yajra\DataTables\DataTables;

//use DataTables;

    class GymController extends Controller
    {

        public function index(Request $request)
        {
            $user = auth()->user();
            if (!$user->hasAnyRole(['City Manager', 'Super Admin'])) {
                return view('errors.401');
            }
            if ($request->ajax()) {
                if ($user->hasRole('City Manager')) {
                    $city = CityManager::where('user_id', $user->id)->first()->city_id;
                    if (!$city) {
                        $gyms = [];
                    } else {
                        $gyms = $city->gyms;
                    }
                } elseif ($user->hasRole('Super Admin')) {
                    $gyms = Gym::all();
                }
                $datatable = Datatables::of($gyms)
                    ->addIndexColumn()
                    ->addColumn('Created By', function ($row) {
                        return $row->creator->getRoleNames()[0];
                    })
                    ->addColumn('Cover Image', function ($row) {
                        $image = $row->cover_image;
                        $imageUrl = asset($image);
                        $cover_image = '<img src=' . $imageUrl . ' style="width:100px;height:100px;" alt="gym_cover_image"/>';
                        return $cover_image;
                    })
                    ->addColumn('action', function ($row) {
                        $showUrl = route('gyms.show', ['gym' => $row]);
                        $editUrl = route('gyms.edit', ['gym' => $row]);
                        $deleteUrl = route('gyms.destroy', ['gym' => $row]);
                        $btn = "<a href='$showUrl' class='btn btn-info'><i class='fa fa-eye'></i></a>
                           <a href='$editUrl' class='btn btn-warning mx-2'><i class='fa fa-edit'></i></a>
                           <a href='$deleteUrl' class='btn btn-danger delete-btn' data-toggle='modal' data-target='#delete-modal'><i class='fa fa-times'></i></a>";

                        return $btn;
                    })
                    ->addColumn('Created At', function ($row) {
                        $date = Carbon::parse($row->created_at)->format('Y-m-d');
                        return $date;
                    });
                if ($user->hasRole("Super Admin")) {
                    $datatable->addColumn('City Name', function ($row) {
                        return $row->city ? $row->city->name : "Not Assigned";
                    })->addColumn('City Manager Name', function ($row) {
                        return $row->city ? ($row->city->manager ? $row->city->manager->user->name : "Not Assigned Manager") : "Not Assigned City";
                    })->rawColumns(['Cover Image', 'City Manager Name', 'City Name', 'Created At', 'Created By', 'action']);
                } else {
                    $datatable->rawColumns(['Cover Image', 'Created At', 'Created By', 'action']);
                }
                return $datatable->make(true);
            }
            if ($user->hasRole("Super Admin")) {
                $headings = ['Gym Name', 'Cover Image', 'City Name', 'City Manager Name', 'Created At', 'Created By'];
            } else {
                $headings = ['Gym Name', 'Cover Image', 'Created_At', 'Created By'];
            }
            $title = "Gyms";
            return view('gyms.index', ["headings" => $headings, "title" => $title]);
        }


        public function create()
        {
            $user = auth()->user();
            if ($user->hasRole('Super Admin')) {
                $cities = City::all();
            } elseif ($user->hasRole('City Manager')) {
                $city = CityManager::where('user_id', $user->id)->first()->city_id;
                $cities = City::where('id', $city)->first();
            } else {
                return view('errors.401');
            }
            $users = User::Role('City Manager')->get()->pluck('id')->toArray();
            $managers = CityManager::with("user")->where("user_id", $users)->whereNull("city_id")->get();
            return view('gyms.create', ["cities" => $cities, 'managers' => $managers]);
        }

        public function store(StoreGymRequest $request)
        {
            $user = auth()->user();
            if (!$user->hasAnyRole(['City Manager', 'Super Admin'])) {
                return view('errors.401');
            } elseif ($user->hasRole('Super Admin')) {
                $cities = City::all();
            } elseif ($user->hasRole('City Manager')) {
                $city = CityManager::where('user_id', $user->id)->first()->city_id;
                if (!$city) {
                    $cities = [];
                } else {
                    $cities = City::where('id', $city)->first();
                }
            } else {
                return view('errors.401');
            }
            if ($request->hasFile('gymCoverImg')) {
                $image = $request->file('gymCoverImg');
                $imageName = $image->getClientOriginalName();
                $image = str_replace(' ', '_', $imageName);
                $request->file('gymCoverImg')->storeAs('public/GymImages/', $image);
                $gymName = $request->input('gymName');
                $result = Gym::create([
                    'name' => $gymName,
                    'cover_image' => 'storage/GymImages/' . $image,
                    'city_id' => $request->input('gym_city'),
                    'created_by' => auth()->user()->id
                ]);
                if ($result) {
                session()->flash("success", "Gym has been added successfully");
                broadcast(new AppNotificationEvent("A new gym has been added"));
                    return to_route('gyms.index');
                    //  return redirect()->back()->with(["success" => "Gym is added successfully", "cities" => $cities]);
                } else {
                    return redirect()->back()->with(["failed" => "Gym failed to add", "cities" => $cities]);
                }
            }
            // return redirect()->back()->with(["cities" => $cities]);
            return to_route('gyms.index');

        }

        public function show(Gym $gym)
        {
            return view('gyms.show', ["gym" => $gym]);
        }

        public function edit(Gym $gym)
        {
            if (auth()->user()->hasRole("Super Admin")) {
                $cities = City::all();
            } else if (auth()->user()->hasRole("City Manager")) {
                $cities = [auth()->user()->manager->city];
            } else {
                return view("errors.401");
            }
            return view('gyms.edit', ["gym" => $gym, 'cities'=>$cities]);
        }

        public function update(UpdateGymRequest $request, $gymId)
        {
            $gym = Gym::find($gymId);
            if ($request->hasFile('gymCoverImg')) {
                Storage::disk('public')->delete('GymImages/' . $gym['cover_image']);
                $image = $request->file('gymCoverImg');
                $imageName = $image->getClientOriginalName();
                $image = str_replace(' ', '_', $imageName);
                $request->file('gymCoverImg')->storeAs('public/GymImages/', $image);
                $gymName = $request->input('gymName');
                $result = $gym->update([
                    'name' => $gymName,
                    'cover_image' => 'storage/GymImages/' . $image,
                    'city_id' => $request->input('gym_city')
                ]);
                if ($result) {
                    session()->flash("success", "Gym has been updated successfully");
                    broadcast(new AppNotificationEvent("A gym has been updated"));
                    return to_route('gyms.index');
                    // return redirect()->back()->with(['success'=>'Gym Updated Successfully']);
                } else {
                    return redirect()->back()->with(['error' => 'Failed to update this gym']);
                }
            } else {
                $gym->update([
                    'name' => $request->input('gymName'),
                    'city_id' => $request->input('gym_city')
                ]);
                // return redirect()->back()->with(['success'=>'Gym Updated Successfully']);
                return to_route('gyms.index');
            }
        }

        public function destroy($gymId)
        {
            $user = auth()->user();
            if ($user->hasAnyRole(['City Manager', 'Super Admin'])) {
                $gym = Gym::find($gymId);
                $sessions = $gym->sessions;
                if ($sessions) {
                    $gym->delete();
                    Storage::disk('public')->delete('GymImages/' . $gym['cover_image']);
                    broadcast(new AppNotificationEvent("A gym has been removed"));
                    return response()->json([], 200);
                } else {
                    return response()->json([], 400);
                }
            } else {
                return view('errors.401');
            }
        }
    }
