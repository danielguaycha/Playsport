<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'desc', 'parent', 'tournament_id', 'status', 'name'
    ];
}
