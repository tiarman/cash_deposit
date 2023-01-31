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
      .onoffswitch-inner:after {
          content: "Reject";
          padding-right: 16px;
      }
      .onoffswitch-inner:before {
          content: "Accept";
          padding-right: 10px;
          padding-left: unset;
      }
      .details-btn{
          float: right;
          margin-top: -39px;
      }
  </style>

@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">All Trainings</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                     cellspacing="0" width="100%" style="font-size: 14px">
                <thead>
                <tr>
                  <th width="50">SN</th>
                  <th>Title</th>
                  <th>Period</th>
                  <th>Institute</th>
                  <th>Members</th>
                  <th class="hidden-phone" width="40">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($trainings as $key => $val)
                  <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                    <td class="p-1">{{ ($key+1) }}</td>
                    <td class="p-1 text-capitalize">{{ $val->title }}</td>
                    <td class="p-1">{{ $val->start_date . ' - ' . $val->end_date }}</td>
                    <td class="p-1">{{ $val->institute?->name }}</td>
                    <td class="p-1">{{ $val->members_count ?? 0 }}</td>

                    <td class="text-center hidden-phone p-1" width="170">
                        <div class="onoffswitch">
                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"
                                   @checked($val->status == \App\Models\Training::$statusArrays[1])
                                   data-id="{{ $val->id }}"
                                   id="myonoffswitch{{ ($key+1) }}">
                            <label class="onoffswitch-label" for="myonoffswitch{{ ($key+1) }}">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                        <a href="{{ route('admin.training.approval.member.list', $val->id) }}" class="btn btn-sm btn-outline-brown details-btn" style="cursor: pointer">Details</a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModal"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 60%">
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="font-size: 25px;" class="text-center">Member Information</h4>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
              <path fill="none" d="M0 0h24v24H0z"></path>
              <path fill="currentColor" d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"></path>
            </svg>
          </button>
        </div>
        <div class="modal-body" style="font-size: 20px;">
          <div class="add-wrap table-responsive">
            <table class="table table-bordered">
              {{--              <thead>--}}
              {{--              <tr>--}}
              {{--                <th scope="col">#</th>--}}
              {{--                <th scope="col">First</th>--}}
              {{--                <th scope="col">Last</th>--}}
              {{--                <th scope="col">Handle</th>--}}
              {{--              </tr>--}}
              {{--              </thead>--}}
              <tbody>
              <tr>
                <td class="p-1"><strong> Name(English) :</strong></td>
                <td class="p-1"><span id="name_en"></span></td>
                <td class="p-1"><strong> Name(Bangla) :</strong></td>
                <td class="p-1"><span id="name_bn"></span></td>
              </tr>
              <tr>
                <td class="p-1"><strong>Email :</strong></td>
                <td class="p-1"><span id="email"></span></td>
                <td class="p-1"><strong>Phone :</strong></td>
                <td class="p-1"><span id="phone"></span></td>
              </tr>
              <tr>
                <td class="p-1"><strong>Father Name :</strong></td>
                <td class="p-1"><span id="father_name"></span></td>
                <td class="p-1"><strong>Mother Name :</strong></td>
                <td class="p-1"><span id="mother_name"></span></td>
              </tr>
              <tr>
                <td class="p-1"><strong>NID :</strong></td>
                <td class="p-1"><span id="nid"></span></td>
                <td class="p-1"><strong>Date of birth :</strong></td>
                <td class="p-1"><span id="dob"></span></td>
              </tr>
              <tr>
                <td class="p-1"><strong>Address :</strong></td>
                <td class="p-1" colspan="3">
                  <span id="village"></span>
                  <span id="ps"></span>
                  <span id="po"></span>
                  <span id="district"></span>
                  <span id="division"></span></td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
        {{--        <div class="modal-footer">--}}
        {{--          <button type="button" class="btn btn-success btn-sm yes-btn">Yes</button>--}}
        {{--        </div>--}}
      </div>
    </div>
  </div>

  <div class="modal fade" id="updateTrainingStatusModal" tabindex="-1" role="dialog" aria-labelledby="updateTrainingStatusModal"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Confirmation</h4>
        </div>
        <div class="modal-body">
          <strong>Are you sure to update this training?</strong>
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
        $(document).on('change', 'input[name="onoffswitch"]', function () {
            var status = '{{ \App\Models\Training::$statusArrays[2] }}';
            var id = $(this).data('id')
            var isChecked = $(this).is(":checked");
            if (isChecked) {
                status = '{{ \App\Models\Training::$statusArrays[1] }}';
            }
            $.ajax({
                url: "{{ route('admin.ajax.update.training.status') }}",
                method: "post",
                dataType: "html",
                data: {'id': id, 'status': status},
                success: function (data) {
                    if (data === "success") {
                    }
                }
            });
        })




        // $('#datatable-buttons').DataTable();

      // var table = $('#datatable-buttons').DataTable({
      //   lengthChange: false,
      //   buttons: ['copy', 'excel', 'pdf', 'colvis']
      // });
      //
      // table.buttons().container()
      //   .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

      $(document).on('click', '.btn-action', function () {
        var pid = $(this).data('id');
        var status = $(this).data('status');
        $('.yes-btn').data('id', pid);
        $('.yes-btn').data('status', status);
        $('#updateTrainingStatusModal').modal('show')
      })

      {{--function updateStatus(id, status) {--}}
      {{--  $.ajax({--}}
      {{--    url: "{{ route('admin.ajax.update.training.status') }}",--}}
      {{--    method: "post",--}}
      {{--    dataType: "html",--}}
      {{--    data: {'id': id, 'status': status},--}}
      {{--    success: function (data) {--}}
      {{--      if (data === "success") {--}}
      {{--        $('#updateTrainingStatusModal').modal('hide')--}}
      {{--        window.location.reload()--}}
      {{--      }--}}
      {{--    }--}}
      {{--  });--}}
      {{--}--}}

      $(document).on('click', '.yes-btn', function () {
        updateStatus($(this).data('id'), $(this).data('status'))
      });
    })
  </script>

@endsection
