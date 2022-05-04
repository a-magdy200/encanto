<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_of_birth',
        'user_id',
        'gender',
    ];
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
