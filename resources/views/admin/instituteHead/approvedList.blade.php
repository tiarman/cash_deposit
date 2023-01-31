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
              <h2 class="panel-title">Approved Members</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
                @if(\App\Helper\CustomHelper::canView('Create Institute User', 'Super Admin'))
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                      <a href="{{ route('admin.institute.head.registration') }}" class="brn btn-brown btn-sm">Pending List</a>
                    </div>
                  </div>
                @endif
              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                     cellspacing="0" width="100%" style="font-size: 14px">

                <thead>
                <tr>
                  <th width="50">SN</th>
                  <th>Name</th>
                  <th>Details</th>
                  <th>Designation</th>
                  @if(\App\Helper\CustomHelper::canView('Manage Institute User|Delete Institute User', 'Super Admin'))
                    <th class="hidden-phone" width="40">Action</th>
                  @endif
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $key => $val)
                  <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                    <td class="p-1">{{ ($key+1) }}</td>
                    <td class="p-1 text-capitalize">{{ $val->name_en }}</td>
                    <td class="p-1 text-center">
                      <span class="btn btn-sm btn-info btn-view view_{{ $val->id }}"
                            style="cursor: pointer"
                            data-id="{{ $val->id }}">View</span>
                    </td>
                    <td class="p-1 ">{{ \App\Helper\CustomHelper::userRoleName($val) }}</td>
                    @if(\App\Helper\CustomHelper::canView('Manage Institute User|Delete Institute User', 'Super Admin'))
                      <td class="center hidden-phone p-1 text-center" width="200">
                        @if($val->status == \App\Models\User::$statusArrays[1])
                          @if(\App\Helper\CustomHelper::canView('Manage Institute User', 'Super Admin'))
                            <span class="btn btn-sm btn-danger btn-reject reject_{{ $val->id }}" style="cursor: pointer"
                                  data-id="{{ $val->id }}">Reject</span>
                          @endif
                            @if(\App\Helper\CustomHelper::canView('Manage Institute User', 'Super Admin'))
                              <span class="btn btn-sm btn-primary btn-pending pending_{{ $val->id }}"
                                    style="cursor: pointer"
                                    data-id="{{ $val->id }}">Send to pending</span>
                            @endif
                        @endif
                      </td>
                    @endif
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
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path fill="currentColor" d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"></path></svg>
          </button>
        </div>
        <div class="modal-body" style="font-size: 20px;">
          <div class="add-wrap">
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
                <td class="p-1"><strong>Address:</strong></td>
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
      $(document).on('click', '.btn-pending', function () {
        const $this = $(this);
        var status = 'inactive';
        var id = $(this).data('id')
        // var isChecked = $(this).is(":checked");
        // if (isChecked) {
        //   status = 'inactive';
        // }
        $.ajax({
          url: "{{ route('admin.ajax.update.registration.status') }}",
          method: "post",
          dataType: "html",
          data: {'id': id, 'status': status},
          success: function (data) {
            if (data === "success") {
              $this.addClass('d-none')
              $this.closest('tr').css('background-color', 'blue').fadeOut();
            }
          }
        });
      })
      $(document).on('click', '.btn-reject', function () {
        const $this = $(this);
        var status = 'rejected';
        var id = $(this).data('id')
        // var isChecked = $(this).is(":checked");
        // if (isChecked) {
        //   status = 'rejected';
        // }
        $.ajax({
          url: "{{ route('admin.ajax.update.registration.status') }}",
          method: "post",
          dataType: "html",
          data: {'id': id, 'status': status},
          success: function (data) {
            if (data === "success") {
              $this.addClass('d-none')
              $this.closest('tr').css('background-color', 'green').fadeOut();
            }
          }
        });
      })
      $(document).on('click', '.btn-view', function () {
        var id = $(this).data('id');
        $.ajax({
          type:'GET',
          url:'{{ route("admin.ajax.user.details") }}',
          data: {'id': id },
          success:function (data){
            console.log(data)
            $("#name_en").html(data.name_en);
            $("#name_bn").html(data.name_bn);
            $("#phone").html(data.phone);
            $("#email").html(data.email);
            $("#father_name").html(data.father_name);
            $("#mother_name").html(data.mother_name);
            $("#nid").html(data.nid);
            $("#dob").html(data.dob);
            $("#village").html(data.village);
            $("#ps").html(data.ps);
            $("#po").html(data.po);
            $("#division").html(data?.division?.name);
            $("#district").html(data?.district?.name);
            $("#viewModal").modal('show');
          }
        });
      });
    })
  </script>
@endsection