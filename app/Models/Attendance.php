<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'training_session_id',
        'attended_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function training_session()
    {
        return $this->belongsTo(Training_Session::class);
    }
}
