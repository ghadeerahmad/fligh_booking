<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class ApiSetting extends Model
{
    use HasFactory;
    protected $guarded = [];
    public static function checkToken()
    {
        $token = ApiSetting::where('name', 'amadeus_token')->first();
        if (!empty($token->value)) {
            $response = Http::get('https://api.amadeus.com/v1/security/oauth2/token/' . $token->value);
            if (isset($response->json()['expires_in']) && $response->json()['expires_in'] == 0) {
                Flight::updateToken();
            }
        } else {
            Flight::updateToken();
        }
        return true;
    }
}
