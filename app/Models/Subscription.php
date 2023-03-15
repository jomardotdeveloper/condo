<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    public const PENDING = 1;
    public const PAID = 2;
    public const REJECTED = 3;

    protected $fillable = [
        'debit_id',
        'amount',
        'payment_method',
        'payment_reference',
        'payment_status',
        'proof_of_payment_src',
    ];

    public function debit()
    {
        return $this->belongsTo(Debit::class);
    }

    public function entry ()
    {
        return $this->hasOne(Entry::class);
    }
    
    public function getFormattedIdAttribute()
    {
        $id = strval($this->id);
        return "PAY" . str_pad($id, 4, "0", STR_PAD_LEFT);
    }
    
}
