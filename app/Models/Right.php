<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Right extends Model
{

    protected $table = 'rights';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];
}
