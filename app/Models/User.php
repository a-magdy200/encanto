<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'role_id'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function city(): BelongsTo
    {
        // TODO:: complete relation
        return $this->belongsTo(City::class);
    }
    public function gym(): BelongsTo
    {
        // TODO:: complete relation
        return $this->belongsTo(Gym::class);
    }
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
    public function manager()
    {
        if ($this->role_id === 3) {
            return $this->hasOne(GymManager::class);
        }
        return $this->hasOne(CityManager::class);
    }
    public function gymManager(): HasOne
    {
        return $this->hasOne(GymManager::class);
    }
    public function client(): HasOne
    {
        return $this->hasOne(Client::class,'user_id');
    }
    public function gymManager(): HasOne
    {
        return $this->hasOne(GymManager::class,'user_id');
    }

}
