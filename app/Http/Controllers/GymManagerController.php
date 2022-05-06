<?php

namespace App\Http\Controllers;

use App\Models\CityManager;
use Database\Seeders\RoleSeeder;

use App\Models\GymManager;
use App\Models\User;
use App\Models\Gym;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateGymManagerRequest;
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
            }
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
                        $image=$row->avatar;
                        $imageUrl=asset($image);
                        // $cover_image='<img src=\"" + $imageUrl + "\" height=\"100px\" width=\"100px\" alt=\"gym_cover_image\"/>';
                        return '<img src='.$imageUrl.' style="width:100px;height:100px;" alt="user avatar"/>';
                    })
                    ->addColumn('action', function($row){
                        $showUrl = route('gymmanagers.create', ['gymmanagerid'=>$row->id]);
                        $editUrl = route('gymmanagers.edit', ['gymmanagerid'=>$row->id]);
                        $deleteUrl = route('gymmanagers.destroy', ['gymmanagerid' => $row->id]);

                        $btn ="<a href='$showUrl' class='btn btn-info'><i class='fa fa-eye'></i></a>
                           <a href='$editUrl' class='btn btn-warning mx-2'><i class='fa fa-edit'></i></a>
                           <a href='$deleteUrl' class='btn btn-danger delete-btn' data-toggle='modal' data-target='#delete-modal'><i class='fa fa-times'></i></a>";

                        return $btn;
                    })

                    ->rawColumns(['avatar', 'manager_name', 'gym_name','action'])
                    ->make(true);
            }
            $headings = ['Manager Name','Gym Name', 'Avatar', 'National ID', 'Action'];
            $title = 'gymmanager';
            return view('gymmanagers.index')->with(['title' => $title, 'headings' => $headings]);
        }
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

    public function show($gymmanagerid)
    {
        $gymmanager = GymManager::find($gymmanagerid);
        $user_id=$gymmanager->user_id;
        $user = User::where('id', $user_id)->first();
        $gymmanager = GymManager::where('id', $gymmanagerid)->first();
        $gym = Gym::where('id', $gymmanager->gym_id)->first();
        $headings = ['name', 'email', 'avatar', 'national_id', 'is_banned',];
        $title = 'gymmanager';
        return view('gymmanagers.show', [
            'gymmanager' => $gymmanager,
            'user' => $user,
            'gym' => $gym,
        ]);
    }

    public function edit($gymmanagerid)
    {
        $gymmanager = GymManager::find($gymmanagerid);
        $user_id=$gymmanager->user_id;
        $user = User::where('id', $user_id)->first();
        $gymmanager = GymManager::where('id', $gymmanagerid)->first();
        $gyms = Gym::all();
        return view('gymmanagers.edit', [
            'gymmanager' => $gymmanager,
            'user' => $user,
            'gyms' => $gyms,
        ]);
    }
    public function update(UpdateGymManagerRequest $request, $gymmanagerid)
    {
        $data = request()->all();
        $path=Storage::putFile('avatars',$request->file('image'));
        $gym = Gym::where('name', $data['gym'])->first();
        User::where('id', $gymmanagerid)
            ->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'avatar'=>$path,
            ]);
        GymManager::where('user_id', $gymmanagerid)
            ->update([
                'is_banned' => '0',
                'gym_id' => $gym->id,
            ]);

        return to_route('gymmanagers.index');
    }
    public function create()
    {
        $gyms = Gym::all();
        return view('gymmanagers.create', [
            'gyms' => $gyms,
        ]);
    }
    public function store(StoreUserRequest $request)
    {

        $data = request()->all();
        $path = Storage::putFile('avatars', $request->file('image'));
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
//            'role_id'=>'3',
            'avatar'=>$path,
        ]);
        $user->assignRole('Gym Manager');

        $gymmanager = GymManager::create([
            'national_id' => $data['nationalid'],
            'is_banned' => '0',
            'user_id' => $user->id,
            'gym_id' => $data['gym'],

        ]);
        return to_route('gymmanagers.index');
    }
    public function ban($id)
    {
        $gymmanager = GymManager::find($id);
        $gymmanager->is_banned=!$gymmanager->is_banned;
       // dd($gymmanager->is_banned);
       $gymmanager->update();
       return to_route('gymmanagers.index');

    }
    public function approve($id)
    {
        $gymmanager = GymManager::find($id);
        $gymmanager->is_approved='1';
       // dd($gymmanager->is_banned);
       $gymmanager->update();
       return to_route('gymmanagers.index');

    }
}
