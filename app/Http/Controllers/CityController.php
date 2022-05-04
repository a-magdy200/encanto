<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Models\City;


class CityController extends Controller
{
    public function showCities(){
        $cities=City::all();
        return view('CityPages.cities',['cities'=>$cities]);
    }
    public function showCreateCity(){
        return view('CityPages.createCity');
    }

    public function createCity(StoreCityRequest $request){
            $cityName=$request->input('cityName');
            $result=City::create([
                'name'=>$cityName,
            ]);
            if($result){
                return redirect()->back()->with(["success"=>"City is added successfully"]);

            }else{
                return redirect()->back()->with(["failed"=>"City failed to add"]);

            }
    }


    public function showSingleCity($cityId){
        $city=City::find($cityId);
        return view('CityPages.showSingleCity',["city"=>$city]);
    }

    public function editCity($cityId){
        $city=City::find($cityId);
        return view('CityPages.updateCity',["city"=>$city]);
    }

    public function updateCity(StoreCityRequest $request,$cityId){
        $city=City::find($cityId);
        $cityName=$request->input('cityName');
            $result=$city->update([
                'name'=>$cityName,
            ]);
            if ($result) {
                return redirect()->back()->with(['success'=>'City is Updated Successfully']);
            } else {
                return redirect()->back()->with(['error'=>'Failed to update this city']);
            }
    }
    public function deleteCity($cityId){
        $city=City::find($cityId);
        $result=$city->delete();
        if($result){
            return redirect()->back()->with(['success'=>'City is delete Successfully']);

        }else{
            return redirect()->back()->with(['failed'=>'City failed to delete']);

        }
    }
}
