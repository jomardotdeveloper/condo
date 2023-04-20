<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    use HasFactory;

    public const FORM_OF_ORGANIZATION = [
        1 => 'Sole Proprietorship ',
        2 => 'Corporation',
        3 => 'Partnership',
        4 => 'Cooperative',
    ];

    public const TYPE_CHECKLISTS = [
        1 => 'Information Technology',
        2 => 'Consultancy',
        3 => 'Services',
    ];

    public const CATEGORY_CHECKLISTS = [
        1 => 'Information Technology',
        2 => 'Information Technology Parts & Accessories & Peripherals',
        3 => 'Services',
        4 => 'Consulting Services',
        5 => 'Structured Cabling',
        6 => 'Systems Integration',
        7 => 'Security Surveillance and Detection Equipment',
    ];

    public const STATUS = [
        1 => 'New Application',
        2 => 'Accredited Vendors',
        3 => 'For Renewal',
    ];

    protected $fillable = [
        'organization_number',
        'form_of_organization',
        'organization_name',
        'type_checklists',
        'category_checklists',
        'capitalization',
        'business_tax_identification_number',
        'dti_certificate_number',
        'dti_registration_date',
        'acronym',
        'former_name',
        'number_of_employees',
        'prev_year_revenue',
        'website_address',
        'description',
        'address',
        'first_name',
        'email',
        'last_name',
        'mobile_number',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'mayors_permit_src',
        'dti_src',
        'bir_src',
        'afs_src',
        'company_profile_src',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormOfOrganizationNameAttribute()
    {
        return self::FORM_OF_ORGANIZATION[$this->form_of_organization];
    }

    public function getStatusNameAttribute()
    {
        return self::STATUS[$this->status];
    }
    

    public function getCategoryChecklistsArrAttribute() {
        $checklists = $this->category_checklists;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }

    public function getTypeChecklistsArrAttribute() {
        $checklists = $this->type_checklists;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }

    public function getTypeChecklistsNamesAttribute() {
        $checklists = $this->type_checklists_arr;

        if(!$checklists)
            return [];

        $names = [];
        foreach($checklists as $checklist) {
            $names[] = self::TYPE_CHECKLISTS[$checklist];
        }

        return $names;
    }

    public function getCategoryChecklistsNamesAttribute() {
        $checklists = $this->category_checklists_arr;

        if(!$checklists)
            return [];

        $names = [];
        foreach($checklists as $checklist) {
            $names[] = self::CATEGORY_CHECKLISTS[$checklist];
        }

        return $names;
    }

    public function getCategoryNameStrAttribute() {
        $names = $this->category_checklists_names;

        if(!$names)
            return '';

        return implode(', ', $names);
    }

    public function getTypeNameStrAttribute() {
        $names = $this->type_checklists_names;

        if(!$names)
            return '';

        return implode(', ', $names);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }


}
