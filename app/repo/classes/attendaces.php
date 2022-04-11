<?php

namespace App\repo\classes;
use App\repo\interfaces\attendaces as attendacesInterface;


use App\Models\attendace as ModelsAttendace;

class attendaces implements attendacesInterface{


    public function store($request)
    {


        $statuss=$request->status;
            foreach($statuss as $key=> $status){
                ModelsAttendace::create([
                    "student_id"=>$key,
                    "status"=>$status,
                    "section_id"=>$request->section_id
                ]);

            }


    }


    public function update($request)
    {

        $attendaces=ModelsAttendace::where("created_at","like", "%".date('Y-m-d')."%")->get();
        foreach($attendaces as $object){

            $object->status=$request->status[$object->student_id];
            $object->save();

        }


    }


}
