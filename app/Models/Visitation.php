<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitation extends Model
{
    use HasFactory;

    public const VALID_IDS = [
        1 => 'Passport',
        2 => 'Drivers License',
        3 => 'UMID',
        4 => 'SSS',
        5 => 'PRC ID',
        6 => 'Voters ID',
        7 => 'Postal ID',
    ];

    protected $fillable = [
        'visitor_id',
        'unit_id',
        'valid_id',
        'valid_id_number',
        'reason',
        'number_of_guests',
        'plate_number',
        'expected_arrival_date',
        'is_approved'
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function getValidIdNameAttribute()
    {
        return self::VALID_IDS[$this->valid_id];
    }
}
