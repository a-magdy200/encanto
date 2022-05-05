<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\TrainingPackage;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use DataTables;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $headings = ['id', 'Client Name', 'Package Name', 'number_of_sessions', 'price'];
        $title = 'orders';
        if ($request->ajax()) {
            $Orders = Order::select('*');
            return DataTables::of($Orders)
                ->addIndexColumn()
                ->addColumn('Client Name', function ($row) {
                    $clientName=$row->client->user->name;
                    return $clientName;
                })
                ->addColumn('Package Name', function ($row) {
                    $PackageName=$row->package->package_name;
                    return $PackageName;
                })
                ->addColumn('action', function ($row) {
                    $show=route('orders.show',['order'=>$row->id]);
                    $edit=route('orders.edit',['order'=>$row->id]);
                    $delete=route('orders.delete',['id'=>$row->id]);

                    $btn = "<a href='$show' class='btn btn-info'><i class='fa fa-eye'></i></a>
                    <a href='$edit' class='btn btn-warning mx-2'><i class='fa fa-edit'></i></a>
                    <a href='$delete' class='btn btn-danger delete-btn' data-toggle='modal' data-target='#delete-modal'><i class='fa fa-times'></i></a>";
                    return $btn;
                })
                ->rawColumns(['Client Name','action'])
                ->make(true);
        }

        return view('orders.index')->with(['title' => $title, 'headings' => $headings]);
    }
    public function create()
    {
        $users = User::all();
        $packages = TrainingPackage::all();
        return view('orders.create', [
            'users' => $users, 'packages' => $packages
        ]);
    }
    public function store(StoreOrderRequest $request)
    {
        $Package_id = $request->get('package_id');
        $Order_Package = TrainingPackage::find($Package_id);
        Order::create([
            'client_id' => $request->get('user_id'),
            'package_id' => $Package_id,
            'number_of_sessions' => $Order_Package->number_of_sessions,
            'price' => $Order_Package->price,

        ]);
        return to_route('orders.index');
    }
    public function show($order)
    {
        $Order = Order::find($order);
        return view('orders.show', ['order' => $Order]);
    }
    public function edit($orderid)
    {
        $Users = User::all();
        $Packages = TrainingPackage::all();
        $Order = Order::find($orderid);
        return view('orders.edit', [
            'order' => $Order, 'users' => $Users, 'packages' => $Packages
        ]);
    }
    public function update(UpdateOrderRequest $request, $orderid)
    {
        $Order = Order::find($orderid);
        $Order->user_id = $request->get('user_id');
        $Order->package_id = $request->get('package_id');
        $Order->price = $request->get('order_price');
        $Order->number_of_sessions = $request->get('number_of_sessions');
        $Order->update();
        return to_route("orders.index");
    }
    public function delete($id)
    {
        $order = Order::find($id);
        $order->delete();
        return response()->json([], status: 200);
    }
}
