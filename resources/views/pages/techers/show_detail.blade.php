@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('techer.techer_details')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('techer.techer_details')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="card-body">
                        <div class="tab nav-border">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                       role="tab" aria-controls="home-02"
                                       aria-selected="true">{{trans('techer.techer_details')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                       role="tab" aria-controls="profile-02"
                                       aria-selected="false">{{trans('techer.Attachments')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-03-tab" data-toggle="tab" href="#profile-03"
                                       role="tab" aria-controls="profile-03"
                                       aria-selected="false">{{trans('techer.subject_that_learn')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-03-tab" data-toggle="tab" href="#profile-04"
                                       role="tab" aria-controls="profile-03"
                                       aria-selected="false">{{trans('techer.section_that_learn')}}</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                     aria-labelledby="home-02-tab">
                                    <table class="table table-striped table-hover" style="text-align:center">
                                        <tbody>
                                        <tr>
                                            <th scope="row">{{trans('techer.email')}}</th>
                                            <td>{{ $techer->email	 }}</td>
                                            <th scope="row">{{trans('techer.Name')}}</th>
                                            <td>{{$techer->Name}}</td>
                                            <th scope="row">{{trans('techer.number')}}</th>
                                            <td>{{ $techer->number }}</td>
                                            <th scope="row">{{trans('techer.Gender')}}</th>
                                            <td>{{ $techer->gender }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{trans('techer.start_date')}}</th>
                                            <td>{{ $techer->start_date }}</td>
                                            <th scope="row">{{trans('techer.salary')}}</th>
                                            <td>{{ $techer->salary->salary }}</td>
                                            <th scope="row">{{trans('techer.title')}}</th>
                                            <td>{{ $techer->title }}</td>
                                            <th scope="row">{{trans('techer.specific')}}</th>
                                            <td>{{ $techer->spicefic }}</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>



                                <div class="tab-pane fade" id="profile-02" role="tabpanel"
                                     aria-labelledby="profile-02-tab">
                                    <div class="card card-statistics">
                                        <div class="card-body">
                                            <form method="post" action="{{ route("attachment_techer_save") }}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label
                                                            for="academic_year">{{trans('parents.Attachments')}}
                                                            : <span class="text-danger">*</span></label>
                                                        <input type="file" accept="image/*" name="attchments[]" multiple required>
                                                        <input type="hidden" name="id" value="{{ $techer->id }}">
                                                    </div>
                                                </div>
                                                <br><br>
                                                <button type="submit" class="button button-border x-small">
                                                       {{trans('parents.submit')}}
                                                </button>
                                            </form>
                                        </div>
                                        <br>

                                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('parents.FileName') }}</th>
                            <th>{{ trans('parents.Created_at') }}</th>
                            <th>{{ trans('Grades_trans.Processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($techer->photos as  $attachment)

                        <tr style='text-align:center;vertical-align:middle'>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$attachment->url}}</td>
                            <td>{{$attachment->created_at->diffForHumans()}}</td>
                            <td colspan="2">
                                <a class="btn btn-outline-info btn-sm" href="{{ url("download_attachment/attachment/teachers/".$techer->id."/".$attachment->url) }}" role="button"><i class="fas fa-download"></i>&nbsp; {{trans('parents.Download')}}</a>
                                <a href="{{ route("parent_attachment",$attachment->id) }}" type="button" class="btn btn-outline-danger btn-sm"title="{{ trans('Grades_trans.Delete') }}">{{trans('parents.delete')}}</a>

                            </td>
                        </tr>



@endforeach





                    </tbody>
                       </table>


                                    </div>
                                </div>


                                <div class="tab-pane fade" id="profile-03" role="tabpanel"
                                     aria-labelledby="profile-02-tab">
                                    <div class="card card-statistics">
                                        <div class="card-body">


                                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                                                <thead>
                                                <th>#</th>
                                                <th>{{ __("parents.student_name") }}</th>
                                                <th>{{ __("parents.student_classroom") }}</th>
                                                </thead>
                                                <tbody>
                                                    @foreach($techer->subjects as $subject)
                                                    <tr>
                                                    <td>{{ $subject->id }}</td>
                                                    <td>{{ $subject->Name }}</td>
                                                    <td>{{ $subject->classroom->Name }}</td>
                                                    </tr>


                                                    @endforeach

                                                </tbody>
                                            </table>




                                        </div>
                                        <br>

                                    </div>
                                </div>




                                <div class="tab-pane fade" id="profile-04" role="tabpanel"
                                aria-labelledby="profile-02-tab">
                               <div class="card card-statistics">
                                   <div class="card-body">


                                    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">{{ trans("techer.add_section") }}</button>

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

                                                <form class=" row mb-30" action="{{ route('techer.subject') }}" method="POST">
                                                    @csrf
                                                    <input name="techer_id" type="hidden" value="{{ $techer->id }}"/>
                                                    <div class="card-body">
                                                        <div class="repeater">
                                                            <div data-repeater-list="List_Classes">
                                                                <div data-repeater-item>
                                                                    <div class="row">

                                                                        <div class="col">
                                                                            <label for="Name"
                                                                                class="mr-sm-2">{{ trans('techer.subject') }}
                                                                                :</label>

                                                                                <select class="form-control p-0" name="section_id">

                                                                                    @foreach($sections as  $section)

                                                                                    <option value="{{ $section->id }}">{{ $section->classroom->Name }} {{ $section->Name }}</option>

                                                                                    @endforeach


                                                                                </select>


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
                                    <br/>
                                    <br/>

                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                                           <thead>
                                           <th>#</th>
                                           <th>{{ __("techer.Section_name") }}</th>
                                           <th>{{ __("techer.Start_at") }}</th>
                                           <th>{{ __("techer.Processes") }}</th>
                                           </thead>
                                           <tbody class="{{  $i=0 }}">

                                               @foreach($techer->sections as $section)
                                               <tr>

                                               <td>{{ $section->pivot->id }}</td>
                                               <td>{{$section->classroom->Name." ".$section->Name }}</td>
                                               <td>{{ $section->created_at }}</td>
                                               <td>

                                                <button  class="btn btn-outline-info btn-sm"  data-toggle="modal" data-target="#edit{{ $section->pivot->id }}"role="button"><i class="fas fa-edit"></i>&nbsp; {{trans('techer.edit')}}</button>

                                                <div class="modal fade" id="edit{{ $id=$section->pivot->id }}" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                   <div class="modal-dialog" role="document">
                                                       <div class="modal-content">
                                                           <div class="modal-header">
                                                               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                   id="exampleModalLabel">
                                                                   {{ trans('Grades_trans.edit_Grade') }}
                                                               </h5>
                                                               <button type="button" class="close" data-dismiss="modal"
                                                                       aria-label="Close">
                                                                   <span aria-hidden="true">&times;</span>
                                                               </button>
                                                           </div>
                                                           <div class="modal-body">
                                                               <!-- add_form -->
                                                               <form action="{{route('section_techer.update')}}" method="post">
                                                                   {{method_field('post')}}
                                                                   @csrf
                                                                   <input type="hidden" value="{{ $section->pivot->id }}" name="techer_section_id"/>
                                                                   <div class="row">
                                                                       <div class="col ">
                                                                           <label for="Name"
                                                                                  class="">{{ trans('Grades_trans.stage_name_ar') }}
                                                                            </label>
                                                                             <div>
                                                                               <select class="form-control p-0" name="section_id">

                                                                                @foreach($sections as $section1)

                                                                                <option @if($section1->id==$section->id) selected @endif value="{{ $section1->id }}">{{$section1->classroom->Name." ".$section1->Name }}</option>

                                                                                @endforeach


                                                                               </select>
                                                                             </div>

                                                                       </div>

                                                                   </div>
                                                                   <br><br>

                                                                   <div class="modal-footer">
                                                                       <button type="button" class="btn btn-secondary"
                                                                               data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                                       <button type="submit"
                                                                               class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                                                                   </div>
                                                               </form>

                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>




                                                <a href="{{ route("delete_section_techer",$section) }}"  class="btn btn-outline-danger btn-sm"title="{{ trans('Grades_trans.Delete') }}">{{trans('parents.delete')}}</a>


                                               </td>

                                            </tr>


                                               @endforeach

                                           </tbody>
                                       </table>




                                   </div>
                                   <br>

                               </div>
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
