<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('index');
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
        $items = [[1, 'hi'],[2, 'hi'],[3, 'hi'],[4, 'hi'],[5, 'hi'],[6, 'hi'],[7, 'hi'],[8, 'hi'],[9, 'hi'],[10, 'hi']];
        $headings = ['id', 'name'];
        $title='test';
        return view('table')->with(['items'=> $items, 'title'=>$title, 'headings' => $headings]);
    }
}
