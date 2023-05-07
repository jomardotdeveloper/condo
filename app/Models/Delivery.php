<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    public const TYPE = [
        1 => 'FOOD',
        2 => 'PARCEL'
    ];

    protected $fillable = [
        'unit_id',
        'type',
        'receiver_name',
        'from',
        'number_of_items',
        'reference_number',
        'notes',
        'expected_arrival_date',
        'plate_number',
        'is_approved'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function getTypeNameAttribute()
    {
        return self::TYPE[$this->type];
    }

}
