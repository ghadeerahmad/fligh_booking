<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pcr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PcrController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'travel_date'=>'required|date',
            'city'=>'required',
            
        ]);
        if($validator->fails()) return response(['status'=>0,'message'=>$validator->errors()->first()],200);
        $data = [
            'travel_date'=>$request->input('travel_date'),
            'city'=>$request->input('city'),
            'user_id'=>auth()->user()->id
        ];
        $res = Pcr::create($data);
        if($res != null) return response(['status'=>1,'message'=>'success'],200);
        return response(['status'=>0,'message'=>'error'],200);
    }
}
