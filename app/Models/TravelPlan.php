<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelPlan extends Model
{
    protected $table = 'travel_plans';
    use SoftDeletes;

    protected $fillable = [
        'activity_id',
        'city_id',
        'title',
        'description',
        'price',
        'day_from',
        'day_to',
        'is_active',
    ];

    protected $casts = [
        'day_from' => 'date',
        'day_to' => 'date',
        'price' => 'double',
        'is_active' => 'boolean',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function touristSpots()
    {
        return $this->hasMany(TouristSpot::class);
    }

    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
