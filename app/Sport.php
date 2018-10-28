<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'duration',
        'status',
        'min_players',
        'max_players',
        'denomination',
        'rules',
        'logo',
    ];
}
