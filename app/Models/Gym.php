<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Gym extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cover_image',
        'city_id',
    ];
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function managers(): HasMany
    {
        return $this->hasMany(GymManager::class);
    }
    public function sessions(): HasMany
    {
        return $this->hasMany(TrainingSession::class);
    }
}
