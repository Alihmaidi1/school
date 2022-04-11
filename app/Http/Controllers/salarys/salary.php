<?php

namespace App\Http\Controllers\salarys;

use App\Http\Controllers\Controller;
use App\Http\Requests\salarys\add_salary;
use Illuminate\Http\Request;
use App\Models\salary as salaryModel;
use App\repo\interfaces\salary as salary_interface;
use Illuminate\Support\Facades\Cache;

class salary extends Controller
{


    public $salary;
    public function __construct(salary_interface $salary)
    {

        $this->salary=$salary;
    }
    public function index(){

        $salary=$this->salary->getAllSalary();
        return view("pages.salarys.show",["salarys"=>$salary]);

    }


    public function create(){

        return view("pages.salarys.create");

    }


    public function store(add_salary $request){


        try{

            $this->salary->store($request);
            toastr()->success(trans("messages.success"));
            return redirect()->route("techer.salary_show");

        }catch(\Exception $ex){

            toastr()->error($ex->getMessage());
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);


        }

    }


    public function delete( Request $request){


        try{

            $this->salary->delete($request);
            toastr()->success(trans("messages.Delete"));
            return redirect()->back();


        }catch(\Exception $ex){

            toastr()->error($ex->getMessage());
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);


        }



    }



    public function edit($id){

        $arr=Cache::get("salarys");
        $salary=$arr[$id];

        return view("pages.salarys.edit",["salary"=>$salary]);


    }



    public function update(add_salary $request){


        try{

            $this->salary->update($request);
            toastr()->success(trans("messages.Update"));
            return redirect()->route("techer.salary_show");


        }catch(\Exception $ex){


            toastr()->error($ex->getMessage());
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);


        }


    }


}
