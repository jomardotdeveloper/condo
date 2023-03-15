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
    ];

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
}
