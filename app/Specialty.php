<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $guarded = [];

    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'specialty_id');
    }
}
