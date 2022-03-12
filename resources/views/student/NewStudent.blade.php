@extends('layouts.master')
@section('title','Student Registration')
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Student</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#all-classRoom" class="nav-link active" data-toggle="tab">Manage Student</a></li>
            @if(!Qs::userIsStudent() && !Qs::userIsLecture()) <li class="nav-item">
                <a href="#new-classRoom" class="nav-link" data-toggle="tab">
                    <i class="icon-plus2"></i> Register New Student</a></li>@endif
        </ul>

        <div class="tab-content">
                <div class="tab-pane fade show active" id="all-classRoom">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>S/N</th>

                            <th>Student Name</th>
                            <th>Registration Number</th>
                            <th>Level</th>
                            <th>class Name</th>
                            <th>Number</th>
                            <th>Academic Year</th>


                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>






                            @foreach ($student_infos as $student_info)



                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                               </td>

                                <td>{{ $student_info->user->name }}</td>
                                <td>{{ $student_info->regno }}</td>
                                <td>{{ $student_info->level->level_name }}</td>

                                <td>{{ $student_info->classroom->class_name }}</td>
                                <td>{{ $student_info->phone_number }}</td>
                                <td>{{ $student_info->setting->current_session }}
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






                <form method="POST" action="{{ route('hod.student.store') }}">
                        @csrf
                    <div class="row">
                        <div class="col-md-6">

                                <input  type="text"  name="department_id" value="{{ Qs::Save_department_Id()}}" hidden>






                        <div class="form-group row">
                            <label for="name" class="col-lg-3 col-form-label font-weight-semibold">{{ __('Name') }} <span class="text-danger">*</span></label>

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
                            <label for="email" class="col-lg-3 col-form-label font-weight-semibold">{{ __('Registration Number') }} <span class="text-danger">*</span> </label>

                            <div class="col-lg-9">
                                <input id="regno" type="text" class="form-control @error('regno') is-invalid @enderror" name="regno" value="{{ old('regno') }}" required >

                                @error('regno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-lg-3 col-form-label font-weight-semibold">{{ __('E-Mail Address') }} <span class="text-danger">*</span></label>

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
                            <label for="email" class="col-lg-3 col-form-label font-weight-semibold">{{ __('Phone Number') }} <span class="text-danger">*</span></label>

                            <div class="col-lg-9">
                                <input id="phone_number" type="phone_number" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required ">

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>







                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">level  <span class="text-danger">*</span></label>



                                <div class="col-lg-9">

                                    <select equired data-placeholder="Select Level" class="form-control select" name="level_id" id="level_id">
                                    <option value="" pacelholde="Select Level"></option>

                                        @foreach ($levels as $level )


                                    <option  {{ old('level_id') ? 'selected' : '' }} value="{{ $level->id }}">{{ $level->level_name }}</option>

                                        @endforeach
                                    </select>


                                </div>

                            </div>
                             <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Class Name <span class="text-danger">*</span></label>



                                <div class="col-lg-9">

                                    <select equired data-placeholder="Select Class name" class="form-control select" name="classroom_id" >
                                    <option value="" pacelholde="Select Class Name"></option>
                                        @foreach ( $className as $classroom )

                                    <option  {{ old('classroom_id') ?'selected' : '' }} value="{{ $classroom->id }}">{{ $classroom->class_name }}</option>

                                        @endforeach
                                    </select>


                                </div>

                            </div>


                        <div class="form-group row">

                            <div class="col-lg-9">
                                <input id="password" hidden type="password" class="form-control @error('password') is-invalid @enderror" value="password" name="password" required autocomplete="new-password">

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
                    </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>







@endsection
