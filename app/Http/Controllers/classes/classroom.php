<?php

namespace App\Http\Controllers\classes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Requests\classes\add_class;
use App\Models\classroom as ModelsClassroom;
use App\repo\interfaces\classroom as classroomInterface;
use App\repo\interfaces\grade as gradeInterface;
use Illuminate\Support\Facades\Cache;

class classroom extends Controller
{


    public $classroom_interface;
    public $grade_interface;
    public function __construct(classroomInterface $classroom_interface,gradeInterface $grade_interface)
    {
        $this->grade_interface=$grade_interface;
        $this->classroom_interface=$classroom_interface;
    }
    public function index(){

        $classrooms=$this->classroom_interface->getAllClassroom();
        $stages=$this->grade_interface->GetAllGrade();
        return view("pages.classrooms.classroom",["classrooms"=>$classrooms,"stages"=>$stages]);

    }


    public function store(add_class $request){
        try{


            foreach($request->List_Classes as $classroom){


                $this->classroom_interface->store($classroom);

            }
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        }catch(\Exception $ex){
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);
        }
    }

    public function update(add_class $request){
        try{

        $this->classroom_interface->update($request);
        toastr()->success(trans('messages.Update'));
        return redirect()->back();
        }catch(\Exception $ex){
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);
        }

    }


    public function destroy(Request $request){

        try{

            $this->classroom_interface->delete($request);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();

        }catch(\Exception $ex){
            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);
        }

    }

    public function get_classes_by_grade($id){

        try{

            $classes=$this->classroom_interface->get_classes_by_grade($id);
            return response()->json($classes);

        }catch(\Exception $ex){
            return response()->json(["error"=>$ex]);

        }

    }

    public function student_classroom($id){


        $students=ModelsClassroom::find($id)->students;
        $arr=cache::get("classrooms");
        $classroom=$arr[$id];
        return view("pages.classrooms.show_student",["students"=>$students,"classroom"=>$classroom]);

    }


    public function show_subject($id){


        $subject=ModelsClassroom::find($id);
        $subject=$subject->subjects;

        return view("pages.classrooms.show_subject",["subjects"=>$subject]);



    }



    public function delete_group_class(Request $request){

        try{

            $array=explode(",",$request->id_all);
            array_pop($array);
            $this->classroom_interface->delete_group_class($array);
            toastr()->error(trans("messages.Delete"));
            return redirect()->back();

        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);


        }




    }




}
