<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoachRequest;
use App\Models\Attendance;
use App\Models\Client;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class CoachController extends Controller
{
    public function index(Request $request)
    {


        $roleID = 4;

        $headings = ['username', 'email'];
        $title = 'coaches';
        if ($request->ajax()) {
            $coaches = User::where('role_id', "=", $roleID)->get();
            return Datatables::of($coaches)
                ->addColumn('action', function($row){
                    $showUrl=route('coaches.show',['coach'=>$row->id]);
                   $editUrl= route('coaches.edit',['coach'=>$row->id]);
                   $deleteUrl=route('coaches.delete',['coach'=>$row->id]);
                  $btn="<a href='$showUrl' class='btn btn-info'><i class='fa fa-eye'></i></a>
                      <a href='$editUrl' class='btn btn-warning mx-2'><i class='fa fa-edit'></i></a>
                            <a href='deleteUrl' class='btn btn-danger delete-btn' data-toggle='modal'
                               data-target='#delete-modal'><i class='fa fa-times'></i></a>";

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('coaches.index')->with(['title' => $title, 'headings' => $headings]);
    }

    public function create()
    {
        return view('coaches.create');
    }

    public function store(StoreCoachRequest $request)
    {
        $data = request()->all();
        if($request->file('avatar'))
        {$path = Storage::putFile('avatars/coaches', $request->file('avatar'));}
        else
            $path=env('DEFAULTIMAGE');
       $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'avatar'=>$path,

        ]);
        $user->assignRole('Coach');
        return to_route('coaches.index');


    }

    public function edit($coachId)
    {

        $coach = User::find($coachId);
        return view('coaches.edit', [
            "coach" => $coach]);
    }

    public function update($coachId,StoreCoachRequest $request)
    {
        $data = request()->all();
        if($request->file('avatar'))
        {$path = Storage::putFile('avatars/coaches', $request->file('avatar'));}
        else
            $path=env('DEFAULTIMAGE');
       $user=User::where('id', $coachId)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'avatar'=>$path,
        ]);
        $user->assignRole('Coach');
        return to_route('coaches.index');
    }

    public function delete($coach)
    {
        User::find($coach)->delete();
        return response()->json([], 200);

    }

    public function show($coachId)
    {  $coach = User::find($coachId);
        return view('coaches.show',['coach'=>$coach]);
    }


}
