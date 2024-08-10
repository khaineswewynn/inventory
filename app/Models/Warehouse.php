<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    
    use HasFactory;
    protected $fillable=['name','isRefrigerated','location_id'];

    public function Transfers(){
        return $this->hasMany(Transfer::class);
    }

    public function Location(){
        return $this->belongsTo(Location::class);
    }
}
