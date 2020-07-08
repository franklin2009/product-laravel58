@extends('layouts.base')

@section('content')

<productfilter-component > </productfilter-component>

<hr/>

 <product-component   v-bind:productos="{{ $productos }}" v-bind:bodegas="{{ $bodegas }}" > </product-component>

 <productmodal-component v-bind:bodegas="{{ $bodegas }}" > </productmodal-component>

@endsection
