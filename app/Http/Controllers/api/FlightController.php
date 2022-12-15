<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ApiSetting;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class FlightController extends Controller
{
    public function searchAirport($keyword)
    {
       if (ApiSetting::checkToken()) {
            $token = ApiSetting::where('name', 'amadeus_token')->first();
            $response = Http::withToken($token->value)->get('https://api.amadeus.com/v1/reference-data/locations?subType=AIRPORT&keyword=' . $keyword);
        
            return response($response, 200);
        }
    }
    public function searchFlights(Request $request){
        $validator = Validator::make($request->all(),[
            'originLocationCode'=>'required|max:3',
            'destinationLocationCode'=>'required|max:3',
            'departureDate'=>'required|date',
            'returnDate'=>'required|date',
            'adults'=>'required',
            'children'=>'nullable',
            'max'=>'nullable'
        ]);
        if($validator->fails())return response(['status'=>0,'message'=>$validator->errors()->first()]);
        $response = [];
        if(ApiSetting::checkToken()){
            $token = ApiSetting::where('name', 'amadeus_token')->first();
            $url = "https://api.amadeus.com/v2/shopping/flight-offers?originLocationCode={$request->input('originLocationCode')}&destinationLocationCode={$request->input('destinationLocationCode')}&departureDate={$request->input('departureDate')}&returnDate={$request->input('returnDate')}&adults={$request->input('adults')}";
            if($request->input('children') != null) $url .= '&children='.$request->input('children');
            if($request->input('max') != null) $url .= '&max='.$request->input('max');
            $response = Http::withToken($token->value)->get($url);
        }
        return response($response->json(),200);
    }
}
