<?php

namespace App\Http\Controllers;


use App\Models\GymManager;
use Illuminate\Http\Request;

class GymManagerController extends Controller
{
    public function table() {
        $gymmanagers=GymManager::all();
        //dd($gymmanagers);
        $items = [['id' => 1, 'name'=>'rowan','email'=>'rowan@gmail.com', 'is_banned' => true],['id' => 2, 'name'=>'dina','email'=>'dina@gmail.com', 'is_banned' => false]];
        $headings = ['id', 'name','email', 'is banned'];
        $title='gymmanager';
        return view('table')->with(['items'=> $items, 'title'=>$title, 'headings' => $headings]);

    }
    public function destory($gymmanagerid)
    {
        $gymmanager = GymManager::find($gymmanagerid);
        dd($gymmanager);
//        Storage::delete($post->path);
        $gymmanager->delete();
        //return to_route('gymmanager.index');
    }

}
