<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Message extends Model
{
    protected $guarded = [];

    public function sender()
    {
        $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        $this->belongsTo(User::class, 'receiver_id');
    }
}
