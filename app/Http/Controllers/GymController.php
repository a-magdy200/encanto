<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGymRequest;
use App\Http\Requests\UpdateGymRequest;
use App\Models\City;
use App\Models\CityManager;
use App\Models\Gym;
use Illuminate\Support\Facades\Storage;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GymController extends Controller
{

    public function showGyms(Request $request)
    {
        $user = auth()->user();
        if (!$user->hasAnyRole(['City Manager', 'Super Admin'])) {
            return view('errors.401');
        } elseif ($user->hasRole('City Manager')) {
            $city = CityManager::where('user_id', $user->id)->first()->city_id;
            if (!$city) {
                $gyms = [];
            } else {
                $gyms = Gym::where('city_id', $city)->get();
            }
        } elseif ($user->hasRole('Super Admin')) {
            $gyms = Gym::all();
        }
        if ($request->ajax()) {
            $data = Gym::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('City Name', function ($row) {
                    $cityName = $row->city->name;
                    return $cityName;
                })
                ->addColumn('cover_image', function ($row) {
                    $image = $row->cover_image;
                    $imageUrl = asset($image);
                    // $cover_image='<img src=\"" + $imageUrl + "\" height=\"100px\" width=\"100px\" alt=\"gym_cover_image\"/>';
                    $cover_image = '<img src=' . $imageUrl . ' style="width:100px;height:100px;" alt="gym_cover_image"/>';
                    return $cover_image;
                })

                ->addColumn('action', function ($row) {
                    $showUrl = route('show.singleGym', ['gymId' => $row->id]);
                    $editUrl = route('edit.gymForm', ['gymId' => $row->id]);
                    $deleteUrl = route('delete.gym', ['gymId' => $row->id]);
                    $btn = "<a href='$showUrl' class='btn btn-info'><i class='fa fa-eye'></i></a>
                           <a href='$editUrl' class='btn btn-warning mx-2'><i class='fa fa-edit'></i></a>
                           <a href='$deleteUrl' class='btn btn-danger delete-btn' data-toggle='modal' data-target='#delete-modal'><i class='fa fa-times'></i></a>";

                    return $btn;
                })
                ->addColumn('Created_At', function ($row) {
                    $date = Carbon::parse($row->created_at)->format('Y-m-d');
                    return $date;
                })

                ->rawColumns(['cover_image', 'City Name', 'Created_At','created_by', 'action'])
                ->make(true);
        }
        $headings = ['Gym Name', 'Cover Image', 'City Name', 'Created_At','created_by'];
        $title = "Gyms";
        return view('GymPages.showAllGyms', ["headings" => $headings, "title" => $title]);
    }


    public function showGymForm()
    {
        $user = auth()->user();
        if ($user->hasRole('Super Admin')) {
            $cities = City::all();
        } elseif ($user->hasRole('City Manager')) {
            $city = CityManager::where('user_id', $user->id)->first()->city_id;
            $cities = City::where('city_id', $city)->first();
        } else {
            return view('errors.401');
        }
        return view('GymPages.createGym', ["cities" => $cities]);
    }
    public function createGymForm(StoreGymRequest $request)
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
                $cities = City::where('city_id', $city)->first();
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
                'city_id' => $request->input('gym_city')
            ]);
            if ($result) {
                return to_route('show.AllGyms');
                //  return redirect()->back()->with(["success" => "Gym is added successfully", "cities" => $cities]);
            } else {
                return redirect()->back()->with(["failed" => "Gym failed to add", "cities" => $cities]);
            }
        }
       // return redirect()->back()->with(["cities" => $cities]);
          return to_route('show.AllGyms');

    }

    public function showSingleGym($gymId)
    {
        $Gym = Gym::find($gymId);

        return view('GymPages.showSingleGym',["Gym"=>$Gym]);
    }
    public function editGymForm($gymId){
        $Gym=Gym::find($gymId);
        $cities=City::all();
        return view('GymPages.updateGym',["Gym"=>$Gym,"cities"=>$cities]);
    }
    public function updateGymForm(UpdateGymRequest $request, $gymId)
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
                return to_route('show.AllGyms');
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
            return to_route('show.AllGyms');
        }
    }

    public function deleteGym($gymId)
    {
        $user = auth()->user();
        if ($user->hasAnyRole(['City Manager', 'Super Admin'])) {
            $gym = Gym::find($gymId);
            $sessions = $gym->sessions;
            if ($sessions) {
                $gym->delete();
                Storage::disk('public')->delete('GymImages/' . $gym['cover_image']);
                return response()->json([], 200);
            } else {
                return response()->json([], 400);
            }
        } else {
            return view('errors.401');
        }
    }
}
