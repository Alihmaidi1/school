<?php

namespace App\repo\classes;
use App\repo\interfaces\salary as salaryInterface;
use App\Models\salary as salaryModel;
use Illuminate\Support\Facades\Cache;

class salary implements salaryInterface{


    public function getAllSalary()
    {
        return Cache::get("salarys");
    }

    public function store($request)
    {


        $salary=new salaryModel();
        $salary->salary=$request->salary;
        $salary->Note=$request->note;
        $salary->save();
        $arr=Cache::get("salarys");
        $arr[$salary->id]=$salary;
        Cache::put("salarys",$arr);

    }

    public function delete($request)
    {

        $salary=salaryModel::find($request->id);
        $salary->delete();
        $arr=Cache::get("salarys");
        unset($arr[$request->id]);
        Cache::put("salarys",$arr);

    }



    public function update($request)
    {

        $salary=salaryModel::find($request->id);
        $salary->salary=$request->salary;
        $salary->Note=$request->note;
        $salary->save();
        $arr=Cache::get("salarys");
        $arr[$salary->id]=$salary;
        Cache::put("salarys",$arr);
    }

}
