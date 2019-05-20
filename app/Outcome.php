<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    protected $fillable = [
        'name', 'abbr',
    ];
}
