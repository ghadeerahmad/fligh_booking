<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servic extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function servicCategory(){
        return $this->belongsTo(ServicCategory::class);
    }
    public function servicReservations(){
        return $this->hasMany(ServicReservation::class);
    }
}
