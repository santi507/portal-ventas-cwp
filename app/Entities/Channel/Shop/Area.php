<?php

namespace App\Entities\Channel\Shop;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';
    public $timestamps = false;

    public function shops(){
    	return $this->hasMany('App\Entities\Channel\Shop\Shop', 'area_id'); 
    }
}
