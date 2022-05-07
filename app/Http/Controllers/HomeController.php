<?php

namespace App\Http\Controllers;


use App\Events\AppNotificationEvent;
use App\Models\City;
use App\Models\Gym;
use App\Models\Order;
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
        $ordersCount = Order::all()->count();
        $gymsCount = Gym::all()->count();
        $citiesCount = City::all()->count();
        $clientsCount = User::role('Client')->get()->count();
        $femaleClientsCount = User::role("Client")->join('clients', 'users.id','clients.user_id')->where('clients.gender', 'female')->get()->count();
        $maleClientsCount = $clientsCount - $femaleClientsCount;
        $coachesCount = User::role("Coach")->get()->count();
        $gymManagersCount = User::role("Gym Manager")->get()->count();
        $cityManagersCount = User::role("City Manager")->get()->count();
        $stats = [
            [
                "key" => "Orders Count",
                "value" => $ordersCount
            ],
            [
                "key" => "Gyms Count",
                "value" => $gymsCount
            ],
            [
                "key" => "Coaches Count",
                "value" => $coachesCount
            ],
            [
                "key" => "Total Clients Count",
                "value" => $clientsCount
            ],
            [
                "key" => "Female Clients Count",
                "value" => $femaleClientsCount
            ],
            [
                "key" => "Male Clients Count",
                "value" => $maleClientsCount
            ],
            [
                "key" => "Cities Count",
                "value" => $citiesCount
            ],
            [
                "key" => "Gym Managers Count",
                "value" => $gymManagersCount
            ],
            [
                "key" => "City Managers Count",
                "value" => $cityManagersCount
            ],
        ];
        return view('home')->with([
            'stats'=>$stats
        ]);
    }

    public function table() {
        broadcast(new AppNotificationEvent("hi"));
        return 1;
    }
    public function sampleDelete($gymId) {
        Gym::find($gymId)->delete();
        return response()->json([], 200);
    }
}
