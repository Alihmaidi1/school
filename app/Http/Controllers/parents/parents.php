<?php

namespace App\Http\Controllers\parents;

use App\Http\Controllers\Controller;
use App\Models\parents as parentsModel;
use App\Http\Requests\parents\add_parent;
use App\repo\interfaces\parents as parentInterfaces;
use Illuminate\Support\Facades\Cache;
use App\traits\photo as phototrait;
use Illuminate\Http\Request ;

class parents extends Controller
{

    use phototrait;
    public $parent;
    public function __construct(parentInterfaces $parent)
    {
        $this->parent=$parent;

    }
    public function index(){

        $parents=$this->parent->getAllParent();
        return view("pages.parents.parent",compact("parents"));

    }

    public function add_parents(){

        return view("pages.parents.add_parent");

    }

    public function store(add_parent $request){

        try{


            $parent=$this->parent->store($request);
            if($request->attachments)
            $this->savePhoto($request,$parent->id,"App\Models\parents","parents/".$request->father_name);
            toastr()->success(trans("messages.success"));
            return redirect()->route("show_parents");

        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->route("show_parents")->withErrors(["error"=>$ex->getMessage()]);

        }


    }


    public function delete($id){

        try{

            $this->parent->delete($id);
            toastr()->error(trans("messages.Delete"));
            return redirect()->back();

        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex]);
        }

    }


    public function edit($id){
        try{
            $arr=Cache::get("parents");
            $parent=$arr[$id];

            return view("pages.parents.edit",compact("parent"));


        }catch(\Exception $ex){

            return redirect()->back()->withErrors(["error"=>trans("messages.error")]);

        }

    }


    public function update(add_parent $request){

        try{

            $this->parent->update($request);
            toastr()->success(trans("messages.success"));
            return redirect()->route("show_parents");

        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));

            return redirect()->back()->withErrors(["error"=>$ex]);

        }


    }


    public function show_info($id){

        try{
            $arr=Cache::get("parents");
            $parent=$arr[$id];
            $attachments=parentsModel::find($id)->photos;
            return view("pages.parents.show_info",["parent"=>$parent,"attachments"=>$attachments]);




        }catch(\Exception $ex){


            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);


        }



    }



    public function delete_image($id){

        try{

            $this->parent->delete_image($id);
            toastr()->success(trans("messages.Delete"));
            return redirect()->back();
        }catch(\Exception $ex){

            toastr()->error(trans("messages.error"));
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);


        }
    }


    public function download_image($attachment,$type,$id,$url){

        try{

            $path=public_path($attachment."/".$type."/".$id."/".$url);
            return response()->download($path);
        }catch(\Exception $ex){

            toastr()->error($ex->getMessage());
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);


        }

    }


    public function parent_save_images(Request $request){

        try{

            $this->parent->save_image($request,$request->father_name);
            toastr()->success(trans("messages.success"));
            return redirect()->back();

        }catch(\Exception $ex){

            toastr()->error($ex->getMessage());
            return redirect()->back()->withErrors(["error"=>$ex->getMessage()]);


        }


    }

}
