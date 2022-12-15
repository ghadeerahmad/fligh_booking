<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(){
        $cates = Category::all();
        return response(['status'=>1,'data'=>$cates],200);
    }
}
