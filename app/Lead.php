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

    public function appointments(){
        return $this->hasMany('App\Appointment');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function outcome(){
        return $this->belongsTo('App\Outcome');
    }

    public function setOutcome($id){
        return $this->outcome_id = $id;
    }

    public function phone(){
        if(!$this->category->exists()){
            return $this->category->prefix.''.$this->phone;
        }else{
            return '<a href="sip:'.$this->phone.'">'.$this->phone.'</a>';
        }
    }
}
