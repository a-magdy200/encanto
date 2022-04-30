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
        $orders = Order::all('id', 'user_id', 'package_id', 'number_of_sessions', 'price')->toArray();
        $headings = ['id', 'user_id', 'package_id', 'number_of_sessions', 'price'];
        $title = 'orders';
        return view('orders.index')->with(['items' => $orders, 'title' => $title, 'headings' => $headings]);
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
        $package_id = $request->get('package_id');
        $order_package = TrainingPackage::find($package_id);
        Order::create([
            'user_id' => $request->get('user_id'),
            'package_id' => $package_id,
            'number_of_sessions' => $order_package->number_of_sessions,
            'price' => $order_package->price,

        ]);
        return to_route('orders.index');
    }
    public function show($orderid)
    {
        $order = Order::find($orderid);
        return view('orders.show', ['order' => $order]);
    }
    public function edit($orderid)
    {
        $users = User::all();
        $packages = TrainingPackage::all();
        $order = Order::find($orderid);
        return view('orders.edit', [
            'order' => $order, 'users' => $users, 'packages' => $packages
        ]);
    }
    public function update($request,$id)
    {
        $order = User::find($id);
        $order->user_id = $request->get('user_id');
        $order->package_id = $request->get('package_id');
        
        $order->update();
        
    }
}
/*
return view('orders.create', [
            'users' => $users, 'packages' => $packages
        ]);
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users = User::all();
        return view('users', ['users' => $users]);
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        User::create([
            'name'=>$request->get('name'),
            'email'=>$request->get('email'),
            'password'=>Hash::make($request->get('password')),
            'role_id'=>$request->get('role_id'),

        ]);
        return to_route('users');

    }
    public function destory($userid)
    {
        $user = User::find($userid);
        $user->delete();
       return to_route('users');

    }
    public function show($userid)
    {
        $user = User::find($userid);
        return view('users.view', ['user' => $user]);


    }
    
}

*/
