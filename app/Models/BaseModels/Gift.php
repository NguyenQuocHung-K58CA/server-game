<?php

namespace App\Models\BaseModels;

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
        'user_id', 'gift_id', 'status'
    ];
}
