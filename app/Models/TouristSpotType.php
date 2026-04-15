<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TouristSpotType extends Model
{
    protected $table = 'tourist_spot_types';
    protected $fillable = ['type_name', 'type_code'];

    public function spots()
    {
        return $this->hasMany(TouristSpot::class, 'tourist_spot_type_id');
    }
}
