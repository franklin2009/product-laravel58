<?php

namespace App\Http\Models;

class Producto extends ModelBase
{
	protected $table = 'productos';
	protected $fillable = ['id','codigo','nombre','descripcion','existencia','estado','id_bodega'];
    protected $hidden = ['created_at', 'updated_at'];
    
    public function bodega()
    {
        return $this->belongsTo(Bodega::class, 'id_bodega');

    }

}