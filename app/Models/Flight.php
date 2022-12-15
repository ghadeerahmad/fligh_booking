<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Flight extends Model
{
    use HasFactory;
    protected $guarded = [];
    public static function updateToken()
    {
        try {
            $response = Http::asForm()->post('https://api.amadeus.com/v1/security/oauth2/token', [
                'grant_type' => 'client_credentials',
                'client_id' => '8z8MH7cJYG8SMzpAjdCU37L5rAs3KDy2',
                'client_secret' => 'KDWr7qdP631FDLuT', 
            ]);
            //dd($response->json());
            $settings = ApiSetting::where('name', 'amadeus_token')->first();
            $data = ['value' => $response->json()['access_token']];
            $settings->update($data);
        } catch (Exception $e) {
        }
    }
}
