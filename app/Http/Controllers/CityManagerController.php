<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\City;
use App\Models\CityManager;
use App\Http\Requests\UpdateCityManagerRequest;
use App\Http\Requests\AddCityManagerRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Averages;

class CityManagerController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $roleId = Role::where('name', '=', 'city_manager')->value('id');
        $cityManagers = User::where('role_id', '=', $roleId)->get();
        $headings = ['id', 'name', 'city'];
        $title = 'City Managers';

        return view('citymanagers.index', [
            'cityManagers' => $cityManagers,
            'title' => $title,
            'headings' => $headings
        ]);
    }
    public function show($managerId)
    {
        // TODO :: show Image
        
        $user = User::find($managerId);
        return view('citymanagers.show', [
=======
        //User::find()
        $items=[];
        $roleId=Role::where('name','=','city_manager')->value('id');
        $cityManagers=User::find($roleId)->get();
        //dd($cityManagers);
        foreach ($cityManagers as $cityManager)
             {
              //dd($cityManager->city); // returns null ??????
              $item = ['id' => $cityManager->id, 'name'=>$cityManager->name, 'city'=> $cityManager->city];
              //dd($item['id']);
              array_push($items,$item);
             }
        //$items = [['id' => 1, 'test'=>'hi', 'is_banned' => true],['id' => 2, 'test'=>'hi', 'is_banned' => false],['id' => 3, 'test'=>'hi', 'is_banned' => false],['id' => 4, 'test'=>'hi', 'is_banned' => false],['id' => 5, 'test'=>'hi', 'is_banned' => false],['id' => 6, 'test'=>'hi', 'is_banned' => false],['id' => 7, 'test'=>'hi', 'is_banned' => false],['id' => 8, 'test'=>'hi', 'is_banned' => false],['id' => 9, 'test'=>'hi', 'is_banned' => false],['id' => 10, 'test'=>'hi', 'is_banned' => false]];
        $headings = ['id', 'name', 'city'];
        $title='citymanager';

        return view('table')->with(['items'=> $items, 'title'=>$title, 'headings' => $headings]);

        //return view('CityManagers.index',compact('cityManagers'));
    }
    public function show($ManagerId){

        $user = User::find($ManagerId)->first();
        //dd($user->manger->national_id);
        return view('citymanagers.show',[
>>>>>>> b84fb959f6aa3081323b4ee09f5a3ded89b62853
            'user' => $user
        ]);
    }
    public function edit($managerId)
    {
        $user = User::find($managerId);
        $cities = City::all();
        return view('citymanagers.edit', [
            'user' => $user,
            'cities' => $cities
        ]);
    }
    public function update($managerId, UpdateCityManagerRequest $request)
    {
        $data = request()->all();

        $user = User::find($managerId);
        if (!Hash::check($data['old_password'], $user->password)) {

            return redirect()->back()->with('error', 'old password is not correct');
        } else {

            if ($request->hasFile('avatar')) {
                Storage::disk('public')->delete('public/images' . User::find($managerId)->avatar);
                $detination_path = 'public/images';
                $avatar = $request->file('avatar');
                $avatar_name = $avatar->getClientOriginalName();
                $request->file('avatar')->storeAs($detination_path, $avatar_name);
            } else {
                $avatar_name = User::find($managerId)->avatar;
            }

            User::where('id', $managerId)->update([
                'name' => $data['name'],
                'email' =>  $data['email'],
                'password' => Hash::make($data['new_password']),
                'avatar' => $avatar_name,
            ]);
            return redirect()->route('citymanagers.index');
        }
    }
    public function create()
    {
        $cities = City::all();
        return view('citymanagers.create', [
            'cities' => $cities,
        ]);
    }
<<<<<<< HEAD
    public function store(AddCityManagerRequest $request)
    {
        $data = request()->all();
        if ($request->hasFile('avatar')) {
            $detination_path = 'public/images';
            $avatar = $request->file('avatar');
            $avatar_name = $avatar->getClientOriginalName();
            $request->file('avatar')->storeAs($detination_path, $avatar_name);
        } else {
            $avatar_name = 'default_avatar.jpg';
        }
=======
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
public function edit($managerId)
{

    $user = User::find($managerId);
    //dd($user['id']);
    return view('citymanagers.edit',[
        'user' => $user,
    ]);

}
public function update($managerId){
    //$data = request()->all();

    //Storage::delete(Post::find($managerId)->path);
    //$path = Storage::putFile('avatars', $request->file('avatar'));

  /*  User::where('id',$managerId)->update([
        'title' => $post['Title'],
        'description' =>  $post ['Description'],
        'user_id' => $post['post_creator'],
        'path' => $path,
    ]);*/
    return redirect()->route('citymanagers.index');

}
public function destroy($managerId)
{
    //Storage::delete(User::find($managerId)->path);
    $user = User::find($managerId);
    $user->delete();
    return redirect()->route('citymanagers.index');
}
}
>>>>>>> b84fb959f6aa3081323b4ee09f5a3ded89b62853

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar' => $avatar_name,
            'role_id' => 2
        ]);

        $userId = User::where('email', '=', $data['email'])->value('id');

        CityManager::create([
            'national_id' => $data['national_id'],
            'user_id' => $userId,
            'city_id' => $data['city'],
        ]);

        return redirect()->route('citymanagers.index');
    }
    public function destroy($managerId)
    {   
        // TODO :: use ajax

        Storage::disk('public')->delete('public/images' . User::find($managerId)->avatar);
        $user = User::find($managerId);
        $user->delete();
        return redirect()->route('citymanagers.index');
    }
}
