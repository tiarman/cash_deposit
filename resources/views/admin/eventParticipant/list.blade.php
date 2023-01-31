@extends('layout.admin')

@section('stylesheet')
  <!-- DataTables -->
{{--  <link href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"--}}
        type="text/css"/>
{{--  <link href="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"--}}
        type="text/css"/>

{{--  <link href="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"--}}
        type="text/css"/>
  <style>
      .onoffswitch-inner:after {
          content: "Rejected";
          padding-right: 8px;
      }
      .onoffswitch-inner:before {
          content: "Approved";
          padding-right: 16px;
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
          <section class="panel table-responsive">
            <header class="panel-heading">
              <h2 class="panel-title">Event Participants List</h2>
            </header>
              <div  class="row mt-3">
                  <div class="col-md-4">
                      <div class="form-group">
                          <label class="control-label">Choose Participant Type</label>
                          <select name="designation" class="form-control @error('designation') is-invalid @enderror">
                              <option value="">Choose a Type</option>
                              {{-- @foreach($institutes as $institute)
                                <option value="{{ $institute->id }}" @selected($institute->id == old('designation'))>{{ $institute->name }}</option>
                              @endforeach --}}
                              <option value="1">Interested</option>
                              <option value="2">Invited</option>
                              <option selected value="2">All</option>
                          </select>
                          @error('designation')
                          <strong class="text-danger">{{ $errors->first('designation') }}</strong>
                          @enderror
                      </div>
                  </div>
              </div>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                     cellspacing="0" width="100%" style="font-size: 14px">
                <thead>
                <tr>
                  <th>SN</th>
                  <th>Name</th>
                  <th>Event Name</th>
                  <th>Institute</th>
                  <th width="150">Trade/Technology</th>
                  <th width="190">Distance From The Event (KM)</th>
                  <th>Type</th>
                  <th class="hidden-phone" >Action</th>
                </tr>
                </thead>
                <tbody>
{{--                @foreach($trainings as $key => $val)--}}
                  <tr class="gradeX">
                    <td class="p-1">{{ (1) }}</td>
                    <td class="p-1 text-capitalize">{{ "Mahir Anowar" }}</td>
                    <td class="p-1">{{ "Workshop 2022" }}</td>
                    <td class="p-1">{{ "Touch & Solve" }}</td>
                    <td class="p-1">{{ "Science" }}</td>
                    <td class="p-1">{{ "4.9" }}</td>
                    <td class="p-1">{{ "Invited" }}</td>

                    <td class="text-center hidden-phone p-1" width="120">
                        <div class="onoffswitch">
                            <input type="checkbox" checked name="onoffswitch" class="onoffswitch-checkbox"
{{--                                   @checked($val->status == \App\Models\Training::$statusArrays[1])--}}
                                   data-id="{{ 1 }}"
                                   id="myonoffswitch 1">
                            <label class="onoffswitch-label" for="myonoffswitch 1">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
{{--                        <a href="{{ route('admin.training.approval.member.list', 1) }}" class="btn btn-sm btn-outline-brown details-btn" style="cursor: pointer">Details</a>--}}
                    </td>
                  </tr>
                  <tr class="gradeX">
                    <td class="p-1">{{ (2) }}</td>
                    <td class="p-1 text-capitalize">{{ "Arif Hosen" }}</td>
                    <td class="p-1">{{ "Workshop 2022" }}</td>
                    <td class="p-1">{{ "Touch & Solve" }}</td>
                    <td class="p-1">{{ "Arts" }}</td>
                    <td class="p-1">{{ "2.4" }}</td>
                    <td class="p-1">{{ "Interested" }}</td>

                    <td class="text-center hidden-phone p-1" width="120">
                        <div class="onoffswitch">
                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"
{{--                                   @checked($val->status == \App\Models\Training::$statusArrays[1])--}}
                                   data-id="{{ 2 }}"
                                   id="myonoffswitch 2">
                            <label class="onoffswitch-label" for="myonoffswitch 2">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
{{--                        <a href="{{ route('admin.training.approval.member.list', 1) }}" class="btn btn-sm btn-outline-brown details-btn" style="cursor: pointer">Details</a>--}}
                    </td>
                  </tr>
{{--                @endforeach--}}
                </tbody>
              </table>
            </div>
          </section>
        </div>
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
          <strong>Are you sure you want to update this status?</strong>
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
