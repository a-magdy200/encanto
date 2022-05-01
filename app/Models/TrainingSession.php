<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingSession extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'day',
        'start_time',
        'finish_time',
        'gym_id',
    ];
    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }
    public function coach(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'training_sessions_coaches', 'training_session_id', 'user_id');
    }
    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
}
