<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    public function index(Category $category){
        $stores = Store::where('category_id',$category->id)->with('user')->get();
        return response(['status'=>1,'data'=>$stores],200);
    }
}
