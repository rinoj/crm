<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadComment extends Model
{
    public $table = 'leadcomments';

    protected $fillable = [
        'comment',
    ];

    public function lead(){
        return $this->belongsTo(Lead::class);
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
