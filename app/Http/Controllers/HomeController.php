<?php

namespace App\Http\Controllers;


use App\Events\AdminNotificationEvent;
use App\Models\Gym;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth')->only('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function table() {
        broadcast(new AdminNotificationEvent("hi"));
        return 1;
    }
    public function sampleDelete($gymId) {
        Gym::find($gymId)->delete();
        return response()->json([], 200);
    }
}
