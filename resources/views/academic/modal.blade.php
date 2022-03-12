@extends('layouts.master')
@section('title','New TimeTable')
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title"> Timetable</h6>
        {!! Qs::getPanelOptions() !!}
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#all-classRoom" class="nav-link active" data-toggle="tab">Manager Timetable</a></li>
            @if(Qs::userIsAcademic()) <li class="nav-item">
                <a href="#new-classRoom" class="nav-link" data-toggle="tab">
                    <i class="icon-plus2"></i> New Time Table</a></li>@endif
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="all-classRoom">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>S/N</th>

                            <th>Timetable Name</th>
                            <th>Department</th>
                            <th>Level</th>
                            <th>Semester</th>
                            <th>Academic</th>

                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>





                            @foreach ($displays as $key=>$display)


                            <tr>
                                <td>
                                    {{$loop->iteration  }}
                            </td>
                            <td>{{ $display->timetable_name }}
                            </td>
                                <td>{{ $display->department->abbr }}</td>
                                <td>{{ $display->level->level_name }}</td>
                                <td>{{ $display->semester->semester_name }}</td>
                                <td>{{ $display->setting->current_session }}


                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-left">

                                                {{--Edit--}}
                                                @if(Qs::userIsAcademic())
                                                <a href="{{ route('academic.timetable',$display->id) }}" class="dropdown-item"><i class="icon-pencil"></i> View</a>
                                                @endif
                                                @if(Qs::userIsHod())
                                                <a href="{{ route('hod.view.timetable',$display->id) }}" class="dropdown-item"><i class="icon-pencil"></i> View</a>

                                                @endif
                                                @if(Qs::userIsLecture())
                                                <a href="{{ route('lecture.view.timetable',$display->id) }}" class="dropdown-item"><i class="icon-pencil"></i> View</a>

                                                @endif
                                                   @if(Qs::userIsAcademic())
                                                {{--Delete--}}
                                                <form method="post" action="{{ route('academic.timetable.destroy',$display->id) }}"  onsubmit="return confirm('are You sure you want to delete ');">
                                                    @csrf

                                                <button type="submit" class="dropdown-item"><i class="icon-trash"></i> Delete</button>
                                                </form>
                                                    @endif

                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                             @endforeach
                        </tbody>
                    </table>
                </div>
            <div class="tab-pane fade" id="new-classRoom">

            <div class="row">

             <div class="col-md-6">

                <form  method="POST" action="{{route('academic.timetable.create.new') }}" >
                    @csrf
                  <div class="form-group row">
                     <label class="col-lg-3 col-form-label font-weight-semibold">TimeTable Name <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input name="timetable_name" id="timetable_name" value="{{old('table_name') }}" required type="text" class="form-control" placeholder="Name of TimeTable">
                        </div>
                  </div>


                   <div class="form-group row">
                      <label class="col-lg-3 col-form-label font-weight-semibold">Department <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                              <select required data-placeholder="Select Department" id='department_id' class="form-control select" name="department_id" id="department_id">
                                 <option value="" pacelholde="Select Department"></option>

                                    @foreach ($departs as $depart)
                                     <option  {{ old('department_id') ?'selected' : '' }} value="{{ $depart->id }}">{{ $depart->abbr }}</option>
                                          @endforeach
                                    </select>

                            </div>

                    </div>
                    <div class="form-group row">
                            <label for="Level" class="col-lg-3 col-form-label font-weight-semibold">Level <span class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <select name="level_id" id="level_id" class="form-control select" required data-placeholder="Select Level">
                                <option value="">

                                </option>
                            </select>

                        </div>
                    </div>
                    <div class="form-group row">
                            <label for="Level" class="col-lg-3 col-form-label font-weight-semibold">Semester <span class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <select name="semester_id" id="semester_id" class="form-control select" required data-placeholder="Select Semester">
                                <option value="">

                                </option>
                                @foreach ($semesters as $key=>$semester )
                                     <option  {{ old('semester_id') ?'selected' : '' }} value="{{ $semester->Se_id }}">{{ $semester->semester_name }}</option>

                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="text-right">
                                <button id="ajax-btn" type="submit" class="btn btn-success" >Save <i class="icon-store ml-2"></i></button>


                                <button id="ajax-btn"  type="reset"  class="btn btn-danger">Clear <i class="icon-bin ml-2"></i></button>

                    </div>
                 </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

