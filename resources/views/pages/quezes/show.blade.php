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

                    <a href="{{ route("queze.create") }}" class="button text-white x-small" >
                        {{ trans('queze.add_queze') }}
                    </a>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('queze.title_question')}}</th>
                                <th>{{trans('queze.exam')}}</th>
                                <th>{{trans('queze.first_answer')}}</th>
                                <th>{{trans('queze.second_answer')}}</th>
                                <th>{{trans('queze.third_answer')}}</th>
                                <th>{{trans('queze.correct_answer')}}</th>
                                <th>{{trans('queze.mark')}}</th>

                                <th>{{trans('queze.Processes')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @if($quezes)
                            @foreach ($quezes as $queze)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $queze->title }}</td>
                                    <td>{{ $queze->exam->Name }}</td>
                                    <td>{{ $queze->first_answer }}</td>
                                    <td>{{ $queze->second_answer }}</td>
                                    <td>{{ $queze->third_answer }}</td>
                                    <td>{{ $queze->correct_answer }}</td>
                                    <td>{{ $queze->mark }}</td>
                                    <td>
                                        <a  href="{{ route("queze.edit",$queze->id) }}" class="btn btn-info text-white btn-sm" ><i
                                                class="fa fa-edit"></i></a>
                                        <a  href="{{ route("queze.delete",$queze->id) }}" class="btn btn-danger text-white btn-sm"><i
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
