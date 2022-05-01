<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\TrainingPackage;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $Orders = Order::all('id', 'user_id', 'package_id', 'number_of_sessions', 'price')->toArray();
        $Headings = ['id', 'user_id', 'package_id', 'number_of_sessions', 'price'];
        $Title = 'orders';
        return view('orders.index')->with(['items' => $Orders, 'title' => $Title, 'headings' => $Headings]);
    }
    public function create()
    {
        $users = User::all();
        $packages = TrainingPackage::all();
        return view('orders.create', [
            'users' => $users, 'packages' => $packages
        ]);
    }
    public function store(Request $request)
    {
        $Package_id = $request->get('package_id');
        $Order_Package = TrainingPackage::find($Package_id);
        Order::create([
            'user_id' => $request->get('user_id'),
            'package_id' => $Package_id,
            'number_of_sessions' => $Order_Package->number_of_sessions,
            'price' => $Order_Package->price,

        ]);
        return to_route('orders.index');
    }
    public function show($orderid)
    {
        $Order = Order::find($orderid);
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
    public function update(Request $request,$orderid)
    {
       // dd($request);
        $Order = Order::find($orderid);
        $Order->user_id = $request->get('user_id');
        $Order->package_id = $request->get('package_id');
        $Order->price = $request->get('order_price');
        $Order->number_of_sessions = $request->get('number_of_sessions');
        $Order->update();
        return to_route("orders.index");
    }
}
