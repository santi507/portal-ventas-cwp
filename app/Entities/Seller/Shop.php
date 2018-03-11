<?php

namespace App\Entities\Seller;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops_sellers';
    public $timestamps = false;
    protected $fillable = ['name', 'nt', 'cis', 'cwp', 'employee_id', 'shop_id', 'status'];

    public function shop(){
    	return $this->belongsTo('App\Entities\Channel\Shop\Shop', 'shop_id');
    }

    public function goals(){
    	return $this->hasMany('App\Entities\Goal\Shop\Seller','shop_seller_id');
    }
}
