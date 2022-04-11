@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.list_students')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.list_students')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <a href="{{ route("promotion.create") }}"  class="btn btn-success text-white" >
                                   {{ __("promotion.Promotion Classroom") }}
                                </a>



                                <br><br>


                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th class="alert-info">#</th>
                                            <th class="alert-info">{{trans('promotion.student_name')}}</th>
                                            <th class="alert-danger">{{ __("promotion.old_grade") }}</th>
                                            <th class="alert-danger">{{ __("promotion.in_year") }}</th>
                                            <th class="alert-danger">{{ __("promotion.classroom_old") }}</th>
                                            <th class="alert-danger">{{ __("promotion.section_old") }}</th>
                                            <th class="alert-success">{{ __("promotion.grade_new") }}</th>
                                            <th class="alert-success">{{ __("promotion.year_new") }}</th>
                                            <th class="alert-success">{{ __("promotion.classroom_new") }}</th>
                                            <th class="alert-success">{{ __("promotion.section_new") }}</th>
                                            <th>{{trans('promotion.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($promotions as $promotion)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$promotion->student->Name}}</td>
                                                <td>{{$promotion->grade_old->Name}}</td>
                                                <td>{{$promotion->old_year}}</td>
                                                <td>{{$promotion->classroom_old->Name}}</td>
                                                <td>{{$promotion->section_old->Name}}</td>
                                                <td>{{$promotion->grade_new->Name}}</td>
                                                <td>{{$promotion->new_year}}</td>
                                                <td>{{$promotion->classroom_new->Name}}</td>
                                                <td>{{$promotion->section_new->Name}}</td>
                                                <td>

                                                    <a  href="{{ route("promotion.backStudent",$promotion->id) }}" class="btn  btn-outline-danger" >{{ __("promotion.student_back") }}</a>
                                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#">{{ __("promotion.graduation_student") }}</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
