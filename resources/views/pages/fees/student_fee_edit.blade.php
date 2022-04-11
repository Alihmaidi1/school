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
                            <form action="{{ route("fee.student.update") }}" method="post">
                             @csrf
                             <input type="hidden" name="id" value="{{ $fee1->id }}"/>
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('fee.student_name')}}</label>
                                    <select name="student_id" class="form-control p-0">

                                        <option value="{{ $fee1->student->id }}">{{ $fee1->student->Name }}</option>

                                    </select>


                                    @error('student_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label for="title">{{trans('fee.fee')}}</label>

                                    <select onchange="edit_amount()" id="select_amount" name="fee_id" class="form-control p-0">
                                        @if($fees)
                                        @foreach($fees as $fee)
                                        <option @if($fee->id==$fee1->fee_id) selected @endif value="{{ $fee->id }}">{{ $fee->Name }}</option>
                                        @endforeach
                                        @endif
                                    </select>


                                    @error('fee_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <br>


                            <div class="form-row">

                                <div class="col">
                                    <label for="title">{{trans('fee.amount')}}</label>
                                    <input readonly  value="{{ $fee1->fee->amount }}" id="amount" name="amount"  class="form-control">
                                    @error('amount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="col">
                                    <label for="title">{{trans('fee.note')}}</label>
                                    <input name="note"  value="{{ $fee1->Note }}" class="form-control">
                                    @error('note')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div>

                            <br/>
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

    <script>

        function edit_amount(){


            let select_amount=document.getElementById("select_amount");
            let amount=document.getElementById("amount");
            let request = new XMLHttpRequest();
            request.open("get", "/get_amount/"+select_amount.value);
            request.onreadystatechange = function() {

                if(request.status==200&&request.readyState==4)
                {


                    amount.value=request.response;

                }


                }
            request.send()


        }



    </script>


    @endsection
