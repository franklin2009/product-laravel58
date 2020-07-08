<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bodegas</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    </head>

    <style>
      .rounder{
        border-radius: 50px;
      }
      .table{ }
      .table > thead, .table > tfoot { 
          color:white;
          background: #0086f9;
      }
    </style>

    <script>
        $(function(){

            let isNew=true;
            let estado=[];

            $(document).ready(function () {

                $("#guardar").click(function() {
                    let url="producto/";
                    let data={
                        "id":0,
                        "codigo":$("#codigo").val(),
                        "nombre":$("#nombre").val(),
                        "descripcion":$("#descripcion").val(),
                        "existencia":$("#existencia").val(),
                        "estado":$("#estado").val(),
                        "bodega":$("#bodega").val()
                    };

                    if(isNew){
                        url+="create";
                        if(data.codigo=="" || data.nombre=="") {
                            alert("debes ingresar codigo y nombre");
                            return;
                        }
                    }else{
                        url+="update";
                        if(data.nombre=="") {
                            alert("debes ingresar  nombre");
                            return;
                        }
                    }
                    if(data.existencia=="") data.existencia=0;


                    $.ajax({ type: 'post', url: url, data: data }).then(function(res){
                            if(res.type == 'success'){
                                if(isNew) {
                                    //new
                                } else {
                                    // edit
                                } 
                                $("#ProductoModal").modal('hide');
                                alert("Correcto");
                            } else {
                                $("#ProductoModal").modal('hide');
                                alert("error");
                            }
                        }, function(err){
                            $("#ProductoModal").modal('hide');
                            alert("error");
                        });


                    $("#ProductoModal").modal('hide');
                });
                
                $("#nuevo").click(function() {
                    isNew=true;
                    $("#z-codigo").show();
                    $("#z-bodega").show();
                    $("#title-modal").html("Crear Producto");
                    $("#ProductoModal").modal();
                });

                $(".editar").click(function() {
                    isNew=false;
                    $("#z-codigo").hide();
                    $("#z-bodega").hide();
                    $("#title-modal").html("Editar Producto");
                    $("#ProductoModal").modal();
                });


                $('#buscar').click(function() {
                    var val = $.trim($("#producto").val()).replace(/ +/g, ' ').toLowerCase();
                    $('#table > tbody  > tr').each(function() {
                        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                        if(!~text.indexOf(val)) $(this).hide();
                        else $(this).show();
                    });
                });

                $('.estado-ch').click(function() {
                    var val = $(this).val();
                    var ch=$(this).is(':checked');
                    if(ch) {
                        estado.push(val);
                    } else {
                        estado.splice(estado.indexOf(val), 1);
                    }
                   console.log(" >> ",estado);
                });

                


            });
        });
    </script>

    <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Bodegas</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="container theme-showcase" role="main">
      <div class="jumbotron" style=" margin-top: 80px;">

      <div class="row"> 
            <div class="col-lg-8"> <b>Gestión de productos</b> </div>
            <div class="col-lg-4">  <button class="btn btn-info pull-right rounder"   id="nuevo">  Crear producto </button> </div>
      </div>

      <hr/>

      <div class="row"> 
            <div class="col-lg-6"> 

            <div class="input-group">
                    <span class="input-group-addon">Producto</span>
                    <input type="text" class="form-control" placeholder="Nombre del producto" id="producto">
                    <span class="input-group-btn"> <button class="btn btn-info" type="button" id="buscar">Buscar</button>  </span>
            </div>

            </div>
            <div class="col-lg-6">  
                    <div class="checkbox pull-right"> 
                        <label>  <input type="checkbox" value="T" class="estado-ch">  Mostrar Todos  </label>
                        <label>  <input type="checkbox" value="A" class="estado-ch"> Activos </label>
                        <label>  <input type="checkbox" value="I" class="estado-ch"> Inactivos </label>
                        <label>  <input type="checkbox" value="P" class="estado-ch"> Pendientes </label>
                    </div>
             </div>
      </div>


      <hr/>
       <div class="row">
            <div class="col-lg-12">
            <table class="table table-striped" id="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Codigo</th>
                        <th>Existencia</th>
                        <th>Bodega</th>
                        <th>Descripcion</th>
                        <th>Editar</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                @foreach( $productos as $producto )
                    <tr >
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->codigo }}</td>
                        <td>{{ $producto->existencia }}</td>
                        <td>{{ $producto->bodega->nombre }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td> <button class="btn btn-default editar" data-id="{{ $producto->id }}" data-estado="{{ $producto->estado }}"  data-bodega="{{ $producto->id_bodega }}" >  <i class="glyphicon glyphicon-pencil"></i> </button></td>
                        <td>  <span class="label label-{{ $producto->getClassEstado() }}">{{ $producto->getEstado() }}</span> </td>
                    </tr>
                </tbody>
                @endforeach
                <tfoot>
                        <tr >
                            <th colspan="7"> {{ count($productos) }} productos registrados. [ activos: 8] - [pendientes: 1] -  [Inactivos: 1] </th>
                        </tr>
                </tfoot>

                </table>
        </div>
       </div>


      </div>
    </div>






<div class="modal fade" tabindex="-1" role="dialog" id="ProductoModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title-modal">Modal</h4>
      </div>
      <div class="modal-body">
        <div class="form-group" id="z-codigo">
            <label for="codigo">Codigo * </label>
            <input type="text" class="form-control" id="codigo">
        </div>
        <div class="form-group">
            <label for="nombre">Nombre *</label>
            <input type="text" class="form-control" id="nombre">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <input type="text" class="form-control" id="descripcion">
        </div>
        <div class="form-group">
            <label for="existencia">Existencia</label>
            <input type="text" class="form-control" id="existencia">
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" class="form-control" id="estado">
        </div>
        <div class="form-group" id="z-bodega">
            <label for="bodega">Bodega</label>
            <input type="text" class="form-control" id="bodega">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="guardar">Guardar</button>
      </div>
    </div>
  </div>
</div>





    </body>
</html>
