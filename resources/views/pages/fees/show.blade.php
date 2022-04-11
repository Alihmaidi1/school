@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('fee.title_page') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('fee.title_page')}}
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

                    <a href="{{ route("fee.create") }}" class="button x-small" >
                        {{ trans('fee.add_fee') }}
                    </a>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('fee.Name')}}</th>
                                <th>{{trans('fee.classroom')}}</th>
                                <th>{{trans('fee.Notes')}}</th>
                                <th>{{trans('fee.amount')}}</th>
                                <th>{{trans('fee.year')}}</th>
                                <th>{{trans('fee.Processes')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @if($fees)
                            @foreach ($fees as $fee)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $fee->Name }}</td>
                                    <td>{{ $fee->classroom }}</td>
                                    <td>{{ $fee->note }}</td>
                                    <td>{{ $fee->amount }}</td>
                                    <td>{{ $fee->year }}</td>
                                    <td>
                                        <a href="{{ route("fee.edit",$fee->id) }}"  class="btn btn-info btn-sm"><i
                                                class="fa text-dark fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $fee->id }}"
                                                title="{{ trans('Grades_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>


                                            </td>
                                </tr>


                                <!-- delete_modal_Grade -->
                                <div class="modal fade" id="delete{{ $fee->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('fee.delete_fee') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('fee.delete')}}" method="post">
                                                    {{method_field('post')}}
                                                    @csrf
                                                    {{ trans('Grades_trans.Warning_Grade') }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $fee->id }}">
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


        <!-- add_modal_Grade -->

    </div>

    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
