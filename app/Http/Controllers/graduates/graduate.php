<?php

namespace App\Http\Controllers\graduates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\repo\interfaces\grade as gradeInterface;

class graduate extends Controller
{


    public $grade;

    public function __construct(gradeInterface $grade){

        $this->grade=$grade;

    }
    public function index(){

        return view("pages.graduates.show");


    }


    public function create(){

        $Grades=$this->grade->GetAllGrade();

        return view("pages.graduates.create",["Grades"=>$Grades]);

    }







}
