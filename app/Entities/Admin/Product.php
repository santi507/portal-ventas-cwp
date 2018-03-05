<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    public $timestamps = false;

    public function subcategory(){
    	return $this->belongsTo('App\Entities\Admin\Subcategory','subcategory_id');
    }
}
