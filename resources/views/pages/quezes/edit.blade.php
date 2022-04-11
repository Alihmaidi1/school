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


            <form method="POST" action="{{ route("queze.update") }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $queze->id }}"/>
            <div class="container">

                <div class="row">

                    <div class="col">
                            <div>{{ __("queze.title_question") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                            <div><input name="name"  value="{{ $queze->title }}" class="form-control mt-1 mb-1"/></div>

                    </div>


                    <div class="col">
                        <div>{{ __("queze.exam") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                        <div>

                            <select name="exam_id" class="form-control p-0">

                                @foreach($exams as $exam)

                                <option @if($exam->id==$queze->exam_id) selected @endif value="{{ $exam->id }}">{{ $exam->Name }}</option>

                                @endforeach

                            </select>


                        </div>

                    </div>

                </div>

                <div class="row">
                    <div class="col-6">
                            <div>{{ __("queze.first_answer") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                            <div>

                                <input name="first_answer" value="{{ $queze->first_answer }}" class="form-control"/>

                            </div>
                    </div>

                    <div class="col-6">
                            <div>{{ __("queze.second_answer") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                            <div>

                                <input class="form-control" value="{{ $queze->second_answer }}" name="second_answer"/>
                            </div>

                    </div>
                </div>


                <div class="row">
                    <div class="col-6">
                            <div>{{ __("queze.third_answer") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                            <div>

                                <input name="third_answer" value="{{ $queze->third_answer }}" class="form-control"/>

                            </div>
                    </div>

                    <div class="col-6">
                            <div>{{ __("queze.correct_answer") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                            <div>

                                <input class="form-control" value="{{ $queze->correct_answer }}" name="correct_answer"/>
                            </div>

                    </div>
                </div>








                <div class="row">
                    <div class="col">
                            <div>{{ __("queze.mark") }} <span class="text-danger" style="font-size: 27px"> <sub>*</sub></span></div>
                            <div><input name="mark" value="{{ $queze->mark }}" class="form-control mt-1 mb-1"/></div>
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
