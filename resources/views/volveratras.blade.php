<html>
    <head>
            <style>
                    body{
                        background-color:#a7ffeb;
                    }
            </style>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">   
    </head>
<body>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<h2>Necesitas permisos</h2>
<p>Cambia a una cuenta con permiso.(plaiaundi.net)</p>
<p>Has iniciado sesión como<strong> {{$email}}</strong></p>
<a class="waves-effect waves-teal btn-flat" href = "http://10.10.17.214.xip.io:8000/"/>Volver al home<i class="material-icons left">chevron_left</i></a>

<iframe id="logoutframe" src="https://accounts.google.com/logout" style="display: none"></iframe>
<img src="candado.png" style="position:absolute;left:40%;top:2%;" width="130" height="130">
</body>
</html>