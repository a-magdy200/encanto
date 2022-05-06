<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Order;
use App\Models\Gym;
use App\Models\City;
use Illuminate\Support\Facades\DB;
use App\Models\TrainingPackage;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function index()
    {
        /* Admin */
        if (auth()->user()->role_id === 1) {
            $roleId = Role::where('name', '=', 'client')->value('id');
            
            $clients = User::where('role_id', '=', $roleId)->get();
            $orders = Order::all();
            $revenues = Order::all()->sum('price');

            $clientsCount = $clients->count();
            $ordersCount = $orders->count();

        }

        /* City Manager */ 
        elseif (auth()->user()->role_id === 2) {

            $cityId = auth()->user()->manager->city->id;
            
            $orders = DB::table('orders')->select('orders.id')->join('training_packages', 'training_packages.id', 'orders.package_id')
                ->join('gyms', 'gyms.id', 'gym_id')->join('cities', 'cities.id', 'city_id')->where('city_id', $cityId)->get();

            $clients = DB::table('orders')->select('orders.id')->join('training_packages', 'training_packages.id', 'orders.package_id')->select('client_id')
                ->join('gyms', 'gyms.id', 'gym_id')->join('cities', 'cities.id', 'city_id')->where('city_id', $cityId)->select('client_id')->distinct()->get();
            
            $revenues = DB::table('orders')->select('orders.id')->join('training_packages', 'training_packages.id', 'orders.package_id')->select('client_id')
                ->join('gyms', 'gyms.id', 'gym_id')->join('cities', 'cities.id', 'city_id')->where('city_id', $cityId)->sum('orders.price');


            $ordersCount = $orders->count();
            $clientsCount = $clients->count();

       
        }

        /* Gym Manager */
        elseif (auth()->user()->role_id === 3)
        {
            $gymId = auth()->user()->gymManager->gym->id;

            $orders = DB::table('orders')->select('orders.id')->join('training_packages', 'training_packages.id', 'orders.package_id')
            ->join('gyms', 'gyms.id', 'gym_id')->where('gym_id', $gymId)->get();

            $clients = DB::table('orders')->select('orders.id')->join('training_packages', 'training_packages.id', 'orders.package_id')->select('client_id')
            ->join('gyms', 'gyms.id', 'gym_id')->where('gym_id', $gymId)->select('client_id')->distinct()->get();

            $revenues = DB::table('orders')->select('orders.id')->join('training_packages', 'training_packages.id', 'orders.package_id')->select('client_id')
            ->join('gyms', 'gyms.id', 'gym_id')->where('gym_id', $gymId)->sum('orders.price');

       
            $ordersCount = $orders->count();
            $clientsCount = $clients->count();
         
       
        }
        return view('revenues.index', [
            'clientsCount' => $clientsCount,
            'ordersCount' => $ordersCount,
            'revenues' => $revenues,
        ]);
    

    }
}
