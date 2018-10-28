<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id', 'name', 'logo'
    ];
}
