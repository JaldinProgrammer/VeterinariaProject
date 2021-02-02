<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;    
    protected $fillable = [
        'diagnostic',
        'initdate',
        'enddate',
        'pet_id',
        'visit',
        'price',
    ];
    public function pet()
    {
        return  $this->belongsTo('App\Models\Pet');
    }

    public function visits()
    {
        return $this->hasMany('App\Models\Visit');
    }

    

}
