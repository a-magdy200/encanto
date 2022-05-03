<?php

namespace App\Http\Controllers\PageContent;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGymRequest;
use Illuminate\Http\Request;
use App\Models\Gym;
use Illuminate\Support\Facades\Storage;

class GymController extends Controller
{
    public function showGyms(){
        $gyms=Gym::all();
        return view('GymPages.gyms',["gyms"=>$gyms]);
    }
    public function showGymForm(){
        return view('GymPages.createGym');
    }
    public function createGymForm(StoreGymRequest $request){

        if ($request->hasFile('gymCoverImg')) {
            $image=$request->file('gymCoverImg');
            $imageName = $image->getClientOriginalName();
            $request->file('gymCoverImg')->storeAs('public/GymImages/',$imageName);
            $gymName=$request->input('gymName');
            $result=Gym::create([
                'name'=>$gymName,
                'cover_image'=>$imageName
            ]);
            if($result){
                return redirect()->back()->with(["success"=>"Gym is added successfully"]);

            }else{
                return redirect()->back()->with(["failed"=>"Gym failed to add"]);

            }
        }
        return redirect()->back();
    }

    public function showSingleGym($gymId){
        $Gym=Gym::find($gymId);
        return view('GymPages.showSingleGym',["Gym"=>$Gym]);
    }
    public function editGymForm($gymId){
        $Gym=Gym::find($gymId);
        return view('GymPages.updateGym',["Gym"=>$Gym]);
    }
    public function updateGymForm(StoreGymRequest $request,$gymId){
        $gym=Gym::find($gymId);
        if ($request->hasFile('gymCoverImg')) {
            Storage::disk('public')->delete('GymImages/'.$gym['cover_image']);
            $image=$request->file('gymCoverImg');
            $imageName = $image->getClientOriginalName();
            $request->file('gymCoverImg')->storeAs('public/GymImages/',$imageName);
            $gymName=$request->input('gymName');
            $result=$gym->update([
                'name'=>$gymName,
                'cover_image'=>$imageName
            ]);
            if ($result) {
                return redirect()->back()->with(['success'=>'Gym Updated Successfully']);
            } else {
                return redirect()->back()->with(['error'=>'Failed to update this gym']);
            }
        }else{
            $gym->update($request->input());
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
