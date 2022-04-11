<?php

namespace App\repo\classes;
use App\repo\interfaces\sheck as sheckInterface;
use Illuminate\Support\Facades\Cache;
use App\Models\sheck as ModelsSheck;
use App\Models\student_fee;

class sheck implements sheckInterface{


public function getAllSheck()
{

    return Cache::get("shecks");


}

public function store($request)
{

    $sheck=ModelsSheck::create([
        "student_id"=>$request->student_id,
        "student_fees_id"=>$request->student_fees,
        "note"=>$request->note
    ]);
    $arr=Cache::get("shecks");
    $arr[$sheck->id]=$sheck;
    Cache::put("shecks",$arr);
    $student_fee=student_fee::find($request->student_fees);
    $student_fee->status="yes";
    $student_fee->save();
    $arr=Cache::get("student_fees");
    $arr[$student_fee->id]=$student_fee;
    Cache::put("student_fees",$arr);


}


public function update($request)
{


            $sheck=ModelsSheck::find($request->id);
            $student_fees1=student_fee::find($sheck->student_fees_id);
            $student_fees1->status="no";
            $student_fees1->save();
            $arr=Cache::get("student_fees");
            $arr[$student_fees1->id]=$student_fees1;
            Cache::put("student_fees",$arr);


            $sheck->note=$request->note;
            $sheck->student_fees_id=$request->student_fees;
            $sheck->save();
            $arr=Cache::get("shecks");
            $arr[$sheck->id]=$sheck;
            Cache::put("shecks",$arr);

            $student_fees2=student_fee::find($request->student_fees);
            $student_fees2->status="yes";
            $student_fees2->save();
            $arr=Cache::get("student_fees");
            $arr[$student_fees2->id]=$student_fees2;
            Cache::put("student_fees",$arr);
            return $sheck;



}



public function delete($id)
{


    $sheck=ModelsSheck::find($id);
    $student=$sheck->student;
    $sheck->delete();
    $arr=Cache::get("shecks");
    unset($arr[$id]);
    Cache::put("shecks",$arr);
    return $student;


}



}
