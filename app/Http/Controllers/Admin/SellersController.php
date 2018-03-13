<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//Entities Sellers
use App\Entities\Seller\Shop as ShopSeller;
use App\Entities\Seller\CallCenter as CallCenterSeller;
use App\Entities\Seller\D2D as D2DSeller;
use App\Entities\Seller\D2DCH as D2DCHSeller;
use App\Entities\Seller\Soho as SohoSeller;
use App\Entities\Seller\Promoter as PromoterSeller;

//Entities Channels
use App\Entities\Channel\Shop\Shop as ChannelShop;
use App\Entities\Channel\CallCenter\Area as ChannelCallCenter;

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


    /* Call Center Sellers */
    public function getCallCenterSellers()
    {
        $sellers = CallCenterSeller::all();
        return view('admin.sellers.callcenter.index', compact('sellers'));
    }

    public function addCallCenterSellers(){
        $areas = ChannelCallCenter::all();
        return view('admin.sellers.callcenter.add', compact('areas'));
    }

    public function storeCallCenterSellers(){
        try {
            $seller = new CallCenterSeller();
            $seller->name = request()->get('name_seller');
            $seller->nt = request()->get('nt_seller');
            $seller->cis = request()->get('cis_seller');
            $seller->cwp = request()->get('cwp_seller');
            $seller->employee_id = request()->get('employee_id');
            $seller->call_center_area_id = request()->get('area_seller');
            $seller->save();

            return redirect()->route('admin.sellers.callcenter')->with('success','El vendedor '. $seller->name .' se ha agregado.');
        } catch (Exception $e) {
            return redirect()->route('admin.sellers.callcenter')->with('error','Error al crear vendedor.');
        }
        
    }

    public function editCallCenterSellers($id){
        $seller = CallCenterSeller::find($id);
        $areas = ChannelCallCenter::all();
        return view('admin.sellers.callcenter.edit', compact('seller','areas'));
    }

    public function updateCallCenterSellers($id){

        try {
            $seller = CallCenterSeller::find($id);
            $seller->name = request()->get('name_seller');
            $seller->nt = request()->get('nt_seller');
            $seller->cis = request()->get('cis_seller');
            $seller->cwp = request()->get('cwp_seller');
            $seller->employee_id = request()->get('employee_id');
            $seller->call_center_area_id = request()->get('area_seller');
            $seller->status = request()->get('status_seller');
            $seller->save();

            return redirect()->route('admin.sellers.callcenter')->with('success','El vendedor '. $seller->name .' se ha editado.');
            
        } catch (Exception $e) {
            return redirect()->route('admin.sellers.callcenter')->with('error','Error al editar vendedor.');
        }
        
    }

    public function deleteCallCenterSellers($id){
        try {
            $seller = CallCenterSeller::find($id);
            $seller->delete();
            return redirect()->route('admin.sellers.callcenter')->with('warning','Se ha eliminado el vendedor.');
        } catch (Exception $e) {
            return redirect()->route('admin.sellers.callcenter')->with('error','Error al eliminar vendedor.');
        }
    }

    /* D2D Sellers */
    public function getD2DSellers()
    {
        $sellers = D2DSeller::all();
        return view('admin.sellers.d2d.index', compact('sellers'));
    }

    public function addD2DSellers(){
        
        return view('admin.sellers.d2d.add');
    }

    public function storeD2DSellers(){
        try {
            $seller = new D2DSeller();
            $seller->name = request()->get('name_seller');
            $seller->nt = request()->get('nt_seller');
            $seller->cis = request()->get('cis_seller');
            $seller->cwp = request()->get('cwp_seller');
            $seller->employee_id = request()->get('employee_id');
            $seller->save();

            return redirect()->route('admin.sellers.d2d')->with('success','El vendedor '. $seller->name .' se ha agregado.');
        } catch (Exception $e) {
            return redirect()->route('admin.sellers.d2d')->with('error','Error al crear vendedor.');
        }
        
    }

    public function editD2DSellers($id){
        $seller = D2DSeller::find($id);
        return view('admin.sellers.d2d.edit', compact('seller'));
    }

    public function updateD2DSellers($id){

        try {
            $seller = D2DSeller::find($id);
            $seller->name = request()->get('name_seller');
            $seller->nt = request()->get('nt_seller');
            $seller->cis = request()->get('cis_seller');
            $seller->cwp = request()->get('cwp_seller');
            $seller->employee_id = request()->get('employee_id');
            $seller->status = request()->get('status_seller');
            $seller->save();

            return redirect()->route('admin.sellers.d2d')->with('success','El vendedor '. $seller->name .' se ha editado.');
            
        } catch (Exception $e) {
            return redirect()->route('admin.sellers.d2d')->with('error','Error al editar vendedor.');
        }
        
    }

    /* D2DCH Sellers */
    public function getD2DCHSellers()
    {
        $sellers = D2DCHSeller::all();
        return view('admin.sellers.d2dch.index', compact('sellers'));
    }

    public function addD2DCHSellers(){
        
        return view('admin.sellers.d2dch.add');
    }

    public function storeD2DCHSellers(){
        try {
            $seller = new D2DCHSeller();
            $seller->name = request()->get('name_seller');
            $seller->nt = request()->get('nt_seller');
            $seller->cis = request()->get('cis_seller');
            $seller->cwp = request()->get('cwp_seller');
            $seller->employee_id = request()->get('employee_id');
            $seller->save();

            return redirect()->route('admin.sellers.d2dch')->with('success','El vendedor '. $seller->name .' se ha agregado.');
        } catch (Exception $e) {
            return redirect()->route('admin.sellers.d2dch')->with('error','Error al crear vendedor.');
        }
        
    }

    public function editD2DCHSellers($id){
        $seller = D2DCHSeller::find($id);
        return view('admin.sellers.d2dch.edit', compact('seller'));
    }

    public function updateD2DCHSellers($id){

        try {
            $seller = D2DCHSeller::find($id);
            $seller->name = request()->get('name_seller');
            $seller->nt = request()->get('nt_seller');
            $seller->cis = request()->get('cis_seller');
            $seller->cwp = request()->get('cwp_seller');
            $seller->employee_id = request()->get('employee_id');
            $seller->status = request()->get('status_seller');
            $seller->save();

            return redirect()->route('admin.sellers.d2dch')->with('success','El vendedor '. $seller->name .' se ha editado.');
            
        } catch (Exception $e) {
            return redirect()->route('admin.sellers.d2dch')->with('error','Error al editar vendedor.');
        }
        
    }

    /* Soho Sellers */
    public function getSohoSellers()
    {
        $sellers = SohoSeller::all();
        return view('admin.sellers.soho.index', compact('sellers'));
    }

    public function addSohoSellers(){
        
        return view('admin.sellers.soho.add');
    }

    public function storeSohoSellers(){
        try {
            $seller = new SohoSeller();
            $seller->name = request()->get('name_seller');
            $seller->nt = request()->get('nt_seller');
            $seller->cis = request()->get('cis_seller');
            $seller->cwp = request()->get('cwp_seller');
            $seller->employee_id = request()->get('employee_id');
            $seller->save();

            return redirect()->route('admin.sellers.soho')->with('success','El vendedor '. $seller->name .' se ha agregado.');
        } catch (Exception $e) {
            return redirect()->route('admin.sellers.soho')->with('error','Error al crear vendedor.');
        }
        
    }

    public function editSohoSellers($id){
        $seller = SohoSeller::find($id);
        return view('admin.sellers.soho.edit', compact('seller'));
    }

    public function updateSohoSellers($id){

        try {
            $seller = SohoSeller::find($id);
            $seller->name = request()->get('name_seller');
            $seller->nt = request()->get('nt_seller');
            $seller->cis = request()->get('cis_seller');
            $seller->cwp = request()->get('cwp_seller');
            $seller->employee_id = request()->get('employee_id');
            $seller->status = request()->get('status_seller');
            $seller->save();

            return redirect()->route('admin.sellers.soho')->with('success','El vendedor '. $seller->name .' se ha editado.');
            
        } catch (Exception $e) {
            return redirect()->route('admin.sellers.soho')->with('error','Error al editar vendedor.');
        }
        
    }

     /* Promoters Sellers */
    public function getPromoterSellers()
    {
        $sellers = PromoterSeller::all();
        return view('admin.sellers.promoter.index', compact('sellers'));
    }

    public function addPromoterSellers(){
        
        return view('admin.sellers.promoter.add');
    }

    public function storePromoterSellers(){
        try {
            $seller = new PromoterSeller();
            $seller->name = request()->get('name_seller');
            $seller->nt = request()->get('nt_seller');
            $seller->cis = request()->get('cis_seller');
            $seller->cwp = request()->get('cwp_seller');
            $seller->employee_id = request()->get('employee_id');
            $seller->save();

            return redirect()->route('admin.sellers.promoter')->with('success','El vendedor '. $seller->name .' se ha agregado.');
        } catch (Exception $e) {
            return redirect()->route('admin.sellers.promoter')->with('error','Error al crear vendedor.');
        }
        
    }

    public function editPromoterSellers($id){
        $seller = PromoterSeller::find($id);
        return view('admin.sellers.promoter.edit', compact('seller'));
    }

    public function updatePromoterSellers($id){

        try {
            $seller = PromoterSeller::find($id);
            $seller->name = request()->get('name_seller');
            $seller->nt = request()->get('nt_seller');
            $seller->cis = request()->get('cis_seller');
            $seller->cwp = request()->get('cwp_seller');
            $seller->employee_id = request()->get('employee_id');
            $seller->status = request()->get('status_seller');
            $seller->save();

            return redirect()->route('admin.sellers.promoter')->with('success','El vendedor '. $seller->name .' se ha editado.');
            
        } catch (Exception $e) {
            return redirect()->route('admin.sellers.promoter')->with('error','Error al editar vendedor.');
        }
        
    }
    
}
