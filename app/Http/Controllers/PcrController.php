<?php

namespace App\Http\Controllers;

use App\Models\Pcr;
use Illuminate\Http\Request;

class PcrController extends Controller
{
    public function index(){
        $pcrs = Pcr::with(['user'])->paginate(20);
        return view('control.pcrReservation',['pcrs'=>$pcrs]);
    }
}
