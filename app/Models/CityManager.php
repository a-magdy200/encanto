<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class CityManager extends Model
{
    public $timestamps = false;

    use HasFactory;
    protected $fillable = [
        'national_id',
        'user_id',
        'city_id',
        'is_approved',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class)->with('gyms');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
