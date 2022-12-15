<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function messages(){
        return $this->hasMany(Message::class);
    }
    public function sender(){
        return $this->belongsTo(User::class,'sender_id','id');
    }
    public function reciever(){
        return $this->belongsTo(User::class,'rec_id','id');
    }
}
