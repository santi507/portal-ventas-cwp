<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//Entities
use App\Entities\Channel\Shop\Shop;
use App\Entities\Channel\Shop\Area;

class ShopController extends Controller
{
    public function getShops(){
        $shops = Shop::all();
        return view('admin.admin.shops.index', compact('shops'));
    }

    public function createShops(){
        $areas = Area::all();
        return view('admin.admin.shops.create', compact('areas'));
    }
}
