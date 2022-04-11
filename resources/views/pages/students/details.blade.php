@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('student.student_details')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('student.student_details')}}
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
                                       aria-selected="true">{{trans('student.student_details')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                       role="tab" aria-controls="profile-02"
                                       aria-selected="false">{{trans('techer.Attachments')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-03-tab" data-toggle="tab" href="#profile-03"
                                       role="tab" aria-controls="profile-03"
                                       aria-selected="false">{{trans('techer.subject_that_learn')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-04-tab" data-toggle="tab" href="#profile-04"
                                       role="tab" aria-controls="profile-04"
                                       aria-selected="false">{{trans('student.fees')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-05-tab" data-toggle="tab" href="#profile-05"
                                       role="tab" aria-controls="profile-04"
                                       aria-selected="false">{{trans('student.sheck')}}</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                     aria-labelledby="home-02-tab">
                                    <table class="table table-striped table-hover" style="text-align:center">
                                        <tbody>
                                        <tr>
                                            <th scope="row">{{trans('student.email')}}</th>
                                            <td>{{ $student->email	 }}</td>
                                            <th scope="row">{{trans('student.gender')}}</th>
                                            <td>{{$student->gender}}</td>
                                            <th scope="row">{{trans('student.Name')}}</th>
                                            <td>{{ $student->Name }}</td>

                                            <th scope="row">{{trans('student.age')}}</th>
                                            <td>{{ $student->age }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{trans('student.classroom')}}</th>
                                            <td>{{ $student->section->classroom->Name }}</td>
                                            <th scope="row">{{trans('student.title')}}</th>
                                            <td>{{ $student->title }}</td>
                                            <th scope="row">{{trans('student.section')}}</th>
                                            <td>{{ $student->section->Name }}</td>

                                            <th scope="row">{{trans('student.parent')}}</th>
                                            <td>{{ $student->parent->father_name }}</td>

                                        </tr>
                                        <tr>

                                            <th scope="row">{{trans('student.grade')}}</th>
                                            <td>{{ $student->section->classroom->grade->Name }}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                            <td></td>
                                            <td></td>



                                        </tr>

                                        </tbody>
                                    </table>
                                </div>



                                <div class="tab-pane fade" id="profile-02" role="tabpanel"
                                     aria-labelledby="profile-02-tab">
                                    <div class="card card-statistics">
                                        <div class="card-body">
                                            <form method="post" action="{{ route("attachment_student_save") }}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label
                                                            for="academic_year">{{trans('parents.Attachments')}}
                                                            : <span class="text-danger">*</span></label>
                                                        <input type="file" accept="image/*" name="attchments[]" multiple required>
                                                        <input type="hidden" name="id" value="{{ $student->id }}">
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

                        @foreach($student->photos as  $attachment)

                        <tr style='text-align:center;vertical-align:middle'>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$attachment->url}}</td>
                            <td>{{$attachment->created_at->diffForHumans()}}</td>
                            <td colspan="2">
                                <a class="btn btn-outline-info btn-sm" href="{{ url("download_attachment/attachment/students/".$student->id."/".$attachment->url) }}" role="button"><i class="fas fa-download"></i>&nbsp; {{trans('parents.Download')}}</a>
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
                                                </thead>
                                                <tbody>
                                                    @foreach($student->subjects as $subject)
                                                    <tr>
                                                    <td>{{ $subject->id }}</td>
                                                    <td>{{ $subject->Name }}</td>
                                                    <td>{{ $subject->classroom->Name }}</td>
                                                    </tr>


                                                    @endforeach

                                                </tbody>
                                            </table>




                                        </div>
                                        <br>

                                    </div>
                                </div>



                                <div class="tab-pane fade" id="profile-04" role="tabpanel"
                                     aria-labelledby="profile-02-tab">
                                    <div class="card card-statistics">
                                        <div class="card-body">

                                            <a href="{{ route("add_fee_student",$student->id) }}" class="btn text-white" style="background: rgb(81, 183, 81)">{{ __("student.add_Fee") }}</a>

                                            <br/>
                                            <br/>

                                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                                                <thead>
                                                <th>#</th>
                                                <th>{{ __("student.fee_Name") }}</th>
                                                <th>{{ __("student.Amount") }}</th>
                                                <th>{{ __("student.year") }}</th>
                                                <th>{{ __("student.note") }}</th>
                                                <th>{{ __("student.process") }}</th>



                                                </thead>
                                                <tbody>
                                                    @foreach($student->fees as $fee)
                                                    <tr>
                                                    <td>{{ $fee->id }}</td>
                                                    <td>{{ $fee->fee->Name }}</td>
                                                    <td>{{ $fee->fee->amount }}</td>
                                                    <td>{{ $fee->fee->year }}</td>
                                                    <td>{{ $fee->Note }}</td>
                                                    <td>
                                                        <a href="{{ route("student_fee.edit",$fee->id) }}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                        <a href="{{ route("student_fee.delete",$fee->id) }}" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fa fa-trash"></i></a>


                                                    </td>
                                                    </tr>


                                                    @endforeach

                                                </tbody>
                                            </table>




                                        </div>
                                        <br>

                                    </div>
                                </div>




                                <div class="tab-pane fade" id="profile-05" role="tabpanel"
                                     aria-labelledby="profile-02-tab">
                                    <div class="card card-statistics">
                                        <div class="card-body">

                                            <a href="{{ route("add_shecks_student",$student->id) }}" class="btn text-white" style="background: rgb(81, 183, 81)">{{ __("sheck.add_sheck") }}</a>

                                            <br/>
                                            <br/>

                                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                                                <thead>
                                                <th>#</th>
                                                <th>{{ __("sheck.note") }}</th>
                                                <th>{{ __("sheck.Amount") }}</th>
                                                <th>{{ __("sheck.process") }}</th>
                                                </thead>
                                                <tbody>
                                                    @foreach($student->shecks as $sheck)
                                                    <tr>
                                                    <td>{{ $sheck->id }}</td>
                                                    <td>{{ $sheck->note }}</td>
                                                    <td>{{ $sheck->amount }}</td>
                                                    <td>
                                                        <a href="{{ route("student_sheck.edit",$sheck->id) }}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                        <a href="{{ route("student_sheck.delete",$sheck->id) }}" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fa fa-trash"></i></a>


                                                    </td>
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
