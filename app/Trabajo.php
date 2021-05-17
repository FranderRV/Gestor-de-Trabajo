<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trabajo extends Model
{
    
    public $timestamps = false;
    protected $fillable = [
        'descripcion', 'precio', 'user_id','cliente_id', 'fecha_entrega','estado','created_at',
    ];
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
