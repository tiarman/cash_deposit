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
      #datatable-buttons td
      {
          text-align: center;
          vertical-align: middle;
      }
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
              <h2 class="panel-title">Applied For</h2>
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
                  <th>Title</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  {{--                  <th>Job Posts</th>--}}
                  <th width="200">Place</th>
                  <th width="200">Status</th>
                  {{--                  <th>Associates</th>--}}
                  <th class="hidden-phone" width="40">Option</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $key => $val)
                  <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                    <td class="p-1">{{ ($key+1) }}</td>
                    <td class="p-1 ">{{ $val->jobEvent?->title}}</td>
                    <td class="p-1">{{ $val->jobEvent?->start_date }}</td>
                    <td class="p-1">{{ $val->jobEvent?->end_date }}</td>
                   <td class="p-1">{{ $val->jobEvent?->place }}</td>
                                            <td class="p-1 text-capitalize">{{ $val->status }}</td>

                    @if(\App\Helper\CustomHelper::canView('Manage Industry Post|Delete Industry Post', 'Industry'))
                      <td class="text-center p-1" width="100">
                        @if(\App\Helper\CustomHelper::canView('Manage Industry Post', 'Industry'))

                          <a href="{{ route('admin.event.job.manage',$val->jobEvent?->id) }}"
                             class="btn btn-sm btn-primary"> <i class="fa fa-cogs"></i> </a>
                        @endif
                        @if(\App\Helper\CustomHelper::canView('Delete Industry Post', 'Industry'))
                          <span class="btn btn-sm btn-danger btn-delete delete_{{ $val->id }}" style="cursor: pointer"
                                data-id="{{ $val->id }}"><i
                              class="fa fa-trash-o"></i></span>
                        @endif
                      </td>
                    @endif
                  </tr>
                @endforeach
                  {{-- <td class="p-1">{{ $val->start_date }}</td>
                  <td class="p-1">{{ $val->end_date }}</td>
                  <td class="p-1">{{ $val->month_name }}</td>
                  <td class="p-1">{{ $val->quarter_no }}</td>
                  <td class="p-1">{{ \App\Models\User::where('id',$val->created_by)->pluck('name_en')->first() }}</td> --}}
                  {{-- <td class="p-1">{{ \App\Models\User::where('id',$val->updated_by)->pluck('name_en')->first() ?? 'N\A' }}</td>
                  @if(\App\Helper\CustomHelper::canView('Manage Fiscal Period|Delete Fiscal Period', 'Super Admin'))
                      <td class="center hidden-phone p-1" width="100">
                          @if(\App\Helper\CustomHelper::canView('Manage Fiscal Period', 'Super Admin'))
                              <a href="{{ route('admin.fiscalPeriod.manage', [$val->id]) }}"
                                 class="btn btn-sm btn-success"> <i class="fa fa-edit"></i> </a>
                          @endif
                          @if(\App\Helper\CustomHelper::canView('Delete Fiscal Period', 'Super Admin'))
                              <span class="btn btn-sm btn-danger btn-delete delete_{{ $val->id }}" style="cursor: pointer"
                                    data-id="{{ $val->id }}"><i class="fa fa-trash-o"></i></span>
                          @endif
                      </td>
                  @endif --}}
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


  <script>
    $(document).ready(function () {
      // $('#datatable-buttons').DataTable();

      // var table = $('#datatable-buttons').DataTable({
      //   lengthChange: false,
      //   buttons: ['copy', 'excel', 'pdf', 'colvis']
      // });
      //
      // table.buttons().container()
      //   .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');


      {{--$(document).on('change', 'input[name="onoffswitch"]', function () {--}}
      {{--  var status = 'inactive';--}}
      {{--  var id = $(this).data('id')--}}
      {{--  var isChecked = $(this).is(":checked");--}}
      {{--  if (isChecked) {--}}
      {{--    status = 'active';--}}
      {{--  }--}}
      {{--  $.ajax({--}}
      {{--    url: "{{ route('admin.ajax.update.user.status') }}",--}}
      {{--    method: "post",--}}
      {{--    dataType: "html",--}}
      {{--    data: {'id': id, 'status': status},--}}
      {{--    success: function (data) {--}}
      {{--      if (data === "success") {--}}
      {{--      }--}}
      {{--    }--}}
      {{--  });--}}
      {{--})--}}


      $(document).on('click', '.yes-btn', function () {
        var pid = $(this).data('id');
        var $this = $('.delete_' + pid)
        $.ajax({
          url: "{{ route('admin.division.destroy') }}",
          method: "DELETE",
          dataType: "html",
          data: {id: pid},
          success: function (data) {
            if (data === "success") {
              $('#userDeleteModal').modal('hide')
              $this.closest('tr').css('background-color', 'red').fadeOut();
            }
          }
        });
      })

      $(document).on('click', '.btn-delete', function () {
        var pid = $(this).data('id');
        $('.yes-btn').data('id', pid);
        $('#userDeleteModal').modal('show')
      });
    })
  </script>
@endsection
