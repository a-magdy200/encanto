<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingSessionCoach extends Model
{
    use HasFactory;
    protected $fillable = [
        'training_session_id',
        'coach_id',
    ];
}
