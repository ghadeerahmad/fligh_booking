<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicCategory extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function services(){
        return $this->hasMany(Servic::class);
    }
}
