<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Models\City;
use Illuminate\Http\Request;
use DataTables;

class CityController extends Controller
{
    public function showCities(Request $request){

        $headings=['City Name'];
        $title="Cities";
        if ($request->ajax()) {
            $data = City::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $showUrl = route('show.singleCity',['cityId'=>$row->id]);
                        $editUrl = route('edit.city',['cityId'=>$row->id]);
                        $deleteUrl = route('delete.city',['cityId'=>$row->id ]);
                           $btn ="<a href='$showUrl' class='btn btn-info'><i class='fa fa-eye'></i></a>
                           <a href='$editUrl' class='btn btn-warning mx-2'><i class='fa fa-edit'></i></a>
                           <a href='$deleteUrl' class='btn btn-danger delete-btn' data-toggle='modal' data-target='#delete-modal'><i class='fa fa-times'></i></a>";

                            return $btn;
                    })

                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('CityPages.showAllCities',["headings"=>$headings,"title"=>$title]);

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
            return response()->json([], 200);

        }else{
            return response()->json([], 400);

        }
    }
}
