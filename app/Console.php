<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Console extends Model
{
    protected $fillable = [
        'name', 'slug', 'description','manufacturer', 'thumbnail', 'pal_release_date', 'na_release_date'
    ];
}