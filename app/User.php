<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

use App\Appointment;
use Carbon\Carbon;
class User extends Authenticatable
{
    use Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(){
        if($this->hasRole('admin'))
            return true;
        return false;
    }

    public function appointments(){
        return $this->hasMany('App\Appointment');
    }

    public function leads(){
        return $this->hasMany('App\Lead');
    }

    public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = bcrypt($password);
    }

    public function todayappointmentscount(){
        if($this->hasRole('admin')){
            $appointments = Appointment::whereDate('created_at', Carbon::today())
                ->where('end_date','>', Carbon::now())
                ->count();
        }
        else{
            $appointments = Appointment::where('user_id', $this->id)
                ->whereDate('created_at', Carbon::today())
                ->where('end_date','>', Carbon::now())
                ->count();
        }

        return $appointments;
    }

    public function todayappointments(){
       if($this->hasRole('admin')){
            $appointments = Appointment::whereDate('created_at', Carbon::today())
                ->where('end_date','>', Carbon::now())
                ->get();
        }
        else{
            $appointments = Appointment::where('user_id', $this->id)
                ->whereDate('created_at', Carbon::today())
                ->where('end_date','>', Carbon::now())
                ->get();
        }
        return $appointments;
    }
}
