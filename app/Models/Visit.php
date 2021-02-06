<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'date',
        'time',
        'treatment_id',
        'user_id',
        'service_id',
    ];
    public function treatment()
    {
        return  $this->belongsTo('App\Models\Treatment');
    }

    public function user()
    {
        return  $this->belongsTo('App\Models\User');
    }

    public function service()
    {
        return  $this->belongsTo('App\Models\Service');
    }
}
