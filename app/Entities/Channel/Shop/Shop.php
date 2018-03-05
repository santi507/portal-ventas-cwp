<?php

namespace App\Entities\Channel\Shop;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';
    public $timestamps = false;


    public function area(){
    	return $this->belongsTo('App\Entities\Channel\Shop\Area', 'area_id');
    }

    public function sellers(){
    	return $this->hasMany('App\Entities\Seller\Shop','shop_id');
    }
}
