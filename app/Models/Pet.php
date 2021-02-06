<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
//xdxddd
    public function breed()
    {
        return  $this->belongsTo('App\Models\Breed');
    }

    public function user()
    {
        return  $this->belongsTo('App\Models\User');
    }

    public function treatments()
    {
        return  $this->hasMany('App\Models\Treatment');
    }
}
