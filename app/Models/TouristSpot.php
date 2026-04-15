<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TouristSpot extends Model
{
    protected $table = 'tourist_spots';
    protected $fillable = [
        'tourist_spot_name', 
        'tourist_spot_address', 
        'reviews', 
        'tourist_spot_cost', 
        'is_active', 
        'city_id', 
        'tourist_spot_type_id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function type()
    {
        return $this->belongsTo(TouristSpotType::class, 'tourist_spot_type_id');
    }
}
