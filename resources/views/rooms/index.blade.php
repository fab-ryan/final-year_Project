@extends('layouts.master')
@section('title','Rooms')
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Rooms And Labs</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#all-depart" class="nav-link active" data-toggle="tab">Manage Rooms And Labs</a></li>
            @if(Qs::userIsAcademic()) <li class="nav-item"><a href="#new-depart" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Create New Room</a></li>@endif
        </ul>

        <div class="tab-content">
                <div class="tab-pane fade show active" id="all-depart">
                    <table class="table ">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Lab Or Class</th>
                            <th>Room</th>
                            <th>Descrption</th>
                            <th>Department</th>
                            <th>Status</>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $room )



                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $room->lab_class }}</td>
                                <td>{{ $room->room}}</td>
                                <td>{{ $room->description}}</td>
                                <td>{{ $room->department->abbr }}
                                <td>
                                      <input class="toggle-class" id="toggle-class" type="checkbox" data-id="{{$room->id}}" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-off="InActive" data-on="Available" {{ $room->status ? 'checked' : '' }}/>

                                </td>
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
                                                <a id="" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                <form method="post" id="item-delete-" action="" class="hidden">@csrf @method('delete')</form>
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
                        <form class="ajax-store" method="post" action="{{ route('academic.rooms.create') }}">
                            @csrf
                             <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Labs Or Class <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <select equired data-placeholder="Select Class and Labs" class="form-control select" name="lab_class">
                                        <option></option>

                                    <option  {{ old('lab_class') ?'selected' : '' }} value="Labs">Lab</option>
                                    <option  {{ old('lab_class') ?'selected' : '' }} value="Class">Class</option>

                                    </select>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Room Name  <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input name="room" value="{{old('room') }}" required type="text" class="form-control" placeholder="Name of Room">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Description</label>
                                <div class="col-lg-9">
                                    <input name="description" value="{{ old('description') }}"  type="text" class="form-control" placeholder="Description of Room">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Department <span class="text-danger">*</span></label>

                                <div class="col-lg-9">
                                    <select equired data-placeholder="Select Department" class="form-control select" name="department_id">
                                    <option></option>
                                    @foreach ($departments as $department )


                                    <option  {{ old('department_id') ?'selected' : '' }} value="{{ $department->id }}">{{ $department->abbr }}</option>
                                         @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Status <span class="text-danger">*</span></label>

                                <div class="col-lg-9">
                                    <select equired data-placeholder="Select status" class="form-control select" name="status">
                                        <option></option>
                                    <option {{ old('status') ?'selected' : '' }} value="1" pacelholde="Labs And Class">Valiable</option>
                                    <option  {{ old('status') ?'selected' : '' }} value="0">Unvaliable</option>

                                    </select>
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
@section('scripts')
<script>

$(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var room_id = $(this).data('id');
        console.log(room_id);
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{ route('academic.change.status') }}",
            data: {'status': status, 'room_id': room_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })
  </script>
  @endsection
