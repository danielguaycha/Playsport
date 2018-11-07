<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        "title",
        'description',
        "content",
        "url",
        "type",
        "user_id",
        "parent"
    ];
}
