<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    protected $fillable = [
        'name', 'abbr',
    ];

    public function leads(){
        return $this->hasMany('App\Lead');
    }
}
