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
      .btn-light {
          color: #212529;
          background-color: #f8f9fa;
          border-color: #1d1e3a;
      }
      .btn-light:hover{color:#212529;background-color:#e2e6ea;border-color:#1d1e3a}
  </style>
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">{{ $job_event->title }}</h2>
            </header>
            <div class="panel-body">
              <div class="row">
                @if(\App\Helper\CustomHelper::canView('', 'Institute Head'))
                  <div class="col-md-3">
                    <a href="{{route('admin.event.job.participant.industry.list',request('id'))}}"class="btn btn-lg btn-light mt-1" style="width: 100%">Industry List</a>
                  </div>
                  <div class="col-md-3">
                    <a href="{{route('admin.organizer.applicant.list')}}"class="btn btn-lg btn-light mt-1" style="width: 100%">Applicant List</a>
                  </div>
                  <div class="col-md-3">
                    <a href="{{route('admin.organizer.guest.list')}}"class="btn  btn-lg btn-light mt-1" style="width: 100%">Guests</a>
                  </div>
                  <div class="col-md-3">
                    <a href="{{route('admin.organizer.post.list',$job_event->id)}}"class="btn btn-lg btn-light mt-1" style="width: 100%">Job Posts</a>
                  </div>
                @endif
                @if(\App\Helper\CustomHelper::canView('', 'Industry'))
                  <div class="col-md-3">
{{--                    <a href="{{route('admin.job.post.create'),$job_event->id}}"class="btn btn-lg btn-light mt-1" style="width: 100%">Post Job</a>--}}
                    <a href="{{route('admin.job.post.create.event',$job_event->id)}}"class="btn btn-lg btn-light mt-1" style="width: 100%">Post A Job</a>
                  </div>
                @endif
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
          <h4>Delete Training</h4>
        </div>
        <div class="modal-body">
          <strong>Are you sure to delete this training?</strong>
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
          url: "{{ route('admin.training.destroy') }}",
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
