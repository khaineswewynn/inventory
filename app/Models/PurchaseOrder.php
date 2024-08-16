<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = ['order_no', 'purchaseorder_date', 'provider_id', 'total',
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function purchaseOrderDetails()
    {
        return $this->hasMany(PurchaseOrderDetails::class);
    }
}
