<?php

namespace App\repo\classes;
use App\repo\interfaces\techer as techerinterface;
use Illuminate\Support\Facades\Cache;
use App\Models\techer as techerModel;
use App\Models\techer_section;
use Illuminate\Support\Facades\Hash;

class techer implements techerinterface{


    public function store($request){

        $techer=new techerModel();
        $techer->Name=["ar"=>$request->Name_ar,"en"=>$request->Name_en];
        $techer->email=$request->Email;
        $techer->password=Hash::make($request->Password);
        $techer->number=$request->number;
        $techer->gender=$request->Gender;
        $techer->start_date=$request->Joining_Date;
        $techer->salary_id=$request->salary_id;
        $techer->title=$request->Address;
        $techer->spicefic=$request->specialization;
        $techer->save();
        $arr=Cache::get("techers");
        $arr[$techer->id]=$techer;
        Cache::put("techers",$arr);
        return $techer;


    }

    public function getAllTecher()
    {

        return Cache::get("techers");
    }

    public function findTecher($id)
    {

        $arr=Cache::get("techers");
        return $arr[$id];

    }

    public function update($techer,$request)
    {

        $techer->Name=["ar"=>$request->Name_ar,"en"=>$request->Name_en];
        $techer->email=$request->Email;
        $techer->password=Hash::make($request->Password);
        $techer->number=$request->number;
        $techer->gender=$request->Gender;
        $techer->start_date=$request->Joining_Date;
        $techer->salary_id=$request->salary_id;
        $techer->title=$request->Address;
        $techer->spicefic=$request->specialization;
        $techer->save();
        $arr=Cache::get("techers");
        $arr[$techer->id]=$techer;
        Cache::put("techers",$arr);
        return $techer;

    }


    public function delete($id)
    {

        $techer=techerModel::find($id);
        $techer->delete();
        $arr=Cache::get("techers");
        unset($arr[$id]);
        Cache::put("techers",$arr);
        toastr()->error(trans("messages.Delete"));

    }


    public function store_subject($list,$id)
    {


        foreach($list as $array){


            techer_section::create([
                "techer_id"=>$id,
                "section_id"=>$array['section_id']
            ]);

        }

    }


    public function update_subject($request)
    {

        $techer_section=techer_section::find($request->techer_section_id);
        $techer_section->section_id=$request->section_id;
        $techer_section->save();

        return $techer_section;




    }




}
