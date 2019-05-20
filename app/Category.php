<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = 'categories';
    protected $fillable = [
        'name', 'prefix', 
    ];

    public function leads(){
        return $this->hasMany('App\Lead');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function countleads(){
        return $this->leads()->count();
    }
}
