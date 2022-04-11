@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('parents.add_parent_title') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('parents.add_parent_title') }}
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


            <form method="POST" action="{{ route("parent.update") }}">
                @csrf
                <input name="id" value="{{ $parent->id }}" type="hidden"/>
            <div class="container">

                <div class="row">
                    <div class="col-6">
                            <div>{{ __("parents.email") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                            <div><input value="{{ $parent->email }}" name="email" class="form-control mt-1 mb-1"/></div>
                    </div>

                    <div class="col-6">
                            <div>{{ __("parents.password") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                            <div><input value="{{ $parent->password }}" name="password" type="password" class="form-control mt-1 mb-1"/></div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                            <div>{{ __("parents.father_name") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                            <div><input value="{{ $parent->father_name }}" name="father_name" class="form-control mt-1 mb-1"/></div>
                    </div>

                    <div class="col-6">
                            <div>{{ __("parents.mother_name") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                            <div><input value="{{ $parent->mother_name }}" name="mother_name" class="form-control mt-1 mb-1"/></div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                            <div>{{ __("parents.title_father") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                            <div><input value="{{ $parent->father_Title }}" name="title_father" class="form-control mt-1 mb-1"/></div>
                    </div>

                    <div class="col-3">
                            <div>{{ __("parents.father_nationality") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                            <div><input value="{{ $parent->father_nationality }}" name="father_nationality" class="form-control mt-1 mb-1"/></div>

                    </div>

                    <div class="col-3">
                        <div>{{ __("parents.father_job") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                        <div><input value="{{ $parent->father_job }}" name="father_job" class="form-control mt-1 mb-1"/></div>

                    </div>


                    <div class="col-3">
                        <div>{{ __("parents.number_father") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                        <div><input value="{{ $parent->father_Number }}" name="father_number" class="form-control mt-1 mb-1"/></div>

                    </div>

                </div>


                <div class="row">

                    <div class="col-3">
                            <div>{{ __("parents.title_mother") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                            <div><input value="{{ $parent->mother_Title }}" name="title_mother" class="form-control mt-1 mb-1"/></div>
                    </div>

                    <div class="col-3">
                            <div>{{ __("parents.mother_nationality") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                            <div><input value="{{ $parent->mother_nationality }}" name="mother_nationality" class="form-control mt-1 mb-1"/></div>

                    </div>

                    <div class="col-3">
                        <div>{{ __("parents.mother_job") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                        <div><input name="mother_job" value="{{ $parent->mother_job }}" class="form-control mt-1 mb-1"/></div>

                    </div>
                

                    <div class="col-3">
                        <div>{{ __("parents.number_mother") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                        <div><input name="mother_number" value="{{ $parent->mother_Number }}" class="form-control mt-1 mb-1"/></div>

                    </div>
                

                </div>

                <div class=" d-flex justify-content-center m-3">


                    <button  type="submit" class="button m-2 text-white x-small" >
                        {{ trans('parents.submit') }}
                    </button>

                    <a href="{{ route("show_parents") }}" type="button" class="button m-2 border-danger bg-danger text-white x-small" >
                        {{ trans('parents.close') }}
                    </a>


                </div>





            </div>

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
