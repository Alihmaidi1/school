@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('student.add_student') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('student.add_student') }}
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
                            <form action="{{ route("student.update") }}" method="post">
                             @csrf
                             <input type="hidden" name="id" value="{{ $student->id }}"/>
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('student.Email')}}</label>
                                    <input type="email" value="{{ $student->email }}" name="Email" class="form-control">
                                    @error('Email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('student.Password')}}</label>
                                    <input type="password" value="{{ $student->password }}" name="Password" class="form-control">
                                    @error('Password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>


                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('student.Name_ar')}}</label>
                                    <input type="text" value="{{ $student->getTranslation("Name","ar") }}" name="Name_ar" class="form-control">
                                    @error('Name_ar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('student.Name_en')}}</label>
                                    <input type="text" value="{{ $student->getTranslation("Name","en") }}" name="Name_en" class="form-control">
                                    @error('Name_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('student.age')}}</label>
                                    <input type="text" name="age" value="{{ $student->age }}" class="form-control">
                                    @error('age')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('student.classroom')}}</label>
                                    <select class="form-control p-0" name="classroom_id">

                                        @foreach($classrooms as $classroom)
                                        <option  @if($classroom->id==$student->classroom_id) selected @endif value="{{ $classroom->id }}">{{ $classroom->Name }}</option>
                                        @endforeach

                                    </select>

                                    @error('classroom_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="inputCity">{{trans('student.parents')}}</label>
                                    <select name="parents_id" class="form-control p-0">
                                    @foreach($parents as $parent)

                                    <option @if($parent->id==$student->parents_id) @endif value="{{ $parent->id }}">{{ $parent->father_name }}</option>

                                    @endforeach
                                    </select>
                                    @error('parents_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="inputState">{{trans('student.Gender')}}</label>
                                    <input type="text" value="{{ $student->gender }}" name="Gender" class="form-control">
                                    @error('Gender')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('student.section')}}</label>
                                    <div class='input-group date'>

                                        <select class="form-control p-0" name="section_id">

                                            @foreach($sections as $section)
                                                <option @if($section->id==$student->section_id) selected @endif value="{{ $section->id }}">{{ $section->Name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                    @error('section_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('student.grade')}}</label>
                                    <div class='input-group date'>

                                        <select class="form-control p-0" name="grade_id">

                                            @foreach($grades as $grade)
                                                <option @if($grade->id==$student->grade_id) selected @endif value="{{ $grade->id }}">{{ $grade->Name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                    @error('grade_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>


                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{trans('student.title')}}</label>
                                <textarea class="form-control" name="Address"
                                          id="exampleFormControlTextarea1" rows="4">{{ $student->title }}</textarea>
                                @error('Address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

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
