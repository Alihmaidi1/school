@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('techer.edit_techer') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('techer.edit_techer') }}
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
                            <form action="{{ route("techer.update") }}" method="post">
                             @csrf
                             <input name="id" type="hidden" value="{{ $techer->id }}"/>
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('techer.Email')}}</label>
                                    <input type="email" value="{{ $techer->email }}" name="Email" class="form-control">
                                    @error('Email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('techer.Password')}}</label>
                                    <input type="password" value="{{ $techer->password }}" name="Password" class="form-control">
                                    @error('Password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>


                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('techer.Name_ar')}}</label>
                                    <input type="text" value="{{ $techer->getTranslation('Name', 'ar')}}" name="Name_ar" class="form-control">
                                    @error('Name_ar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('techer.Name_en')}}</label>
                                    <input type="text" name="Name_en" value="{{ $techer->getTranslation("Name","en") }}" class="form-control">
                                    @error('Name_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('techer.number')}}</label>
                                    <input type="text" value="{{ $techer->number }}" name="number" class="form-control">
                                    @error('number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('techer.salary')}}</label>

                                    <select class="form-control p-0" name="salary_id">

                                        @foreach($salarys as  $salary)
                                            <option @if($salary->id==$techer->salary_id) selected @endif value="{{ $salary->id }}">{{ $salary->salary }}</option>
                                        @endforeach


                                    </select>

                                    @error('salary')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="inputCity">{{trans('techer.specialization')}}</label>
                                    <input type="text" value="{{ $techer->spicefic }}" name="specialization" class="form-control">
                                    @error('Specialization')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="inputState">{{trans('techer.Gender')}}</label>
                                    <input type="text" name="Gender" value="{{ $techer->gender }}" class="form-control">
                                    @error('Gender')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('techer.Joining_Date')}}</label>
                                    <div class='input-group date'>
                                        <input class="form-control" value="{{ $techer->start_date }}" type="text"  id="datepicker-action" name="Joining_Date" data-date-format="yyyy-mm-dd"  required>
                                    </div>
                                    @error('Joining_Date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{trans('techer.Address')}}</label>
                                <textarea class="form-control" name="Address"
                                          id="exampleFormControlTextarea1" rows="4">{{ $techer->title }}</textarea>
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
