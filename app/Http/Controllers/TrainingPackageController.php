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
use Stripe;
use Session;

class TrainingPackageController extends Controller
{
    public function index()
    {
        $packages = TrainingPackage::with('gym')->get();
        // $package-gym->name
        return view('packages.index', [
            'items' => $packages,
            'title' => 'Training Packages',
            'headings' => ['Package ID','Package Name','Sessions Number','Gym','Price','Created At','Updated At']
        ]);
    }

    public function create()
    {
        $gyms = Gym::all();
        return view('packages.create', [
            'gyms' => $gyms,
        ]);
    }

    public function store(StorePackageRequest $request)
    {
        $request = request()->all();
        TrainingPackage::create([
            'package_name' => $request['package_name'],
            'number_of_sessions' => $request['number_of_sessions'],
            'price' => $request['price'],
            'gym_id' => $request['gym_id'],
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
        $gyms = Gym::all();
        $packages = TrainingPackage::find($packageId);
        return view('packages.edit', [
            'packages' => $packages,
            'gyms' => $gyms,
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
        return view('packages.purchase', [
            'packages' => $packages,
            'clients' => $clients,
        ]);
    }

    public function order(OrderPackageRequest $request)
    {
        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            Stripe\Charge::create ([
                    "amount" => 100 * 150,
                    "currency" => "inr",
                    "source" => $request->stripeToken,
                    "description" => "Making test payment." 
            ]);
            
            $package = TrainingPackage::find($request->get('package_id'));
            Order::create([
                'client_id' => $request->get('client_id'),
                'package_id' => $request->get('package_id'),
                'number_of_sessions'=>$package->number_of_sessions,
                'price' => $package->price,
            ]);
            Session::flash('success', 'Payment has been successfully processed.');
        return to_route('packages.index');
           } catch (\Throwable $th) {
            Session::flash('fail', 'Payment has been failed.');
            return back();
           }
    }
}
