<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'user_id',
        'name',
        'amount',
        'or_ar_number',
        'date',
        'is_utility_bond',
        'reason'
    ];
}
