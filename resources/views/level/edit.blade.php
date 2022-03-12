@extends('layouts.master')
@section('title', 'Edit Level')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Edit Level</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form method="post" action="{{ route('academic.level.update',$levels_edit->id) }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">level Name <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input name="level_name" value="{{  $levels_edit->level_name }}" required type="text" class="form-control" placeholder="Name of Level">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="term" class="col-lg-3 col-form-label font-weight-semibold">Department</label>
                            <div class="col-lg-9">



                                <select data-placeholder="Select Teacher" class="form-control select-search" name="department_id" id="{{ $levels_edit->department_id }}">
                                   @foreach ($department as $depart )
                                    <option {{  $levels_edit->department_id == $depart->id ? 'selected' : '' }} value="{{ $depart->id }}"> {{ $depart->abbr}}</option>
                                @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">current session <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input name="current_session" value="{{  $levels_edit->setting->current_session }}" required type="text" readonly class="form-control" placeholder="Name of Level">
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Submit form <i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
