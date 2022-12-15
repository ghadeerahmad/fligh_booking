<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Servic;
use App\Models\ServicReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{
    public function index($id){
        $services = Servic::where('servicCategory_id',$id)->get();
        return response(['status'=>1,'data'=>$services],200);
    }
    public function reserve(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'birthday'=>'required|date',
            'bank'=>'required',
            'education'=>'required',
            'work'=>'required',
            'account_type'=>'required',
            'other_passport'=>'required',
            'other_resdince'=>'required',
            'age'=>'nullable',
            'staying_time'=>'nullable',
            'destination'=>'nullable',
            'diseases'=>'nullable',
            'gender'=>'required',
            'married'=>'required'

        ]);
        if($validator->fails())return response(['status'=>0,'message'=>$validator->errors()->first()],200);
        $data = [
            'servic_id'=>$id,
            'birthday'=>$request->input('birthday'),
            'bank'=>$request->input('bank'),
            'education'=>$request->input('education'),
            'work'=>$request->input('work'),
            'account_type'=>$request->input('account_type'),
            'other_passport'=>$request->input('other_passport'),
            'other_resdince'=>$request->input('other_resdince'),
            'age'=>$request->input('age'),
            'gender'=>$request->input('gender'),
            'married'=>$request->input('married'),
            'user_id'=>auth()->user()->id
        ];
        if($request->input('staying_time') != null) $data['staying_time'] = $request->input('staying_time');
        if($request->input('distination') != null) $data['distination'] = $request->input('distination');
        if($request->input('diseases') != null) $data['diseases'] = $request->input('diseases');
        $res = ServicReservation::create($data);
        if($res !=null)
            return response(['status'=>1,'message'=>'success'],200);
        return response(['status'=>0,'message'=>'error'],200);
    }
}
