<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'unit_towers',
        'reading_day',
        'due_date',
        'monthly_due_rate',
        'parking_rate',
        'electricity_rate',
        'water_rate',
        'penalty_rate',
        'recollection_fee'
    ];

    public function getUnitTowersArrayAttribute()
    {
        if($this->unit_towers == null)
            return [];
        return explode(',', $this->unit_towers);
    }

    
}
