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
        $items = [['id' => 1, 'test'=>'hi', 'is_banned' => true],['id' => 2, 'test'=>'hi', 'is_banned' => false],['id' => 3, 'test'=>'hi', 'is_banned' => false],['id' => 4, 'test'=>'hi', 'is_banned' => false],['id' => 5, 'test'=>'hi', 'is_banned' => false],['id' => 6, 'test'=>'hi', 'is_banned' => false],['id' => 7, 'test'=>'hi', 'is_banned' => false],['id' => 8, 'test'=>'hi', 'is_banned' => false],['id' => 9, 'test'=>'hi', 'is_banned' => false],['id' => 10, 'test'=>'hi', 'is_banned' => false]];
        $headings = ['id', 'name', 'is banned'];
        $title='test';
        return view('table')->with(['items'=> $items, 'title'=>$title, 'headings' => $headings]);
    }
}
