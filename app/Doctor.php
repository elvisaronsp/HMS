<?php

namespace App;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable implements CanResetPassword
{
    use \Illuminate\Auth\Passwords\CanResetPassword, Notifiable;
    protected $guarded = [];
    protected $hidden = ['pivot'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function workingHours()
    {
        return $this->belongsToMany(WorkingHour::class, 'doctor_working_hours', 'doctor_id')->pluck('time');
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'specialty_id');
    }
}
