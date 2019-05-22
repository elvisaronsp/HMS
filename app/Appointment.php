<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guarded = [];

    public function users()
    {
        $this->belongsToMany(User::class);
    }

    public function doctors()
    {
        $this->belongsToMany(Doctor::class);
    }
}
