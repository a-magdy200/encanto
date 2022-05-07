<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gym extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'cover_image',
        'city_id',
        'created_by',
    ];
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function managers(): HasMany
    {
        return $this->hasMany(GymManager::class)->with('user');
    }
    public function sessions(): HasMany
    {
        return $this->hasMany(TrainingSession::class);
    }
    public function packages(): HasMany
    {
        return $this->hasMany(TrainingPackage::class)->with('orders');
    }
    public function coachesCount(): int
    {
        return 0;
    }


}
