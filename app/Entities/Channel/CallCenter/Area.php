<?php

namespace App\Entities\Channel\CallCenter;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'call_center_areas';
    public $timestamps = false;

    public function sellers(){
    	return $this->hasMany('App\Entities\Seller\CallCenter', 'call_center_area_id');
    }
}
