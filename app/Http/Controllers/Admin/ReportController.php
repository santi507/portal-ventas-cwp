<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entities\Goal\Shop\Seller as GoalShopSeller;

//Entities
use App\Entities\Seller\Shop as ShopSeller;

use Carbon\Carbon;

class ReportController extends Controller
{
    protected $fecha;

    public function __construct()
    {
       $this->fecha = Carbon::today()->format('Y-m');
    }

    public function indexShop(){
        return view('admin.reports.shop.index');
    }

    public function fixedShopSeller($nt, Request $request){
        if ($request->has('fecha_consulta')) {
            $this->fecha = $request->get('fecha_consulta');
        }
        $seller = ShopSeller::where('nt', $nt)->first();
        $goals = GoalShopSeller::getGoals($this->fecha,$seller->id);
        return view('admin.reports.shop.seller.fixed')
                ->with(['fecha_consulta' => $this->fecha, 'seller' => $seller, 'goals' => $goals]);
    }

    public function movilShopSeller($nt){
        return $nt;
    }
}
