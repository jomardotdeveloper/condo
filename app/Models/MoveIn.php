<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoveIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'move_in_date',
        'number_of_person',
        'unit_owner_checklists',
        'unit_tenant_checklists',
        'tenant_bond_ar',
        'utility_bond_ar',
        'charges_checklists',
        'charges_remarks',
        'signature_checklists',
        'requested_by',
        'approved_by',
        'cleared_by',
        'verified_by',
        'noted_by',
        'additional_instruction',
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
