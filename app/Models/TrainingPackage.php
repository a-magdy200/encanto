<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingPackage extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_name',
        'sessions_number',
        'price_in_cents',
    ];
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
