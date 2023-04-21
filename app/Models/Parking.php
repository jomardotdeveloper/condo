<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;

    public const STATUS = [
        1 => 'AVAILABLE',
        2 => 'OCCUPIED',
        3 => 'RESERVED',
    ];

    protected $fillable = [
        'user_id', #
        'cluster_id', #
        'unit_tower', #
        'parking_floor_area', #
        'parking_level', #
        'slot_number', #
        'plate_number', #
        'status', #
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cluster()
    {
        return $this->belongsTo(Cluster::class);
    }

    public function getStatusNameAttribute()
    {
        return self::STATUS[$this->status];
    }


}
