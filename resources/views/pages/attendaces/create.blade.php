@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('attendace.title_page') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('attendace.title_page')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <br><br>

                    <div class="table-responsive">
                        <form method="post" action="{{ route("attendace.store") }}">
                        @csrf
                         <h5>{{ trans("attendace.Attendaces Date") }} {{ now()->format("Y-m-d") }}</h5>
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('attendace.student_name')}}</th>
                                <th>{{trans('attendace.age')}}</th>
                                <th>{{trans('attendace.title')}}</th>
                                <th>{{trans('attendace.attendace')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($students as $student)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $student->Name }}</td>
                                    <td>{{ $student->age }}</td>
                                    <td>{{ $student->title }}</td>
                                    <td>
                                        <input  type="hidden" name="operation"
                                        @if(getAttendace($student->attendace)=="not found")

                                        value ="create"
                                        @else

                                        value="update"
                                        @endif

                                        />
                                        <input name="date" type="hidden" value="{{ now() }}"/>
                                        <input type="hidden" name="section_id" value="{{ $student->section_id }}"/>
                                        <label>{{ __("attendace.exist") }}</label>
                                        <input @if( getAttendace($student->attendace)=="on") checked @endif value="on" name="status[{{ $student->id }}]" required type="radio"/>
                                        <label>{{ __("attendace.not exist") }}</label>
                                        <input value="off" @if( getAttendace($student->attendace)=="off") checked @endif name="status[{{ $student->id }}]" required type="radio"/>

                                    </td>
                                </tr>


                            @endforeach

                        </table>
                        <button class="btn btn-primary ml-3 mb-3">{{ __("attendace.submit") }}</button>

                    </form>
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
