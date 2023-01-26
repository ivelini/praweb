<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionGroup extends Model
{
    use HasFactory;

    public function optionGroup()
    {
        return $this->belongsTo(__CLASS__, 'option_group_id', 'id');
    }

    public function options()
    {
        return $this->hasMany(Option::class, 'option_group_id', 'id');
    }
}
