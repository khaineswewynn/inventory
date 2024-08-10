<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
<<<<<<< HEAD
=======
    protected $fillable = ['id', 'name', 'description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
>>>>>>> 73f16fa (updated purchase migrations)
}
