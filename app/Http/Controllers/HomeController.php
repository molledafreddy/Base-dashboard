<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Setting;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        // dd("ola");
            // $this->lang();
            return redirect('/admin');
        
        // return route("login");
        
    }

    public function favicon(){
        return Setting::where(['param' => 'Favicon', 'type' => 'image'])->first();
    }

    public function lang(){
        \Log::debug('llego al metodo lang');
        $lang = Setting::where(['param' => 'Defaul languaje', 'type' => 'link'])->first();
        session(['lang' => $lang]);
        return \Redirect::back();
    }
}
