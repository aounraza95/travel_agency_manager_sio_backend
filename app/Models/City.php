<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $fillable = ['name', 'code', 'country_id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function residenceLocations()
    {
        return $this->hasMany(ResidenceLocation::class);
    }

    public function touristSpots()
    {
        return $this->hasMany(TouristSpot::class);
    }

    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }
}
