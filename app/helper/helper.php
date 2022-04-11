<?php
use Illuminate\Support\Carbon;

function getAttendace($arr){


    foreach($arr as $object){

        if(date("Y-m-d",$object->created_at->timestamp)==date('Y-m-d')){

            return $object->status;

        }


        return "not found";



    }




}
