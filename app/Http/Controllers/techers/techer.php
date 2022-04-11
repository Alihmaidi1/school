<?php

namespace App\Http\Controllers\techers;

use App\Http\Controllers\Controller;
use App\Http\Requests\techers\add_techer;
use App\repo\interfaces\techer as techerinter;
use App\repo\interfaces\salary as salaryInterface;
use App\repo\interfaces\section as sectionInterface;
use App\traits\photo as phototrait;
use App\Models\techer as techerModel;
use App\Models\techer_section;
use Illuminate\Http\Request;

class techer extends Controller
{

    use phototrait;
    public $techer;
    public $salary;
    public $section;
    public function __construct(techerinter $techer,salaryInterface $salary,sectionInterface $section)
    {

        $this->techer=$techer;
        $this->salary=$salary;
        $this->section=$section;

    }

    public function index(){

        $teachers=$this->techer->getAllTecher();
        return view("pages.techers.techer",compact("teachers"));

    }

    public function create(){

        $salary=$this->salary->getAllSalary();

        return view("pages.techers.create",["salarys"=>$salary]);

    }
    public function store(add_techer $request){

        try{
            $teacher=$this->techer->store($request);
            if($request->attchments)
            $this->savePhoto($request,$teacher->id,"App\Models\\techer","teachers/".$teacher->id);
            toastr()->success(trans("messages.success"));
            return redirect()->route("techer.show");

        }catch(\Exception $ex){

            toastr()->error($ex->getMessage());
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);

        }

    }

    public function edit($id){

        try{


            $techer=$this->techer->findTecher($id);
            $salary=$this->salary->getAllSalary();

            return view("pages.techers.edit",["techer"=>$techer,"salarys"=>$salary]);

        }catch(\Exception $ex){

            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);

        }

    }

    public function update(add_techer $request){

        try{

            $techer=$this->techer->findTecher($request->id);
            $this->techer->update($techer,$request);
            toastr()->success(trans("messages.success"));
            return redirect()->route("techer.show");


        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);

        }

    }


    public function delete($id){

        try{

            $this->techer->delete($id);

            return redirect()->back();

        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);


        }


    }



    public function show_detail($id){

        try{

            $techer=$this->techer->findTecher($id);
            $sections=$this->section->getAllSection();

            return view("pages.techers.show_detail",["techer"=>$techer,"sections"=>$sections]);


        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);


        }


    }


    public function save_attachment(Request $request){


        try{

            $this->savePhoto($request,$request->id,"App\Models\\techer","teachers/".$request->id);
            toastr()->success(trans("messages.success"));
            return redirect()->back();

        }catch(\Exception $ex){

            toastr()->success(trans("messages.success"));
            return redirect()->back();

        }

    }


    public function store_subject(Request $request){

        try{

            $techer_id=$request->techer_id;

            $list=$request->List_Classes;
            $this->techer->store_subject($list,$techer_id);

            toastr()->success(trans("messages.success"));
            return redirect()->route("techer.show_details",$techer_id);

        }catch(\Exception $ex){

            toastr()->error($ex->getMessage());

            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);

        }

    }


    public function delete_section($id){

        try{

            $section=techer_section::find($id);
            $section->delete();
            toastr()->error(trans("messages.Delete"));
            return redirect()->back();

        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);




        }

    }



    public function update_section(Request $request){


        try{

            $techer_section=$this->techer->update_subject($request);
            toastr()->success(trans("messages.Update"));
            return redirect()->route("techer.show_details",$techer_section->techer_id);



        }catch(\Exception $ex){


            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);




        }



    }




}
