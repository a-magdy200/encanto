<?php

namespace App\Http\Controllers;


use App\Events\AppNotificationEvent;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateGymManagerRequest;
use App\Models\CityManager;
use App\Models\GymManager;
use App\Models\User;
use App\Models\Gym;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class GymManagerController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if (!$user->hasAnyRole(['City Manager', 'Super Admin'])) {
            return view('errors.401');
        } else{
            if ($user->hasAnyRole('Super Admin')) {
                // Super Admin
                $gymManagers = GymManager::with('user')->get();
            } else {
                // City Manager
                $cityManager = CityManager::with('user', 'city')->where('user_id', $user->id)->first();
                $gymManagers = GymManager::with('user', 'gym')->where('gym_id', $cityManager->city->gyms->pluck('id')->toArray())->get();
            }}
            if ($request->ajax()) {
                return Datatables::of($gymManagers)
                    ->addIndexColumn()
                    ->addColumn('manager_name',function($row){
                        return $row->user->name;
                    })
                    ->addColumn('gym_name',function($row){
                        return $row->gym->name;
                    })
                    ->addColumn('avatar',function($row){
                        $image=$row->user->avatar;
                        $imageUrl=Storage::url($image);
                        // $cover_image='<img src=\"" + $imageUrl + "\" height=\"100px\" width=\"100px\" alt=\"gym_cover_image\"/>';
                        return '<img src='.$imageUrl.' style="width:100px;height:100px;" alt="user avatar"/>';
                    })
                    ->addColumn('action', function($row){
                        $showUrl = route('gym-managers.show', ['gymManager'=>$row]);
                        $editUrl = route('gym-managers.edit', ['gymManager'=>$row]);
                        $deleteUrl = route('gym-managers.destroy', ['gymManager' => $row]);

                        $btn ="<a href='$showUrl' class='btn btn-info'><i class='fa fa-eye'></i></a>
                           <a href='$editUrl' class='btn btn-warning mx-2'><i class='fa fa-edit'></i></a>
                           <a href='$deleteUrl' class='btn btn-danger delete-btn' data-toggle='modal' data-target='#delete-modal'><i class='fa fa-times'></i></a>";

                        return $btn;
                    })

                    ->rawColumns(['avatar', 'manager_name', 'gym_name','action'])
                    ->make(true);
            }
            $headings = ['Manager Name','Gym Name', 'Avatar', 'National ID', 'Action'];
            $title = 'Gym Manager';
            return view('gym-managers.index')->with(['title' => $title, 'headings' => $headings]);
        }

    public function destroy($gymmanagerid)
    {
        $user = auth()->user();
        if (!$user->hasAnyRole(['City Manager', 'Super Admin'])) {
            return view('errors.401');
        } else {
            $gymmanager = GymManager::find($gymmanagerid);
            $user_id = $gymmanager->user_id;
            $gymmanager->delete();
            User::find($user_id)->delete();
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        }
    }

    public function show(GymManager $gymManager)
    {
        return view('gym-managers.show', [
            'gymManager' => $gymManager,
        ]);
    }

    public function edit(GymManager $gymManager)
    {
        if (auth()->user()->hasRole('Super Admin')) {
            $gyms = Gym::all();
        } else if (auth()->user()->hasRole('City Manager')) {
            $gyms = auth()->user()->manager->city ? auth()->user()->manager->city->gyms : [];
        }
        return view('gym-managers.edit', [
            'gymManager' => $gymManager,
            'gyms' => $gyms,
        ]);
    }
    public function update(UpdateGymManagerRequest $request , GymManager $gymManager)
    {
        $data = request()->all();
            $user = $gymManager->user;
        if ($request->file('image')) {
            $path = Storage::putFile('public/avatars/gymmanagers', $request->file('image'));
        } else {
            $path = env('DEFAULT_IMAGE');
        }
        $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
            'avatar'=>$path,
            ]);
        $gymManager->gym_id = $data['gym'];
        $gymManager->save();

        return to_route('gym-managers.index');
    }
    public function create()
    {
        if (auth()->user()->hasRole("Super Admin")) {
            $gyms = Gym::all();
        } else if (auth()->user()->hasRole('City Manager')) {
            $gyms = auth()->user()->manager->city ? auth()->user()->manager->city->gyms : [];
        } else {
            return view('errors.401');
        }
        return view('gym-managers.create', [
            'gyms' => $gyms,
        ]);
    }
    public function store(StoreUserRequest $request)
    {

        $data = request()->all();
        if ($request->file('image')) {
            $path = Storage::putFile('public/avatars/gymmanagers', $request->file('image'));
        } else {
            $path = env('DEFAULT_IMAGE');
        }
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),

            'avatar'=>$path,
        ]);
        $user->assignRole('Gym Manager');

       GymManager::create([
            'national_id' => $data['national_id'],
            'is_banned' => false,
            'user_id' => $user->id,
            'gym_id' => $data['gym'],
           'is_approved' => true
        ]);
       session()->flash("success", "Gym managers has been added successfully");
       broadcast(new AppNotificationEvent("A new gym manager has been added"));
        return to_route('gym-managers.index');
    }
    public function ban($id)
    {
        $gymmanager = GymManager::find($id);
      //  dd($gymmanager->ban()->bannable_id);
        $gymmanager->is_banned=!$gymmanager->is_banned;
       //if($gymmanager->ban()->bannable_id)
      // $gymmanager->unban();
      // else
       $gymmanager->ban();
       // dd($x);
       $gymmanager->update();
       return to_route('gym-managers.index');

    }
    public function approve($id)
    {
        $gymmanager = GymManager::find($id);
        $gymmanager->is_approved='1';
       $gymmanager->update();
       return to_route('gym-managers.index');

    }
}
