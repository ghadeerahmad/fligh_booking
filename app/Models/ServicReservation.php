<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicReservation extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function servic(){
        return $this->belongsTo(Servic::class);
    }
}
