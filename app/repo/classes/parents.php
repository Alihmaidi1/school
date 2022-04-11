<?php

namespace App\repo\classes;
use App\repo\interfaces\parents as parentInterface1;
use App\Models\parents as parentModels;
use Illuminate\Support\Facades\Cache;
use App\Models\photos as photosModel;
use Illuminate\Support\Facades\Hash;

class parents implements parentInterface1{

public function getAllParent()
{

    return Cache::get("parents");
}

public function store($request)
{

    $parent=new parentModels();
    $parent->email=$request->email;
    $parent->password=Hash::make($request->password);
    $parent->father_name=$request->father_name;
    $parent->father_Number=$request->father_number;
    $parent->father_Title=$request->title_father;
    $parent->father_nationality=$request->father_nationality;
    $parent->father_job=$request->father_job;

    $parent->mother_name=$request->mother_name;
    $parent->mother_nationality=$request->mother_nationality;
    $parent->mother_job=$request->mother_job;
    $parent->mother_Number=$request->mother_number;
    $parent->mother_Title=$request->title_mother;
    $parent->save();
    $arr=Cache::get("parents");
    $arr[$parent->id]=$parent;
    Cache::put("parents",$arr);
    return $parent;
}



public function delete($id)
{


    $parent=parentModels::find($id);
    $parent->delete();
    $arr=Cache::get("parents");
    unset($arr[$id]);
    Cache::put("parents",$arr);


}





public function update($request)
{

            $parent=parentModels::find($request->id);

            $parent->email=$request->email;
            $parent->password=Hash::make($request->password);
            $parent->father_name=$request->father_name;
            $parent->father_Number=$request->father_number;
            $parent->father_Title=$request->title_father;
            $parent->father_nationality=$request->father_nationality;
            $parent->father_job=$request->father_job;

            $parent->mother_name=$request->mother_name;
            $parent->mother_nationality=$request->mother_nationality;
            $parent->mother_job=$request->mother_job;
            $parent->mother_Number=$request->mother_number;
            $parent->mother_Title=$request->title_mother;
            $parent->save();

            $arr=Cache::get("parents");
            $arr[$parent->id]=$parent;
            Cache::put("parents",$arr);


}


public function delete_image($id){

    $image=photosModel::find($id);
    $image->delete();


}




public function save_image($request,$father_name)
{

    foreach($request->photos as $photo){

        $photo->storeAs("parents/".$father_name,$photo->getClientOriginalName(),"parent_attachment");
        $image=new photosModel();
        $image->url=$photo->getClientOriginalName();
        $image->photoable_id=$request->parent_id;
        $image->photoable_type="App\Models\parents";
        $image->save();




    }




}

}
