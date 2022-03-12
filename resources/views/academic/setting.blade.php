@extends('layouts.master')
@section('title','Setting')
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Academic Setting</h6>
        <h6 class="card-title"><strong>Current academic year: </strong> {{ $datas->current_session ?? '' }}</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#update-academic" class="nav-link active" data-toggle="tab">New Academic</a></li>
            @if(Qs::userIsAcademic()) <li class="nav-item"><a href="#view-academics" class="nav-link" data-toggle="tab"> view Academic</a></li>@endif
        </ul>

        <div class="tab-content">
                <div class="tab-pane fade show active" id="update-academic">
                     <form enctype="multipart/form-data" method="POST" action="{{ route('academic.settingUpdate') }}">
                     @csrf
                    <div class="row">
                    <div class="col-md-12  ">
                        <div class="form-group row">
                        <label class="col-lg-3 col-form-label font-weight-semibold">Name of System <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input name="system_name" value="{{ Qs::applicationName() }}" required type="text" class="form-control" placeholder="Name of projct" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="current_session" class="col-lg-3 col-form-label font-weight-semibold">Current Session <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <select data-placeholder="Choose..." required name="current_session" id="current_session" class="select-search form-control">
                                <option value="">{{ $datas->current_session ?? '' }}</option>
                                @for($y=date('Y', strtotime('- 0 years')); $y<=date('Y', strtotime('+ 5 years')); $y++)
                                    <option {{ ($s ?? '' == (($y-=1).'-'.($y+=1))) ? 'selected' : '' }}>{{ ($y-=1).'-'.($y+=1) }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label font-weight-semibold">Academic Start</label>
                        <div class="col-lg-6">
                            <input name="term_ends" value="{{ $datas->term_ends ?? '' }}" type="text" class="form-control date-pick" placeholder="Date Term Ends">
                        </div>
                        <div class="col-lg-3 mt-2">
                            <span class="font-weight-bold font-italic">M-D-Y or M/D/Y </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label font-weight-semibold">Academic End</label>
                        <div class="col-lg-6">
                            <input name="term_begins" value="{{ $datas->term_begins ?? '' }}" type="text" class="form-control date-pick" placeholder="Date Term Ends">
                        </div>
                        <div class="col-lg-3 mt-2">
                            <span class="font-weight-bold font-italic">M-D-Y or M/D/Y </span>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-danger">Save <i class="icon-store ml-2"></i></button>
                    </div>
                    </div>
                    </div>
                    </form>

                </div>

            <div class="tab-pane fade" id="view-academics">
                            <table class="table ">
                        <thead>
                        <tr>
                            <th>S/N</th>

                            <th>Current Session</th>
                            <th>Term Begin</th>
                            <th>Term Ends</>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>



                            @foreach ($infos as $info )


                            <tr>


                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $info->current_session }}</td>
                                <td>{{ $info->term_begins }}</td>
                                <td>{{ $info->term_ends }}
                                <td>
                                   <input class="toggle-class" id="setting_id" type="checkbox" data-id="{{$info->id}}" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-off="InActive" data-on="Active" {{ $info->status ? 'checked' : '' }}/>
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>

            </div>
        </div>
    </div>
</div>




@endsection

@section('scripts')
<script>
    $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var setting_id = $(this).data('id');
        console.log(setting_id);
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{ route('academic.change.status.setting') }}",
            data: {'status': status, 'setting_id': setting_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })
  </script>
@endsection
