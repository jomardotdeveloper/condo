<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public const ADMINISTRATIVE_OFFICER = 1;
    public const FINANCE_DEPARTMENT = 2;
    public const EXECUTIVE_AO_COMPLEX_MANAGER = 3;
    public const SECURITY_OFFICER = 4;
    
    use HasFactory;

    protected $fillable = [
        'name',
        'is_deletable'
    ];
}
