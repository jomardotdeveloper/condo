<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'move_out_id'
    ];

    public function moveOut()
    {
        return $this->belongsTo(MoveOut::class);
    }
}
