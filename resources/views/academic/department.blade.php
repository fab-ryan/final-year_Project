@extends('layouts.master')
@section('title','Department')
@section('content')


<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Manage Department</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#all-depart" class="nav-link active" data-toggle="tab">Manage Department</a></li>
            @if(Qs::userIsAcademic()) <li class="nav-item"><a href="#new-depart" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Create New Department</a></li>@endif
        </ul>

        <div class="tab-content">
                <div class="tab-pane fade show active" id="all-depart">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Abbreviation</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if($department->count())
                        @foreach ($department as $depart )


                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td class=" font-bold">{{ $depart->abbr }}</td>
                                <td>{{ $depart->description }}</td>
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
                                                <form method="post" action="{{ route('academic.destroy.department' ,$depart->id)}}">
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
                            {{ $department->links() }}
                            @else
                            No data
                            @endif
                        </tbody>
                    </table>
                </div>

            <div class="tab-pane fade" id="new-depart">

                <div class="row">
                    <div class="col-md-6">
                        <form class="ajax-store" method="post" action="{{ route('academic.create.department') }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Abbreviation <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input name="obbr" value="{{old('obbr') }}" required type="text" class="form-control" placeholder="Name of Abbreviation">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Description</label>
                                <div class="col-lg-9">
                                    <input name="description" value="{{ old('description') }}"  type="text" class="form-control" placeholder="Description of Department">
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

{{--  Departement List --}}


@endsection
