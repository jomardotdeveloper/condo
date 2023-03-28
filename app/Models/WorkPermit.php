<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkPermit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'unit_id',
        'date',
        'contact_number',
        'name_of_contractor',
        'start_date',
        'end_date',
        'is_owner',
        'scope_of_work_checklists',
        'service_provider_checklists',
        'others',
        'name_of_workers',
        'scope_of_works',
        'debit_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function debit()
    {
        return $this->belongsTo(Debit::class);
    }
}
