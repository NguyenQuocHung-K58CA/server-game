<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    protected $table = 'db_gifts';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];
}
