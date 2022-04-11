<?php

namespace App\traits;
use App\Models\photos as photoModels;
trait photo{


public function savePhoto($request,$id,$Model_type,$path){


    foreach($request->attchments as $photo){

        $name=$photo->getClientOriginalName();
        $photo->storeAs($path,$name,"parent_attachment");

        $image=new photoModels();
        $image->url=$name;
        $image->photoable_id=$id;
        $image->photoable_type=$Model_type;
        $image->save();
    }


}




}
