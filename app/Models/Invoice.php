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

    public function payments ()
    {
        return $this->hasMany(Payment::class);
    }

    public function getInvoiceTypeAttribute()
    {
        $invoiceTypes = [
            self::MONTHLY_DUES => 'Monthly Dues',
            self::MOVE_IN => 'Move In',
            self::MOVE_OUT => 'Move Out',
            self::NORMAL => 'Normal'
        ];

        if($this->application)
        {
            return $invoiceTypes[self::MOVE_IN];
        }

        if($this->moveOut)
        {
            return $invoiceTypes[self::MOVE_OUT];
        }

        if($this->unit)
        {
            return $invoiceTypes[self::MONTHLY_DUES];
        }
        
        return $invoiceTypes[self::NORMAL];
    }

    public function getLinesArrayAttribute()
    {
        return json_decode($this->lines);
    }

    public function getTotalAmountAttribute()
    {
        $amount = 0;
        foreach($this->linesArray as $line)
        {
            $amount += $line->amount;
        }

        return $amount;
    }

    public function getFormattedTotalAmountAttribute()
    {
        return "₱ " . number_format($this->totalAmount, 2);
    }

    public function getAmountDueAttribute()
    {
        $amount = $this->totalAmount;
        
        foreach($this->payments as $payment)
        {
            if($payment->payment_status == Payment::PAID)
                $amount -= $payment->amount;
        }

        return $amount;
    }

    public function getFormattedIdAttribute()
    {
        $id = strval($this->id);
        return "INV" . str_pad($id, 4, "0", STR_PAD_LEFT);
    }

    public function getInvoiceToAttribute() {
        if($this->application)
        {
            return $this->application->full_name;
        }

        if($this->moveOut)
        {
            return $this->moveOut->full_name;
        }
        
        return "N/A";
    }

    public function getInvoiceToAddressAttribute() {
        if($this->application)
        {
            return $this->application->residentInformation->address;
        }

        if($this->moveOut)
        {
            return $this->moveOut->address;
        }
        
        return "N/A";
    }


    public function getInvoiceToContactAttribute() {
        if($this->application)
        {
            return $this->application->residentInformation->mobile_number;
        }

        if($this->moveOut)
        {
            return $this->moveOut->mobile_number;
        }
        
        return "N/A";
    }
    
    public function getIsPaidAttribute()
    {
        return $this->amountDue <= 0;
    }
    
}
