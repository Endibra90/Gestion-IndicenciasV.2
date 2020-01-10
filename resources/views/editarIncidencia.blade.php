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
    <div class="row justify-content-center">
        <div class="col-md-8">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach ($datos as $dato)
                    <form action="/modificarinciPost/{{$dato->id}}" method="POST">
                        @csrf
                        <p>Fecha: <input type="date" name="fecha" size="40" value="{{$dato->fecha}}"></p>
                        <p>Clase: <input type="text" name="clase" size="40" value="{{$dato->clase}}"></p>
                        <p>Hora: <input type="text" name="hora" size="40" value="{{$dato->hora}}"></p>
                        <p>Equipo: <input type="text" name="equipo" size="40" value="{{$dato->equipo}}"></p>
                        <div class="input-field">
                            <select name="descripcion" onchange="if(this.value=='Otro'){document.getElementById('otro').disabled = false} else {document.getElementById('otro').disabled = true}">
                                <option selected>{{$dato->descripcion}}</option>
                                <option value="No se enciende la CPU/ CPU ez da pizten">No se enciende la CPU/ CPU ez da pizten</option>
                                <option value="No se enciende la pantalla/Pantaila ez da pizten">No se enciende la pantalla/Pantaila ez da pizten</option>
                                <option value="No entra en mi sesión/ ezin sartu nere erabiltzailearekin">No entra en mi sesión/ ezin sartu nere erabiltzailearekin</option>
                                <option value="No navega en Internet/ Internet ez dabil">No navega en Internet/ Internet ez dabil</option>
                                <option value="No se oye el sonido/ Ez da aditzen">No se oye el sonido/ Ez da aditzen</option>
                                <option value="No lee el DVD/CD">No lee el DVD/CDn</option>
                                <option value="Teclado roto/ Tekladu hondatuta">Teclado roto/ Tekladu hondatuta</option>
                                <option value="No funciona el ratón/Xagua ez dabil">No funciona el ratón/Xagua ez dabil</option>
                                <option value="Muy lento para entrar en la sesión/oso motel dijoa">Muy lento para entrar en la sesión/oso motel dijoa</option>
                                <option value="Otro">Otro/Beste bat</option>
                            </p></select>
                        </div>
                        <p>Otro: <input type="text" name="otro" size="40" value="{{$dato->otro}}" id="otro" disabled></p>
                        <p>
                            <button class="btn waves-effect waves-light" type="submit" value="Enviar" style="margin-left:86%">Enviar<i class="material-icons right">send</i>
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
</body>
</html>
@endsection
