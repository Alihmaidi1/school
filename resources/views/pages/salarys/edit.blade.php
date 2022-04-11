@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('salary.edit_salary') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('salary.edit_salary') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">


                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{ route("salary.update") }}" method="post">
                             @csrf
                             <input type="hidden" value="{{ $salary->id }}" name="id"/>
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('salary.salary_much')}}</label>
                                    <input  name="salary" value="{{ $salary->salary }}" class="form-control">
                                    @error('salary')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('salary.note')}}</label>
                                    <input value="{{ $salary->Note }}"  name="note" class="form-control">
                                    @error('note')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>


                            
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('techer.submit')}}</button>
                    </form>
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
