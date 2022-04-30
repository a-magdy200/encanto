<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
   public function index()
   {
       $orders=Order::all();
       $headings = ['id','user_id', 'package_id', 'number_of_sessions','price'];
       $title='orders';
       return view('orders.index')->with(['items'=> $orders, 'title'=>$title, 'headings' => $headings]);
    }
}
