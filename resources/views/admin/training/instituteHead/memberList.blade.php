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
              <h2 class="panel-title">Training Info</h2>
            </header>

            <div class="row">
              <div class="col-md-12">
                <h3 class="panel-sub-title text-center">{{ $training->title }}</h3>
              </div>
              <div class="col-md-6">
                <h6 class="mb-2">Start: <span class="bold-500">{{ $training->start_date }}</span></h6>
                <h6 class="mb-2">End: <span class="bold-500">{{ $training->start_date }}</span></h6>
                <h6 class="mb-2">Status: <span class="bold-500 bg bg-{{ $training->status }}">{{ $training->status }}</span></h6>
                <h6 class="mb-2">Type: <span class="bold-500">{{ $training->type->name }}</span></h6>
                <h6 class="mb-2">Participant Type: <span class="bold-500">
                    @foreach($training->participants as $type)
                      <span class="bg bg-success mr-2 text-white">{{$type->name}}</span>
                    @endforeach
                  </span></h6>
              </div>
              <div class="col-md-6 text-right">
                <h6 class="mb-2">Institute: <span class="bold-500">{{ $training->institute?->name }}</span></h6>
                <h6 class="mb-2">Creator: <span class="bold-500">{{ $training->user?->name_en }}</span></h6>
                <h6 class="mb-2">Members: <span class="bold-500">{{ count($training->members) }}</span></h6>
                <h6 class="mb-2">Created At: <span class="bold-500">{{ $training->created_at->format('Y-m-d') }}</span></h6>
                <h6 class="mb-2">Participant Limit: <span class="bold-500">{{ $training->participant_limit }}</span></h6>
              </div>
            </div>

            <header class="panel-heading">
              <h2 class="panel-title">Pending Members List</h2>
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
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Applied At</th>
                  <th class="hidden-phone" width="200">
                    <label for="all"> Select all <input type="checkbox" id="all"></label>
                    <span class="btn btn-sm btn-primary submitBtn" style="float: right" data-id="{{ $training->id }}">Submit</span>
                  </th>
                </tr>
                </thead>
                <tbody>
                @foreach($pendings as $key => $val)
                  <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                    <td class="p-1">{{ ($key+1) }}</td>
                    <td class="p-1 text-capitalize">{{ $val->name }}</td>
                    <td class="p-1 text-capitalize">{{ $val->phone }}</td>
                    <td class="p-1 text-capitalize">{{ $val->email }}</td>
                    <td class="p-1 text-capitalize">{{ $val->created_at->format('(h:i A) F d,Y') }}</td>
                    <td class="text-center hidden-phone p-1" width="200">
                      <input type="checkbox" name="members[]" class="mr-2" value="{{ $val->id }}" @checked($val->status == \App\Models\Training::$statusArrays[1])>
                      @if($val->status != \App\Models\Training::$statusArrays[1])
                        <a href="{{ route('admin.training.apply.member.update', ['id'=>$val->id, 'status' => \App\Models\TrainingMember::$statusArrays[1]]) }}"
                           class="btn btn-sm btn-success btn-action action_{{ $val->id }}" style="cursor: pointer">Accept</a>
                      @endif
                      @if($val->status != \App\Models\Training::$statusArrays[2])
                        <a href="{{ route('admin.training.apply.member.update', ['id'=>$val->id, 'status' => \App\Models\TrainingMember::$statusArrays[2]]) }}"
                           class="btn btn-sm btn-danger btn-action action_{{ $val->id }}" style="cursor: pointer">Reject</a>
                      @endif
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
              <header class="panel-heading">
                <h2 class="panel-title">Accepted Members List</h2>
              </header>
              <div class="panel-body">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                       cellspacing="0" width="100%" style="font-size: 14px">
                  <thead>
                  <tr>
                    <th width="50">SN</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Applied At</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($accepted as $key => $val)
                    <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                      <td class="p-1">{{ ($key+1) }}</td>
                      <td class="p-1 text-capitalize">{{ $val->name }}</td>
                      <td class="p-1 text-capitalize">{{ $val->phone }}</td>
                      <td class="p-1 text-capitalize">{{ $val->email }}</td>
                      <td class="p-1 text-capitalize">{{ $val->created_at->format('(h:i A) F d,Y') }}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
                <header class="panel-heading">
                  <h2 class="panel-title">Rejected Members List</h2>
                </header>
                <div class="panel-body">
                  <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                         cellspacing="0" width="100%" style="font-size: 14px">
                    <thead>
                    <tr>
                      <th width="50">SN</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Applied At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rejected as $key => $val)
                      <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                        <td class="p-1">{{ ($key+1) }}</td>
                        <td class="p-1 text-capitalize">{{ $val->name }}</td>
                        <td class="p-1 text-capitalize">{{ $val->phone }}</td>
                        <td class="p-1 text-capitalize">{{ $val->email }}</td>
                        <td class="p-1 text-capitalize">{{ $val->created_at->format('(h:i A) F d,Y') }}</td>
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

      {{--$(document).on('click', '.btn-action', function () {--}}
      {{--  const $this = $(this);--}}
      {{--  var status = $(this).data('status');--}}
      {{--  var id = $(this).data('id')--}}
      {{--  // var isChecked = $(this).is(":checked");--}}
      {{--  // if (isChecked) {--}}
      {{--  //   status = 'reject';--}}
      {{--  // }--}}
      {{--  $.ajax({--}}
      {{--    url: "{{ route('admin.approval.member.list.update') }}",--}}
      {{--    method: "post",--}}
      {{--    dataType: "html",--}}
      {{--    data: {'id': id, 'status': status},--}}
      {{--    success: function (data) {--}}
      {{--      if (data === "success") {--}}
      {{--        window.location.reload()--}}
      {{--      }--}}
      {{--    }--}}
      {{--  });--}}
      {{--})--}}

      $('.submitBtn').click(function () {
        let values = $.map($('input[name="members[]"]:checked'), function (c) {
          return c.value;
        })
        let rejected = $.map($('input[name="members[]"]:not(:checked)'), function (c) {
          return c.value;
        })
        if (values.length < 1) {
          values = [];
        }
        const id = $(this).data('id')
        $.ajax({
          url: "{{ route('admin.training.apply.member.list.update') }}",
          method: "post",
          dataType: "html",
          data: {'id': id, 'accepted': values, 'rejected': rejected},
          success: function (data) {
            // console.log(data)
            if (data === "success") {
              window.location.reload()
            }
          }
        });
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
