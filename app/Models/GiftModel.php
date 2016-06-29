<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModels\Gift;

class GiftModel extends Gift
{
    public static function updateByUserId($user_id, $options){
    	$gift = GiftModel::where('user_id', $user_id);
        return $gift->update($options);
    }
}
