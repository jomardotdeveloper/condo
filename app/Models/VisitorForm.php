<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_number',
        'date',
        'date_of_visit',
        'email',
        'is_owner',
        'name_of_visitors',
        'purpose_of_visits',
        'unit_id',
        'user_id',
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
