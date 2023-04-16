<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public const STATUS = [
        1 => 'New',
        2 => 'In Progress',
        3 => 'Closed',
    ];

    protected $fillable = [
        'employee_id',
        'user_id',
        'subject',
        'description',
        'attachment',
        'status',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
