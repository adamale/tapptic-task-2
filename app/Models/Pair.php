<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Pair extends Pivot
{
    protected $table = 'pairs';

    public $timestamps = false;
}
