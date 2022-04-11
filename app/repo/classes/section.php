<?php

namespace App\repo\classes;

use App\repo\interfaces\section as section_interface;
use App\Models\section as sectionModels;
use Illuminate\Support\Facades\Cache;
class section implements section_interface{


    public function store($request)
    {

        $section= new sectionModels();
        $section->Name=["en"=>$request->Name_Section_En,"ar"=>$request->Name_Section_Ar];
        $section->classroom_id=$request->Class_id;
        $section->save();
        $arr=Cache::get("sections");
        $arr[$section->id]=$section;
        Cache::put("sections",$arr);


    }



    public function update($request)
    {

        $section=sectionModels::find($request->id);
        $section->Name=["en"=>$request->Name_Section_En,"ar"=>$request->Name_Section_Ar];
        $section->classroom_id=$request->Class_id;
        $section->save();
        $arr=Cache::get("section");
        $arr[$request->id]=$section;
        Cache::put("sections",$arr);

    }

    public function delete($request)
    {

        sectionModels::find($request->id)->delete();
        $arr=Cache::get("sections");
        unset($arr[$request->id]);
        Cache::put("sections",$arr);
    }

    public function get_section_by_classroom($id){

    return sectionModels::where("classroom_id",$id)->pluck("Name","id");

    }


    public function getAllSection()
    {
        return Cache::get("sections");
    }
}
