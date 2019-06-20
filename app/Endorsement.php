<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Endorsement extends Pivot
{
    protected $guarded = [];
    protected $table = 'endorsements';
}
