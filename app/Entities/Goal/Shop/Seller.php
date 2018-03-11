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
    	return $this->belongsTo('App\Entities\Seller\Seller', 'shop_seller_id');
    }

    public function subcategory(){
        return $this->belongsTo('App\Entities\Admin\Subcategory', 'subcategory_id');
    }

    public static function getGoals($fecha, $seller_id){
        $fecha = Carbon::parse($fecha);
        $month = $fecha->month;
        $year = $fecha->year;
        $query = Seller::where('month',$month)->where('year',$year)->where('shop_seller_id', $seller_id)->get();

        return $query;
    }

    public static function getFormatGoalSeller(){
    	$query = DB::select("
    		SELECT ss.name as vendedor, '0' as meta, '0' as arpu, '0' as peso, sc.name as tecnologia, MONTH(CURRENT_DATE()) as mes, YEAR(CURRENT_DATE()) as ano, ss.id as vendedor_id, sc.id as tecnologia_id from subcategories sc, shops_sellers ss where sc.is_goal = 1; 
    	");
    	$query = json_decode(json_encode($query), true);
    	return $query;
    }
}
