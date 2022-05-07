<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\City;
use App\Models\CityManager;
use App\Http\Requests\UpdateCityManagerRequest;
use App\Http\Requests\AddCityManagerRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Averages;
use Yajra\DataTables\DataTables;

class CityManagerController extends Controller
{
    public function index(Request $request)
    {

        $headings = ['id', 'name', 'city','is_approved'];
        $title = 'City Managers';
        $user = auth()->user();
        if (!$user->hasRole([ 'Super Admin'])) {
            return view('errors.401');
        } else {

            if ($request->ajax()) {
                $cityManagers = CityManager::with('user', 'city')->get();
                return Datatables::of($cityManagers)
                    ->addColumn('action', function ($row) {
                        $showUrl = route('citymanagers.show', ['citymanager' => $row->id]);
                        $editUrl = route('citymanagers.edit', ['citymanager' => $row->id]);
                        $deleteUrl = route('citymanagers.destroy', ['citymanager' => $row->id]);

                        return "<a href='$showUrl' class='btn btn-info'><i class='fa fa-eye'></i></a>
                <a href='$editUrl' class='btn btn-warning mx-2'><i
                        class='fa fa-edit'></i></a>
                <a href='$deleteUrl' class='btn btn-danger delete-btn' data-toggle='modal'
                    data-target='#delete-modal'><i class='fa fa-times'></i></a>";
                    })
                    ->addColumn('city', function ($row) {
                        $city = $row->manager->city ? $row->manager->city->name : 'Not Found';
                        return $city;
                    })
                    ->rawColumns(['name', 'city', 'action'])
                    ->make(true);
            }
        }
        return view('citymanagers.index', [
            'title' => $title,
            'headings' => $headings
        ]);
    }
    public function show($managerId)
    {

        $user = User::find($managerId);
        return view('citymanagers.show', [
            'user' => $user
        ]);
    }
    public function edit($managerId)
    {
        $user = User::find($managerId);
        $cities = City::all();
        return view('citymanagers.edit', [
            'user' => $user,
            'cities' => $cities
        ]);
    }
    public function update($managerId, UpdateCityManagerRequest $request)
    {
        $data = request()->all();

        $user = User::find($managerId);
        if (!Hash::check($data['old_password'], $user->password)) {

            return redirect()->back()->with('error', 'old password is not correct');
        } else {

            if ($request->hasFile('avatar')) {
                Storage::disk('public')->delete('public/images' . User::find($managerId)->avatar);
                $detination_path = 'public/images';
                $avatar = $request->file('avatar');
                $avatar_name = $avatar->getClientOriginalName();
                $request->file('avatar')->storeAs($detination_path, $avatar_name);
            } else {
                $avatar_name = User::find($managerId)->avatar;
            }

            User::where('id', $managerId)->update([
                'name' => $data['name'],
                'email' =>  $data['email'],
                'password' => Hash::make($data['new_password']),
                'avatar' => $avatar_name,
            ]);
            CityManager::where('user_id', $managerId)->update([
               'city_id' => $data['city'],
            ]);
            return redirect()->route('citymanagers.index');
        }
    }
    public function create()
    {
        $cities = City::all();
        return view('citymanagers.create', [
            'cities' => $cities,
        ]);
    }
    public function store(AddCityManagerRequest $request)
    {
        $data = request()->all();
        if ($request->hasFile('avatar')) {
            $detination_path = 'public/images';
            $avatar = $request->file('avatar');
            $avatar_name = $avatar->getClientOriginalName();
            $request->file('avatar')->storeAs($detination_path, $avatar_name);
        } else {
            $avatar_name = 'images/default_avatar.jpg';
        }

        $user=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar' => $avatar_name,
            // 'role_id' => 2
        ]);
        $user->assignRole('City Manager');


        $userId = User::where('email', '=', $data['email'])->value('id');

        CityManager::create([
            'national_id' => $data['national_id'],
            'user_id' => $userId,
            'city_id' => $data['city'],
        ]);

        return redirect()->route('citymanagers.index');
    }
    public function destroy($managerId)
    {
        Storage::disk('public')->delete('public/images' . User::find($managerId)->avatar);
        $user = User::find($managerId);
        $user->delete();
        return redirect()->route('citymanagers.index');
    }
    public function approve($id)
    {
        $citymanager = CityManager::find($id);
       // dd($citymanager);
        $citymanager->is_approved=1;
      // dd($citymanager->is_approved);
       $citymanager->update();
       return to_route('citymanagers.index');
    }
}
