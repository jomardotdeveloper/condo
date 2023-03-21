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
        'cleared_by_id',
        'verified_by_id',
        'noted_by_id',
        'approved_by_id',
        'cleared_is_signed',
        'verified_is_signed',
        'noted_is_signed',
        'approved_is_signed',
    ];

    public function clearedBy()
    {
        return $this->belongsTo(Employee::class, 'cleared_by_id');
    }

    public function verifiedBy()
    {
        return $this->belongsTo(Employee::class, 'verified_by_id');
    }

    public function notedBy()
    {
        return $this->belongsTo(Employee::class, 'noted_by_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(Employee::class, 'approved_by_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function getUnitOwnerChecklistsArrAttribute() {
        $checklists = $this->unit_owner_checklists;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }

    public function getUnitTenantChecklistsArrAttribute() {
        $checklists = $this->unit_tenant_checklists;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }


    public function getChargesChecklistsArrAttribute() {
        $checklists = $this->charges_checklists;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }


    public function getChargesRemarksArrAttribute() {
        $checklists = $this->charges_remarks;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }

    public function getSignatureChecklistsArrAttribute() {
        $checklists = $this->signature_checklists;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }

    public function getSignatoriesAttribute() {
        $signatories = [];

        if($this->cleared_by_id)
            $signatories[] = $this->cleared_by_id;
        
        if($this->verified_by_id)
            $signatories[] = $this->verified_by_id;
        
        if($this->noted_by_id)
            $signatories[] = $this->noted_by_id;
        
        if($this->approved_by_id)
            $signatories[] = $this->approved_by_id;
        
        return $signatories;
    }
}
