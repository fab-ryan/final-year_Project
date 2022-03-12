@extends('layouts.master')
@section('title','Class Room')
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Levels</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">


        <div class="tab-content">
                <div class="tab-pane fade show active" id="all-depart">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>S/N</th>

                            <th>Name</th>
                            <th>Courses</th>

                            @if(Qs::userIsAcademic())
                            <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>




                            @foreach ($classes as $classe )



                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $classe->class_name }}</td>
                                <td>

                        </td>

                                @if(Qs::userIsAcademic())
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-left">

                                                {{--Edit--}}
                                                <a href="{{ route('academic.level.edit',$level ?? ''->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>


                                                {{--Delete--}}
                                                <form method="post" action="{{ route('academic.destroy.level' ,$level ?? ''->id)}}"  onsubmit="return confirm('are You sure you want to delete {{ __($level ?? ''->name) }}');">
                                                    @csrf
                                                     @method('delete')
                                                <button type="submit" class="dropdown-item"><i class="icon-trash"></i> Delete</button>
                                                </form>


                                            </div>
                                        </div>
                                    </div>
                                </td>
                                 @endif
                            </tr>
                         @endforeach

                        </tbody>
                    </table>
                </div>


        </div>
    </div>
</div>

@endsection
