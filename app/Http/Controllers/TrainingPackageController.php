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
use DataTables;

class TrainingPackageController extends Controller
{
    public function ajax(Request $request)
    {
       // $packages = TrainingPackage::with('gym')->get();
        $packages = TrainingPackage::select('*');
         // dd ($packages);
           return Datatables::of($packages)
            ->addIndexColumn()
            ->addColumn('gym_id', function ($row) {
                $gymName=$row->gym->name;
                return $gymName;
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
            ->rawColumns(['gym_id','action'])
            ->make(true);
    }

   public function index()
    {
        $title = 'Training Packages';
        $headings = ['Package ID', 'Package Name', 'Sessions Number', 'Gym Name', 'Price', 'Created At', 'Updated At'];
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
        $request = request()->all();
        if (auth()->user()->hasAnyRole(['Super Admin', 'City Manager'])) {
            $gymId = $request->get('gymid');
        } elseif (auth()->user()->hasRole('Gym Manager')) {
            $gymId = auth()->user()->manager->gym_id;
        }
        TrainingPackage::create([
            'package_name' => $request['package_name'],
            'number_of_sessions' => $request['number_of_sessions'],
            'price' => $request['price'],
            'gym_id' => $gymId,
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
        return response()->json([], 200);
    }

    public function purchase()
    {
        $packages = TrainingPackage::all();
        $clients = User::where('role_id', 5)->get();
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
            Session::flash('success', 'Payment has been successfully processed.');
            return to_route('packages.index');
        } catch (\Throwable $th) {
            Session::flash('fail', 'Payment has been failed.');
            return back();
        }
    }
}
