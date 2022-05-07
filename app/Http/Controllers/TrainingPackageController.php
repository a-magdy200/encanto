<?php

namespace App\Http\Controllers;

use App\Events\AppNotificationEvent;
use App\Models\TrainingPackage;
use App\Models\User;
use App\Models\Gym;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Http\Requests\OrderPackageRequest;
use Stripe;


use Stripe\BillingPortal\Session;
use Yajra\DataTables\DataTables;

class TrainingPackageController extends Controller
{
    public function ajax(Request $request)
    {
//        $packages = TrainingPackage::select(["id", "package_name", "number_of_sessions", "price", "gym_id"])->get();
        $packages = TrainingPackage::all();
         // dd ($packages);
           return Datatables::of($packages)
            ->addIndexColumn()
            ->addColumn('gym', function ($row) {
                $gymName=$row->gym->name;
                return $gymName;
            })
               ->addColumn('price', function ($row) {
                   return $row->price / 100;
               })
            ->addColumn('action', function ($row) {
                $show=route('packages.show',['package'=>$row->id]);
                $edit=route('packages.edit',['package'=>$row->id]);
                $delete=route('packages.delete',['package'=>$row->id]);

                $btn = "<td class='d-flex align-items-center justify-content-center'><a href='$show' class='btn btn-info'><i class='fa fa-eye'></i></a>
                <a href='$edit' class='btn btn-warning mx-2'><i class='fa fa-edit'></i></a>
                <a href='$delete' class='btn btn-danger delete-btn' data-toggle='modal' data-target='#delete-modal'><i class='fa fa-times'></i></a></td>";
                return $btn;
            })
            ->rawColumns(['gym_id','action', 'price'])
            ->make(true);
    }

   public function index()
    {
        $title = 'Training Packages';
        $headings = ['Package ID', 'Package Name', 'Sessions Number', 'Gym Name', 'Price'];
        return view('packages.index')->with(['title' => $title, 'headings' => $headings]);
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
        if (!auth()->user()->hasAnyRole(["Super Admin", 'City Manager'])) {
            return view("errors.401");
        }
        TrainingPackage::create([
            'package_name' => $request->package_name,
            'number_of_sessions' => $request->number_of_sessions,
            'price' => $request->price,
            'gym_id' => $request->gym_id,
        ]);
        broadcast(new AppNotificationEvent("A new training package has been added"));
        session()->flash("success", "A new training package has been added successfully");
        return to_route('packages.index');
    }

    public function show($packageId)
    {
        $packages = TrainingPackage::find($packageId);
        return view('packages.show', [
            'package' => $packages,
        ]);
    }
    public function edit($packageId)
    {
        if (!auth()->user()->hasRole("Super Admin")) {
            return view("errors.401");
        }
        $gyms = Gym::all();
        $packages = TrainingPackage::find($packageId);
        return view('packages.edit', [
            'packages' => $packages,
            'gyms' => $gyms,
        ]);
    }

    public function update(UpdatePackageRequest $request, $packageId)
    {
        if (!auth()->user()->hasRole("Super Admin")) {
            return view("errors.401");
        }
        $package = TrainingPackage::find($packageId);
        $data = $request->all();
        $package->update($data);
        session()->flash("success", "Training package details has been updated successfully");
        broadcast(new AppNotificationEvent("A training package details has been updated"));
        return to_route('packages.index');
    }

    public function delete($package)
    {
        TrainingPackage::find($package)->delete();
        return response()->json([], 200);
    }

    public function purchase()
    {
        $packages = TrainingPackage::all();
        $clients = User::role("Client")->get();
        $gyms = Gym::all();
        return view('packages.purchase', [
            'packages' => $packages,
            'clients' => $clients,
            'gyms' => $gyms,
        ]);
    }

    public function order(OrderPackageRequest $request)
    {
        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            Stripe\Charge::create([
                "amount" => 100 * 150,
                "currency" => "inr",
                "source" => $request->stripeToken,
                "description" => "Making test payment."
            ]);
            $package = TrainingPackage::find($request->get('package_id'));
            Order::create([
                'client_id' => $request->get('client_id'),
                'package_id' => $request->get('package_id'),
                'number_of_sessions' => $package->number_of_sessions,
                'price' => $package->price,
            ]);
            broadcast(new AppNotificationEvent("A new training package purchase"));
            session()->flash('success', 'Payment has been successfully processed.');
            return to_route('packages.index');
        } catch (\Throwable $th) {
            session()->flash('fail', 'Payment has been failed.');
            dd($th);
            return back();
        }
    }
}
