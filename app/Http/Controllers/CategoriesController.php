<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(){
        $cates = Category::all();
        return view('control.categories',['cates'=>$cates]);
    }
    public function addCategoryPage(){
        return view('control.addCategory');

    }
    public function addCategory(Request $request){
        $request->validate([
            'ar_name'=>'required|max:50',
            'en_name'=>'required|max:50',
            'image'=>'nullable|mimes:png,jpg,jpeg,csv,txt,pdf|max:2048'
        ]);
        $data = [
            'ar_name'=>$request->input('ar_name'),
            'en_name'=>$request->input('en_name')
        ];
        $cate = Category::create($data);
        if($cate != null){
            if($request->hasFile('image')){

                $file = $request->file('image');
                $fileName = $file->getClientOriginalName();
                $path = $request->file('image')->storeAs('storeCategories', $fileName, 'public');
                $cate->image = $path;
                $cate->save();
            }
            return back()->with(['success'=>'تم الحفظ']);
        }
        return back()->withErrors(['error'=>'خطأ غير معروف']);
    }
    public function updateCategoryPage($id){
        $cate = Category::find($id);
        return view('control.updateCategory',['cate'=>$cate]);
    }
    public function updateCategory(Request $request,$id){
        $cate = Category::find($id);
        $request->validate([
            'ar_name'=>'required|max:50',
            'en_name'=>'required|max:50',
            'image'=>'nullable|mimes:png,jpg,jpeg,csv,txt,pdf|max:2048'
        ]);
        $data = [
            'ar_name'=>$request->input('ar_name'),
            'en_name'=>$request->input('en_name')
        ];
        $cate->update($data);
        if($request->hasFile('image')){
            
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $path = $request->file('image')->storeAs('storeCategories', $fileName, 'public');
            $cate->image = $path;
            $cate->save();
        }
        return back()->with(['success'=>'تم الحفظ']);
    }
    public function delete($id){
        $cate = Category::find($id);
        $cate->delete();
        return back()->with(['success'=>'تم الحذف']);
    }
}
