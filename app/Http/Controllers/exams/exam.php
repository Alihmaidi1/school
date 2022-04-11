<?php

namespace App\Http\Controllers\exams;

use App\Http\Controllers\Controller;
use App\Models\exam as ModelsExam;
use App\Models\section;
use App\Models\subject;
use App\Models\techer;
use Illuminate\Http\Request;
use App\repo\interfaces\exam as examInterface;
use App\repo\interfaces\techer as techerInterface;
use App\repo\interfaces\section as sectionInterface;
use App\repo\interfaces\subject as subjectInterface;
use Illuminate\Support\Facades\Cache;

class exam extends Controller
{

    public $exam;
    public $techer;
    public $section;
    public $subject;
    public function __construct(examInterface $exam,techerInterface $techer,sectionInterface $section,subjectInterface $subject)
    {

        $this->exam=$exam;
        $this->techer=$techer;
        $this->section=$section;
        $this->subject=$subject;

    }

    public function index(){

        $exams=$this->exam->getAllExam();

        return view("pages.exams.show",["exams"=>$exams]);

    }

    public function create(){


        $techers=$this->techer->getAllTecher();
        $sections=$this->section->getAllSection();
        $subjects=$this->subject->getAllsubject();
        return view("pages.exams.create",["techers"=>$techers,"sections"=>$sections,"subjects"=>$subjects]);

    }


    public function store(Request $request){

        try{


            $this->exam->store($request);

            toastr()->success(trans("messages.success"));
            return redirect()->route("show_exam");


        }catch(\Exception $ex){


            toastr()->error(trans("messages.error"));

            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);

        }

    }



    public function delete($id){

        try{

            $this->exam->delete($id);
            toastr()->error(trans("messages.Delete"));
            return redirect()->back();


        }catch(\Exception $ex){


            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);

        }

    }



    public function edit($id){


        $arr=Cache::get("exams");
        $exam=$arr[$id];
        $techers=$this->techer->getAllTecher();
        $sections=$this->section->getAllSection();
        $subjects=$this->subject->getAllsubject();
        return view("pages.exams.edit",["exam"=>$exam,"techers"=>$techers,"sections"=>$sections,"subjects"=>$subjects]);


    }


    public function update(Request $request){

        try{

            $this->exam->update($request);

            toastr()->success(trans("messages.Update"));
            return redirect()->route("show_exam");


        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);


        }



    }




}
