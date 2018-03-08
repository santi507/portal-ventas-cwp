<?php

namespace App\Entities\Channel\Shop;

use Illuminate\Database\Eloquent\Model;

class ShopAdmin extends Model
{
    protected $table = 'shop_admins';
    public $timestamps = false;

    public function shop(){
    	return $this->belongsTo('App\Entities\Channel\Shop\Shop', 'shop_id');
    }
}
