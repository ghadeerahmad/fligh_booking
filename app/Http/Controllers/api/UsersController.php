<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function profile(){
        return response(['sttaus'=>1,'data'=>auth()->user()],200);
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if($validator->fails()) return response(['status'=>1,'message'=>$validator->errors()->first()],200);
        $data = [
            'email'=>$request->input('email'),
            'password'=>$request->input('password')
        ];
        if(Auth::attempt($data)){
            $user = auth()->user();
            $token = Auth::user()->createToken('api_token')->accessToken;
            //$user->save();
            $user->setRememberToken($token);
            $user['api_token'] = $user->getRememberToken();
            return response(['status'=>1,'data'=>auth()->user()],200);
        }
        return response(['status'=>0,'message'=>'error in email or password'],200);
    }
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'name'=>'required|max:50',
            'passport'=>'required',
            'gender'=>'required',
            'password'=>'required|min:8'
        ]);
        if($validator->fails()) return response(['status'=>0,'message'=>$validator->errors()->first()],200);
        $data = [
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'passport'=>$request->input('passport'),
            'gender'=>$request->input('gender'),
            'password'=>bcrypt($request->input('password'))
        ];
        $user = User::create($data);
        if($user != null){
            Auth::login($user);
            $token = Auth::user()->createToken('api_token')->accessToken;
            $user->setRememberToken($token);
            $user['api_token'] = $user->getRememberToken();
            return response(['status'=>1,'data'=>auth()->user()],200);
        }
        return response(['status'=>0,'message'=>'error'],200);
    }
    public function update(Request $request){
        $user = auth()->user();
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:50',
            'passport'=>'required',
            'gender'=>'required',
            'password'=>'nullable',
            'image'=>'nullable|mimes:png,jpg,jpeg,csv,txt,pdf|max:2048'
        ]);
        if($validator->fails()) return response(['status'=>0,'message'=>$validator->errors()->first()],200);
        $data = [
            'name'=>$request->input('name'),
            'passport'=>$request->input('passport'),
            'gender'=>$request->input('passport'),
        ];
        if($request->input('password') != null)$data['password']=bcrypt($request->input('password'));
        $user->update($data);
        if($request->hasFile('image')){
            $path = $request->file('image')->store('public/users');
            $pth = explode('/',$path);
            $user->image = $pth[1].'/'.$pth[2];
            $user->save();
        }
        return response(['status'=>1,'message'=>'success'],200);
    }
}
