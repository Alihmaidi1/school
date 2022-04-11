<?php

namespace App\repo\classes;
use App\repo\interfaces\promotion as promotionInterface;
use App\Models\promotion as promotionModel;
use App\Models\student;
use App\Models\student_subject;
use App\Models\subject;
use Illuminate\Support\Facades\Cache;

class promotion implements promotionInterface{


    public function getAllpromotion()
    {

        return Cache::get("promotions");


    }

    public function store($student,$request)
    {

        $promotion=new promotionModel();
        $promotion->student_id=$student->id;
        $promotion->old_year=$request->academic_year;
        $promotion->new_year=$request->academic_year_new;
        $promotion->section_id_new=$request->section_id_new;
        $promotion->classroom_id_new=$request->Classroom_id_new;
        $promotion->grade_id_new=$request->Grade_id_new;
        $promotion->section_id_old=$request->section_id;
        $promotion->classroom_id_old=$request->Classroom_id;
        $promotion->grade_id_old=$request->Grade_id;
        $promotion->save();
        $arr=Cache::get("promotions");
        $arr[$promotion->id]=$promotion;
        Cache::put("promotions",$arr);

        $student->section_id=$request->section_id_new;
        $student->save();
        $arr=Cache::get("students");
        $arr[$student->id]=$student;
        Cache::put("students",$arr);

        $subjects=subject::where("classroom_id",$request->Classroom_id_new)->get();

        foreach($subjects as $subject){
        $student_subject=student_subject::create([
            "student_id"=>$student->id,
            "subject_id"=>$subject->id
        ]);
        $arr=Cache::get("student_subjects");
        $arr[$student_subject->id]=$student_subject;
        Cache::put("student_subjects",$arr);
        }


    }



    public function backStudent($id)
    {

        $arr=Cache::get("promotions");
            $promotion=$arr[$id];
            $student=student::find($promotion->student_id);
            $subjects=$student->subjects;

            foreach($subjects as $subject){

                if($subject->classroom_id==$promotion->classroom_id_new){

                    $arr1=Cache::get("student_subjects");
                    unset($arr1[$subject->id]);
                    Cache::put("student_subjects",$arr1);
                    $subject->delete();
                }

            }
            $student->section_id=$promotion->section_id_old;
            $student->save();
            $arr1=Cache::get("students");
            $arr1[$student->id]=$student;
            Cache::put("students",$arr1);
            $promotion=promotionModel::find($id);
            $promotion->delete();
            $arr1=Cache::get("promotions");
            unset($arr1[$id]);
            Cache::put("promotions",$arr1);






    }






}
