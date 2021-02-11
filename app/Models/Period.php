<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class period extends Model
{
    use HasFactory;
    protected $dates = ['created_at', 'updated_at','begin','end'];

    public function reservations()
    {
        return  $this->hasMany('App\Models\Reservation');
    }
}
