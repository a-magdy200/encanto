<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'manager_id',
    ];
    
    public function manager(): BelongsTo
    {
        return $this->belongsTo(CityManager::class,'manager_id');
    }
    public function gyms(): HasMany
    {
        return $this->hasMany(Gym::class);
    }
}
