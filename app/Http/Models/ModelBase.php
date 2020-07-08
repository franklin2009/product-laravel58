<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ModelBase extends Model
{
  
	public static function getArrayEstado(){
		return array("A"=>"Activo","P"=>"Pendiente","I"=>"Inactivo");
    }
    
    public static function getArrayClassEstado(){
		return array("A"=>"success","P"=>"warning","I"=>"danger");
	}
	
	public function getEstado(){
		$estado=static::getArrayEstado();
		return $estado[$this->estado];
    }
    
    public function getClassEstado(){
		$class=static::getArrayClassEstado();
		return $class[$this->estado];
	}
		
}
