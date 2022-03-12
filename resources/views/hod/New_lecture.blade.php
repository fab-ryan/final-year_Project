@extends('layouts.master')
@section('title','Lectures')
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Lectures</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#all-classRoom" class="nav-link active" data-toggle="tab">Manage lectures</a></li>
            @if(Qs::userIsAcademic()) <li class="nav-item">
                <a href="#new-classRoom" class="nav-link" data-toggle="tab">
                    <i class="icon-plus2"></i> Register New Lecture</a></li>@endif
        </ul>

        <div class="tab-content">
                <div class="tab-pane fade show active" id="all-classRoom">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>S/N</th>

                            <th>Name</th>
                            <th>Department</th>
                            <th>Courses</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>





                            @foreach ($displays as $k=>$display )


                            <tr>

                                <td>
                                    {{ $loop->iteration  }}
                               </td>

                                <td>{{ $display->user->name }}</td>
                                <td>{{ $display->department->abbr }}</td>
                                <td></td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-left">

                                                {{--Edit--}}
                                                <a href="" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>

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

            <div class="tab-pane fade" id="new-classRoom">

                <div class="row">

                    <div class="col-md-6">

                    <form method="POST" action="{{ route('academic.lecture.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-lg-3 col-form-label font-weight-semibold">{{ __('Name') }}</label>

                            <div class="col-lg-9">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-lg-3 col-form-label font-weight-semibold">{{ __('E-Mail Address') }}</label>

                            <div class="col-lg-9">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Department <span class="text-danger">*</span></label>



                                <div class="col-lg-9">
                                    <select equired data-placeholder="Select Department" class="form-control select" name="department" id="department_id">
                                    <option value="" pacelholde="Select Department"></option>
                                        @foreach ($departments as $department )



                                    <option  {{ old('department_id') ?'selected' : '' }} value="{{ $department->id }}">{{ $department->abbr }}</option>
                                         @endforeach
                                    </select>

                                </div>

                            </div>
                        {{-- <div class="form-group row ">
                            <label for="email" class="col-lg-3 col-form-label font-weight-semibold">{{ __('Managed By') }}</label>

                            <div class="col-lg-9">
                                <input id="hod_id" type="text" class="form-control @error('hod') is-invalid @enderror" name="hod_id" value="" readonly required >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="form-group row">

                            <div class="col-lg-9">
                                <input id="password" hidden  value="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-lg-6 offset-lg-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register Lecture') }} <i class="icon-user-plus ml-2"></i>
                                </button>


                            </div>

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
