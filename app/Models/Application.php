<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    public const NEW_APPLICATION = 1;
    public const FOR_PAYMENT = 2;
    public const LOBBY_GUARD = 3;
    public const DONE = 4;

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

    public function debit() {
        return $this->hasOne(Debit::class);
    }

    public function invoices() {
        return $this->hasMany(Invoice::class);
    }

    public function getFullNameAttribute()
    {
        return $this->last_name . ' ' . $this->first_name . ' ' . $this->middle_name;
    }
   
}
