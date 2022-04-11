<?php

namespace App\Http\Controllers\attendaces;

use App\Http\Controllers\Controller;
use App\Models\attendace as ModelsAttendace;
use Illuminate\Http\Request;
use App\Models\student;
use App\repo\interfaces\classroom;
use App\repo\interfaces\grade;
use App\repo\interfaces\attendaces as attendacesInterface;
class attendace extends Controller
{


    public $classroom;
    public $grade;
    public $attendace;
    public function __construct(classroom $classroom,grade $grade,attendacesInterface $attendace)
    {

        $this->classroom=$classroom;
        $this->grade=$grade;
        $this->attendace=$attendace;

    }

    public function index(){

        $classroom=$this->classroom->getAllClassroom();
        $grade=$this->grade->GetAllGrade();
        return view("pages.attendaces.show",["classrooms"=>$classroom,"grades"=>$grade]);

    }



    public function create($id){

        $student=student::where("section_id",$id)->get();

        return view("pages.attendaces.create",["students"=>$student]);


    }


    public function store(Request $request){

        try{

            if($request->operation=="create"){

            $this->attendace->store($request);
            toastr()->success(trans("messages.success"));


            }else{


             $this->attendace->update($request);

             toastr()->success(trans("messages.Update"));
            }
            return redirect()->route("attendace.show");

        }catch(\Exception $ex){
            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);
        }

    }


    public function details($id){


        $records=ModelsAttendace::where("section_id",$id)->get();

        return view("pages.attendaces.records",["records"=>$records]);


    }

}
