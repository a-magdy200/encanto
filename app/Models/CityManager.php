<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CityManager extends Model
{
    use HasFactory;
    protected $fillable = [
        'national_id',
        'user_id',
        'city_id',
    ];

    public function city(): HasOne
    {
        return $this->hasOne(City::class,'manager_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
