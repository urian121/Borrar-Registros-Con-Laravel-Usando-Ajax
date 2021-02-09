<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" rel="shortcut icon" href="{{ asset ('img/logo-mywebsite-urian-viera.svg') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <title>Borrar Registro en Laravel usando Ajax :: WebDeveloper Urian Viera</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style> 
        table tr th{
            background:rgba(0, 0, 0, .6);
            color: azure;
        }
        h3{
            color:crimson; 
            margin-top: 100px;
        }
        a:hover{
            cursor: pointer;
            color: #333 !important;
        }
      </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top" style="background-color: #563d7c !important;">
    <span class="navbar-brand">
        <img src="{{ asset ('img/logo-mywebsite-urian-viera.svg') }}" alt="Web Developer Urian Viera" width="120">
        Web Developer Urian Viera
    </span>
</nav>



<div class="container top">

    <h3 class="text-center">
      <span> 
          Borrar Registro usando Checkbox con Laravel y Ajax
            <strong id="profeAll">
              ({{ $totalProfesoresList->count() }})
            </strong> 
        </span>
    </h3>
    <hr>

<!----Mensaje de Exito --->
@include('mjs')


    @if($profesores->count())
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>#</th>
                <th>Nombre del Profesor</th>
                <th>Edad</th>
                <th>Sexo </th>
                <th>Acción</th>
            </tr>
                @foreach($profesores as $posicion => $profesor)
                    <tr id="registro{{ $profesor->id }}">
                        <td>
                            <input type="checkbox" class="delete_checkbox" data-id="{{$profesor->id}}">
                            <em>{{ $posicion }}</em>
                        </td>
                        <td>{{ $profesor->name }}</td>
                        <td>{{ $profesor->edad }}</td>
                        <td>{{ $profesor->sexo }}</td>
                        <td width='100px'>
                            <form name="form-data" id="form-data" action="{{ route('eliminarProfe',$profesor->id) }}" method="POST">
                                {{ method_field('DELETE') }} 
                                {{ csrf_field() }}  
                                <a href="#" class="btn-delete btn btn-danger btn-sm" id="{{ $profesor->id }}" title="Borrar Registro {{ $profesor->id }}">
                                    <i class="zmdi zmdi-delete zmdi-hc-lg"></i>
                                    Borrar
                                </a>
                        </form>
                        </td>
                    </tr>
                @endforeach
        </table>
    
        {!! $profesores->links() !!}
    
    </div>
    @endif


</div>

<script src="{{ asset('js/jquery-3.5.1.js') }}"></script>  
<script src="{{ asset('js/bootstrap.min.js') }}"></script> 
<script>
$(document).ready(function () {
    $('#contenMsjs').hide();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    
$(".btn-delete").click(function (e) {
    e.preventDefault();
    var id = $(this).attr("id");

    var form    = $(this).parents('form');
    var url     = form.attr('action');

        $.ajax({
            type: "DELETE", 
            url: url,
            data: $("#form-data").serialize(),
            success: function(data)
            {
                $("#contenMsjs").show();
                $('#msj').html(data.mensaje); //mensaje de exito
                $('#profeAll').html(data.totalprofesores); //Nuevo total de Registros
                $("#registro" + id).hide('slow');
            setTimeout(function () {
                $("#contenMsjs").fadeOut("slow");
            }, 4000);
            }
        }); 

    });
    
});
</script>
</body>
</html>