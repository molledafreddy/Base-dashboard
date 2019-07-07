<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Binnacle extends Model
{
    protected $fillable = [
        'ip','action', 'description', 'affected_table','query','user_id'
    ];
}
