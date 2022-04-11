<?php

namespace App\repo\classes;

use App\repo\interfaces\classroom as classroominterface;
use Illuminate\Filesystem\Cache;
use Illuminate\Support\Facades\Cache as FacadesCache;
use App\Models\classroom as classroomModels;
class classroom implements classroominterface{

    public function getAllClassroom()
    {

        return FacadesCache::get("classrooms");
    }


    public function store($request)
    {


        $classroom1=new classroomModels();
        $classroom1->grade_id=$request['grade_id'];
        $classroom1->Name=["ar"=>$request['name_ar'],"en"=>$request['name_en']];
        $classroom1->save();
        $arr=FacadesCache::get("classrooms");
        $arr[$classroom1->id]=$classroom1;
        FacadesCache::put("classrooms",$arr);

    }


    public function update($request)
    {

        $ClassRoom=classroomModels::find($request->id);
        $ClassRoom->grade_id=$request->stage;
        $ClassRoom->Name=["ar"=>$request->Name,"en"=>$request->Name_en];
        $ClassRoom->save();
        $arr=FacadesCache::get("classrooms");
        $arr[$ClassRoom->id]=$ClassRoom;
        FacadesCache::put("classrooms",$arr);


    }


    public function delete($request)
    {

        $ClassRoom=classroomModels::find($request->id);
        $ClassRoom->delete();
        $arr=FacadesCache::get("classrooms");
        unset($arr[$request->id]);
        $arr=FacadesCache::put("classrooms",$arr);



    }


    public function get_classes_by_grade($id){

        return classroomModels::where("grade_id",$id)->pluck("Name","id");

    }


    public function delete_group_class($array)
    {

        foreach($array as $value){

            $classroom=classroomModels::find($value);
            $classroom->delete();
            $arr=FacadesCache::get("classrooms");
            unset($arr[$value]);
            $arr=FacadesCache::put("classrooms",$arr);



        }



    }

}
