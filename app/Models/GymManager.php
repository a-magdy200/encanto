<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymManager extends Model
{
    use HasFactory;
    protected $fillable = [
        'national_id',
        'is_banned',
        'user_id',

    ];
}
