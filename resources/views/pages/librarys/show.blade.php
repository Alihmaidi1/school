@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('library.title_page') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('library.title_page')}}
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

                    <a  href="{{ route("library.create") }}" class="button text-white x-small" >
                        {{ trans('library.add_library') }}
                    </a>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('library.file_name')}}</th>
                                <th>{{trans('library.techer_Name')}}</th>
                                <th>{{trans('library.classroom')}}</th>
                                <th>{{trans('library.section')}}</th>
                                <th>{{trans('library.Processes')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @if($librarys)
                            @foreach ($librarys as $library)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $library->Name_File }}</td>
                                    <td>{{ $library->techer->Name }}</td>
                                    <td>{{ $library->classroom->Name }}</td>
                                    <td>{{ $library->section->Name }}</td>

                                    <td>
                                        <a  href="{{ route("download_file",$library->id) }}" class="btn text-white btn-warning btn-sm"
                                        title="{{ trans('Grades_trans.details') }}"><i
                                        class="fa fa-download"></i></a>
                                        <a href="{{ route("library.edit",$library->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $library->id }}"
                                                title="{{ trans('Grades_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>


                                            </td>
                                </tr>

                                <!-- delete_modal_Grade -->
                                <div class="modal fade" id="delete{{ $library->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('library.delete_file') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('library.destroy')}}" method="post">
                                                    {{method_field('post')}}
                                                    @csrf
                                                    {{ trans('Grades_trans.Warning_Grade') }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $library->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">{{ trans('Grades_trans.submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            @endforeach

                                @endif
                        </table>
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
