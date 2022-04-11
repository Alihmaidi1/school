<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\setting as ModelsSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class setting extends Controller
{

    public function index(){

        $setting=ModelsSetting::all()[0];
        return view("pages.settings.show",["setting"=>$setting]);

    }


    public function store(Request $request){

        try{

            $setting=ModelsSetting::find(1);
            if($request->file("logo")){
                $setting->logo="1.".$request->file("logo")->getClientOriginalExtension();
                Storage::disk("public_path")->delete($setting->logo);
                Storage::disk("public_path")->putFileAs("",$request->file("logo"),"1.".$request->file("logo")->getClientOriginalExtension());
            }
            $setting->school_name=$request->school_name;
            $setting->address=$request->address;
            $setting->number=$request->phone;
            $setting->lowest_subject=$request->lowest_subject;
            $setting->save();

            toastr()->success(trans("messages.success"));
            return redirect()->back();
        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);

        }


    }


}
