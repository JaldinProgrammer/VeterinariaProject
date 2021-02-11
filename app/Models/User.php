<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'veterinarian',
        'admin',
        'photo',
        'customer',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function is_admin()
    {
        if($this->admin)
        {
            return true;
        }
        return false;
    }
    public function is_veterinarian()
    {
        if($this->veterinarian)
        {
            return true;
        }
        return false;
    }

    public function pets()
    {
        return $this->hasMany('App\Models\Pet');
    }

    public function Visits()
    {
        return $this->hasMany('App\Models\Visit');
    }

    public function reservations()
    {
        return  $this->hasMany('App\Models\Reservation');
    }

    public function bargains()
    {
        return  $this->hasMany('App\Models\Bargain');
    }
}
