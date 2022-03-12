@extends('layouts.master')
@section('title','Time Slot')
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Time Slot</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#all-depart" class="nav-link active" data-toggle="tab">Manage Time</a></li>
            @if(Qs::userIsAcademic()) <li class="nav-item"><a href="#new-depart" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Create New Time Slot</a></li>@endif
        </ul>

        <div class="tab-content">
                <div class="tab-pane fade show active" id="all-depart">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>S/N</th>


                            <th>Period</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>





                            @foreach ($infos as $info )


                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $info->from .' '.'  -  '.' '. $info->to }}</td>

                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-left">



                                                   @if(Qs::userIsAcademic())
                                                {{--Delete--}}
                                                <form method="post" action="{{ route('academic.timeslot.destroy',$info->id) }}"  onsubmit="return confirm('are You sure you want to delete ');">
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

            <div class="tab-pane fade" id="new-depart">

                <div class="row">
                    <div class="col-md-6">
                        <form class="ajax-store" method="post" action="{{ route('academic.timeslot.store') }}">
                            @csrf



                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Time  <span class="text-danger">*</span></label>

                                 <div class="col-lg-9 flex space-x-4">
                                    <select id="from-select" name="from" class="form-control select">
                                                @for($i = 6; $i <= 17; $i++)
                                                   @foreach(['00'] as $subPart)
                                                    <option value="{{ (($i < 10) ? "0" : "") . $i . ":" . $subPart }}">
                                                        {{ (($i <10) ? "0" : "") . $i . ":" . $subPart }}
                                                    </option>
                                                    @endforeach
                                                @endfor
                                            </select>




                                            <select id="to-select" name="to" class="form-control select">
                                                @for($i = 6; $i <= 17; $i++)
                                                    @foreach(['50'] as $subPart)
                                                    <option value="{{ (($i < 10) ? "0" : "") . $i . ":" . $subPart }}">
                                                        {{ (($i < 10) ? "0" : "") . $i . ":" . $subPart }}
                                                    </option>
                                                    @endforeach
                                                @endfor
                                                </select>
                                 </div>


                            </div>



                            <div class="text-right">
                                <button id="ajax-btn" type="submit" class="btn btn-success">Submit form <i class="icon-store ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Time slot section --}}
@endsection
