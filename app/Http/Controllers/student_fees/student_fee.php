<?php

namespace App\Http\Controllers\student_fees;

use App\Http\Controllers\Controller;
use App\Models\fees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\repo\interfaces\student_fee as student_feeInterface;
use App\repo\interfaces\fee as feeInterface;
use App\repo\interfaces\classroom as classroomInterface;
class student_fee extends Controller
{

    public $student_fee;
    public $fee;

    public $classroom;
    public function __construct(student_feeInterface $student_fee,feeInterface $fee,classroomInterface $classroom)
    {

        $this->student_fee=$student_fee;
        $this->fee=$fee;
        $this->classroom=$classroom;
    }

    public function create_student_fee($id){

        $arr=Cache::get("students");
        $student=$arr[$id];
        $fees=$this->fee->getAllFee();
        $fee_first=fees::first();
        if($fee_first){
            $fee_first=$fee_first->amount;
        }
        return view("pages.fees.create_student_fee",["student"=>$student,"fees"=>$fees,"first"=>$fee_first]);

    }



    public function store_student_fee(Request $request){

        try{

            $this->student_fee->store($request);

        return redirect()->route("student.details",$request->student_id);
        }catch(\Exception $ex){
            toastr()->error($ex->getMessage());
            return redirect()->back();
        }

    }



    public function student_fee_edit($id){

        $arr=Cache::get("student_fees");
        $fee11=$arr[$id];
        $fees=$this->fee->getAllFee();
        $classrooms=$this->classroom->getAllClassroom();

    return view("pages.fees.student_fee_edit",["fee1"=>$fee11,"classrooms"=>$classrooms,"fees"=>$fees]);


    }




    public function student_fee_update(Request $request){

        try{

            $fee=$this->student_fee->update($request);
            toastr()->success(trans("messages.Update"));
            return redirect()->route("student.details",$fee->student_id);


        }catch(\Exception $ex){


            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);



        }

    }





    public function student_fee_delete($id){

        try{


            $this->student_fee->delete($id);
            toastr()->error(trans("messages.Delete"));
            return redirect()->back();


        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);

        }

    }





    public function student_fee_get($id){


        $arr=Cache::get("fees");
        $fee=$arr[$id];
        return   $fee->amount;


    }


}
