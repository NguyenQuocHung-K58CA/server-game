<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiftDetail extends Model
{
    protected $table = 'db_gift_details';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'gift_id', 'send_gift', 'receive_gift'
    ];

    public static function updateByUserId($user_id, $options){
    	$giftDetail = GiftDetail::where('user_id', $user_id);
    	return $giftDetail->update($options);
    }
}
