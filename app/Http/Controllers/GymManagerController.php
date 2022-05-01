<?php

namespace App\Http\Controllers;


use App\Models\GymManager;
use App\Models\User;
use App\Models\Gym;
use App\Models\City;
use Illuminate\Http\Request;

class GymManagerController extends Controller
{
    public function table() {
        $gymmanagers=GymManager::all()->toArray();
        // dd($gymmanagers);
        // $data=$gymmanagers;
        // dd($data);
        // foreach ($gymmanagers as $gymmanager) {}
            // dd($gymmanager->national_id);
        
            $items = [['id' => 1, 'name'=>'rowan','email'=>'rowan@gmail.com', 'is_banned' => 'true'],['id' => 2, 'name'=>'dina','email'=>'dina@gmail.com', 'is_banned' => false]];
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
        $items = [['id' => 1, 'name'=>'rowan','email'=>'rowan@gmail.com', 'is_banned' => 'true'],['id' => 2, 'name'=>'dina','email'=>'dina@gmail.com', 'is_banned' => false]];
        $headings = ['id', 'name','email', 'is banned'];
        $title='gymmanager';
        return view('table')->with(['items'=> $items, 'title'=>$title, 'headings' => $headings]);
    }

    public function show($gymmanagerid){
        $user = User::where('id',$gymmanagerid)->first();
        $gymmanager = GymManager::where('user_id', $gymmanagerid)->first();
        // dd($gymmanager->gym_id);
        $gym=Gym::where('id',$gymmanager->gym_id)->first();
       // dd($user);
        /**************************************************************************/
        /* $items = [['id' => 2, 'name'=>'Dina','email'=>'Dina@gmail.com', 'is_banned' =>'true','Gym Name'=>'Hola']];
        $headings = ['id', 'name','email', 'is banned','Gym Name'];
        $title='gymmanager';
        return view('table')->with(['items'=> $items, 'title'=>$title, 'headings' => $headings]);*/



        /********************************************************************************* */

        return view('gymmanagers.show', [
            'gymmanager' => $gymmanager,
            'user' => $user,
            'gym'=>$gym,
        ]);


    }

    public function edit ($gymmanagerid){
        $user = User::where('id',$gymmanagerid)->first();
        $gymmanager = GymManager::where('user_id', $gymmanagerid)->first();
        // dd($gymmanager);
        // $gym=Gym::where('id',$gymmanager->gym_id)->first();
        $gyms=Gym::all();
        // dd($gyms);
        return view('gymmanagers.edit', [
            'gymmanager' => $gymmanager,
            'user' => $user,
            'gyms'=>$gyms,
        ]);

    } 
    public function update($gymmanagerid){
        $data = request()->all();
        dd($data);
        $user = User::where('id',$gymmanagerid)->first();
        User::where('id', $gymmanagerid)
        ->update($request->only([
            'name' => $data['name'],
            'email' => $data['email'],
        ]));
        $gym=Gym::where('id',$gymmanager->gym_id)
        ->update($request->only([
            'name' => $data['name'],
        ]));
        
        $items = [['id' => 1, 'name'=>'rowan','email'=>'rowan@gmail.com', 'is_banned' => 'false'],['id' => 2, 'name'=>'dina','email'=>'dina@gmail.com', 'is_banned' => false]];
        $headings = ['id', 'name','email', 'is banned'];
        $title='gymmanager';
    
    return view('table')->with(['items'=> $items, 'title'=>$title, 'headings' => $headings]);


    }


}
