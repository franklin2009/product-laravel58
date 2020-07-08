@extends('layouts.base')

@section('content')

<h2>About</h2>
<hr/>
<p>
    <b> Desarrollador Web : Test </b> <br/>
    Herramientas: PHP (laravel 5.8), HTML, CSS, Bootstrap 3, JavaScript, jQuery 3.x, Vue 2.x, MySQL <br/><br/>
    Modelo de base de datos. <br/>
    <img src="{{ asset('img/modelo.png') }}"/>

    <br/><br/>Script de base de datos <br/>
    <a href="{{ asset('db/bodega.sql') }}" download>descargar sql</a> <br/><br/>
    
    Consulta Sql:  obtener nombre de la bodega y la información del producto

    <div class="well">
            SELECT p.codigo, p.nombre, p.descripcion, p.existencia, p.estado, b.nombre as bodega FROM productos p, bodegas b WHERE p.id_bodega=b.id
    </div>
    

</p>

@endsection
