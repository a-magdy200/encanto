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
        $user = auth()->user();
        if ($user->hasRole('Super Admin')) {
            //$roleId = Role::where('name', '=', 'client')->value('id');
            $users=User::role('Client')->get();
//            $users = User::where('role_id', '=', $roleId)->get();
            $orders = Order::all();
            $totalRevenues = Order::all()->sum('price');

            $allUsersCount = $users->count();
            $allOrdersCount = $orders->count();

            return view('revenues.index', [
                'allUsersCount' => $allUsersCount,
                'allOrdersCount' => $allOrdersCount,
                'totalRevenues' => $totalRevenues,
            ]);
        }

        /* City Manager */
        elseif ($user->hasRole('City Manager')) {

            //$cityId = auth()->user()->manager->city->id;
            $cityId=User::with('manager')->find($user->id)->manager->city->id;
            $cityOrders = DB::table('orders')->select('orders.id')->join('training_packages', 'training_packages.id', 'orders.package_id')
                ->join('gyms', 'gyms.id', 'gym_id')->join('cities', 'cities.id', 'city_id')->where('city_id', $cityId)->get();

            $cityClients = DB::table('orders')->select('orders.id')->join('training_packages', 'training_packages.id', 'orders.package_id')->select('client_id')
                ->join('gyms', 'gyms.id', 'gym_id')->join('cities', 'cities.id', 'city_id')->where('city_id', $cityId)->select('client_id')->distinct()->get();

            $cityRevenues = DB::table('orders')->select('orders.id')->join('training_packages', 'training_packages.id', 'orders.package_id')->select('client_id')
                ->join('gyms', 'gyms.id', 'gym_id')->join('cities', 'cities.id', 'city_id')->where('city_id', $cityId)->sum('orders.price');


            $cityOrdersCount = $cityOrders->count();
            $cityClientsCount = $cityClients->count();

            return view('revenues.index', [
                'cityOrdersCount' => $cityOrdersCount,
                'cityClientsCount' => $cityClientsCount,
                'cityRevenues' => $cityRevenues,
            ]);
        }

        /* Gym Manager */
        elseif ($user->hasRole('Gym Manager'))
        {
            $gymId = auth()->user()->gymManager->gym->id;

            $gymOrders = DB::table('orders')->select('orders.id')->join('training_packages', 'training_packages.id', 'orders.package_id')
            ->join('gyms', 'gyms.id', 'gym_id')->where('gym_id', $gymId)->get();

            $gymClients = DB::table('orders')->select('orders.id')->join('training_packages', 'training_packages.id', 'orders.package_id')->select('client_id')
            ->join('gyms', 'gyms.id', 'gym_id')->where('gym_id', $gymId)->select('client_id')->distinct()->get();

            $gymRevenues = DB::table('orders')->select('orders.id')->join('training_packages', 'training_packages.id', 'orders.package_id')->select('client_id')
            ->join('gyms', 'gyms.id', 'gym_id')->where('gym_id', $gymId)->sum('orders.price');


            $gymOrdersCount = $gymOrders->count();
            $gymClientsCount = $gymClients->count();

            return view('revenues.index', [
                'gymOrdersCount' => $gymOrdersCount,
                'gymClientsCount' => $gymClientsCount,
                'gymRevenues' => $gymRevenues,
            ]);


        }


    }
}
