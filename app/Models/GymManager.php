<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GymManager extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'national_id',
        'is_banned',
        'user_id',
        'gym_id',
        'updated_at'
    ];
    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class, 'gym_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
