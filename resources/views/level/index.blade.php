@extends('layouts.master')
@section('title','Level')
@section('content')


<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Levels</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#all-depart" class="nav-link active" data-toggle="tab">Manage Level</a></li>
            @if(Qs::userIsAcademic()) <li class="nav-item"><a href="#new-depart" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Create New Level</a></li>@endif
        </ul>

        <div class="tab-content">
                <div class="tab-pane fade show active" id="all-depart">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>S/N</th>

                            <th>Name</th>
                            <th>Department</th>
                            <th>Session</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>



                            @foreach ($levels as $level )


                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $level->level_name }}</td>
                                <td>{{ $level->department->abbr }}</td>
                                <td>{{ $level->setting->current_session }}</td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-left">

                                                {{--Edit--}}
                                                <a href="{{ route('academic.level.edit',$level->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>

                                                   @if(Qs::userIsAcademic())
                                                {{--Delete--}}
                                                <form method="post" action="{{ route('academic.destroy.level' ,$level->id)}}"  onsubmit="return confirm('are You sure you want to delete {{ __($level->name) }}');">
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
                        <form class="ajax-store" method="post" action="{{ route('academic.level.create') }}">
                            @csrf



                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Level Name  <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input name="level_name" value="{{old('level_name') }}" required type="text" class="form-control" placeholder="Name of Level">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Department <span class="text-danger">*</span></label>



                                <div class="col-lg-9">
                                    <select equired data-placeholder="Select Department" class="form-control select" name="depart">
                                    <option value="" pacelholde="Select Department"></option>

                                       @foreach ($departs as $depart)
                                    <option  {{ old('depart') ?'selected' : '' }} value="{{ $depart->id }}">{{ $depart->abbr }}</option>
                                          @endforeach
                                    </select>

                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Academic Year <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input name="current_session" value="{{ $session }}" readonly  type="text" class="form-control" placeholder="{{ $session }}">
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

