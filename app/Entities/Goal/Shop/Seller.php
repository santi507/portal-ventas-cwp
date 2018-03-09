<?php

namespace App\Entities\Goal\Shop;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class Seller extends Model
{
    protected $table = 'goals_shop_sellers';
    public $timestamps = false;

    public function seller(){
    	return $this->belongsTo('App\Entities\Seller\Seller', 'seller_id');
    }

    public static function getFormatGoalSeller(){
    	$query = DB::select("
    		SELECT ss.name as vendedor, '0' as meta, '0' as arpu, '0' as peso, sc.name as tecnologia, MONTH(CURRENT_DATE()) as mes, YEAR(CURRENT_DATE()) as ano from subcategories sc, shops_sellers ss 
    	");
    	$query = json_decode(json_encode($query), true);
    	return $query;
    }
}
