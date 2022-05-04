<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGymRequest;
use App\Http\Requests\UpdateGymRequest;
use App\Models\City;
use App\Models\Gym;
use Illuminate\Support\Facades\Storage;

class GymController extends Controller
{
    public function showGyms(){
        $gyms=Gym::all();

        return view('GymPages.gyms',["gyms"=>$gyms]);
    }
    public function showGymForm(){
        $cities=City::all();
        return view('GymPages.createGym',["cities"=>$cities]);
    }
    public function createGymForm(StoreGymRequest $request){
        $cities=City::all();
        if ($request->hasFile('gymCoverImg')) {
            $image=$request->file('gymCoverImg');
            $imageName = $image->getClientOriginalName();
            $request->file('gymCoverImg')->storeAs('public/GymImages/',$imageName);
            $gymName=$request->input('gymName');
            $result=Gym::create([
                'name'=>$gymName,
                'cover_image'=>'storage/GymImages/'.$imageName,
                'city_id'=>$request->input('gym_city')
            ]);
            if($result){
                return redirect()->back()->with(["success"=>"Gym is added successfully","cities"=>$cities]);

            }else{
                return redirect()->back()->with(["failed"=>"Gym failed to add","cities"=>$cities]);

            }
        }
        return redirect()->back()->with(["cities"=>$cities]);
    }

    public function showSingleGym($gymId){
        $Gym=Gym::find($gymId);
        return view('GymPages.showSingleGym',["Gym"=>$Gym]);
    }
    public function editGymForm($gymId){
        $Gym=Gym::find($gymId);
        $cities=City::all();
        return view('GymPages.updateGym',["Gym"=>$Gym,"cities"=>$cities]);
    }
    public function updateGymForm(UpdateGymRequest $request,$gymId){
        $gym=Gym::find($gymId);
        if ($request->hasFile('gymCoverImg')) {
            Storage::disk('public')->delete('GymImages/'.$gym['cover_image']);
            $image=$request->file('gymCoverImg');
            $imageName = $image->getClientOriginalName();
            $request->file('gymCoverImg')->storeAs('public/GymImages/',$imageName);
            $gymName=$request->input('gymName');
            $result=$gym->update([
                'name'=>$gymName,
                'cover_image'=>'storage/GymImages/'.$imageName,
                'city_id'=>$request->input('gym_city')
            ]);
            if ($result) {
                return redirect()->back()->with(['success'=>'Gym Updated Successfully']);
            } else {
                return redirect()->back()->with(['error'=>'Failed to update this gym']);
            }
        }else{
            $gym->update([
                'name'=>$request->input('gymName'),
                'city_id'=>$request->input('gym_city')]);
            return redirect()->back()->with(['success'=>'Gym Updated Successfully']);
        }
    }

    public function deleteGym($gymId){
        $gym=Gym::find($gymId);
        $result=$gym->delete();
        if($result){
            Storage::disk('public')->delete('GymImages/'.$gym['cover_image']);
            return redirect()->back()->with(['success'=>'Gym is delete Successfully']);

        }else{
            return redirect()->back()->with(['failed'=>'Gym failed to delete']);

        }
    }
}
