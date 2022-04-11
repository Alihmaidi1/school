<?php

namespace App\repo\classes;
use App\repo\interfaces\exam as examInterface;
use App\Models\exam as ModelsExam;
use Illuminate\Support\Facades\Cache;

class exam implements examInterface{


    public function getAllExam()
    {

        return Cache::get("exams");


    }
    public function store($request)
    {

        $exam=ModelsExam::create([

            "Name"=>$request->name,
            "techer_id"=>$request->techer_id,
            "section_id"=>$request->section_id,
            "subject_id"=>$request->subject_id,
            "mark"=>$request->mark
        ]);
        $arr=Cache::get("exams");
        $arr[$exam->id]=$exam;
        Cache::put("exams",$arr);
        return $exam;


    }

    public function update($request)
    {
        $exam=ModelsExam::find($request->id);
        $exam->Name=$request->name;
        $exam->techer_id=$request->techer_id;
        $exam->section_id=$request->section_id;
        $exam->subject_id=$request->subject_id;
        $exam->mark=$request->mark;
        $exam->save();
        $arr=Cache::get("exams");
        $arr[$exam->id]=$exam;
        Cache::put("exams",$arr);

        return $exam;

    }



    public function delete($id)
    {

        $exam=ModelsExam::find($id);
        $exam->delete();
        $arr=Cache::get("exams");
        unset($arr[$id]);
        Cache::put("exams",$arr);


    }


}
