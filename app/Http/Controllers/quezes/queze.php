<?php

namespace App\Http\Controllers\quezes;

use App\Http\Controllers\Controller;
use App\Models\exam;
use App\Models\queze as ModelsQueze;
use Illuminate\Http\Request;
use App\repo\interfaces\queze as quezeInterface;
use App\repo\interfaces\exam as examInterface;
use Illuminate\Support\Facades\Cache;

class queze extends Controller
{

    public $queze;
    public $exam;
    public function __construct(quezeInterface $queze,examInterface $exam)
    {
        $this->queze=$queze;
        $this->exam=$exam;



    }

    public function index(){

        $quezes=$this->queze->getAllQueze();
        return view("pages.quezes.show",["quezes"=>$quezes]);

    }


    public function create(){

        $exams=$this->exam->getAllExam();

        return view("pages.quezes.create",["exams"=>$exams]);

    }


    public function store(Request $request){

        try{


            $this->queze->store($request);
            toastr()->success(trans("messages.success"));
            return redirect()->route("show_queze");


        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);

        }



    }


    public function delete($id){

        try{

            $this->queze->delete($id);
            toastr()->error(trans("messages.Delete"));
            return redirect()->back();

        }catch(\Exception $ex){


            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);


        }



    }


    public function edit($id){

        $arr=Cache::get("quezes");
        $queze=$arr[$id];
        $exams=$this->exam->getAllExam();
        return view("pages.quezes.edit",["queze"=>$queze,"exams"=>$exams]);



    }


    public function update(Request $request){


        try{

            $this->queze->update($request);
            toastr()->success(trans("messages.Update"));
            return redirect()->route("show_queze");

        }catch(\Exception $ex){


            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);




        }




    }



}
