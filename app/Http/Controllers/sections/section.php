<?php

namespace App\Http\Controllers\sections;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\section\add_section;
use App\repo\interfaces\grade as gradeInterface;
use App\repo\interfaces\section as sectionInterface;
use App\repo\interfaces\classroom as classroominterface;
class section extends Controller
{


    public $grade;
    public $section;
    public $classroom;
    public function __construct(gradeInterface $grade_interface,sectionInterface $section,classroominterface $classroom)
    {
        $this->grade=$grade_interface;
        $this->section=$section;
        $this->classroom=$classroom;

    }


    public function index(){

        $grades=$this->grade->GetAllGrade();
        $classrooms=$this->classroom->getAllClassroom();
        return view("pages.section.section",["classrooms"=>$classrooms,"grades"=>$grades]);
    }


    public function store(add_section $request){

        try{

            $this->section->store($request);
            toastr()->success(trans("messages.success"));
            return redirect()->back();


        }catch(\Exception $ex){
            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>trans("messages.error")]);
        }
    }


    public function edit(add_section $request){

        try{

            $this->section->update($request);
            toastr()->success(trans("messages.success"));
            return redirect()->back();

        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex]);

        }

    }


    public function delete(Request $request){

        try{

            $this->section->delete($request);
            toastr()->error(trans("messages.Delete"));
            return redirect()->back();

        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex]);

        }

    }


    public function get_section_by_classroom($id){


        try{

            $section=$this->section->get_section_by_classroom($id);
            return response()->json($section);

        }catch(\Exception $ex){
            return response()->json(["error"=>$ex]);

        }



    }



}
