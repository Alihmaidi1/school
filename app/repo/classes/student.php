<?php

namespace App\repo\classes;

use App\repo\interfaces\student as studentinter;
Use App\Models\student as studentModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class student implements studentinter{


public function getAllStudent()
{

    return Cache::get("students");


}

public function store($request)
{

    $student=new studentModel();
    $student->Name=["ar"=>$request->Name_ar,"en"=>$request->Name_en];
    $student->email=$request->Email;
    $student->password=Hash::make($request->Password);
    $student->gender=$request->Gender;
    $student->title=$request->Address;
    $student->age=$request->age;
    $student->section_id=$request->section_id;
    $student->parents_id=$request->parents_id;
    $student->save();
    $arr=Cache::get("students");
    $arr[$student->id]=$student;
    Cache::put("students",$arr);

    return $student;

}


public function update($request)
{

    $student=studentModel::find($request->id);
    $student->Name=["ar"=>$request->Name_ar,"en"=>$request->Name_en];
    $student->email=$request->Email;
    $student->password=Hash::make($request->Password);
    $student->grade_id=$request->grade_id;
    $student->gender=$request->Gender;
    $student->title=$request->Address;
    $student->age=$request->age;
    $student->classroom_id=$request->classroom_id;
    $student->section_id=$request->section_id;
    $student->parents_id=$request->parents_id;
    $student->save();
    $arr=Cache::get("students");
    $arr[$student->id]=$student;
    Cache::put("students",$arr);


}


public function delete($id)
{

    $student=studentModel::find($id);
    $student->delete();
    $arr=Cache::get("students");
    unset($arr[$id]);
    Cache::forget("students",$arr);

}


public function update_level($request,$id)
{

    $student1=studentModel::find($id);
    $student1->classroom_id=$request->Classroom_id_new;
    $student1->section_id=$request->section_id_new;
    $student1->grade_id=$request->Grade_id_new;
    $student1->save();
    Cache::put("student_".$student1->id,$student1);

    return $student1;
}

}
