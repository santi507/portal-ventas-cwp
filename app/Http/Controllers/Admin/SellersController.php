<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//Entities
use App\Entities\Seller\Shop as ShopSeller;
use App\Entities\Channel\Shop\Shop as ChannelShop;

class SellersController extends Controller
{
    /* Shop Sellers */
    public function getShopSellers()
    {
        $sellers = ShopSeller::all();
        return view('admin.sellers.shop.index', compact('sellers'));
    }

    public function addShopSellers(){
        $shops = ChannelShop::all();
        return view('admin.sellers.shop.add', compact('shops'));
    }

    public function storeShopSellers(){
        try {
            $seller = new ShopSeller();
            $seller->name = request()->get('name_seller');
            $seller->nt = request()->get('nt_seller');
            $seller->cis = request()->get('cis_seller');
            $seller->cwp = request()->get('cwp_seller');
            $seller->employee_id = request()->get('employee_id');
            $seller->shop_id = request()->get('shop_seller');
            $seller->save();

            return redirect()->route('admin.sellers.shop')->with('success','El vendedor '. $seller->name .' se ha agregado.');
        } catch (Exception $e) {
            return redirect()->route('admin.sellers.shop')->with('error','Error al crear vendedor.');
        }
        
    }

    public function editShopSellers($id){
        $seller = ShopSeller::find($id);
        $shops = ChannelShop::all();
        return view('admin.sellers.shop.edit', compact('seller','shops'));
    }

    public function updateShopSellers($id){

        try {
            $seller = ShopSeller::find($id);
            $seller->name = request()->get('name_seller');
            $seller->nt = request()->get('nt_seller');
            $seller->cis = request()->get('cis_seller');
            $seller->cwp = request()->get('cwp_seller');
            $seller->employee_id = request()->get('employee_id');
            $seller->shop_id = request()->get('shop_seller');
            $seller->status = request()->get('status_seller');
            $seller->save();

            return redirect()->route('admin.sellers.shop')->with('success','El vendedor '. $seller->name .' se ha editado.');
            
        } catch (Exception $e) {
            return redirect()->route('admin.sellers.shop')->with('error','Error al editar vendedor.');
        }
        
    }

    public function deleteShopSellers($id){
        try {
            $seller = ShopSeller::find($id);
            $seller->delete();
            return redirect()->route('admin.sellers.shop')->with('warning','Se ha eliminado el vendedor.');
        } catch (Exception $e) {
            return redirect()->route('admin.sellers.shop')->with('error','Error al eliminar vendedor.');
        }
    }

    
}
