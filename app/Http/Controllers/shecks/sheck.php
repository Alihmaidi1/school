<?php

namespace App\Http\Controllers\shecks;

use App\Http\Controllers\Controller;
use App\Models\sheck as ModelsSheck;
use Illuminate\Http\Request;
use App\Models\student;
use App\Models\student_fee;
use App\repo\interfaces\sheck as sheckInterface;
use App\repo\interfaces\student as studentInterface;
use Illuminate\Support\Facades\Cache;

class sheck extends Controller
{

    public $sheck;
    public $student;
    public function __construct(sheckInterface $sheck ,studentInterface $student)
    {

        $this->sheck=$sheck;
        $this->student=$student;

    }

    public function create($id){

        $arr=Cache::get("students");
        $student=$arr[$id];
        $shecks=Cache::get("shecks");
        $student_fee=student_fee::where("student_id",$id)->get();
        $first=student_fee::where("student_id",$id)->first();
        if($first){
            $first=$first->fee->amount;
        }
        return view("pages.shecks.create",["student"=>$student,"shecks"=>$shecks,"student_fee"=>$student_fee,"first"=>$first]);

    }

    public function store(Request $request){

        try{

            $this->sheck->store($request);
            toastr()->success(trans("messages.success"));
            return redirect()->route("student.details",$request->student_id);


        }catch(\Exception $ex){

            toastr()->error($ex->getMessage());
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);

        }

    }


    public function delete($id){

        try{
            $student=$this->sheck->delete($id);
            toastr()->success(trans("messages.success"));
            return redirect()->route("student.details",$student->id);

        }catch(\Exception $ex){


            toastr()->error($ex->getMessage());
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);

        }



    }



    public function edit($id){


        $arr=Cache::get("shecks");
        $sheck=$arr[$id];
        $student_fee=Cache::get("student_fees");
        $first=$sheck->student_fees_id;
        $first=$student_fee[$first]->fee->amount;
        $arr1=Cache::get("students");
        $student=$arr1[$sheck->student_id];
         return view("pages.shecks.edit",["student"=>$student,"sheck"=>$sheck,"student_fee"=>$student_fee,"first"=>$first]);

    }

    public function update(Request $request){

        try{

            $sheck=$this->sheck->update($request);
            toastr()->success(trans("messages.Update"));
            return redirect()->route("student.details",$sheck->student_id);



        }catch(\Exception $ex){

            toastr()->error($ex->getMessage());
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);

        }




    }





}
