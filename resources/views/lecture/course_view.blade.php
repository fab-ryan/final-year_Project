@extends('layouts.master')
@section('title','Course')
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Lectures</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#all-classRoom" class="nav-link active" data-toggle="tab">Manage lectures</a></li>
            @if(Qs::userIsAcademic() || Qs::userIsHod()) <li class="nav-item">
                <a href="#new-classRoom" class="nav-link" data-toggle="tab">
                    <i class="icon-plus2"></i> Register New Lecture</a></li>@endif
        </ul>

        <div class="tab-content">
                <div class="tab-pane fade show active" id="all-classRoom">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>S/N</th>

                            <th>Course Name</th>
                            <th>Course Code</th>
                            <th>Course Credit</th>
                            <th>Hours per Week</th>

                            @if (Qs::userIsAcademic())
                                <th>Action</th>
                            @endif

                        </tr>
                        </thead>
                        <tbody>






                            @foreach ($courses as  $course )



                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                               </td>

                                <td>{{ $course->course_name }}</td>
                                <td>{{ $course->course_code }}</td>
                                <td>{{ $course->course_credit }}</td>
                                <td>{{ (int)($course->course_credit/2) }}</td>

                                    @if(Qs::userIsAcademic())
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-left">

                                                {{--Edit--}}
                                                <a href="" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>


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





        </div>
    </div>
</div>

@endsection
