<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class BloodType extends Model
{
    protected $guarded = [];
    protected $table = 'blood_types';

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
