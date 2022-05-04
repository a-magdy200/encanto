<?php

namespace App\Http\Controllers;

use App\Models\TrainingPackage;
use App\Models\User;
use App\Models\Gym;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Http\Requests\OrderPackageRequest;

class TrainingPackageController extends Controller
{
    public function index()
    {
        $packages = TrainingPackage::all();
        return view('packages.index', [
            'items' => $packages,
            'title' => 'Training Packages',
            'headings' => ['Package ID','Package Name','Sessions Number','Price','Created At','Updated At']
        ]);
    }

    public function create()
    {
        $packages = TrainingPackage::all();
        return view('packages.create', [
            'packages' => $packages,
        ]);
    }

    public function store(StorePackageRequest $request)
    {
        $request = request()->all();
        TrainingPackage::create([
            'package_name' => $request['package_name'],
            'number_of_sessions' => $request['number_of_sessions'],
            'price' => $request['price'],
        ]);

        return to_route('packages.index');
    }

    public function show($packageId)
    {
        $packages = TrainingPackage::find($packageId);
        return view('packages.show', [
            'items' => $packages,
        ]);
    }
    public function edit($packageId)
    {
        $packages = TrainingPackage::find($packageId);
        return view('packages.edit', [
            'packages' => $packages,
        ]);
    }

    public function update(UpdatePackageRequest $request, $packageId)
    {
        $package = TrainingPackage::find($packageId);
        $data = $request->all();
        $package->update($data);
        return to_route('packages.index');
    }

    public function delete($package)
    {
        TrainingPackage::find($package)->delete();
        return response()->json([],200);
    }

    public function purchase()
    {
        $packages = TrainingPackage::all();
        $clients= User::where('role_id',5)->get();
        $gyms = Gym::all();
        return view('packages.purchase', [
            'packages' => $packages,
            'clients' => $clients,
            'gyms' => $gyms,
        ]);
    }

    public function order(OrderPackageRequest $request)
    {
        $package = TrainingPackage::find($request->get('package_id'));
        Order::create([
            'user_id' => $request->get('user_id'),
            'package_id' => $request->get('package_id'),
            'number_of_sessions'=>$package->number_of_sessions,
            'price' => $package->price,
        ]);

        return to_route('packages.index');
    }
}
