<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Cashier\Billable;

class Client extends Model
{
    use HasFactory;
    use Billable;

    protected $fillable = [
        'date_of_birth',
        'user_id',
        'gender',
    ];
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function remainingSessionsCount(){
        $totalSessionsCount = $this->totalSessionsCount();
        $attendanceCount = $this->attendance()->count();
        return $totalSessionsCount - $attendanceCount;
    }
    public function totalSessionsCount() {
        $totalSessionsArray = $this->orders()->pluck("number_of_sessions")->toArray();
        $totalSessionsCount = array_sum($totalSessionsArray);
        return $totalSessionsCount;
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function attendance() {
        return $this->hasMany(Attendance::class);
    }

}
