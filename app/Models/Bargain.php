<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bargain extends Model
{
    use HasFactory;
        protected $fillable = [
        'title',
        'body',
        'photo',
        'start',
        'expiration',
        'note',
        'user_id'
    ];
    protected $dates = ['created_at', 'updated_at', 'start','expiration'];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
