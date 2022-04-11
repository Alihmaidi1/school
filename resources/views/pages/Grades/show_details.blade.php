@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ $grade->Name }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ $grade->Name }}
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

            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('Grades_trans.Name_classroom') }}</th>
                            <th>{{ trans('Grades_trans.Note') }}</th>
                            <th>{{ trans('Grades_trans.Processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($grade->classroom as $classroom)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $classroom->Name }}</td>
                                <td>{{ $classroom->Notes }}</td>

                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#edit{{ $classroom->id }}"
                                    title="{{ trans('classroom.Edit') }}"><i
                                    class="fa fa-edit"></i></button>

                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $classroom->id }}"
                                                title="{{ trans('classroom.Delete') }}"><i
                                                class="fa fa-trash"></i></button>

                                </td>
                            </tr>

                            <div class="modal fade" id="edit{{ $classroom->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                               id="exampleModalLabel">
                                               {{ trans('classroom.Edit') }}
                                           </h5>
                                           <button type="button" class="close" data-dismiss="modal"
                                                   aria-label="Close">
                                               <span aria-hidden="true">&times;</span>
                                           </button>
                                       </div>
                                       <div class="modal-body">
                                           <!-- add_form -->
                                           <form action="{{route('classroom.update')}}" method="post">
                                               {{method_field('post')}}
                                               @csrf
                                               <div class="row">
                                                   <div class="col">
                                                       <label for="Name"
                                                              class="mr-sm-2">{{ trans('classroom.classroom_name_ar') }}
                                                           :</label>
                                                       <input id="Name" type="text" name="Name"
                                                              class="form-control"
                                                              value="{{$classroom->getTranslation('Name', 'ar')}}"
                                                              required>
                                                       <input id="id" type="hidden" name="id" class="form-control"
                                                              value="{{ $classroom->id }}">
                                                   </div>
                                                   <div class="col">
                                                       <label for="Name_en"
                                                              class="mr-sm-2">{{ trans('classroom.classroom_name_en') }}
                                                           :</label>
                                                       <input type="text" class="form-control"
                                                              value="{{$classroom->getTranslation('Name', 'en')}}"
                                                              name="Name_en" required>
                                                   </div>
                                               </div>
                                               <div class="rom m-3">

                                                   <label for="Name_en"
                                                   class="mr-sm-2">{{ trans('classroom.stages') }}
                                                :</label>
                                                   <select name="stage" class="form-control p-0">
                                                       @foreach($stages as  $value)
                                                           <option @if($value->id==$classroom->grade_id) selected @endif value="{{ $value->id }}">{{ $value->Name }}</option>
                                                       @endforeach

                                                   </select>

                                               </div>

                                               <div class="form-group">
                                                   <label
                                                       for="exampleFormControlTextarea1">{{ trans('classroom.Notes') }}
                                                       :</label>
                                                   <textarea class="form-control" name="Notes"
                                                             id="exampleFormControlTextarea1"
                                                             rows="3">{{ $classroom->Notes }}</textarea>
                                               </div>
                                               <br><br>

                                               <div class="modal-footer">
                                                   <button type="button" class="btn btn-secondary"
                                                           data-dismiss="modal">{{ trans('classroom.Close') }}</button>
                                                   <button type="submit"
                                                           class="btn btn-success">{{ trans('classroom.submit') }}</button>
                                               </div>
                                           </form>

                                       </div>
                                   </div>
                               </div>
                           </div>

                           <div class="modal fade" id="delete{{ $classroom->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                           id="exampleModalLabel">
                                           {{ trans('classroom.delete_class') }}
                                       </h5>
                                       <button type="button" class="close" data-dismiss="modal"
                                               aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <div class="modal-body">
                                       <form action="{{route('classroom.destroy')}}" method="post">
                                           {{method_field('post')}}
                                           @csrf
                                           {{ trans('Grades_trans.Warning_Grade') }}
                                           <input id="id" type="hidden" name="id" class="form-control"
                                                  value="{{ $classroom->id }}">
                                           <div class="modal-footer">
                                               <button type="button" class="btn btn-secondary"
                                                       data-dismiss="modal">{{ trans('classroom.Close') }}</button>
                                               <button type="submit"
                                                       class="btn btn-danger">{{ trans('classroom.Delete Data') }}</button>
                                           </div>
                                       </form>
                                   </div>
                               </div>
                           </div>
                       </div>



                        @endforeach
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
