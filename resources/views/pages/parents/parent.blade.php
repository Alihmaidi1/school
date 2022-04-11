@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('parents.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('parents.title_page') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

@if ($errors->any())
    <div class="error">{{ $errors->first('Name') }}</div>
@endif


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

            <a href="{{ route("add_parents") }}" type="button" class="button text-white x-small" >
                {{ trans('parents.add_parents') }}
            </a>
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('parents.father Name') }}</th>
                            <th>{{ trans('parents.mother Name') }}</th>
                            <th>{{ trans('Grades_trans.Processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @if($parents)

                        @foreach ($parents as $parent)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $parent->father_name }}</td>
                                <td>{{ $parent->mother_name }}</td>

                                <td>
                                    <a href="{{ route("parent.edit",$parent->id) }}" class="btn btn-info text-white btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route("parent.delete",$parent->id) }}"  class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    <a href="{{ route("parent.show_info",$parent->id) }}"  class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></a>

                                </td>
                            </tr>



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
