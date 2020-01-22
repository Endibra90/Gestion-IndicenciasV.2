<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use Exception;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
   
    public function handleGoogleCallback()//Funcion del inicio de sesion de google
    {
        try {
  
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('google_id', $user->id)->first();
            $emailA=$user->email;
            if((explode("@", $user->email)[1] !== 'plaiaundi.net') or (explode("@", $user->email)[1] !== 'plaiaundi.com')){//Comprobar que es de plaiaundi
                return view('volveratras')->with('email',$emailA);
            }
            
            else if($finduser){
   
                Auth::login($finduser);
            if($finduser->admin==1){//Comprobar si es admin
                return redirect('admin/home');
            }
                return redirect('/home');
   
            }else{
                $newUser = User::create([//Creamos usuario en caso de que no este registrado
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'avatar'=>$user->avatar,
                ]);
  
                Auth::login($newUser);
   
                return redirect()->back();
            }
  
        } catch (Exception $e) {
            return redirect('auth/google');
        }
    }
}
