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
              $item = ['id' => $cityManager->id, 'name'=>$cityManager->name, 'city'=> $cityManager->city];
              array_push($items,$item);
             }
        //$items = [['id' => 1, 'test'=>'hi', 'is_banned' => true],['id' => 2, 'test'=>'hi', 'is_banned' => false],['id' => 3, 'test'=>'hi', 'is_banned' => false],['id' => 4, 'test'=>'hi', 'is_banned' => false],['id' => 5, 'test'=>'hi', 'is_banned' => false],['id' => 6, 'test'=>'hi', 'is_banned' => false],['id' => 7, 'test'=>'hi', 'is_banned' => false],['id' => 8, 'test'=>'hi', 'is_banned' => false],['id' => 9, 'test'=>'hi', 'is_banned' => false],['id' => 10, 'test'=>'hi', 'is_banned' => false]];
        $headings = ['id', 'name', 'city'];
        $title='test';
        return view('table')->with(['items'=> $items, 'title'=>$title, 'headings' => $headings]);
      
        //return view('CityManagers.index',compact('cityManagers'));
    }
    public function show($managerId)
    {
        //$users = User::all();
        //post = Post::find($postId);
        //$comments=$post->comments;
        // return view('posts.show',[
        //     'post' => $post,
        //     'users' => $users,
        //     'comments'=>$comments,
        //     'created_at'=>Carbon::parse($post['created_at'])->format('l jS \of F Y h:i:s A')
            
        // ]);
       return view ('CityManagers.show');
    }
}

