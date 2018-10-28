<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    public $timestamps = false;
    protected $fillable = [
      'date', 'hour', 'place', 'status', 'team_id_a', 'team_id_b', 'stage_id', 'group_id'
    ];
}
