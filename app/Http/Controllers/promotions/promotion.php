<?php

namespace App\Http\Controllers\promotions;

use App\Http\Controllers\Controller;
use App\Models\promotion as ModelsPromotion;
use App\Models\setting;
use Illuminate\Http\Request;
use App\Models\student;
use App\repo\interfaces\promotion as promotionInterface;
use App\repo\interfaces\student as studentInterface;
use App\repo\interfaces\grade as gradeInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class promotion extends Controller
{


    public  $promotion;
    public  $student;
    public $grade;
    public function __construct(promotionInterface $promotion,studentInterface $student,gradeInterface $grade)
    {
        $this->student=$student;
        $this->promotion=$promotion;
        $this->grade=$grade;
    }

    public function index(){


        $promotions=$this->promotion->getAllpromotion();

        return view("pages.promotions.show",["promotions"=>$promotions]);

    }


    public function create(){

        $Grades=$this->grade->GetAllGrade();

        return view("pages.promotions.create",["Grades"=>$Grades]);

    }





    public function store(Request $request){

        DB::beginTransaction();
        try{


            $students=student::where("section_id",$request->section_id)->get();

            $low_subject=setting::all()[0]->lowest_subject;

            foreach($students as $student){

                if(count($student->subjects)<=$low_subject){

                    $this->promotion->store($student,$request);

                }

            }

            DB::commit();
            toastr()->success(trans("messages.success"));
            return redirect()->route("promotion.index");


        }catch(\Exception $ex){

            DB::rollBack();
            toastr()->error($ex->getMessage());
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);


        }

    }



    public function backStudent($id){

        DB::beginTransaction();
        try{


            $this->promotion->backStudent($id);


            DB::commit();
            toastr()->success(trans("messages.Update"));
            return redirect()->back();


        }catch(\Exception $ex){
            DB::rollBack();
            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);





        }







    }





}
