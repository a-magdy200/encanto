<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\City;
use App\Models\CityManager;

class CityManagerController extends Controller
{
    public function index()
    {
        //User::find()
        $items=[];
        $roleId=Role::where('role_name','=','admin')->value('id');
        $cityManagers=User::find($roleId)->get();
        //dd($cityManagers);
        foreach ($cityManagers as $cityManager)
             {
              //dd($cityManager->city); // returns null ??????
              $item = ['id' => $cityManager->id, 'name'=>$cityManager->name, 'city'=> $cityManager->city];
              array_push($items,$item);
             }
        //$items = [['id' => 1, 'test'=>'hi', 'is_banned' => true],['id' => 2, 'test'=>'hi', 'is_banned' => false],['id' => 3, 'test'=>'hi', 'is_banned' => false],['id' => 4, 'test'=>'hi', 'is_banned' => false],['id' => 5, 'test'=>'hi', 'is_banned' => false],['id' => 6, 'test'=>'hi', 'is_banned' => false],['id' => 7, 'test'=>'hi', 'is_banned' => false],['id' => 8, 'test'=>'hi', 'is_banned' => false],['id' => 9, 'test'=>'hi', 'is_banned' => false],['id' => 10, 'test'=>'hi', 'is_banned' => false]];
        $headings = ['id', 'name', 'city'];
        $title='citymanager';
        return view('table')->with(['items'=> $items, 'title'=>$title, 'headings' => $headings]);
      
        //return view('CityManagers.index',compact('cityManagers'));
    }
    public function show($ManagerId){
        return view('citymanagers.show');
    }
    public function create()
    {
        // $users = User::all();
        // return view('posts.create',[
        //     'users' => $users,
        // ]);
        return view('citymanagers.create');
    }
    public function store()
    {  
        //$post = request()->all();
       // $path = Storage::putFile('avatars', $request->file('avatar'));
        // Post::create([
        //     'title' => $post['title'],
        //     'description' => $post['description'],
        //     'user_id' => $post['post_creator'],
        //     'path' => $path,
        // ]);
        return redirect()->route('citymanagers.index');            
    }
}

