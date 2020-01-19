@extends('layouts.app')
@section('content')
<html>
<style>
body{
    background-color:#a7ffeb;
}
</style>
<head> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"><link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <div class="row justify-content-center">
        <div class="col-md-8">
                <h3 class="flow-text" style="margin-left:36%;color:#00bfa5;">Listado de incidencias </h3>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="highlight">
                        <thead>
                            <tr class="teal accent-4">
                            <th>Fecha</th>
                            <th>Clase</th>
                            <th>Equipo</th>
                            <th>Descripción</th>
                            <th>Hora</th>
                            <th>ComentarioAdmin</th>
                            <th>Estado</th>
                            <th>Imagen</th>
                            <th>Editar</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos as $dato)
                        
                        <tr class="teal accent-3">
                            <td>{{$dato->fecha}}</td>
                            <td>{{$dato->clase}}</td>
                            <td>{{$dato->equipo}}</td>
                            <td>{{$dato->descripcion}}</td>
                            <td>{{$dato->hora}}</td>
                            <td>{{$dato->comentario}}</td>
                            <td>{{$dato->estado}}</td>
                            <td><img width="100px" src="/storage/{{$dato->archivo}}"></td>
                            <td><a href="/modificarinci/{{$dato->id}}"><img src="lapiz.png" width="50" height="50" style="cursor:pointer;"></td>
                            <td><a href="/eliminarinci/{{$dato->id}}"><img src="basura.png" width="50" height="50" style="cursor:pointer;"></td>
                        </tr>
                        
                        @endforeach 
                    </tbody>    
                    </table>
                    <br><br>
                    <div style="background-color:#00bfa5;">
                    <a href="{{ route('crear') }}" style="text-decoration:none;color:black;"><img src="Añadir.png" width="50" height="50" style="cursor:pointer;">Añadir nueva incidencia
                    </div>
                </div>
            </div>
</body>
</html>
@endsection
