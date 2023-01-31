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
          text-align: left;
          vertical-align: middle;
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
              <h2 class="panel-title">Applications</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
{{--              @if(\App\Helper\CustomHelper::canView('Create Institute User', 'Super Admin'))--}}
{{--                <div class="row">--}}
{{--                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">--}}
{{--                    <a href="{{ route('admin.institute.head.student.create') }}" class="brn btn-success btn-sm">New Member</a>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              @endif--}}
              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                     cellspacing="0" width="100%" style="font-size: 14px">

                <thead>
                <tr>
                  <th width="50">#</th>
                  <th>Name</th>
                  <th>Employment status</th>
                  <th>Work for</th>
                  <th>Resume</th>
                  {{--                  <th>Address</th>--}}
{{--                  <th width="50">Status</th>--}}
                  @if(\App\Helper\CustomHelper::canView('Manage Industry|Delete Industry', 'Super Admin|Industry'))
                    <th class="hidden-phone" width="20%">Option</th>
                  @endif
                </tr>
                </thead>
                <tbody>
                @foreach($graduate as $key => $val)
                  <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                    <td class="p-1">{{ ($key+1) }}</td>
                    <td class="p-1 text-capitalize"><span style="font-weight: bold; font-size: 16px">{{ $val->graduate?->name_en }}</span><br>
                      <span style="font-weight: lighter; font-size: 12px">Email: &nbsp;{{ $val->graduate?->email }}</span><br>
                      <span style="font-weight: lighter; font-size: 12px">Phone: &nbsp;{{ $val->graduate?->phone }}</span><br>
                    <td class="p-1">{{ ucfirst($val->graduate?->employment_status) }}</td>
                    <td class="p-1">{{ $val->graduate?->employing_company }}</td>
                    <td class="p-1 text-center"><a href="{{ asset($val->graduate?->cv) }}" download><i class="fa fa-download"></i>&nbsp; Download</a></td>
                    <td>
                      <div class="row">
                        <div class="col-md-8">
                          <select class="form-control" name="status" data-id="{{ $val->id }}">
                            {{--                        <option value="">Select</option>--}}
                            @foreach(\App\Models\PostHasStudent::$statusArrays as $status)
                              <option value="{{ $status }}"
                                      @if(old('status',$val->status) == $status) selected @endif>{{ ucfirst($status) }}</option>
                            @endforeach
                          </select></div>
                        <div class="col-md-4">

                      <span class="btn btn-sm btn-info btn-mail" style="cursor: pointer"
                            data-id="{{ $val->id }}"><i
                          class="fa fa-mail-forward"></i></span>
                        </div>
                      </div>

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



  <div class="modal fade" id="userDeleteModal" tabindex="-1" role="dialog" aria-labelledby="userDeleteModal"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Delete Member</h4>
        </div>
        <div class="modal-body">
          <strong>Are you sure to delete this member?</strong>
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

  <script src="{{ asset('assets/admin/plugins/select2/js/select2.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>


  <script>

    $(document).ready(function () {
      $('#member-dropdown').select2()
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
    $(document).on('click', '.btn-mail', function () {
      var pid = $(this).data('id');
      // var $this = $('.delete_' + pid)
      $.ajax({
        url: "{{ route('admin.ajax.send-mail') }}",
        method: "Post",
        dataType: "html",
        data: {id: pid},
        success: function (data) {
          console.log(data);
          if (data === "success") {
            Toast.fire({
            icon: 'success',
            text: 'Successfully Mail Send.'
          })
          }
        }
      });
    })
      $(document).on('change', 'select[name="status"]', function () {
        var id = $(this).data('id')
        var status = $(this).val()
        const $this = $(this);
        $.ajax({
          url: "{{ route('admin.ajax.update.job.applicant.status') }}",
          method: "post",
          dataType: "html",
          data: {'id': id, 'status': status},
          success: function (data) {
            console.log(data);
            if (data === "exist") {
              Toast.fire({
                icon: 'warning',
                text: 'Sorry. '+ type +' type exist in this group.'
              })
              setTimeout(function () {
                document.location.reload(true)
              }, 3000)
            }
            if (data === "success") {
              Toast.fire({
                icon: 'success',
                text: 'Successfully changed.'
              })
            }
          }
        });
      })
    })
  </script>
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


      $(document).on('change', 'input[name="onoffswitch"]', function () {
        var status = 'inactive';
        var id = $(this).data('id')
        var isChecked = $(this).is(":checked");
        if (isChecked) {
          status = 'active';
        }
        $.ajax({
          url: "{{ route('admin.ajax.update.user.status') }}",
          method: "post",
          dataType: "html",
          data: {'id': id, 'status': status},
          success: function (data) {
            if (data === "success") {
            }
          }
        });
      })


      $(document).on('click', '.yes-btn', function () {
        var pid = $(this).data('id');
        var $this = $('.delete_' + pid)
        $.ajax({
          url: "{{ route('admin.institute.head.destroy') }}",
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
