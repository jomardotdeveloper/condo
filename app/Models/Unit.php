<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_number',
        'cluster_id',
        'unit_tower',
        'unit_floor',
        'unit_room',
        'unit_type',
        'floor_area',
        // 'unit_association_fee',
        // 'unit_parking_fee',
        'status',
    ];

    public function cluster()
    {
        return $this->belongsTo(Cluster::class);
    }

    public function application ()
    {
        return $this->hasOne(Application::class);
    }

    public function moveOut ()
    {
        return $this->hasOne(MoveOut::class);
    }

    public function debits ()
    {
        return $this->hasMany(Debit::class);
    }

    // public function getNextDueDateAttribute()
    // {
    //     $lastDebit = $this->debits()->orderBy('due_date', 'desc')->first();
    //     if($lastDebit == null)
    //         return $this->cluster->reading_day;
    //     return $lastDebit->due_date->addMonth();
    // }
}
