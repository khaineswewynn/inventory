<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockPrice extends Model
{
    use HasFactory;

    protected $table = 'stock_price';

    protected $fillable = ['product_id', 'buy_price', 'sell_price', 'qty'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
