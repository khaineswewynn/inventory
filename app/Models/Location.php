<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
<<<<<<< HEAD
=======
    protected $fillable = ['name','address'];

    public function warehouses()
    {
        return $this->hasMany(Warehouse::class);
    }
>>>>>>> 73f16fa (updated purchase migrations)
}
