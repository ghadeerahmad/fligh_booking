<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'airport'=>'required',
            'destination'=>'required',
            'date'=>'required',
            'time'=>'required'
        ]);
        if($validator->fails()) return response(['status'=>0,'message'=>$validator->errors()->first()],200);
        $user = auth()->user();
        $data = [
            'airport'=>$request->input('airport'),
            'destination'=>$request->input('destination'),
            'date'=>$request->input('date'),
            'time'=>$request->input('time'),
            'user_id'=>$user->id,
        ];
        $car = Car::create($data);
        if($car) return response(['status'=>1,'message'=>'success','data'=>$car],200);
        return response(['status'=>0,'message'=>'error'],200);
    }
}
