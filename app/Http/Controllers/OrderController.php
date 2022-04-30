<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
   public function index()
   {
       $orders=Order::all()->toArray();;
       $headings = ['id','user_id', 'package_id', 'number_of_sessions','price'];
       $title='orders';
       return view('orders.index')->with(['items'=> $orders, 'title'=>$title, 'headings' => $headings]);
    }
}
/*
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