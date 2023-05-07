<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'account_id',
        'description',
        'amount',
        'date_needed',
        'is_approved',
        'or_src'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
