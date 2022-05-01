<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingSession;
class Training_SessionController extends Controller
{
    public function index()
    {
        $trainingSessions = TrainingSession::all('id', 'user_id', 'package_id', 'number_of_sessions', 'price')->toArray();
        $Headings = ['id', 'user_id', 'package_id', 'number_of_sessions', 'price'];
        $Title = 'orders';
        return view('trainingSessions.index')->with(['items' => $trainingSessions, 'title' => $Title, 'headings' => $Headings]);
    }
}
