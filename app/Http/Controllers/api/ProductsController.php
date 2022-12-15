<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Store $store){
        $products = Product::where('store_id',$store->id)->orderBy('created_at','DESC')->get();
        return response(['status'=>1,'data'=>$products]);
    }
}
