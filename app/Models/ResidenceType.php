<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResidenceType extends Model
{
    protected $table = 'residence_types';
    protected $fillable = ['type_name', 'type_code'];

    public function locations()
    {
        return $this->hasMany(ResidenceLocation::class, 'location_type_id');
    }
}
