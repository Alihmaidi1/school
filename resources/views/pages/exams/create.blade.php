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


            <form method="POST" action="{{ route("exam.store") }}" enctype="multipart/form-data">
                @csrf
            <div class="container">

                <div class="row">

                    <div class="col">
                            <div>{{ __("exam.name") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                            <div><input name="name"  class="form-control mt-1 mb-1"/></div>

                    </div>


                    <div class="col">
                        <div>{{ __("exam.techer") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                        <div>

                            <select name="techer_id" class="form-control p-0">
                                @if($techers)
                                @foreach($techers as  $techer)

                                <option value="{{ $techer->id }}">{{ $techer->Name }}</option>

                                @endforeach
                                @endif

                            </select>


                        </div>

                    </div>

                </div>

                <div class="row">
                    <div class="col-6">
                            <div>{{ __("exam.section") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                            <div>

                                <select class="form-control p-0" name="section_id">
                                    @if($sections)
                                    @foreach($sections as  $section)

                                    <option value="{{ $section->id }}">{{ $section->Name }}</option>

                                    @endforeach
                                    @endif


                                </select>


                            </div>
                    </div>

                    <div class="col-6">
                            <div>{{ __("exam.subject") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                            <div>

                                <select name="subject_id" class="form-control p-0">

                                    @if($subjects)
                                    @foreach($subjects as $subject)

                                    <option value="{{ $subject->id }}">{{ $subject->Name }}</option>

                                    @endforeach
                                    @endif
                                </select>


                            </div>

                    </div>
                </div>


                <div class="row">
                    <div class="col">
                            <div>{{ __("exam.mark") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                            <div><input name="mark" class="form-control mt-1 mb-1"/></div>
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
