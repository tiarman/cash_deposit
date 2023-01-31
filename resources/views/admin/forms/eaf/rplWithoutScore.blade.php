@extends('layout.admin')

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
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">EAF RPL Without Score Application</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              {{--              <div class="row">--}}
              {{--                <div class="col-md-12 text-right">--}}
              {{--                  <a href="{{ route('admin.eaf.form.list.idg', ['type' => 'download']) }}" class="btn btn-info btn-sm">Download As XLSX</a>--}}
              {{--                </div>--}}
              {{--              </div>--}}
              <div class="table-responsive">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                       cellspacing="0" width="100%" style="font-size: 14px">

                  <thead>
                  <tr>
                    <th width="50">#</th>
                    <th>Applicant</th>
                    <th>Institute</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($forms as $key => $val)
                    <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                      <td class="p-1">{{ ($key+1) }}</td>
                      <td class="p-1">
                        <span class="text-capitalize">{{ $val->applicant?->name_en }}</span><br>
                        <span>{{ $val->applicant?->email }}</span><br>
                        <span>{{ $val->applicant?->phone }}</span>
                      </td>
                      <td class="p-1">
                        <span class="text-capitalize">{{ $val->institute?->name }}</span><br>
                        <span>{{ $val->institute?->email }}</span><br>
                        <span>{{ $val->institute?->phone }}</span>
                      </td>
                      <td class="p-1">{{ ucfirst($val->type) }}</td>
                      <td class="p-1">{{ ucfirst($val->category) }}</td>
                      <td class="p-1">
                        <form action="{{ route('admin.eaf.form.list.without.score.update.status') }}" method="POST">
                          @csrf
                          <input type="hidden" name="id" value="{{ $val->id }}">
                          <select name="status" class="form-control" onchange="this.form.submit()">
                            <option value="">Choose one</option>
                            <option value="save" @selected(strtolower($val->status) == 'save')>Save</option>
                            <option value="submited" @selected(strtolower($val->status) == 'submited')>Submitted</option>
                          </select>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
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
          <h4>Delete Upazila</h4>
        </div>
        <div class="modal-body">
          <strong>Are you sure to delete this upazila?</strong>
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
    })
  </script>
@endsection
