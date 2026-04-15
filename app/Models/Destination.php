<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $table = 'destination_activities';
    protected $fillable = [
        'activity_id', 
        'activity_cost', 
        'reviews', 
        'city_id', 
        'best_months', 
        'is_active'
    ];

    protected $casts = [
        'best_months' => 'json',
        'is_active' => 'boolean',
        'activity_cost' => 'double',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
