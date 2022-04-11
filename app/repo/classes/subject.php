<?php

namespace app\repo\classes;
use App\repo\interfaces\subject as subjectInterface;
use App\Models\subject as subjectModel;
use Illuminate\Support\Facades\Cache;

class subject implements subjectInterface{



    public function getAllsubject(){

        return Cache::get("subjects");

    }

    public function store($request)
    {

        $subject=new subjectModel();
        $subject->Name=["ar"=>$request->name_ar,"en"=>$request->name_en];
        $subject->classroom_id=$request->classroom_id;
        $subject->teacher_id=$request->techer_id;
        $subject->save();
        $arr=Cache::get("subjects");
        $arr[$subject->id]=$subject;
        Cache::put("subjects",$arr);
        return $subject;

    }



    public function GetStudent($id){



        $subject=subjectModel::find($id);
        return $subject->classroom->students;


    }


    public function update($request)
    {

        $subject=subjectModel::find($request->id);
        $subject->Name=["ar"=>$request->name_ar,"en"=>$request->name_en];
        $subject->teacher_id=$request->techer_id;
        $subject->classroom_id=$request->classroom_id;
        $subject->save();
        $arr=Cache::get("subjects");
        $arr[$subject->id]=$subject;
        Cache::put("subjects",$arr);
        return $subject;


    }

    public function delete($id)
    {

        $subject=subjectModel::find($id);
        $arr=Cache::get("students");
        unset($arr[$id]);
        Cache::put("subjects",$arr);
        $subject->delete();


    }

}
