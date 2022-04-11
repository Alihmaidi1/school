<?php

namespace App\Http\Controllers\students;

use App\Http\Controllers\Controller;
use App\Http\Requests\students\add_student;
use App\Models\student as studentModel;
use App\Models\student_subject;
use App\repo\interfaces\student as studentInterface;
use App\repo\interfaces\classroom as classroomInterface;
use App\repo\interfaces\grade as gradeInterface;
use App\repo\interfaces\section as sectionInterface;
use App\repo\interfaces\parents as parentInterface;
use App\repo\interfaces\subject as subjectinterface;
use App\traits\photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class student extends Controller
{

    use photo;

    public $student;
    public $classroom;
    public $grade;
    public $section;
    public $parent;
    public function __construct(studentInterface $student,classroomInterface $classroom,gradeInterface $grade,sectionInterface $section,parentInterface $parent,subjectinterface $subject)
    {
        $this->parent=$parent;
        $this->section=$section;
        $this->grade=$grade;
        $this->classroom=$classroom;
        $this->student=$student;
        $this->subject=$subject;

    }

    public function index(){

        $students=$this->student->getAllStudent();
        return view("pages.students.student",compact("students"));

    }

    public function create(){

        $parents=$this->parent->getAllParent();
        $sections=$this->section->getAllSection();
        return view("pages.students.create",["parents"=>$parents,"sections"=>$sections]);

    }

    public function store(add_student $request){

        try{


            $student=$this->student->store($request);
            $subjects=$student->section->classroom->subjects;
            foreach($subjects as $subject){
               student_subject::create([
                "student_id"=>$student->id,
                "subject_id"=>$subject->id
               ]);
            }
            if($request->attchments)
            $this->savePhoto($request,$student->id,"App\Models\student","students/".$student->id);
            toastr()->success(trans("messages.success"));
            return redirect()->route("show.student");

        }catch(\Exception $ex){

            toastr()->error($ex->getMessage());
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);

        }

    }




    public function edit($id){

        try{
            $grades=$this->grade->GetAllGrade();
            $arr=Cache::get("students");
            $student=$arr[$id];
            $classrooms=$this->classroom->getAllClassroom();
            $parents=$this->parent->getAllParent();
            $sections=$this->section->getAllSection();
            return view("pages.students.edit",["student"=>$student,"classrooms"=>$classrooms,"parents"=>$parents,"sections"=>$sections,"grades"=>$grades]);

        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);

        }

    }

    public function update(add_student $request){

        try{

            $this->student->update($request);
            toastr()->success(trans("messages.Update"));
            return redirect()->route("show.student");


        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);

        }

    }

    public function delete($id){

        try{

            $this->student->delete($id);
            toastr()->success(trans("messages.Delete"));
            return redirect()->back();

        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);

        }

    }


    public function show_details($id){

        $arr=Cache::get("students");
        $student=$arr[$id];
        return view("pages.students.details",["student"=>$student]);

    }



    public function attachment_student_save(Request $request){


        try{



            $this->savePhoto($request,$request->id,"App\Models\student","students/".$request->id);
            toastr()->success(trans("messages.success"));
            return redirect()->back();



        }catch(\Exception $ex){


            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);



        }






    }


}
