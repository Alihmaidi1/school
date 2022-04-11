<?php

namespace App\Http\Controllers\subjects;

use App\Http\Controllers\Controller;
use App\Models\student_subject;
use Illuminate\Http\Request;
use App\Models\subject as subjectModel;
use App\repo\interfaces\techer as techerinterface;
use App\repo\interfaces\classroom as classroominterface;
use App\repo\interfaces\subject as subjectInterface;

class subject extends Controller
{


    public $techer;
    public $subject;
    public $classroom;
    public function __construct(techerinterface $techer,classroominterface $classroom,subjectInterface $subject)
    {

        $this->techer=$techer;
        $this->classroom=$classroom;
        $this->subject=$subject;

    }
    public function index(){


        $subjects=$this->subject->getAllsubject();

        return view("pages.subjects.show_subject",["subjects"=>$subjects]);

    }


    public function create(){


        $techers=$this->techer->getAllTecher();
        $classroom=$this->classroom->getAllClassroom();
        return view("pages.subjects.create",["techers"=>$techers,"classrooms"=>$classroom]);

    }


    public function store(Request $request){

        try{

            $subject=$this->subject->store($request);
            $classroom=$subject->classroom;
            $students=$classroom->students;
            foreach($students as $student){

                student_subject::create([
                    "student_id"=>$student->id,
                    "subject_id"=>$subject->id
                ]);


            }
            toastr()->success(trans("messages.success"));
            return redirect()->route("show_subjects");


        }catch(\Exception $ex){

            toastr()->error($ex->getMessage());
            return redirect()->back();


        }





    }



    public function show_student($id){


        $student=$this->subject->GetStudent($id);
        return view("pages.subjects.show_students",["students"=>$student]);



    }




    public function edit($id){

        $techer=$this->techer->getAllTecher();
        $classroom=$this->classroom->getAllClassroom();
        $arr=Cache::get("subjects");
        $subject=$arr[$id];
        return view("pages.subjects.edit",["techers"=>$techer,"classrooms"=>$classroom,"subject"=>$subject]);

    }



    public function update(Request $request){

        try{



            $this->subject->update($request);
            toastr()->success(trans("messages.Update"));
            return redirect()->route("show_subjects");




        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);


        }




    }


    public function delete( Request $request){

        try{


            $this->subject->delete($request->id);
            toastr()->success(trans("messages.Delete"));
            return redirect()->route("show_subjects");




        }catch(\Exception $ex){

            toastr()->error($ex->getMessage());
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);


        }






    }


}
