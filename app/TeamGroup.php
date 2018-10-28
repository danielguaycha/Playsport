<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamGroup extends Model
{
    protected $fillable = [
      'pj', 'gf', 'gc', 'pts', 'pg', 'pe', 'pp', 'team_id', 'group_id'
    ];
}
