<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\ForgotPasswordController;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function signup(Request $request)
    {
        // $request->validate([
        //     'name'     => 'required|string',
        //     'email'    => 'required|string|email|unique:users',
        //     'password' => 'required|string|confirmed',
        // ]);
        // return $request->all();
        \Log::debug('llego al auth controller');
        $user = new User([
            // 'name'     => $request->name,
            'name'     => "carlos",
            // 'email'    => $request->email,
            'email'    => "carlos@gmail.com",
            'api_token' => str_random(50),
            'password' => bcrypt($request->password),
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'], 201);
    }
    
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email'       => 'required|string|email',
    //         'password'    => 'required|string',
    //         'remember_me' => 'boolean',
    //     ]);
    //     $credentials = request(['email', 'password']);
    //     if (!Auth::attempt($credentials)) {
    //         return response()->json([
    //             'message' => 'Unauthorized'], 401);
    //     }
    //     $user = $request->user();
    //     $tokenResult = $user->createToken('Personal Access Token');
    //     $token = $tokenResult->token;
    //     if ($request->remember_me) {
    //         $token->expires_at = Carbon::now()->addWeeks(1);
    //     }
    //     $token->save();
    //     return response()->json([
    //         'access_token' => $tokenResult->accessToken,
    //         'token_type'   => 'Bearer',
    //         'expires_at'   => Carbon::parse(
    //             $tokenResult->token->expires_at)
    //                 ->toDateTimeString(),
    //     ]);
    // }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $user->generateToken();
            \Log::debug("datos de la sesion $user");
            $defaultLang = \App\Setting::where(['param' => 'Defaul languaje', 'type' => 'text'])->first()->value;
            $username = auth()->user()->name;

            return response()->json([
                'access_token' => $user->accessToken,
                'token_type'   => 'Bearer',
                'msg' => "Bienvenido $username", 
                'user' => auth()->user(), 
                'defaultLang'=> $defaultLang
            ]);
            return response()->json([
                'data' => $user->toArray(),
            ]);
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();

            if ($user) {
                $user->api_token = null;
                $user->save();
            }
        // return $user;

        return response()->json(['data' => 'User logged out.'], 200);
    }

    // public function logout(Request $request)
    // {


    // 	\Log::debug("valor request: ". $request->user()->token()->revoke());
    //     // $request->user()->token()->revoke();
    //     return response()->json(['message' => 
    //         'Successfully logged out']);

    // }

    // public function logout(Request $request)
    // {
    //     $this->guard()->logout();

    //     $request->session()->invalidate();
    //     \Log::debug("llego al metodo logout". $request);

    //     return response()->json(['message' => 
    //         'Successfully logged out']);
    //     // return $this->loggedOut($request) ?: redirect('/');
    // }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
