<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Team extends Model
{
    protected $fillable =  [
        'name','alias','type', 'logo', 'tournament_id', 'sport_id',
    ];
}
