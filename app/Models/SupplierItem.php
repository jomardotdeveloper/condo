<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'lines',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    
}
