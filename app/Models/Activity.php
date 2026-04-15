<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';
    protected $fillable = ['activity_name', 'activity_code', 'city_id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
