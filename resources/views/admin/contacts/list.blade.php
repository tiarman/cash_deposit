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
              <h2 class="panel-title">Contacts List</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                     cellspacing="0" width="100%" style="font-size: 14px">
                <thead>
                <tr>
                  <th width="20">SN</th>
                  <th width="280">From</th>
                  <th width="150">Type</th>
                  <th width="250">Subject</th>
                  <th class="hidden-phone" width="150">Description</th>
                  <th width="150">Attachments</th>
                  <th class="hidden-phone" >Action</th>
                </tr>
                </thead>
                <tbody>
{{--                @foreach($trainings as $key => $val)--}}
                  <tr class="gradeX">
                    <td class="p-1">{{ (1) }}</td>
                    <td class="p-1">{{ "Agrani Bank" }} by {{ "Arif Hosen" }}, AD, {{ "01548578845" }} </td>
                    <td class="p-1">{{ "Complain" }}</td>
                    <td class="p-1">{{ "The State of Affairs" }}</td>
                    <td class="hidden-phone p-1"> <a class="btn btn-sm btn-outline-blue-grey">Click to View Description</a> </td>
                    <td class="p-1"><button class="btn"><i class="fa fa-download"></i> Download</button></td>
                    <td class="hidden-phone p-1" width="120">
                        <select name="designation" class="form-control @error('designation') is-invalid @enderror">
                            <option value="">Choose a Type</option>
                            {{-- @foreach($institutes as $institute)
                              <option value="{{ $institute->id }}" @selected($institute->id == old('designation'))>{{ $institute->name }}</option>
                            @endforeach --}}
                            <option value="1">DD</option>
                            <option selected value="2">Seen</option>
                            <option value="3">Resolved</option>
                            <option value="4">Addressed</option>
                            <option value="5">Ignored</option>
                        </select>
                    </td>
                  </tr>
                  <tr class="gradeX">
                    <td class="p-1">{{ (2) }}</td>
                    <td class="p-1">{{ "Standard Chartered Bank" }} by {{ "Towhidul Islam" }}, AD, {{ "01548578845" }} </td>
                    <td class="p-1">{{ "Information" }}</td>
                    <td class="p-1">{{ "Personnel Information" }}</td>
                    <td class="hidden-phone p-1"> <a class="btn btn-sm btn-outline-blue-grey">Click to View Description</a> </td>
                    <td class="p-1"><button class="btn"><i class="fa fa-download"></i> Download</button></td>
                    <td class="hidden-phone p-1" width="120">
                        <select name="designation" class="form-control @error('designation') is-invalid @enderror">
                            <option value="">Choose a Type</option>
                            {{-- @foreach($institutes as $institute)
                              <option value="{{ $institute->id }}" @selected($institute->id == old('designation'))>{{ $institute->name }}</option>
                            @endforeach --}}
                            <option value="1">DD</option>
                            <option value="2">Seen</option>
                            <option value="3">Resolved</option>
                            <option selected value="4">Addressed</option>
                            <option value="5">Ignored</option>
                        </select>
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
