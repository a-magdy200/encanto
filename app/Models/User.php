<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable ,HasRoles;


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

    public function manager()
    {
        if ($this->hasAnyRole('Gym Manager')) {
            return $this->hasOne(GymManager::class)->with('gym');
        }
        return $this->hasOne(CityManager::class)->with('city');
    }

    public function client(): HasOne
    {
        return $this->hasOne(Client::class,'user_id');
    }

}
