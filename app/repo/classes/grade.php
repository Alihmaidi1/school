<?php

namespace App\repo\classes;
use App\repo\interfaces\grade as grade_interface;
use App\Models\Grade as gradeModels;
use Illuminate\Filesystem\Cache;
use Illuminate\Support\Facades\Cache as FacadesCache;
use Psr\SimpleCache\CacheException;
class grade implements  grade_interface{

public function GetAllGrade()
{


    return FacadesCache::get("grades");
}

public function store($request)
{

          $Grade = new gradeModels();
          $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
          $Grade->Notes = $request->Notes;
          $Grade->save();
          $arr=FacadesCache::get("grades");
          $arr[$Grade->id]=$Grade;
          FacadesCache::put("grades",$arr);
          return $Grade;

}

public function delete($request)
{


    gradeModels::find($request->id)->delete();
    $arr=FacadesCache::get("grades");
    unset($arr[$request->id]);
    FacadesCache::put("grades",$arr);

}



public function update($request)
{

    $Grades = gradeModels::find($request->id);
            $Grades->update([
              $Grades->Name = ['ar' => $request->Name, 'en' => $request->Name_en],
              $Grades->Notes = $request->Notes,
            ]);
            $arr=FacadesCache::get("grades");
            $arr[$request->id]=$Grades;
            FacadesCache::put("grades",$arr);




}

}
