<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'reservable',
        'available',
    ];
    protected $dates = ['created_at', 'updated_at'];
    public function visits(){
        return  $this->hasMany('App\Models\Visit');
    }
    public function reservations(){
        return  $this->hasMany('App\Models\Reservation');
    }
}
