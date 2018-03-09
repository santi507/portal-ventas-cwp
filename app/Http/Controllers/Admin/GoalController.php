<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Entities\Goal\Shop\Seller as ShopSeller;

use Excel;
use Carbon\Carbon;

class GoalController extends Controller
{
    public function shop(){
        return view('admin.goals.shops');
    }

    public function getFormatShopSeller(){
        $data = ShopSeller::getFormatGoalSeller();
        Excel::create('metas-vendedores-tienda', function($excel) use($data){
            $excel->sheet('metas', function($sheet) use($data){
                $sheet->fromArray($data);
            });
        })->export('xls');
    }
}
