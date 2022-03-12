@extends('layouts.master')
@section('title','Time Table')
@section('content')
<div class="card">
    @if (Qs::userIsAcademic() || Qs::userIsHod() || Qs::userIsLecture() && !Qs::userIsStudent())
   <div class="card-header">
       <strong>Academic Year:  </strong><label>  {{ "". $timetable->setting->current_session }}</label></br>
       <strong>Department:  </strong><label>  {{ "". $timetable->department->abbr }}</label></br>
       <strong>Level :  </strong><label>  {{ "". $timetable->level->level_name }}</label></br>
       <strong>Semester:  </strong><label>  {{ "". $timetable->semester->Se_id }}</label></br>


   </div>
<div class="card-body">
<table class="table  table-striped table-bordered table-responsive">
    <thead>
          <tr class=" ">
              <th>Day / Time</th>
              @foreach ($hours as $hour)
                  <th>{{ $hour->from .'-'. $hour->to}}</th>
              @endforeach
         </tr>
         </thead>
         <tbody>



           @foreach($schedules as $day)

                                    <tr>

                                        <td>
                                            {{ $days[$loop->index] }}

                                        </td>





                                        @foreach($day as $item)
                                            <td>
                                                <strong>{{ $item }}</strong><br>
                                                <small></small>
                                            </td>
                                        @endforeach
                                    </tr>

                             @endforeach




    </tbody>
</table>
</div>
@endif





















@if (Qs::userIsStudent())
@if($student_timetable ?? '' ==true)
<div class="card-header">
       <strong>Academic Year:  </strong><label>  {{ "". $student_timetable->setting->current_session }}</label></br>
       <strong>Department:  </strong><label>  {{ "". $student_timetable ->department->abbr }}</label></br>
       <strong>Level :  </strong><label>  {{ "". $student_timetable ->level->level_name }}</label></br>
       <strong>Semester:  </strong><label>  {{ "". $student_timetable->semester->Se_id }}</label></br>


   </div>
<div class="card-body">
<table class="table  table-striped table-bordered table-responsive">
    <thead>
          <tr class=" ">
              <th>Day / Time</th>
              @foreach ($hours as $hour)
                  <th>{{ $hour->from .'-'. $hour->to}}</th>
              @endforeach
         </tr>
         </thead>
         <tbody>





           @foreach($schedules as $day)

                                    <tr>
                                      <td> {{ $days[$loop->index] }}</td>
                                        @foreach($day as $item)
                                            <td>
                                                <strong>{{ $item }}</strong><br>
                                                <small></small>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach



    </tbody>
</table>
</div>
@else
<div class="card-body">
<label for="" class="text-danger">No Timetable has been Implement</label>
</div>
@endif
@endif
</div>

@endsection
