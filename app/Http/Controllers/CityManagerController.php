<?php

namespace App\Http\Controllers;

use App\Events\AppNotificationEvent;
use App\Http\Requests\AddCityManagerRequest;
use App\Http\Requests\UpdateCityManagerRequest;
use App\Models\City;
use App\Models\CityManager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class CityManagerController extends Controller
{
    public function index(Request $request)
    {

        $headings = ['id', 'name', 'city', 'Approved'];
        $title = 'City Managers';
        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            return view('errors.401');
        } else {

            if ($request->ajax()) {
                $cityManagers = CityManager::with('user', 'city')->get();
                return Datatables::of($cityManagers)
                    ->addColumn('action', function ($row) {
                        $showUrl = route('city-managers.show', ['cityManager' => $row]);
                        $editUrl = route('city-managers.edit', ['cityManager' => $row]);
                        $deleteUrl = route('city-managers.destroy', ['cityManager' => $row]);
                        return "<a href='$showUrl' class='btn btn-info'><i class='fa fa-eye'></i></a>
                <a href='$editUrl' class='btn btn-warning mx-2'><i
                        class='fa fa-edit'></i></a>
                <a href='$deleteUrl' class='btn btn-danger delete-btn' data-toggle='modal'
                    data-target='#delete-modal'><i class='fa fa-times'></i></a>";
                    })
                    ->addColumn('city', function ($row) {
                        return $row->city ? $row->city->name : 'Not Assigned';
                    })
                    ->addColumn('name', function ($row) {
                        return $row->user->name;
                    })
                    ->addColumn('is_approved', function ($row) {
                        if ($row->is_approved) {
                            return "<i class='fa fa-check'></i>";
                        } else {
                            return "<a href='" . route("city-managers.approve", ["cityManager" => $row]) . "' class='btn btn-info'><i
                        class='fa fa-check mr-1'></i>Approve</a>";
                        }
                    })
                    ->rawColumns(['name', 'city', 'action', 'is_approved'])
                    ->make(true);
            }
        }
        return view('city-managers.index', [
            'title' => $title,
            'headings' => $headings
        ]);
    }

    public function show(CityManager $cityManager)
    {

        return view('city-managers.show', [
            'cityManager' => $cityManager
        ]);
    }

    public function edit(CityManager $cityManager)
    {
        $cities = City::all();
        return view('city-managers.edit', [
            'cityManager' => $cityManager,
            'cities' => $cities
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
            $avatar_name = env('DEFAULT_IMAGE');
        }

        $user = User::create([
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
            'is_approved'=>true
        ]);

        session()->flash("success", "A City Manager has been added");
        broadcast(new AppNotificationEvent("A City Manager has been added"));
        return to_route('city-managers.index');
    }

    public function create()
    {
        $cities = City::all();
        return view('city-managers.create', [
            'cities' => $cities,
        ]);
    }

    public function destroy(CityManager $cityManager)
    {
        Storage::disk('public')->delete('public/images' . $cityManager->user->avatar);
        $user = $cityManager->user;
        $cityManager->delete();
        $user->delete();
        broadcast(new AppNotificationEvent("A city manager has been removed"));
        return response()->json([], 200);
    }

    public function approve(CityManager $cityManager)
    {
        $cityManager->is_approved = 1;
        $cityManager->update();
        session()->flash("success", "A City Manager has been approved");
        broadcast(new AppNotificationEvent("A City Manager has been approved"));
        return to_route('city-managers.index');
    }

    public function update(CityManager $cityManager, UpdateCityManagerRequest $request)
    {
        $data = request()->all();

        $user = $cityManager->user;

        if ($request->hasFile('avatar')) {
            Storage::disk('public')->delete('public/images' . $user->avatar);
            $destination_path = 'public/images';
            $avatar = $request->file('avatar');
            $avatar_name = $avatar->getClientOriginalName();
            $request->file('avatar')->storeAs($destination_path, $avatar_name);
            $user->avatar = $avatar_name;
            $user->save();
        }

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
        $cityManager->update([
            'city_id' => $data['city'],
        ]);
        session()->flash("success", "City manager updated successfully");
        broadcast(new AppNotificationEvent("A city manager has been updated"));
        return to_route('city-managers.index');
    }
}
