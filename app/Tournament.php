<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = [
        'name',
        'date_init',
        'date_end',
        'type',
        'logo',
        'url',
        'status',
        'rules',
        'sports_id',
        'organizations_id'
    ];

    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public function sport(){
        return $this->belongsTo(Sport::class);
    }
}

