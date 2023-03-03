<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_number',
        'cluster_id',
        'unit_tower',
        'unit_floor',
        'unit_room',
        'unit_type',
        'floor_area',
        'unit_association_fee',
        'unit_parking_fee',
        'status',
    ];

    public function cluster()
    {
        return $this->belongsTo(Cluster::class);
    }
}
