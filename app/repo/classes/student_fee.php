<?php

namespace App\repo\classes;

use App\Models\student_fee as ModelsStudent_fee;
use App\repo\interfaces\student_fee as student_feeInterface;
use Illuminate\Support\Facades\Cache;

class student_fee implements student_feeInterface{


    public function store($request)
    {

        $student_fee=ModelsStudent_fee::create([
            "student_id"=>$request->student_id,
            "fee_id"=>$request->fee_id,
            "Note"=>$request->note
        ]);
        $arr=Cache::get("student_fees");
        $arr[$student_fee->id]=$student_fee;
        Cache::put("student_fees",$arr);

    }


    public function update($request)
    {

        $fee=ModelsStudent_fee::find($request->id);
        $fee->fee_id=$request->fee_id;
        $fee->Note=$request->note;
        $fee->save();
        $arr=Cache::get("student_fees");
        $arr[$fee->id]=$fee;
        Cache::put("student_fees",$arr);
        return $fee;
    }


    public function delete($id){

        $student_fee=ModelsStudent_fee::find($id);
        $student_fee->delete();
        $arr=Cache::get("student_fees");
        unset($arr[$id]);
        Cache::put("student_fees",$arr);


    }

}
