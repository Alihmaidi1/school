@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('fee.list_fee') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('fee.list_fee') }}
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
                            <form action="{{ route("fee.update") }}" method="post">
                             @csrf
                             <input type="hidden" name="id" value="{{ $fee->id }}"/>
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('fee.Name_en')}}</label>
                                    <input  value="{{ $fee->getTranslation("Name","en") }}" name="name_en" class="form-control">
                                    @error('name_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('fee.name_ar')}}</label>
                                    <input name="name_ar" value="{{ $fee->getTranslation("Name","ar") }}" class="form-control">
                                    @error('name_ar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>


                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('fee.classroom')}}</label>


                                    <select name="classroom_id" class="form-control p-0">

                                        @foreach($classrooms as  $classroom)

                                        <option @if($classroom->id==$fee->classroom_id) selected @endif value="{{ $classroom->id }}">{{ $classroom->Name }}</option>

                                        @endforeach




                                    </select>

                                    @error('classroom_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label for="title">{{trans('fee.Note')}}</label>

                                    <input value="{{ $fee->note }}" class="form-control" name="note"/>


                                    @error('note')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('fee.amonut')}}</label>

                                    <input value="{{ $fee->amount }}" class="form-control" name="amount"/>

                                    @error('amount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label for="title">{{trans('fee.year')}}</label>

                                    <input value="{{ $fee->year }}" class="form-control" name="year"/>


                                    @error('year')
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
