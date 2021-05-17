<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre', 'telefono', 'user_id','created_at',
    ];
    public function trabajos(){
       return $this->hasMany(Trabajo::class,'');
    }

    public function user(){
        return $this->belongsTo(User::class);
    } 
}
