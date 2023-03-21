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
        'item_quantities',
        'item_names',
        'item_descriptions',
        'item_remarks',
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
        'cleared_by_id',
        'verified_by_id',
        'noted_by_id',
        'approved_by_id',
        'cleared_is_signed',
        'verified_is_signed',
        'noted_is_signed',
        'approved_is_signed',
    ];

    public function outAttachments()
    {
        return $this->hasMany(OutAttachment::class);
    }

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

    public function debit() {
        return $this->hasOne(Debit::class);
    }

    public function getFullNameAttribute()
    {
        return $this->last_name . ' ' . $this->first_name . ' ' . $this->middle_name;
    }

    public function getItemQuantitiesArrAttribute() {
        $checklists = $this->item_quantities;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }

    public function getItemNamesArrAttribute() {
        $checklists = $this->item_names;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }

    public function getItemDescriptionsArrAttribute() {
        $checklists = $this->item_descriptions;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }

    public function getItemRemarksArrAttribute() {
        $checklists = $this->item_remarks;

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

    public function getStatusNameAttribute () {
        return config('enums.application_status')[$this->status];
    }
}
