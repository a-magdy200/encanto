<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'package_id',
        'number_of_sessions',
        'price',
    ];
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class,'user_id');
    }
    public function package(): BelongsTo
    {
        return $this->belongsTo(TrainingPackage::class, 'package_id');
    }
    public function trainingPackage()
    {
        return $this->belongsTo(TrainingPackage::class, 'package_id');
    }
}
