<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

    public function doLogin(Request $request)
    { 
        \Log::debug("nombre del usuario");
        // return "hola";
        
       if(Auth::attempt(['email' => $request->email, 'password' =>$request->password ])){   
            //Login Successful 
        $username = auth()->user()->name;
        \Log::debug("nombre del usuario". $username);
        $defaultLang = \App\Setting::where(['param' => 'Defaul languaje', 'type' => 'text'])->first()->value;
        $color = \App\Setting::where(['param' => 'Colors', 'type' => 'list', 'key' => 'color' ])->first()->value;

        // session('lang');   
        return ['status'=>200,'oper'=>'success','msg' => "Bienvenido $username", 'user' => auth()->user(), 'defaultLang'=> $defaultLang, 'color'=> $color];
           
        }else{
            return ['oper'=>'danger','msg' => "Credenciales Invalidas", 'status'=> 401];
        }
    }

    public function validEmail(Request $request){
      try {      
         $objUser= new User();
         $objpasswrod=new ForgotPasswordController();
         $data_user=$objUser->where('email',$request->email)->select('id')->get();
         if(empty($data_user->all())){
            return response()->json( [ 'oper' => false, 'msg' => 'Email no registrado' ], 200);
         }else{
            if($objpasswrod->sendEmailPassword($request)){
                return response()->json( [ 'oper' => true, 'msg' => 'Email enviado con exito' ], 200);
            }else{
              return response()->json( [ 'oper' => true, 'msg' => 'Error al enviar email password' ], 500);
            }
         }
        } catch (Exception $e) {
            \Log::error('Error enviar email password Usuario: '.$request->email.' LINE: '.$e->getLine().' FILE: '.$ex->getFile());
            return response()->json( [ 'data' => '' , 'msg' => '' ], 500);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        \Log::debug("llego al metodo logout". $request);
        $this->guard()->logout();

        $request->session()->invalidate();
        return response()->json(['message' => 
            'Successfully logged out']);
        // return $this->loggedOut($request) ?: redirect('/');
    }
}
