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
}
