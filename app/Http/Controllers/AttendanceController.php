<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\StoreAttendanceRequest;
    use App\Models\Attendance;
    use App\Models\Client;
    use App\Models\TrainingSession;
    use Illuminate\Http\Request;
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Facades\DB;
    use Yajra\DataTables\DataTables;


    class AttendanceController extends Controller
    {
        public function index(Request $request)
        {
            $user = auth()->user();
            $manager = auth()->user()->manager;
            $title = 'Attendance';
            $attendances = [];
            if ($user->hasRole('Super Admin')) {
                $attendances = Attendance::all();
                $headings = ['User Name', 'Email ', 'Date', 'Time', 'Session Same', 'Gym', 'City'];
            } elseif ($user->hasRole('City Manager')) {

                $headings = ['User Name', 'Email ', 'Date', 'Time', 'Session Same', 'Gym'];
                if ($manager->city) {
                    $cityId = $manager->city->id;
                    $attendanceIds = DB::table('attendances')->select('attendances.id')->join('training_sessions', 'training_sessions.id', 'training_session_id')
                        ->join('gyms', 'gyms.id', 'gym_id')->join('cities', 'cities.id', 'city_id')->where('city_id', $cityId)->get()->pluck('id')->toArray();
                    $attendances = Attendance::whereIn('id', $attendanceIds)->get();
                }
            } elseif ($user->hasRole('Gym Manager')) {
                $headings = ['User Name', 'Email ', 'Date', 'Time', 'Session Same'];
                if ($manager->gym) {
                    $gymId = $manager->gym->id;
                    $attendanceIds = DB::table('attendances')->select('attendances.id')->join('training_sessions', 'training_sessions.id', 'training_session_id')
                        ->join('gyms', 'gyms.id', 'gym_id')->where('gym_id', $gymId)->get()->pluck('id')->toArray();
                    $attendances = Attendance::whereIn('id', $attendanceIds)->get();
                }
            }
            if ($request->ajax()) {
                $dataTables = Datatables::of($attendances)
                    ->addColumn('action', function ($row) {
                        $editUrl = route('attendance.edit', ['attendance' => $row]);
                        $deleteUrl = route('attendance.delete', ['attendance' => $row]);
                        $btn = "<a href='$editUrl' class='btn btn-warning mx-2'><i class='fa fa-edit'></i></a>
                            <a href='$deleteUrl' class='btn btn-danger delete-btn' data-toggle='modal'
                               data-target='#delete-modal'><i class='fa fa-times'></i></a>";
                        return $btn;
                    })
                    ->addColumn('name', function ($row) {
                        return $row->client->user->name;
                    })
                    ->addColumn('email', function ($row) {
                        return $row->client->user->email;
                    })
                    ->addColumn('date', function ($row) {
                        return Carbon::parse($row->attended_at)->format('Y-m-d');
                    })
                    ->addColumn('time', function ($row) {
                        return Carbon::parse($row->attended_at)->format('H:i:s');
                    })
                    ->addColumn('training_session', function ($row) {
                        return $row->training_session->name;
                    });
                if ($user->hasRole('Super Admin')) {
                    $dataTables->addColumn('gym', function ($row) {
                        return $row->training_session->gym->name;
                    });
                    $dataTables->addColumn('city', function ($row) {
                        return $row->training_session->gym->city->name;
                    });
                    $dataTables->rawColumns(['action', 'name', 'email', 'date', 'time', 'gym', 'city', 'training_session']);
                } elseif ($user->hasRole('City Manager')) {
                    if ($manager->city) {
                        $dataTables->addColumn('gym', function ($row) {
                            $gym = $row->training_session->gym->name;
                            return $gym;
                        });
                        $dataTables->rawColumns(['action', 'name', 'email', 'date', 'time', 'gym', 'training_session']);
                    }
                } elseif ($user->hasRole('Gym Manager')) {
                    $dataTables->rawColumns(['action', 'name', 'email', 'date', 'time', 'training_session']);
                }
                return $dataTables->make(true);
            }
            return view('attendance.index')->with(['title' => $title, 'headings' => $headings]);

        }

        public function store(StoreAttendanceRequest $request)
        {
            $data = request()->all();
            session()->flash("success", "Attendance recorded successfully");
            Attendance::create([
                'training_session_id' => $data['training_session_id'],
                'client_id' => $data['client_id'],
                'attended_at' => $data['date'],

            ]);
            return to_route('attendance.index');
        }

        public function create()
        {
            $trainingSessions = TrainingSession::all();
            $clients = Client::all();

            return view('attendance.create', [
                "clients" => $clients,
                "trainingSessions" => $trainingSessions
            ]);
        }

        public function edit(Attendance $attendance)
        {

            $trainingSessions = TrainingSession::all();
            $clients = Client::all();

            return view('attendance.edit', [
                "clients" => $clients,
                "trainingSessions" => $trainingSessions,
                "attendance" => $attendance
            ]);
        }

        public function update($attendanceId, StoreAttendanceRequest $request)
        {
            $data = request()->all();
            Attendance::where('id', $attendanceId)->update([
                'training_session_id' => $data['training_session_id'],
                'client_id' => $data['client_id'],
                'attended_at' => $data['date'],
            ]);
            return to_route('attendance.index');
        }

        public function delete($attendanceId)
        {
            Attendance::find($attendanceId)->delete();
            return response()->json([], 200);
        }
    }
