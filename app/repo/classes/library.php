<?php

namespace App\repo\classes;

use App\repo\interfaces\library as libraryInterface;
use Illuminate\Support\Facades\Storage;
use App\Models\library  as modellibrary;
use Illuminate\Support\Facades\Cache;

class library implements libraryInterface{


    public function getAllLibrary()
    {

        return Cache::get("librarys");


    }

    public function store($request)
    {
        $file=$request->file("files");

        $extension=$file->getClientOriginalExtension();
        Storage::disk("library")->putFileAs("", $file, $request->name.".".$extension);
        $library=modellibrary::create([
                "Name_File"=>$request->name,
                "classroom_id"=>$request->classroom_id,
                "techer_id"=>$request->techer_id,
                "section_id"=>$request->section_id,
                "extension"=>$extension
            ]);
        $arr=Cache::get("librarys");
        $arr[$library->id]=$library;
        Cache::put("librarys", $arr);

        return $library;
    }



    public function update($request)
    {

        $library=modellibrary::find($request->id);
        if($request->file("files")){

            Storage::disk("library")->delete($library->NameFile.".".$library->extension);
            $name=$request->file("files");
            $extension=$name->getClientOriginalExtension();
            $library->extension=$extension;
            Storage::disk("library")->putFileAs("",$name,$request->name.".".$extension);
        }else{


            Storage::disk("library")->move($library->Name_File.".".$library->extension,$request->name.".".$library->extension);

        }

        $library->Name_File=$request->name;
        $library->classroom_id=$request->classroom_id;
        $library->techer_id=$request->techer_id;
        $library->section_id=$request->section_id;
        $library->save();
        $arr=Cache::get("librarys");
        $arr[$library->id]=$library;
        Cache::put("librarys",$arr);
        return $library;


    }


    public function delete($request)
    {

        $library=modellibrary::find($request->id);
        Storage::disk("library")->delete($library->Name_File.".".$library->extension);
        $library->delete();
        $arr=Cache::get("librarys");
        unset($arr[$request->id]);
        Cache::put("librarys",$arr);


    }

}
