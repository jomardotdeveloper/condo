<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_address',
        'contact_no',
        'email',
        'contact_person',
        'is_contractor',
        'is_supplier',
        'industry',
        'service'
    ];

    public function supplierItems()
    {
        return $this->hasMany(SupplierItem::class);
    }

    public function getItemsAttribute()
    {
        $items = [];

        foreach($this->supplierItems as $item){
            $itemConv = explode(',', $item->lines);

            foreach($itemConv as $itemConv2){
                $items[] = $itemConv2;
            }
        }

        return $items;
    }

    
}
