@extends('layout.admin')

@section('stylesheet')
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">View training</h2>
            </header>
            <div class="panel-body">
              {{--              @if(\App\Helper\CustomHelper::canView('List Of Training', 'Super Admin'))--}}
              <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                  <a href="{{ route('admin.training.list') }}" class="brn btn-success btn-sm">List of Trainings</a>
                  @if($training->status != \App\Models\Training::$statusArrays[3])
                    <a href="{{ route('admin.training.make.completed', $training->id) }}" class="brn btn-info btn-sm">Make Completed</a>
                  @endif
                </div>
              </div>
              {{--              @endif--}}
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              <div class="row">
                <div class="col-md-12">
                  <h2 class="panel-sub-title text-center">{{ $training->title }}</h2>
                </div>
                <div class="col-md-6">
                  <h4>Period: {{ \App\Helper\CustomHelper::makeDateFormat($training->start_date) . ' - ' . \App\Helper\CustomHelper::makeDateFormat($training->end_date) }}</h4>
                  <h6>Type: {{ $training->type->name }}</h6>
                  <h6>Status: {{ $training->status }}</h6>
                  <h6>Creator: {{ $training->user->name_en }}</h6>
                </div>
                <div class="col-md-6 text-right">
                  <h4>Country: {{ $training->country->name }}</h4>
                  <h6>Division: {{ $training->division->name }}</h6>
                  <h6>District: {{ $training->district->name }}</h6>
                  <h6>Participate: {{ $training->participate_type }}</h6>
                </div>
                <div class="col-md-12 mt-2 mb-2">
                  {!! $training->description !!}
                </div>

                <div class="col-md-12 mt-2">
                  <h2 class="panel-title">Accepted List</h2>
                </div>
                <div class="col-md-12 table-responsive">
                  <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                         cellspacing="0" width="100%" style="font-size: 14px">
                    <thead>
                    <tr>
                      <th width="50">#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Institute</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($accepted as $key => $val)
                      <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                        <td class="p-1">{{ ($key+1) }}</td>
                        <td class="p-1 text-capitalize">{{ $val->name }}</td>
                        <td class="p-1">{{ $val->email }}</td>
                        <td class="p-1">{{ $val->phone }}</td>
                        <td class="p-1">{{ $val->user?->institute?->name }}</td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>

                <div class="col-md-12">
                  <h2 class="panel-title">Rejected List</h2>
                </div>
                <div class="col-md-12 table-responsive">
                  <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                         cellspacing="0" width="100%" style="font-size: 14px">
                    <thead>
                    <tr>
                      <th width="50">#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Institute</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rejected as $key => $val)
                      <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                        <td class="p-1">{{ ($key+1) }}</td>
                        <td class="p-1 text-capitalize">{{ $val->name }}</td>
                        <td class="p-1">{{ $val->email }}</td>
                        <td class="p-1">{{ $val->phone }}</td>
                        <td class="p-1">{{ $val->user?->institute?->name }}</td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
  <script src="{{ asset('assets/admin/plugins/select2/js/select2.min.js') }}"></script>
  <script>
    $(document).ready(function () {
      $('.select2').select2({
        maximumSelectionLength: 2,
      })

      $('#all').change(function () {
        if ($(this).is(':checked')) {
          $('input[name="members[]"]').prop("checked", true)
        } else {
          $('input[name="members[]"]').prop("checked", false)
        }
      })
    })
  </script>
@endsection
