<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    public $table = 'leads';

    protected $fillable = [
        'name', 'email', 'phone',
    ];

    public function comments(){
        return $this->hasMany('App\LeadComment');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
