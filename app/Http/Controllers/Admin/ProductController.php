<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//Entities
use App\Entities\Admin\Product;
use App\Entities\Admin\Category;
use App\Entities\Admin\Subcategory;

class ProductController extends Controller
{
    public function getProducts(){
        $products = Product::all();
        return view('admin.admin.products.index', compact('products'));
    }

    public function createProducts(){
        $categories = Category::all();
        return view('admin.admin.products.add', compact('categories'));
    }

    public function storeProducts(){
        $product = new Product();
        $product->name = request()->get('name_product');
        $product->code = request()->get('code_product');
        $product->subcategory_id = request()->get('subcategory');
        $product->save();

        return redirect()->route('admin.products')->with('success','Se ha agregado el producto.');

    }

    public function editProducts($id){
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.admin.products.edit', compact('product', 'categories'));
    }

    public function getSubcategories(Request $request, $id)
    {
        if ($request->ajax()) {
            $subcategories = Subcategory::subcategories($id);
            return response()->json($subcategories);
        }

    }

    public function updateProducts($id){
        $product = Product::find($id);
        $product->name = request()->get('name_product');
        $product->code = request()->get('code_product');
        $product->subcategory_id = request()->get('subcategory');
        $product->save();

        return redirect()->route('admin.products')->with('success','Se ha actualizado el producto.');
    }
}
