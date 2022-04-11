@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('parents.parent_details')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('parents.parent_details')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="card-body">
                        <div class="tab nav-border">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                       role="tab" aria-controls="home-02"
                                       aria-selected="true">{{trans('parents.parent_details')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                       role="tab" aria-controls="profile-02"
                                       aria-selected="false">{{trans('parents.Attachments')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-03-tab" data-toggle="tab" href="#profile-03"
                                       role="tab" aria-controls="profile-03"
                                       aria-selected="false">{{trans('parents.children')}}</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                     aria-labelledby="home-02-tab">
                                    <table class="table table-striped table-hover" style="text-align:center">
                                        <tbody>
                                        <tr>
                                            <th scope="row">{{trans('parents.email')}}</th>
                                            <td>{{ $parent->email	 }}</td>
                                            <th scope="row">{{trans('parents.father_name')}}</th>
                                            <td>{{$parent->father_name}}</td>
                                            <th scope="row">{{trans('parents.mother_name')}}</th>
                                            <td>{{ $parent->mother_name }}</td>
                                            <th scope="row">{{trans('parents.father_nationality')}}</th>
                                            <td>{{ $parent->father_nationality }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{trans('parents.mother_nationality')}}</th>
                                            <td>{{ $parent->mother_nationality }}</td>
                                            <th scope="row">{{trans('parents.number_father')}}</th>
                                            <td>{{ $parent->father_Number }}</td>
                                            <th scope="row">{{trans('parents.number_mother')}}</th>
                                            <td>{{ $parent->mother_Number }}</td>
                                            <th scope="row">{{trans('parents.title_father')}}</th>
                                            <td>{{ $parent->father_Title }}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{trans('parents.title_mother')}}</th>
                                            <td>{{ $parent->mother_Title }}</td>
                                            <th scope="row">{{trans('parents.father_job')}}</th>
                                            <td>{{ $parent->father_job }}</td>
                                            <th scope="row">{{ trans("parents.mother_job") }}</th>
                                            <td>{{ $parent->mother_job }}</td>
                                            <th scope="row"></th>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>



                                <div class="tab-pane fade" id="profile-02" role="tabpanel"
                                     aria-labelledby="profile-02-tab">
                                    <div class="card card-statistics">
                                        <div class="card-body">
                                            <form method="post" action="{{ route("attachment_parent_save") }}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label
                                                            for="academic_year">{{trans('parents.Attachments')}}
                                                            : <span class="text-danger">*</span></label>
                                                        <input type="file" accept="image/*" name="photos[]" multiple required>
                                                        <input type="hidden" name="father_name" value="{{ $parent->father_name }}">
                                                        <input type="hidden" name="parent_id" value="{{ $parent->id }}">
                                                    </div>
                                                </div>
                                                <br><br>
                                                <button type="submit" class="button button-border x-small">
                                                       {{trans('parents.submit')}}
                                                </button>
                                            </form>
                                        </div>
                                        <br>

                                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('parents.FileName') }}</th>
                            <th>{{ trans('parents.Created_at') }}</th>
                            <th>{{ trans('Grades_trans.Processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($attachments as  $attachment)

                                                <tr style='text-align:center;vertical-align:middle'>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$attachment->url}}</td>
                                                    <td>{{$attachment->created_at->diffForHumans()}}</td>
                                                    <td colspan="2">
                                                        <a class="btn btn-outline-info btn-sm" href="{{ url("download_attachment/attachment/parents/".$parent->father_name."/".$attachment->url) }}" role="button"><i class="fas fa-download"></i>&nbsp; {{trans('parents.Download')}}</a>

                                                        <a href="{{ route("parent_attachment",$attachment->id) }}" type="button" class="btn btn-outline-danger btn-sm"title="{{ trans('Grades_trans.Delete') }}">{{trans('parents.delete')}}</a>

                                                    </td>
                                                </tr>



                        @endforeach



                    </tbody>
                       </table>


                                    </div>
                                </div>


                                <div class="tab-pane fade" id="profile-03" role="tabpanel"
                                     aria-labelledby="profile-02-tab">
                                    <div class="card card-statistics">
                                        <div class="card-body">


                                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                                                <thead>
                                                <th>#</th>
                                                <th>{{ __("parents.student_name") }}</th>
                                                <th>{{ __("parents.student_classroom") }}</th>
                                                <th>{{ __("parents.gender") }}</th>
                                                <th>{{ __("parents.show_student") }}</th>

                                                </thead>
                                                <tbody>
                                                    @foreach($parent->students as  $student)

                                                    <tr>
                                                            <td>{{ $student->id }}</td>
                                                            <td>{{ $student->Name }}</td>
                                                            <td>{{ $student->section->classroom->Name }}</td>
                                                            <td>{{ $student->gender }}</td>
                                                            <td><a href="{{ route("parent.show_info",$parent->id) }}"  class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></a></td>

                                                        </tr>

                                                    @endforeach
                                                </tbody>
                                            </table>




                                        </div>
                                        <br>

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
