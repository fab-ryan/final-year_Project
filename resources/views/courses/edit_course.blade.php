@extends('layouts.master')
@section('title', 'Course Assigment')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Edit Course Assign</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form method="post" action="{{ route('hod.lecture_course.update',$lecture_course->id) }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">Lecture Name: <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input name="user_id" value="{{  $lecture_course->user_id  }}" required type="text" class="form-control" placeholder="Name of Lecture Name" readonly hidden>

                                <input name="user Name" value="{{  $lecture_course->user->name  }}" required type="text" class="form-control" placeholder="Name of Lecture Name" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="term" class="col-lg-3 col-form-label font-weight-semibold">Department</label>
                            <div class="col-lg-9">



                                <select data-placeholder="Select Teacher" class="form-control select-search" name="department_id" id="">
                                   @foreach ($courses as $course )
                                    <option {{  $lecture_course->course_id == $course->id ? 'selected' : '' }} value="{{ $course->id }}"> {{ $course->course_code . '  '. $course->course_name}}</option>
                                @endforeach

                                </select>
                            </div>
                        </div>


                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Update Course <i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
