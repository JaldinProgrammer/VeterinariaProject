<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'specie_id',
    ];
    protected $dates = ['created_at', 'updated_at'];

    public function specie()
    {
        return  $this->belongsTo('App\Models\Specie');
    }

    public function pets()
    {
        return $this->hasMany('App\Models\Pet');
    }
}
