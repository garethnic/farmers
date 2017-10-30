<?php

namespace App\Models\Objects;

use Illuminate\Database\Eloquent\Model;

class CurrentYear extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'year',
        'assaults',
        'murders'
    ];

}