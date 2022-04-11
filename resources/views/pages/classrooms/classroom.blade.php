@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('classroom.Classroom') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('classroom.Classroom')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

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


                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('classroom.add_classroom') }}
                    </button>

                    <button type="button" disabled  id="btn_delete_row" class="button x-small" data-toggle="modal" data-target="#delete_all">
                        {{ trans('classroom.Delete Selected Row') }}
                    </button>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <td><input type="checkbox" id="box2"/></td>
                                <th>#</th>
                                <th>{{trans('classroom.Name')}}</th>
                                <th>{{trans('classroom.grade')}}</th>
                                <th>{{trans('classroom.Processes')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @if($classrooms)
                            @foreach ($classrooms as $classroom)
                                <tr>
                                    <?php $i++; ?>
                                    <td><input type="checkbox" value="{{ $classroom->id }}" class="box1"/></td>
                                    <td>{{ $i }}</td>
                                    <td>{{ $classroom->Name }}</td>
                                    <td>{{ $classroom->grade->Name }}</td>

                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $classroom->id }}"
                                                title="{{ trans('classroom.Edit') }}"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $classroom->id }}"
                                                title="{{ trans('classroom.Delete') }}"><i
                                                class="fa fa-trash"></i></button>

                                                <a  href="{{ route("classroom_student",$classroom->id) }}" class="btn btn-warning text-dark btn-sm"
                                                title="{{ trans('classroom.show_student') }}"><i
                                                class="fa fa-eye"></i></a>

                                                <a  href="{{ route("classroom_subject",$classroom->id) }}" class="btn btn-dark text-white btn-sm"
                                                    title="{{ trans('classroom.show_subject') }}"><i
                                                    class="fa fa-eye"></i></a>


                                    </td>
                                </tr>

                                <!-- edit_modal_Grade -->
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
                                                            @foreach($stages as $value)
                                                            <option @if($value->id==$classroom->grade_id) selected @endif class="form-control" value="{{ $value->id }}"> {{ $value->Name }}</option>
                                                            @endforeach


                                                        </select>

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

                                <!-- delete_modal_Grade -->
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
                            @endif

                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- add_modal_Grade -->

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('classroom.add_class') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class=" row mb-30" action="{{ route('classroom.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="List_Classes">
                                    <div data-repeater-item>
                                        <div class="row">

                                            <div class="col">
                                                <label for="Name"
                                                    class="mr-sm-2">{{ trans('classroom.Name_class') }}
                                                    :</label>
                                                <input class="form-control" type="text" name="name_ar" />
                                            </div>


                                            <div class="col">
                                                <label for="Name"
                                                    class="mr-sm-2">{{ trans('classroom.Name_class_en') }}
                                                    :</label>
                                                <input class="form-control" type="text" name="name_en" />
                                            </div>


                                            <div class="col">
                                                <label for="Name_en"
                                                    class="mr-sm-2">{{ trans('classroom.Name_Grade') }}
                                                    :</label>

                                                <div class="box">
                                                    <select class="fancyselect" name="grade_id">
                                                        @if($stages)
                                                        @foreach ($stages as $Grade)
                                                            <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <label for="Name_en"
                                                    class="mr-sm-2">{{ trans('classroom.Processes') }}
                                                    :</label>
                                                <input class="btn btn-danger p-3 btn-block" data-repeater-delete
                                                    type="button" value="{{ trans('classroom.delete_row') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button" data-repeater-create type="button" value="{{ trans('classroom.add_row') }}"/>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                    <button type="submit"
                                        class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                                </div>


                            </div>
                        </div>
                    </form>
                </div>


            </div>

        </div>




    </div>



    </div>

    <div class="modal fade " id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                       {{ trans('classroom.delete_classes') }}
                   </h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>

               <form action="{{ route("delete_group_class") }}" method="POST">
                   {{ csrf_field() }}
                   <input type="hidden" type="text" id="id_all" name="id_all"/>
                   <div class="modal-body">
                       {{ trans('classroom.Warning_Grade') }}
                   </div>

                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary"
                               data-dismiss="modal">{{ trans('classroom.Close') }}</button>
                       <button type="submit" class="btn btn-danger">{{ trans('classroom.submit') }}</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render

   <script src="{{ URL::asset('js/include/checks.js')  }}"></script>


    @endsection
