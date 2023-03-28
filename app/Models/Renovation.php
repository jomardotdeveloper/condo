<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renovation extends Model
{
    use HasFactory;

    public const REQUIREMENT_CHECKLISTS = [
        1 => 'Letter of Intent to Renovate from the Unit Owner/ Authorized Representative ',
        2 => 'Specified Scope of Works',
        3 => 'Layout',
    ];
    public const REFUNDABLE_CHECKLISTS = [
        1 => 'Php 5,000.00',
    ];
    public const WORKERS_IDENTIFICATION_CHECKLISTS = [
        1 => 'Photocopy of Police Clearance',
        2 => 'Photocopy of NBI Clearance',
        3 => '2 pcs of 2x2 Picture',
        4 => 'Php30.00/ each for processing Fee of Identification Card',
        5 => 'Work Permit (renewable weekly, 5 working days from Monday to Friday) 8:30AM to 12:00Pm and 1:00PM to 5:30PM',
    ];
    public const PRIOR_CHECKLISTS = [
        1 => 'Fire Extinguisher',
        2 => 'Fire Sprinkler',
        3 => 'Electric Panel',
        4 => 'Smoke and Heat Detectors',
        5 => 'Drainages',
        6 => 'T&B Fixtures',
    ];
    public const CONSTRUCTION_BOND_CHECKLISTS = [
        1 => 'Refund (check) will be under the name of Unit Owner',
        2 => 'Refund (check) will be under the name of the Unit Owners Authorized Representative Note: SPA (specifically for refund of the bond) should be provided',
    ];


    protected $fillable = [
        'unit_id',
        'user_id',
        'date',
        'renovation_start_date',
        'vendor_id',
        'status',
        'requirement_checklists',
        'refundable_checklists',
        'workers_identification_checklists',
        'prior_checklists',
        'construction_bond_checklists',
        'cleared_by_id',
        'check_by_id',
        'approved_by_id',
        'cleared_is_signed',
        'check_is_signed',
        'approved_is_signed',
        'ar_date',
        'ar_number',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    // 'requirement_checklists',
    // 'refundable_checklists',
    // 'workers_identification_checklists',
    // 'prior_checklists',
    // 'construction_bond_checklists',

    public function getRequirementChecklistsArrAttribute() {
        $checklists = $this->requirement_checklists;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }


    public function getRefundableChecklistsArrAttribute() {
        $checklists = $this->refundable_checklists;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }

    public function getWorkersIdentificationChecklistsArrAttribute() {
        $checklists = $this->workers_identification_checklists;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }

    public function getPriorChecklistsArrAttribute() {
        $checklists = $this->prior_checklists;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }
    // construction_bond_checklists
    public function getConstructionBondChecklistsArrAttribute() {
        $checklists = $this->construction_bond_checklists;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }
}
