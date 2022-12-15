<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(){
        $car = Car::with(['user'])->get();
        return view('control.car',['car'=>$car]);
    }
    public function details($id){
        $car = Car::find($id);
        return view('control.carDetails',['details'=>$car]);
    }
}
