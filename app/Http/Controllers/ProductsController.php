<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Store $store)
    {
        $products = $store->products;
        return view('control.products', ['products' => $products, 'store' => $store]);
    }
    public function all(){
        $products = Product::all();
        return view('control.products', ['products' => $products]);
    }
    public function addProductPage(Store $store)
    {
        return view('control.addProduct', ['store' => $store]);
    }
    public function addProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
            'image' => 'nullable|mimes:png,jpg,jpeg,csv,txt,pdf|max:2048',
            'des' => 'required|max:255',
            'price' => 'required',

        ]);
        $data = [
            'name' => $request->input('name'),
            'des' => $request->input('des'),
            'price' => $request->input('price'),
            'store_id' => $id
        ];
        $product = Product::create($data);
        if ($product != null) {
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('public/products');
                $pth = explode('/', $path);
                $product->image = $pth[1] . '/' . $pth[2];
                $product->save();
            }
            return back()->with(['success' => 'تم الحفظ']);
        }
        return back()->withErrors(['error' => 'خطأ غير معروف']);
    }
    public function updateProductPage($id)
    {
        $product = Product::find($id);
        return view('control.updateProduct', ['product' => $product]);
    }
    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);
        $request->validate([
            'name' => 'required|max:50',
            'image' => 'nullable|mimes:png,jpg,jpeg,csv,txt,pdf|max:2048',
            'des' => 'required|max:255',
            'price' => 'required',

        ]);
        $data = [
            'name' => $request->input('name'),
            'des' => $request->input('des'),
            'price' => $request->input('price'),
        ];
        $product->update($data);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/products');
            $pth = explode('/', $path);
            $product->image = $pth[1] . '/' . $pth[2];
            $product->save();
        }
        return back()->with(['success' => 'تم الحفظ']);
    }
    public function delete(Product $product){
        $product->delete();
        return back()->with(['success'=>'تم الحذف']);
    }
}
