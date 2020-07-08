<?php

namespace App\Http\Models;

class Bodega extends ModelBase
{
	protected $table = 'bodegas';
	protected $fillable = ['id','nombre','estado'];
	protected $hidden = ['created_at', 'updated_at'];

}