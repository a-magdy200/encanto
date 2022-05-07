<?php

namespace App\Http\Controllers;

use App\Events\AppNotificationEvent;
use App\Http\Requests\StoreCityRequest;
use App\Models\City;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CityController extends Controller
{
    public function index(Request $request){

        $headings=['City Name', 'Actions'];
        $title="Cities";
        if ($request->ajax()) {
            $data = City::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $showUrl = route('cities.show',['city'=>$row->id]);
                        $editUrl = route('cities.edit',['city'=>$row->id]);
                        $deleteUrl = route('cities.destroy',['city'=>$row->id ]);
                           $btn ="<a href='$showUrl' class='btn btn-info'><i class='fa fa-eye'></i></a>
                           <a href='$editUrl' class='btn btn-warning mx-2'><i class='fa fa-edit'></i></a>
                           <a href='$deleteUrl' class='btn btn-danger delete-btn' data-toggle='modal' data-target='#delete-modal'><i class='fa fa-times'></i></a>";

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('cities.index',["headings"=>$headings,"title"=>$title]);

    }
    public function create(){
        return view('cities.create');
    }

    public function store(StoreCityRequest $request){
            $cityName=$request->input('cityName');
            $result=City::create([
                'name'=>$cityName,
            ]);
            if($result){
                broadcast(new AppNotificationEvent("A new city has been added"));
                session()->flash("success", "City is added successfully");
            } else {
                session()->flash("failed", "City failed to add");
            }
            return to_route("cities.index");
    }


    public function show(City $city){
        return view('cities.show',["city"=>$city]);
    }

    public function edit($cityId){
        $city=City::find($cityId);
        return view('cities.edit',["city"=>$city]);
    }

    public function update(StoreCityRequest $request,$cityId){
        $city=City::find($cityId);
        $cityName=$request->input('cityName');
            $result=$city->update([
                'name'=>$cityName,
            ]);
        if($result){
            broadcast(new AppNotificationEvent("A new city has been updated"));
            session()->flash("success", "City is updated successfully");
        } else {
            session()->flash("failed", "City failed to update");
        }
        return to_route("cities.index");
    }
    public function destroy($cityId){
        $city=City::find($cityId);
        $result=$city->delete();
        if($result){
            broadcast(new AppNotificationEvent("A city has been deleted"));
            return response()->json([], 200);

        }else{
            return response()->json([], 400);

        }
    }
}
