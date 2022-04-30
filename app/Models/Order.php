<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'package_id',
        'number_of_sessions',
        'price',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
