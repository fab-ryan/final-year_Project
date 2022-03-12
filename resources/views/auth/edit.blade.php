@extends('layouts.master')
@section('title','Edit User')
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">User Name : {{ Auth::user()->name }}</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
         <div class="row">

                    <div class="col-md-6">
                        @if (Qs::userIsAcademic())
                        <form method="POST" action="{{ route('academic.user.update',Auth::user()->id) }}">
                        @elseif (Qs::userIsHod())
                        <form method="POST" action="{{ route('hod.user.update',Auth::user()->id) }}">
                        @elseif (Qs::userIsLectur())
                        <form method="POST" action="{{ route('lecture.user.update',Auth::user()->id) }}">
                        @elseif (Qs::userIsStuden())
                        <form method="POST" action="{{ route('student.user.update',Auth::user()->id) }}">

                        @endif
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-lg-3 col-form-label font-weight-semibold">{{ __('Name') }}</label>

                            <div class="col-lg-9">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user_info->name }}"  required autocomplete="name" autofocus>

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
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user_info->email}}"  required  readonly>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if(!Qs::userIsAcademic())
                        <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Department </span></label>



                                <div class="col-lg-9">

                                <input id="email" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{  Qs::Check_UserDepartment()}}"  required  readonly>


                                </div>

                            </div>

                            @endif
                        <div class="form-group row">
                            <label for="confirmed" class="col-lg-3 col-form-label font-weight-semibold">{{ __('Password') }}</label>

                            <div class="col-lg-9">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-lg-3 col-form-label font-weight-semibold">{{ __('Confirm Password') }}s<span class="text-danger">*</span> </label>

                            <div class="col-lg-9">
                                <input id="password_confirmation" type="password" class="form-control @error('confirmed') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-lg-6 offset-lg-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Update User') }} <i class="icon-user-plus ml-2"></i>
                                </button>


                            </div>

                        </div>
                    </form>
                    </div>
         </div>
    </div>

@endsection
