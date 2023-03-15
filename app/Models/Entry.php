<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'bank_id',
        'reference',
        'source_document',
        'amount',
        'subscription_id'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
