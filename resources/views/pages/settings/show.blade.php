@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __("setting.setting") }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ __("setting.setting") }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')


    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form enctype="multipart/form-data" method="post" action="{{ route("setting.store") }}">
                    @csrf @method('post')
                    <div class="row">
                        <div class="col-md-6 border-right-2 border-right-blue-400">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">{{ __("setting.school_name") }}<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input name="school_name" value="{{ $setting->school_name }}"  required type="text" class="form-control" placeholder="Name of School">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">{{ __("setting.phone") }}</label>
                                <div class="col-lg-9">
                                    <input name="phone" value="{{ $setting->number }}" type="text" class="form-control" placeholder="Phone">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">{{ __("setting.email") }}</label>
                                <div class="col-lg-9">
                                    <input name="school_email" value="{{ $setting->email }}" type="email" class="form-control" placeholder="School Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">{{ __("setting.title") }}<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input required name="address" value="{{ $setting->address }}" type="text" class="form-control" placeholder="School Address">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">{{ __("setting.lowest_subject") }}<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input required name="lowest_subject" value="{{ $setting->lowest_subject }}" type="text" class="form-control" placeholder="School Address">
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">{{ __("setting.logo") }}</label>
                                <div class="col-lg-9">
                                    <div class="mb-3">
                                    </div>
                                    <input name="logo" accept="image/*" type="file" class="file-input" data-show-caption="false" data-show-upload="false" data-fouc>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('setting.submit')}}</button>
                </form>
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
