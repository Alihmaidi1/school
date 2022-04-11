<?php

namespace App\Http\Controllers\fees;

use App\Http\Controllers\Controller;
use App\Models\classroom;
use Illuminate\Http\Request;
use App\Models\fees as feesModel;
use App\repo\interfaces\fee as feeInterface;
use App\repo\interfaces\classroom as classroomInterface;
use App\models\student as studentmodel;
use App\Models\student_fee;
use Illuminate\Support\Facades\Cache;

class fees extends Controller
{

    public $classroom;
    public $fee;
    public function __construct(classroomInterface $classroom,feeInterface $fee)
    {

        $this->classroom=$classroom;
        $this->fee=$fee;
    }

    public function index(){


        $fees=$this->fee->getAllFee();

        return view("pages.fees.show",["fees"=>$fees]);

    }


    public function create(){


        $classrooms=$this->classroom->getAllClassroom();
        return view("pages.fees.create",["classrooms"=>$classrooms]);

    }




    public function store(Request $request){


        try{

            $this->fee->store($request);
            toastr()->success(trans("messages.success"));
            return redirect()->route("show_fees");

        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);


        }


    }







    public function edit($id){

        $classroom=$this->classroom->getAllClassroom();
        $fee=feesModel::find($id);
        return view("pages.fees.edit",["classrooms"=>$classroom,"fee"=>$fee]);



    }


    public function update(Request $request){
        try{

            $this->fee->update($request);
            toastr()->success(trans("messages.Update"));
            return redirect()->route("show_fees");

        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);

        }
    }

    public function delete(Request $request){

        try{

            $this->fee->delete($request->id);
            toastr()->error(trans("messages.Delete"));
            return redirect()->route("show_fees");


        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);

        }

    }









    public function student_sheck_get($id){

        $student_fee=student_fee::find($id);
        $amount=$student_fee->fee->amount;
        return $amount;


    }

}
