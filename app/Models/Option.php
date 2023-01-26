<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    public function optionGroup()
    {
        return $this->belongsTo(OptionGroup::class, 'option_group_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_option', 'option_id', 'product_id');
    }
}
