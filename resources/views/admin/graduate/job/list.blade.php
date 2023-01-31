@extends('layout.admin')

@section('stylesheet')
  <!-- DataTables -->
  <link href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>
  <link href="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>

  <link href="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>

  <style>
      /*#datatable-buttons td*/
      /*{*/
      /*    text-align: center;*/
      /*    vertical-align: middle;*/
      /*}*/
      /*#datatable-buttons a*/
      /*{*/
      /*    !*width: 100%;*!*/
      /*    display: block;*/
      /*}*/

  </style>
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Applied Jobs</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                  {{--                  <a href="{{ route('admin.event.job.create') }}" class="brn btn-success btn-sm">New Event</a>--}}
                </div>
              </div>
              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                     cellspacing="0" width="100%" style="font-size: 14px">

                <thead>
                <tr>
                  <th width="50">#</th>
                  <th>Job Title</th>
                  <th width="200">Position</th>
                  <th>Application Deadline</th>
                  <th>Location</th>
{{--                  <th class="hidden-phone" width="40">Option</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $key => $val)
                  <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                    <td class="p-1">{{ ($key+1) }}</td>
                    <td class="p-1 text-capitalize">{{ $val->post?->job_title }}</td>
                    <td class="p-1">{{ $val->post?->position }}</td>
                    <td class="p-1">{{ $val->post?->application_deadline }}</td>
                    <td class="p-1">{{ $val->post?->location }}</td>
                    {{--                    <td class="p-1">{{ $val->status }}</td>--}}
                    {{--                    <td class="p-1 text-capitalize">{{ \App\Helper\CustomHelper::userRoleName($val) }}</td>--}}
                    {{--                                        <td width="200" class="p-1">{{ date('F d, Y h:i A', strtotime($val->created_at)) }}</td>--}}
{{--                    <td class="p-1 text-capitalize">{{ $val->status }}</td>--}}
                    {{--                    @endif--}}
{{--                    @if(\App\Helper\CustomHelper::canView('Manage Industry Post|Delete Industry Post', 'Industry'))--}}
{{--                      <td class="text-center p-1" width="100">--}}
{{--                        @if(\App\Helper\CustomHelper::canView('Manage Industry Post', 'Industry'))--}}

{{--                          <a href="{{ route('admin.event.job.manage',$val->id) }}"--}}
{{--                             class="btn btn-sm btn-primary"> <i class="fa fa-cogs"></i> </a>--}}
{{--                        @endif--}}
{{--                        @if(\App\Helper\CustomHelper::canView('Delete Industry Post', 'Industry'))--}}
{{--                          <span class="btn btn-sm btn-danger btn-delete delete_{{ $val->id }}" style="cursor: pointer"--}}
{{--                                data-id="{{ $val->id }}"><i--}}
{{--                              class="fa fa-trash-o"></i></span>--}}
{{--                        @endif--}}
{{--                      </td>--}}
{{--                    @endif--}}
                  </tr>
                  @endforeach
                  </tr>
                </tbody>
              </table>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="userDeleteModal" tabindex="-1" role="dialog" aria-labelledby="userDeleteModal"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Delete Event</h4>
        </div>
        <div class="modal-body">
          <strong>Are you sure to delete this event?</strong>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-success btn-sm yes-btn">Yes</button>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('script')
  <!-- Required datatable js -->
  <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <!-- Buttons examples -->
  <script src="{{ asset('assets/admin/plugins/datatables/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/jszip.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/pdfmake.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/vfs_fonts.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/buttons.print.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/buttons.colVis.min.js') }}"></script>
  <!-- Responsive examples -->
  <script src="{{ asset('assets/admin/plugins/datatables/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

@endsection
