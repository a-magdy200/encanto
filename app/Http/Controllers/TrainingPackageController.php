<?php

namespace App\Http\Controllers;

use App\Models\TrainingPackage;
use Illuminate\Http\Request;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;

class TrainingPackageController extends Controller
{
    public function index()
    {
        $packages = TrainingPackage::all()->toArray();
        //$packages[0]['price_in_cents']/100;
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
            'sessions_number' => $request['sessions_number'],
            'price_in_cents' => $request['price_in_cents'],
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

    public function delete($packageId)
    {
        $packages = TrainingPackage::find($packageId);
        return view('packages.delete', [
            'packages' => $packages,
        ]);
    }

    public function destroy($packageId)
    {
        $package = TrainingPackage::find($packageId);
        $package->delete();
        return to_route('packages.index');
    }
}
