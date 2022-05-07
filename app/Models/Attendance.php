<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'training_session_id',
        'attended_at',
        'added_by',
    ];
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
    public function added() {
        return $this->belongsTo(User::class, 'added_by');
    }
    public function training_session(): BelongsTo
    {
        return $this->belongsTo(TrainingSession::class);
    }
}
