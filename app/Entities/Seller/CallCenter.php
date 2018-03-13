<?php

namespace App\Entities\Seller;

use Illuminate\Database\Eloquent\Model;

class CallCenter extends Model
{
    protected $table = 'call_center_sellers';
    public $timestamps = false;

    public function area(){
    	return $this->belongsTo('App\Entities\Channel\CallCenter\Area' , 'call_center_area_id');
    }
}
