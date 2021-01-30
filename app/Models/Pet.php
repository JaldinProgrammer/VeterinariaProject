<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'photo',
        'gender',
        'birthdate',
        'deathdate',
        'color',
        'breed_id',
        'user_id'
    ];

    public function breed()
    {
        return  $this->belongsTo('App\Models\Breed');
    }

    public function user()
    {
        return  $this->belongsTo('App\Models\User');
    }
}
