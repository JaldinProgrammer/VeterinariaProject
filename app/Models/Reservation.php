<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    use HasFactory;
    protected $dates = ['created_at', 'updated_at', 'date'];
    protected $fillable = [
        'description',
        'active',
        'pet_id',
        'user_id',
        'period_id',
        'date',
        'service_id'
    ];
    public function user()
    {
        return  $this->belongsTo('App\Models\User');
    }
    public function pet()
    {
        return  $this->belongsTo('App\Models\Pet');
    }
    public function period()
    {
        return  $this->belongsTo('App\Models\Period');
    }
    public function service()
    {
        return  $this->belongsTo('App\Models\Service');
    }
}
