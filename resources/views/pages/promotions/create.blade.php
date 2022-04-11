@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('promotion.Students_Promotions')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('promotion.Students_Promotions')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if (Session::has('error_promotions'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{Session::get('error_promotions')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                        <h6 style="color: red;font-family: Cairo">{{ __("promotion.the_old_stage") }}</h6><br>

                    <form method="post" action="{{ route("promotion.store") }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{trans('promotion.Grade')}}</label>
                                <select class="custom-select mr-sm-2" id="Grade_id_old" onchange="get_all_classrooms('old')"  name="Grade_id" required>
                                    <option selected disabled>{{trans('promotion.Choose')}}...</option>
                                    @if($Grades)
                                    @foreach($Grades as $Grade)
                                        <option value="{{$Grade->id}}">{{$Grade->Name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{trans('promotion.classrooms')}} : <span
                                        class="text-danger">*</span></label>
                                <select id="classroom_id_old" onchange="get_all_section('old')" class="custom-select mr-sm-2" name="Classroom_id" required>
                                    <option>..</option>

                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="section_id">{{trans('promotion.section')}} : </label>
                                <select class="custom-select mr-sm-2" id="section_id_old" name="section_id" required>

                                </select>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="academic_year">{{trans('promotion.academic_year')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="academic_year">
                                        <option selected disabled>{{trans('promotion.Choose')}}...</option>
                                        @php
                                            $current_year = date("Y");
                                        @endphp
                                        @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                            <option value="{{ $year}}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>



                        </div>
                        <br><h6 style="color: red;font-family: Cairo">{{ __("promotion.the_new_stage") }}</h6><br>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{trans('promotion.Grade')}}</label>
                                <select class="custom-select mr-sm-2" id="Grade_id_new" onchange="get_all_classrooms('new')" name="Grade_id_new" >
                                    <option selected disabled>{{trans('promotion.Choose')}}...</option>
                                    @foreach($Grades as $Grade)
                                        <option value="{{$Grade->id}}">{{$Grade->Name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{trans('promotion.classrooms')}}: <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" id="classroom_id_new" onchange="get_all_section('new')" name="Classroom_id_new" >

                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="section_id">:{{trans('promotion.section')}} </label>
                                <select class="custom-select mr-sm-2" id="section_id_new" name="section_id_new" >

                                </select>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="academic_year">{{trans('promotion.academic_year')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="academic_year_new">
                                        <option selected disabled>{{trans('promotion.Choose')}}...</option>
                                        @php
                                            $current_year = date("Y");
                                        @endphp
                                        @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                            <option value="{{ $year}}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>


                        </div>
                        <button type="submit" class="btn btn-primary">{{ __("promotion.submit") }}</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
@endsection
@section('js')

    @toastr_js
    @toastr_render

    <script>

  function  get_all_classrooms(type){

    let grade=document.getElementById("Grade_id_"+type).value;
    $.ajax({

        type:"get",
        url:"get_all_classroom/"+grade,
        success:function(data){

            let Classroom_id=document.getElementById("classroom_id_"+type);
            Classroom_id.innerHTML="<option>...</option>";
            for(key in data){
            Classroom_id.innerHTML+=`
            <option  value=${key}>${data[key]}</option>
            `;
            }

        },




    });


  }


  function get_all_section(type){



    let classroom=document.getElementById("classroom_id_"+type).value;
    $.ajax({

        type:"get",
        url:"get_all_section/"+classroom,
        success:function(data){

            let section_id=document.getElementById("section_id_"+type);
            section_id.innerHTML="";
            for(key in data){
                section_id.innerHTML+=`
            <option  value=${key}>${data[key]}</option>
            `;
            }

        },




    });







  }


    </script>

@endsection
