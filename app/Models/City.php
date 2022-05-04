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
<<<<<<< HEAD
    
=======
>>>>>>> b84fb959f6aa3081323b4ee09f5a3ded89b62853
    public function manager(): HasOne
    {
        return $this->hasOne(CityManager::class);
    }
    public function gyms(): HasMany
    {
        return $this->hasMany(Gym::class);
    }
}
