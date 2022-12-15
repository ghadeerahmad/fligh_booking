<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    public function index(Category $category){
        $stores = $category->stores;
        return view('control.stores',['stores'=>$stores,'cate'=>$category]);
    }
    public function allStores(){
        $stores = Store::all();
        return view('control.stores',['stores'=>$stores]);
    }
    public function addStorePage($id){
        $cate = Category::find($id);
        $users = User::all();
        return view('control.addStore',['cate'=>$cate,'users'=>$users]);
    }
    public function addStore(Request $request,$id){
        $request->validate([
            'ar_name'=>'required|max:50',
            'en_name'=>'required|max:50',
            'user_id'=>'required',
            'image' => 'nullable|mimes:png,jpg,jpeg,csv,txt,pdf|max:2048'
        ]);
        $data = [
            'ar_name'=>$request->input('ar_name'),
            'en_name'=>$request->input('en_name'),
            'user_id'=>$request->input('user_id'),
            'category_id'=>$id
        ];
        $store = Store::create($data);
        if($store != null){
            if($request->hasFile('image')){

                $file = $request->file('image');
                $fileName = $file->getClientOriginalName();
                $path = $request->file('image')->storeAs('stores', $fileName, 'public');
                $store->image = $path;
                $store->save();
            }
            return back()->with(['success'=>'تم الحفظ']);
        }
        return back()->withErrors(['error'=>'خطأ غير معروف']);
    }
    public function updateStorePage($id){
        $store = Store::find($id);
        $users = User::all();
        return view('control.updateStore',['store'=>$store,'users'=>$users]);
    }
    public function updateStore(Request $request,$id){
        $store = Store::find($id);
        $request->validate([
            'ar_name'=>'required|max:50',
            'en_name'=>'required|max:50',
            'user_id'=>'required',
            'image' => 'nullable|mimes:png,jpg,jpeg,csv,txt,pdf|max:2048'
        ]);
        $data = [
            'ar_name'=>$request->input('ar_name'),
            'en_name'=>$request->input('en_name'),
            'user_id'=>$request->input('user_id')
        ];
        $store->update($data);
        if($store != null){
            if($request->hasFile('image')){

                $file = $request->file('image');
                $fileName = $file->getClientOriginalName();
                $path = $request->file('image')->storeAs('stores', $fileName, 'public');
                $store->image = $path;
                $store->save();
            }
            return back()->with(['success'=>'تم الحفظ']);
        }
        return back()->withErrors(['error'=>'خطأ غير معروف']);
    }
    public function delete($id){
        $store = Store::find($id);
        $store->delete();
        return back()->with(['success'=>'تم الحذف']);
    }
}
