<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class treatment extends Model
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
        protected $dates = ['created_at', 'updated_at', 'initdate','enddate'];

    public function pet()
    {
        return  $this->belongsTo('App\Models\Pet');
    }

    public function visits()
    {
        return $this->hasMany('App\Models\Visit');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }
    

}
