<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoveOut extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_owner',
        'move_out_date',
        'first_name',
        'last_name',
        'middle_name',
        'unit_id',
        'item_lines',
        'charges_checklists',
        'others',
        'or_ar_number',
        'amount',
        'additional_instruction_by_accounting',
        'collection_of_assessments',
        'requested_by',
        'approved_by',
        'cleared_by',
        'verified_by',
        'noted_by',
        'additional_instruction',
        'user_id',
        'status', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function getFullNameAttribute()
    {
        return $this->last_name . ' ' . $this->first_name . ' ' . $this->middle_name;
    }
}
