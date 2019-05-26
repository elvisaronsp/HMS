<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    protected $table = 'working_hours';
    protected $guarded = [];
    protected $hidden = ['pivot'];
    public $timestamps = false;

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_working_hours', 'working_hour_id');
    }
}