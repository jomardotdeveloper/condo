<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'amount',
        'payment_method',
        'payment_reference',
        'payment_status',
        'proof_of_payment_src',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    
}
