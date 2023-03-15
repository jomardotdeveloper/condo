<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public const CASH_IN = 1;
    public const CASH_OUT = 2;

    protected $fillable = [
        'code',
        'name',
        'is_in',
    ];
}
