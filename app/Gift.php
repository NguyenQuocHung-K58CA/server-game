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
        'user_id', 'gift_id', 'status'
    ];

    public static function updateByUserId($user_id, $options){
    	$gift = Gift::where('user_id', $user_id);
        return $gift->update($options);
    }
}
