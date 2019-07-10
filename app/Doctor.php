<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User;
use Illuminate\Auth\Passwords\CanResetPassword;

class Doctor extends Authenticatable
{
    use CanResetPassword, Notifiable;

    protected $guarded = [];
    protected $hidden = ['pivot'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function workingHours()
    {
        return $this->belongsToMany(WorkingHour::class, 'doctor_working_hours', 'doctor_id')
            ->orderBy('time', 'asc')
            ->pluck('time');
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'specialty_id');
    }

    public function endorsements()
    {
        return $this->belongsToMany(User::class, 'endorsements')->using(Endorsement::class)->as('endorsement_taken');
    }

    public function rating()
    {
        return $this->endorsements()->count();
    }
}
