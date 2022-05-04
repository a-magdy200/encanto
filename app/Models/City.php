<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    
    public function manager(): HasOne
    {
        return $this->hasOne(CityManager::class);
    }
    public function gyms(): HasMany
    {
        return $this->hasMany(Gym::class);
    }
}
