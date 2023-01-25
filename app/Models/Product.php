<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function options()
    {
        return $this->belongsToMany(Option::class, 'product_option', 'product_id', 'option_id');
    }
}
