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
                    <form action="/crearinciPost" method="POST" enctype="multipart/form-data">
                        @csrf
                        <p>Fecha: <input type="date" name="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha') }}" required autocomplete="fecha" autofocus></p>
                        <p>Clase: <input type="text" name="clase" size="40" class="form-control @error('clase') is-invalid @enderror" value="{{ old('clase') }}" required autocomplete="clase" autofocus></p>
                        <p>Hora: <input type="text" name="hora" size="40" class="form-control @error('hora') is-invalid @enderror" value="{{ old('hora') }}" required autocomplete="hora" autofocus></p>
                        <p>Equipo: <input type="text" name="equipo" size="40" class="form-control @error('equipo') is-invalid @enderror" value="{{ old('equipo') }}" required autocomplete="equipo" autofocus>
                        <p>Descripcion:
                        <div class="input-field">
                        <select name="descripcion" onchange="if(this.value=='Otro'){document.getElementById('otro').disabled = false} else {document.getElementById('otro').disabled = true}">
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
                          <p>Otro: <input type="text" value="Seleciona otro para escribir" name="otro"  size="40" id="otro" disabled class="form-control @error('otro') is-invalid @enderror" value="{{ old('otro') }}" required autocomplete="otro" autofocus></p>
                        <p style="margin-left:85%;">
                            <div class="file-field input-field">
                                <div class="btn">
                                  <span>Archivo(luego no se podra editar)</span>
                                  <input type="file" name="archivo">
                                </div>
                                <div class="file-path-wrapper">
                                  <input class="file-path validate" type="text">
                                </div>
                              </div>
                          <button class="btn waves-effect waves-light" type="submit" value="Enviar">Enviar</button>
                          <button class="btn waves-effect waves-light" type="reset" value="Borrar" >Borrar</button>
                        </p>
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
</body>
</html>
@endsection
