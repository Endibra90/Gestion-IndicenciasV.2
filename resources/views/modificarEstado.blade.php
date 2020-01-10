@extends('layouts.app')
<html>
<head>
<style>
td{
    padding:-10px;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
        $(document).ready(function(){
          $('select').formSelect();
        }); 
 </script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"><link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
@section('content')
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar estado</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach ($datos as $dato)
                    <form action="/admin/modificarEstadoPost/{{$dato->id}}" method="POST">
                        @csrf
                        <div class="input-field">
                        <select name="estado">
                            <option value="Recibida">Recibida</option> 
                            <option value="En proceso">En Proceso</option>
                            <option value="Resuelta">Resuelta</option>
                            <option value="Rechazada">Rechazada</option>
                          </select>
                    </div>
                        <p>
                          <button class="btn waves-effect waves-light" type="submit" value="Enviar" style="margin-left:80%">Enviar<i class="material-icons right">send</i>
                          </button>
                        </p>
                        @endforeach
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                        @endif
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
@endsection