<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $guarded = [];

    public function doctor()
    {
        return $this->hasOne(Specialty::class, 'specialty_id');
    }
}
