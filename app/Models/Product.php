<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code', 'description', 'category_id', 'reorder_qty', 'refrigerated'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sales()
    {
        return $this->belongsToMany(Sales::class);
    }

    public function salesDetails()
    {
        return $this->hasMany(SalesDetails::class);
    }

    public function stockPrice()
    {
        return $this->hasOne(StockPrice::class);
    }
}
