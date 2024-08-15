<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'number', 'cus_id', 'email', 'phone'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cus_id');
    }

    public function salesDetails()
    {
        return $this->hasMany(SalesDetails::class);
    }
}
