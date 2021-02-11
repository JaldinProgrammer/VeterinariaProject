<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'eventDate'];
    protected $fillable = [
        'message',
        'eventDate',
        'treatment_id',
    ];
    public function treatment()
    {
        return $this->belongsTo('App\Models\Treatment');
    }
}
