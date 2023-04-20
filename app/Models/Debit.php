<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debit extends Model
{
    use HasFactory;

    public const MOVE_IN = 1;
    public const MOVE_OUT = 2;
    public const MONTHLY_DUE = 3;

    protected $fillable = [
        'move_in_fee',
        'move_out_fee',
        'parking_fee',
        'monthly_due_fee',
        'electric_fee',
        'water_fee',
        'penalty_fee',
        'other_fee',
        'description',
        'due_date',
        'unit_id',
        'application_id',
        'move_out_id',
        'type',
        'customer_name',
        'user_id'
    ];

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

    public function moveOut()
    {
        return $this->belongsTo(MoveOut::class);
    }

    public function getTypeNameAttribute()
    {
        switch ($this->type) {
            case self::MOVE_IN:
                return 'Move In';
            case self::MOVE_OUT:
                return 'Move Out';
            case self::MONTHLY_DUE:
                return 'Monthly Due';
            default:
                return 'Unknown';
        }
    }

    public function getTotalAmountAttribute()
    {
        return $this->move_in_fee + $this->move_out_fee + $this->parking_fee + $this->monthly_due_fee + $this->electric_fee + $this->water_fee + $this->penalty_fee + $this->other_fee;
    }

    public function getFormattedTotalAmountAttribute()
    {
        return "₱ " . number_format($this->totalAmount, 2);
    }

    public function getFormattedIdAttribute()
    {
        $id = strval($this->id);
        return "INV" . str_pad($id, 4, "0", STR_PAD_LEFT);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function getIsPaidAttribute()
    {
        return $this->subscriptions()->where('payment_status', Subscription::PAID)->sum('amount') >= $this->totalAmount;
    } 




}
