@extends('layout.site')

@section('stylesheet')
  <!-- DataTables -->
  <link href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>
  <link href="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>

  <link href="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>

@endsection

@section('content')
  <div class="container" data-aos="fade-up">

    <div class="section-title mt-5">
      <h2 style="text-align: center">My Enrolled Training List</h2>
    </div>
    @if(session()->has('status'))
      {!! session()->get('status') !!}
    @endif
    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
           cellspacing="0" width="100%" style="font-size: 14px">

      <thead>
      <tr>
        <th width="50">#</th>
        <th>Institute</th>
        <th>Training</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Status</th>

      </tr>
      </thead>
      <tbody>
      @forelse($trainings as $key => $val)
        <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
          <td class="p-1">{{ ($key+1) }}</td>
          <td class="p-1 text-capitalize">{{ $val->training->institute->name }}</td>
          <td class="p-1 text-capitalize">{{ $val->training->title }}</td>
          <td class="p-1 text-capitalize">{{ $val->training->start_date }}</td>
          <td class="p-1 text-capitalize">{{ $val->training->end_date }}</td>
          <td class="p-1 text-capitalize">
            <span class='text-danger'>{{ ($val->status=='inactive') ? $val->status : $val->status }}</span>
            @if($val->status=='inactive')
              <a class="btn btn-info" href="{{ route('institute.trainings.cancel.training',$val->id) }}">Cancel</a>
            @endif
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="text-center ">No result Found</td>

        </tr>
      @endforelse
      </tbody>
    </table>

  </div>
@endsection



