<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResidenceLocation extends Model
{
    protected $table = 'residence_locations';
    protected $fillable = ['location_name', 'location_address', 'is_active', 'location_type_id', 'city_id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function type()
    {
        return $this->belongsTo(ResidenceType::class, 'location_type_id');
    }
}
