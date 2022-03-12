@extends('layouts.master')
@section('title','Courses Lectures')
@section('content')


<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Lectures Courses</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#all-depart" class="nav-link active" data-toggle="tab">Manage Assign</a></li>
            @if(Qs::userIsHod()) <li class="nav-item"><a href="#new-depart" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Create New Assign</a></li>@endif
        </ul>

        <div class="tab-content">
                <div class="tab-pane fade show active" id="all-depart">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>S/N</th>

                            <th>Lecture Name</th>
                            <th>Courses</th>
                            <th>Credit</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>




                            @foreach ($datas as $data )


                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->user->name }}</td>
                                <td>{{$data->course->course_code .'  '.$data->course->course_name }}</td>
                                <td>{{ $data->course->course_credit }}</td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-left">

                                                {{--Edit--}}
                                                <a href="{{ route('hod.lecture.course.edit',$data->id) }}"class="dropdown-item"><i class="icon-pencil"></i> Edit</a>

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

            <div class="tab-pane fade" id="new-depart">

                <div class="row">
                    <div class="col-md-6">
                        <form class="ajax-store" method="post" action="{{ route('hod.lecture_course.store') }}">
                            @csrf



                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Lecture <span class="text-danger">*</span></label>



                                <div class="col-lg-9">
                                    <select equired data-placeholder="Select Lectures" class="form-control select" name="user_id">
                                    <option value="" pacelholde="Select Lectures"></option>
                                        @foreach ($lectures as $lecture)



                                    <option  {{ old('user_id') ?'selected' : '' }} value="{{ $lecture->user_id }}">{{ $lecture->user->name }}</option>
                                         @endforeach
                                    </select>

                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Course <span class="text-danger">*</span></label>



                                <div class="col-lg-9">
                                    <select equired data-placeholder="Select Courses" class="form-control select" name="course_id">
                                    <option value="" pacelholde="Select courses"></option>
                                        @foreach ($courses as $course)



                                    <option  {{ old('course_id') ?'selected' : '' }} value="{{ $course->id }}">{{ $course->course_code  .'   '.  $course->course_name  }}</option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>



                            <div class="text-right">
                                <button id="ajax-btn" type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
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

