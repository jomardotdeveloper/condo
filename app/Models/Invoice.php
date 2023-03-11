<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public const MONTHLY_DUES = 1;
    public const MOVE_IN = 2;
    public const MOVE_OUT = 3;
    public const NORMAL = 4;

    protected $fillable = [
        'user_id',
        'unit_id',
        'application_id',
        'due_date',
        'lines',
        'remarks',
        'move_out_id'
    ];

    public function moveOut()
    {
        return $this->belongsTo(MoveOut::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
