<?php

namespace App\repo\classes;

use App\repo\interfaces\queze as quezeInterface;
use App\Models\queze as ModelsQueze;
use Illuminate\Support\Facades\Cache;

class queze implements quezeInterface{


    public function store($request)
    {


        $queze=ModelsQueze::create([
            "title"=>$request->name,
            "exam_id"=>$request->exam_id,
            "first_answer"=>$request->first_answer,
            "second_answer"=>$request->second_answer,
            "third_answer"=>$request->third_answer,
            "correct_answer"=>$request->correct_answer,
            "mark"=>$request->mark
        ]);

        $arr=Cache::get("quezes");
        $arr[$queze->id]=$queze;
        Cache::put("quezes",$arr);
        return $queze;

    }


    public function getAllQueze()
    {

        return Cache::get("quezes");


    }


    public function delete($id)
    {


        $queze=ModelsQueze::find($id);
        $queze->delete();
        $arr=Cache::get("quezes");
        unset($arr[$id]);
        Cache::put("quezes",$arr);


    }


    public function update($request)
    {
        $queze=ModelsQueze::find($request->id);
        $queze->title=$request->name;
        $queze->exam_id=$request->exam_id;
        $queze->first_answer=$request->first_answer;
        $queze->second_answer=$request->second_answer;
        $queze->third_answer=$request->third_answer;
        $queze->correct_answer=$request->correct_answer;
        $queze->mark=$request->mark;
        $queze->save();
        $arr=Cache::get("quezes");
        $arr[$queze->id]=$queze;
        Cache::put("quezes",$arr);
        return $queze;

    }


}
