<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Testing\Fluent\Concerns\Has;

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

    // use AuthenticatesUsers;




    public function login(HttpRequest $request){



        if(Auth::guard($request->type)->attempt(["email"=>$request->email,"password"=>$request->password])){

            $type=$request->type;
            if ($type=="web") {
                return redirect(RouteServiceProvider::HOME);
            }else if($type=="student"){

                return redirect(RouteServiceProvider::HOMEStudent);

            }else if($type=="techer"){

                return redirect(RouteServiceProvider::HOMETecher);

            }else if($type=="parent1"){

                return redirect(RouteServiceProvider::HOMEParent);


            }


        }else{

            return redirect()->back()->withErrors(["error"=>"error"]);
        }



    }

    public function redirect($type){



    }



    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
