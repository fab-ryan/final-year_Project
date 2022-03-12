@extends('layouts.master')
@section('title','Course')
@section('content')
<div class="card">
    <div class="card-header ">
        @if($show==true)
      <h5 >Courses</h5>

       <strong>Academic Year:  </strong><label>  {{ "". $show->setting->current_session }}</label></br>
        <strong>Department:  </strong><label>  {{ "". $show->department->abbr }}</label></br>
       <strong>Level :  </strong><label>  {{ "". $show->level->level_name }}</label></br>
       <strong>Semester:  </strong><label>  {{ "". $show->semester->Se_id }}</label></br>
        @else
        <div class="text-danger">no Courses are a vailable</div>  @endif
    </div>
    <div class="card-body">
        <div class="tab-content">

                        <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Course Code</th>
                                <th>Name</th>
                                <th>Credit</th>
                                <th>Hours</th>

                                <th>Location</th>

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


                            <td>
                                @if ($course->room)
                                {{ $course->room->room }}
                                @else
                                {{ __('Location is Not Available') }}
                                @endif
                            </td>



                                </tr>
                             @endforeach

                            </tbody>
                        </table>

        </div>

    </div>
</div>
@endsection
