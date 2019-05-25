<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['title','start_date','end_date'];
	protected $dates = ['start_date', 'end_date'];
    public function lead(){
        return $this->belongsTo('App\Lead');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
