<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training_Session extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'started_at',
        'finished_at',
        'gym_id',
    ];
    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
}
