<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'training_session_id',
        'attended_at',
        'added_by',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function training_session(): BelongsTo
    {
        return $this->belongsTo(TrainingSession::class);
    }
}
