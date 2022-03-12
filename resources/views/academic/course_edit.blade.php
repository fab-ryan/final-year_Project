@extends('layouts.master')
@section('title','Edit Course')
@section('content')
<div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Course Edit</h6>
            {!! Qs::getPanelOptions() !!}
        </div>
        <div class="card-body">

             <form class="ajax-store" method="POST" action="{{ route('academic.course.update',$infos->id) }}">
                                @csrf
                     <div class="row">
                        <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Course Code <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="course_code"  required type="text" class="form-control" placeholder="Course Code" value="{{ $infos->course_code }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Course Name<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="course_name"  required type="text" class="form-control" placeholder="Course Name" value="{{ $infos->course_name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Course Credit <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="course_credit" value="{{ $infos->course_credit }}" required type="number" class="form-control" placeholder="Course Credit">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="class_type_id" class="col-lg-3 col-form-label font-weight-semibold">Department  <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="Select Department" class="form-control select" name="department_id" id="department_id">
                                                <option></option>
                                            @foreach($depart as $depart)

                                                <option {{ $infos->department_id == $depart->id ? 'selected' : '' }} value="{{ $depart->id }}">{{ $depart->abbr}}</option>
                                       @endforeach
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="class_type_id" class="col-lg-3 col-form-label font-weight-semibold">Level  <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="Select Level" class="form-control select" name="level_id" id="level_id">
                                            <option ></option>
                                            @foreach ($levels as $level)


                                                <option {{ $infos->level_id == $level->id ? 'selected' : '' }} value="{{ $level->id }}">{{ $level->level_name}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                  <div class="form-group row">
                                    <label for="class_type_id" class="col-lg-3 col-form-label font-weight-semibold">Semester <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="Select Level" class="form-control select" name="semester_id" id="semester_id">
                                            <option ></option>
                                            @foreach ($semesters as $semester)


                                                <option {{ $infos->semester_id == $semester->Se_id ? 'selected' : '' }} value="{{ $semester->Se_id }}">{{ $semester->semester_name}}</option>

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


                                                <option {{ $infos->room_id == $room->id ? 'selected' : '' }} value="{{ $room->id }}">{{ $room->room}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="text-right">
                                    <button id="ajax-btn" type="submit" class="btn btn-success">Update <i class="icon-pencil ml-2"></i></button>
                                </div>
                        </div>
                    </div>
              </form>

 </div>
</div>
@endsection
