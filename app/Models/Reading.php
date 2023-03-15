<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'cluster_id',
        'date_from',
        'date_to',
        'reading',
        'is_electricity',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function cluster()
    {
        return $this->belongsTo(Cluster::class);
    }
}
