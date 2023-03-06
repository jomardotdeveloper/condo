<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        "date",
        'mobile_number',
        'email',
        'address',
        'occupation',
        'citizenship',
        'marital_status',
        'telephone_number',
        'parking_slot',
        'gender',
        'emergency_name',
        'emergency_contact',
        'emergency_address',
        'authorized_unit_occupant_lines',
        'househelper_driver_lines',
        'requested_by',
        'noted_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
