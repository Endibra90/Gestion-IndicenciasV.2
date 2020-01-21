<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Incidencias;
use Illuminate\Support\Facades\Mail;
use validator;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Mail\Estado;
use App\Mail\Comentario;
use App\Mail\CrearIncidencia;
use Illuminate\Support\Facades\Storage;
use File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()//Funcion que se encarga de devolver los datos y la vista del profesor
    {
        $datos = Incidencias::select('id','fecha','clase','equipo','descripcion','hora','comentario','estado','archivo')-> where('User_id',Auth::user()->id)->get();
        return view('homeNormal')->with('datos', $datos);
    }
    public function index2(){//Funcion que devuelve la vista de crear una incidencia
        return view('crearIncidencia');
    }
    public function indexEdit($id){//Funcion que se encarga devolver los datos y la vista de editar incidencia
        $datos = Incidencias::find($id);
        $this->authorize('permiso',$datos);
        $datos = Incidencias::select('id','fecha','clase','equipo','hora','descripcion','otro')-> where('id',$id)->get();
        return view('editarIncidencia')->with('datos', $datos);
    }
    public function indexAdmin(){//Funcion que se encarga de devolver los datos y la vista del administrador
        //$datos = Incidencias::select('id','fecha','clase','equipo','descripcion','hora','comentario','estado');
        $datos=DB::select('SELECT * FROM incidencias');
        return view('homeAdmin')->with('datos', $datos);
    }
    public function indexEstado($id){//Funcion que se encarga de devolver los datos y la vista de modificar estado
        $datos = Incidencias::select('id','estado')-> where('id',$id)->get();
        return view('modificarEstado')->with('datos',$datos);
    }
    public function modificarEstado(Request $request,$id){//Funcion que se encarga de modificar el estado y mandar un gmail
        $listaEstado=['Recibida','En proceso','Resuelta','Rechazada'];
        for($i=0;$i<$listaEstado;$i++){
            if($request->input('estado')!=$listaEstado[$i]){
                $datos = Incidencias::select('id','estado')-> where('id',$id)->get();
                return view('modificarEstado')->with('datos',$datos);
            }
        else{
            $datos = Incidencias::find($id);
            $email = Incidencias::select('email')-> where('id',$id)->get();
            //$fecha= Incidencias::select('fecha')->where('id',$id)->get();
            //$hora= Incidencias::select('hora')->where('id',$id)->get();
            $datos->estado = $request->input('estado');
            Mail::to($email)->send(new Estado);//linea que se encarga e mandar correos mediante una vista
            //view('emails.message-received2')->with('fecha',$fecha);
            $datos->update();
            return redirect('/admin/home');
        }
        }
    }
    public function indexComentario($id){//Funcion que se encarga de devolver los datos y la vista para hacer comentarios
        $datos = Incidencias::select('id','comentario')-> where('id',$id)->get();
        return view('añadirComentario')->with('datos',$datos);
    }
    public function hacerComentario(Request $request,$id){//Funcion que se encarga de hacer un comentario
        $datos = Incidencias::find($id);
        $datos->comentario = $request->input('comentario');
        $email = Incidencias::select('email')-> where('id',$id)->get();
        Mail::to($email)->send(new Comentario);//linea que se encarga e mandar correos mediante una vista
        $datos->update();
        return redirect('/admin/home');
    }
    public function eliminarInci($id){//Funcion que elimina una incidencia
        $user = Incidencias::find($id);
        $this->authorize('permiso',$user);
        $user->delete();
        return redirect('/home');
    }
    public function modificarInci(Request $request,$id){//Funcion que modifica una incidencia
        $listaDescripcion=['No se enciende la CPU/ CPU ez da pizten','No se enciende la pantalla/Pantaila ez da pizten','No entra en mi sesión/ ezin sartu nere erabiltzailearekin','No navega en Internet/ Internet ez dabil','No se oye el sonido/ Ez da aditzen','No lee el DVD/CD','Teclado roto/ Tekladu hondatuta','No funciona el ratón/Xagua ez dabil','Muy lento para entrar en la sesión/oso motel dijoa','Otro'];
        $validatedData = $request->validate([//Validacion de datos
            'fecha' => 'required',
            'clase' => 'required|between:100,999|integer',
            'equipo' => 'required|regex:/^HZ[0-9]{6}$/',
            'hora'=>'required|date_format:H:i',
            'descripcion' => 'required',
        ]);

        for($i=0;$i<$listaDescripcion;$i++){
            if($request->input('descripcion')!=$listaDescripcion[$i]){
                $datos = Incidencias::select('id','fecha','clase','equipo','hora','descripcion','otro')-> where('id',$id)->get();
                return view('modificarEstado')->with('datos',$datos);
            }
            else{
                if($request->input('descripcion')!="Otro"){
                    $otro="";
                }
                else{
                    $otro=$request->input('otro');
                }    
            $datos = Incidencias::find($id);
            $this->authorize('permiso',$datos);
            $datos->fecha = $request->input('fecha');//request de los datos del formulario
            $datos->clase = $request->input('clase');
            $datos->equipo = $request->input('equipo');
            $datos->hora = $request->input('hora');
            $datos->descripcion = $request->input('descripcion');
            $datos->otro = $request->input('otro');
            $datos->update();
            return redirect('/home');
            }
    }
}
    public function crearInci(Request $request){//Funcion que se encarga de crear una incidencia
        $listaDescripcion=['No se enciende la CPU/ CPU ez da pizten','No se enciende la pantalla/Pantaila ez da pizten','No entra en mi sesión/ ezin sartu nere erabiltzailearekin','No navega en Internet/ Internet ez dabil','No se oye el sonido/ Ez da aditzen','No lee el DVD/CD','Teclado roto/ Tekladu hondatuta','No funciona el ratón/Xagua ez dabil','Muy lento para entrar en la sesión/oso motel dijoa','Otro'];
        $validatedData = $request->validate([//Validacion de datos
            'fecha' => 'required',
            'clase' => 'required|between:100,999|integer',
            'equipo' => 'required|regex:/^HZ[0-9]{6}$/',
            'hora'=>'required|date_format:H:i',
            'descripcion' => 'required',
            "archivo" => "required|image|mimes:jpeg,png,jpg",
        ]);

        if($request->file('archivo')==null){
            $path=public_path('default.png');
            $archivo=response()->file($path);
            /*$hola=Storage::get('default.png');
            $requestObj = new Request($hola);
            //$archivo=Storage::disk('public')->get('app/default.png');*/
        }
        else
            $archivo=$request->file('archivo');
        for($i=0;$i<$listaDescripcion;$i++){
            if($request->input('descripcion')!=$listaDescripcion[$i]){
                return view('crearIncidencia');
            }
            else{
                if($request->input('descripcion')!="Otro"){
                    $otro="";
                }
                else{
                    $otro=$request->input('otro');
                }    
                $newUser = Incidencias::create([
                    'fecha' =>$request->input('fecha'),//request de los datos del formulario
                    'clase' =>$request->input('clase'),
                    'equipo'=> $request->input('equipo'),
                    'descripcion'=>$request->input('descripcion'),
                    'hora'=>$request->input('hora'),
                    'estado'=>'Recibida',
                    'email'=>auth::user()->email,
                    'otro'=>$otro,
                    'comentario'=>'',
                    'archivo'=>$archivo->store(''),
                    $archivo->store('public'),
                    'User_id'=>auth::user()->id,
                ]);
                Mail::to('ik012108bhn@plaiaundi.net')->send(new CrearIncidencia);//linea que se encarga e mandar correos mediante una vista
                return redirect('/home');
            }
        }
}
}
