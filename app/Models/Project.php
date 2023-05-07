<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dealer_id',
        'is_approved',
        'budget',
        'description'
    ];

    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }

    public function biddings()
    {
        return $this->hasMany(Bidding::class);
    }
}
