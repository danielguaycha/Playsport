<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{

    protected $fillable = [
        'name',
        'last_name',
        'age',
        'dni',
        'type',
        'observations',
        'number',
        'organization_id'
    ];
}
