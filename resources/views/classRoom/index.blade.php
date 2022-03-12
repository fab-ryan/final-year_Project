@extends('layouts.master')
@section('title','Class Room')
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Class Rooms</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#all-classRoom" class="nav-link active" data-toggle="tab">Manage Level</a></li>
            @if(Qs::userIsAcademic()) <li class="nav-item"><a href="#new-classRoom" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Create New Level</a></li>@endif
        </ul>

        <div class="tab-content">
                <div class="tab-pane fade show active" id="all-classRoom">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>S/N</th>

                            <th>Name</th>
                            <th>Department</th>
                            <th>Courses</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>





                            @foreach ($classRoom as $classRoom )


                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $classRoom->class_name }}</td>
                                <td>{{ $classRoom->department->abbr }}</td>
                                <td>
                                    @if (count($classRoom->course_id))
                            <ul>
                                @foreach ($classRoom->course_id  as $class)
                                    <li>{{ $classRoom->course->course_name }}</li>


                                @endforeach
                            </ul>
                        @else
                            <p>No unavailable Courses</p>
                        @endif
                        {{-- @if (count($classRoom->course_id))
                            {{ $classRoom->course->course_name }}

                        @endif --}}

                    </td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-left">

                                                {{--Edit--}}
                                                <a href="" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>

                                                   @if(Qs::userIsAcademic())
                                                {{--Delete--}}
                                                <form method="post" action=""  onsubmit="return confirm('are You sure you want to delete ');">
                                                    @csrf
                                                     @method('delete')
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
                        <form class="ajax-store" method="post" action="{{ route("academic.classRoom.create") }}">
                            @csrf



                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Class Name  <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input name="class_name" value="{{old('class_name') }}" required type="text" class="form-control" placeholder="Name of Class">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Department <span class="text-danger">*</span></label>



                                <div class="col-lg-9">

                                    <select equired data-placeholder="Select Department" class="form-control select" name="department_id" id="depart">
                                    <option value="" pacelholde="Select Department"></option>
                                        @foreach ($departs as $depart )
                                         <option  {{ old('depart') ?'selected' : '' }} value="{{ $depart->id }}">{{ $depart->abbr }}</option>
                                         @endforeach
                                    </select>

                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Courses <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <select equired data-placeholder="Select Department" multiple class="form-control select" name="course_id[]"  id="course">


                                    </select>
                                </div>
                            </div>

                            <div class="text-right">
                                <button id="ajax-btn" type="submit" class="btn btn-success">Save <i class="icon-store ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--  Room List --}}

@endsection


