<?php

namespace App\repo\classes;
use App\repo\interfaces\fee as feeInterface;

use App\Models\fees as feeModel;
use Illuminate\Support\Facades\Cache;

class fee implements feeInterface{


    public function getAllFee()
    {

        return Cache::get("fees");

    }

    public function store($request){

        $fee=new feeModel();
        $fee->Name=["ar"=>$request->name_ar,"en"=>$request->name_en];
        $fee->amount=$request->amount;
        $fee->classroom_id=$request->classroom_id;
        $fee->year=$request->year;
        $fee->note=$request->note;
        $fee->save();
        $arr=Cache::get("fees");
        $arr[$fee->id]=$fee;
        Cache::put("fees",$arr);
        return $fee;
    }


    public function update($request)
    {


        $fee=feeModel::find($request->id);
        $fee->Name=["ar"=>$request->name_en,"en"=>$request->name_ar];
        $fee->classroom_id=$request->classroom_id;
        $fee->note=$request->note;
        $fee->amount=$request->amount;
        $fee->year=$request->year;
        $fee->save();
        $arr=Cache::get("fees");
        $arr[$fee->id]=$fee;
        Cache::put("fees",$arr);

        return $fee;
    }


    public function delete($id)
    {


        $fee=feeModel::find($id);
        $fee->delete();
        $arr=Cache::get("fees");
        unset($arr[$fee->id]);
        Cache::put("fees",$arr);

    }

}
