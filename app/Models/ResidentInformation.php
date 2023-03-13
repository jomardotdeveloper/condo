<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentInformation extends Model
{
    use HasFactory;

    protected $table = 'resident_informations'; 

    protected $fillable = [
        "date",
        'mobile_number',
        'email',
        'address',
        'occupation',
        'citizenship',
        'marital_status',
        'telephone_number',
        'gender',
        'emergency_name',
        'emergency_contact',
        'emergency_address',
        'authorized_unit_occupant_names',
        'authorized_unit_occupant_relations',
        'authorized_unit_occupant_ages',
        'authorized_unit_occupant_remarks',
        'househelper_driver_names',
        'househelper_driver_ages',
        'househelper_driver_remarks',   
        'requested_by',
        'noted_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function getAucNamesArrAttribute() {
        $checklists = $this->authorized_unit_occupant_names;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }

    public function getAucRelationsArrAttribute() {
        $checklists = $this->authorized_unit_occupant_relations;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }

    public function getAucAgesArrAttribute() {
        $checklists = $this->authorized_unit_occupant_ages;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }


    public function getAucRemarksArrAttribute() {
        $checklists = $this->authorized_unit_occupant_remarks;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }


    public function getHdNamesArrAttribute() {
        $checklists = $this->househelper_driver_names;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }


    public function getHdAgesArrAttribute() {
        $checklists = $this->househelper_driver_ages;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }


    public function getHdRemarksArrAttribute() {
        $checklists = $this->househelper_driver_remarks;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }



    
}
