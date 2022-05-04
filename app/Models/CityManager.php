<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;
>>>>>>> b84fb959f6aa3081323b4ee09f5a3ded89b62853

class CityManager extends Model
{
    public $timestamps = false;

    use HasFactory;
    protected $fillable = [
        'national_id',
        'user_id',
        'city_id'
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
