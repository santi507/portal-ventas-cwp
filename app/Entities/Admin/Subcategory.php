<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'subcategories';
    public $timestamps = false;

    public function category(){
    	return $this->belongsTo('App\Entities\Admin\subcategory','category_id');
    }

    public function products(){
    	return $this->hasMany('App\Entities\Admin\Product','subcategory_id');
    }

    public function goals(){
        return $this->hasMany('App\Entities\Goal\Shop\Seller','subcategory_id');
    }

    public static function subcategories($id)
    {
    	return Subcategory::where('category_id',$id)->where('status',1)->get();
    }
}
