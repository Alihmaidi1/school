<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('dashboard');
    }

    public function logout(Request $request){

        try{


            auth($request->type)->logout();
            Session::flush();

            return redirect()->route("selection");

        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);



        }




    }


}
