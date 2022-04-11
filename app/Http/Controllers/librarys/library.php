<?php

namespace App\Http\Controllers\librarys;

use App\Http\Controllers\Controller;
use App\Models\classroom;
use App\Models\library as ModelsLibrary;
use App\Models\section;
use App\Models\techer;
use Illuminate\Http\Request;
use App\Models\library as modellibrary;
use Illuminate\Support\Facades\Storage;
use App\repo\interfaces\techer as techerInterface;
use App\repo\interfaces\library as libraryInterface;
use App\repo\interfaces\section as sectionInterface;
use App\repo\interfaces\classroom as classroomInterface;
use Illuminate\Support\Facades\Cache;

class library extends Controller
{

    public $library;
    public $techer;
    public $classroom;
    public $section;
    public function __construct(libraryInterface $library,techerInterface $techer,classroomInterface $classroom,sectionInterface $section)
    {

        $this->library=$library;
        $this->techer=$techer;
        $this->classroom=$classroom;
        $this->section=$section;

    }

    public function index(){

        $librarys=$this->library->getAllLibrary();

        return view("pages.librarys.show",["librarys"=>$librarys]);

    }

    public function create(){

        $techers=$this->techer->getAllTecher();
        $classrooms=$this->classroom->getAllClassroom();
        $sections=$this->section->getAllSection();
        return view("pages.librarys.create",["techers"=>$techers,"classrooms"=>$classrooms,"sections"=>$sections]);


    }



    public function store(Request $request){

        try{

            $this->library->store($request);
            toastr()->success(trans("messages.success"));
            return redirect()->route("show_library");

        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);
        }

    }


    public function delete(Request $request){


        try{

            $this->library->delete($request);
            toastr()->error(trans("messages.Delete"));
            return redirect()->back();

        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);

        }

    }
    public function download_file($id){

        $arr=Cache::get("librarys");
        $library=$arr[$id];
        $name=$library->Name_File.".".$library->extension;
        $path=public_path("library/".$name);
        return response()->download($path);

    }


    public function edit($id){


        $techers=techer::all();
        $classrooms=classroom::all();
        $sections=section::all();
        $arr=Cache::get("librarys");
        $library=$arr[$id];
        return view("pages.librarys.edit",["techers"=>$techers,"classrooms"=>$classrooms,"sections"=>$sections,"library"=>$library]);
    }


    public function update(Request $request){

        try{

            $this->library->update($request);

            toastr()->success(trans("messages.Update"));
            return redirect()->route("show_library");


        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);

        }



    }


}
