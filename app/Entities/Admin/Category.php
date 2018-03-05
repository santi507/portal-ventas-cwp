<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = false;

    public function subcategories(){
    	return $this->hasMany('App\Entities\Admin\Subcategory','category_id');
    }
}
