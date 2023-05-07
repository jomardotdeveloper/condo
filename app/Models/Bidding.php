<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'dealer_id',
        'offer_src',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }
}
