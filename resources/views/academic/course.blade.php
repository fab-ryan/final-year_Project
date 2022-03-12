@extends('layouts.master')
@section('title','Course')
@section('content')
<div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Manage Courses</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-classes" class="nav-link active" data-toggle="tab">Courses</a></li>
                <li class="nav-item"><a href="#new-class" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Create New Course</a></li>
            </ul>

            <div class="tab-content">
                    <div class="tab-pane fade show active" id="all-classes">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Course Code</th>
                                <th>Name</th>
                                <th>Credit</th>
                                <th>Hours</th>
                                <th>Depart</th>
                                <th>Level</th>
                                <th>Semester</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                   {{ $course->links() }}
                            @foreach ($course as $course )


                                <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $course->course_code }}</td>
                                <td>{{ $course->course_name }}</td>
                                <td>{{ $course->course_credit }}</td>
                                <td>{{ (int)($course->course_credit/2 )}}</td>
                                <td>{{ $course->department->abbr }}</td>
                                <td>@if (
                                 $course->level->level_name)

                                {{ $course->level->level_name}}
                            @endif
                            </td>
                            <td>{{ $course->semester->semester_name }}</td>
                            <td>
                                @if ($course->room)
                                {{ $course->room->room }}
                                @else
                                {{ __('Location is Not Available') }}
                                @endif
                            </td>

                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-left">

                                                    {{--Edit--}}
                                                    <a href="{{ route('academic.course.edit',$course->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>

                                                        @if(Qs::userIsAcademic())
                                                    {{--Delete--}}
                                                     <form method="post" action="{{ route('academic.destroy.course' ,$course->id)}}"  onsubmit="return confirm('are you sure you want to delete ');">
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


                <div class="tab-pane fade" id="new-class">




                     <form class="ajax-store" method="POST" action="{{ route('academic.create.course') }}">
                                @csrf
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Course Code <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="course_code"  required type="text" class="form-control" placeholder="Course Code">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Course Name<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="course_name"  required type="text" class="form-control" placeholder="Course Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Course Credit <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="course_credit" value="{{ old('course_credit') }}" required type="number" class="form-control" placeholder="Course Credit">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="class_type_id" class="col-lg-3 col-form-label font-weight-semibold">Department  <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="Select Department" class="form-control select" name="department_id" id="department_id">
                                                <option></option>
                                            @foreach($depart as $depart)

                                                <option {{ old('department_id') == $depart->id ? 'selected' : '' }} value="{{ $depart->id }}">{{ $depart->abbr}}</option>
                                       @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="form-group row">
                                    <label for="class_type_id" class="col-lg-3 col-form-label font-weight-semibold">Level  <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="Select Level" class="form-control select" name="level_id" id="level_id">
                                            <option ></option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="class_type_id" class="col-lg-3 col-form-label font-weight-semibold">Semester  <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="Select semester" class="form-control select" name="semester_id" id="semester_id">
                                            <option ></option>
                                            @foreach ($semesters as $semester)


                                                <option {{ old('semester_id') == $semester->Se_id ? 'selected' : '' }} value="{{ $semester->Se_id }}">{{ $semester->semester_name}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="class_type_id" class="col-lg-3 col-form-label font-weight-semibold">Location  <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="Select Room" class="form-control select" name="room_id" id="level_id">
                                            <option ></option>
                                            @foreach ($rooms as $room)


                                                <option {{ old('room_id') == $room->id ? 'selected' : '' }} value="{{ $room->id }}">{{ $room->room}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="text-right">
                                    <button id="ajax-btn" type="submit" class="btn btn-success">Save <i class="icon-store ml-2"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

    {{-- Course Lists --}}
@endsection
