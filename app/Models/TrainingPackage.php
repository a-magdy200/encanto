<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingPackage extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_name',
        'number_of_sessions',
        'price',
        'gym_id'
    ];
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }
}
