@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('exam.title_page') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('exam.title_page')}}
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

                    <a href="{{ route("exam.create") }}" class="button text-white x-small" >
                        {{ trans('exam.add_exam') }}
                    </a>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('exam.name')}}</th>
                                <th>{{trans('exam.techer')}}</th>
                                <th>{{trans('exam.section')}}</th>
                                <th>{{trans('exam.subject')}}</th>
                                <th>{{trans('exam.mark')}}</th>

                                <th>{{trans('exam.Processes')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @if($exams)
                            @foreach ($exams as $exam)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $exam->Name }}</td>
                                    <td>{{ $exam->techer->Name }}</td>
                                    <td>{{ $exam->section->Name }}</td>
                                    <td>{{ $exam->subject->Name }}</td>
                                    <td>{{ $exam->mark }}</td>
                                    <td>
                                        <a  href="{{ route("exam.edit",$exam->id) }}" class="btn btn-info text-white btn-sm" ><i
                                                class="fa fa-edit"></i></a>
                                        <a  href="{{ route("exam.delete",$exam->id) }}" class="btn btn-danger text-white btn-sm"><i
                                                class="fa fa-trash"></i></a>


                                            </td>
                                </tr>


                            @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- add_modal_Grade -->

    </div>

    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
