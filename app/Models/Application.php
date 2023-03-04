<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'is_owner',
        'user_id',
        'unit_id',
        'move_in_id',
        'status',
        'resident_information_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function moveIn()
    {
        return $this->belongsTo(MoveIn::class);
    }

    public function residentInformation()
    {
        return $this->belongsTo(ResidentInformation::class);
    }

    public function getFullNameAttribute()
    {
        return $this->last_name . ' ' . $this->first_name . ' ' . $this->middle_name;
    }
}
