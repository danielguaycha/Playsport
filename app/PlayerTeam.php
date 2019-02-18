<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerTeam extends Model
{
    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
      'player_id', 'team_id'
    ];
}
