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
              <h2 class="panel-title">Institute list</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              @if(\App\Helper\CustomHelper::canView('Create Institute', 'Super Admin'))
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.institute.create') }}" class="brn btn-success btn-sm">New Institute</a>
                  </div>
                </div>
              @endif
              <div class="table-responsive">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                       cellspacing="0" width="100%" style="font-size: 14px">

                  <thead>
                  <tr>
                    <th @class("text-center")  width="50">#</th>
                    <th @class("text-center") >Name</th>
                    <th @class("text-center") >Head of Institute / Email</th>
                    <th @class("text-center") >Phone</th>
                    <th @class("text-center")  width="50">Type</th>
                    <th @class("text-center")  width="130">Data</th>
                    <th @class("text-center")  width="50">Status</th>
                    @if(\App\Helper\CustomHelper::canView('Manage Institute|Delete Institute', 'Super Admin'))
                      <th @class("text-center")  class="hidden-phone" width="70">Option</th>
                    @endif
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($datas as $key => $val)
                    <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                      <td class="p-1">{{ ($key+1) }}</td>
                      <td class="p-1">
                        <span class="text-capitalize">{{ $val->name }} </span><br>
                        <a href="mailto:{{ $val->email }}">{{ $val->email }}</a>
                      </td>
                      <td class="p-1">
                        <span class="text-capitalize">{{ $val->instituteHead?->name_en }} </span><br>
                        <a href="mailto:{{ $val->instituteHead?->email }}">{{ $val->instituteHead?->email }}</a>
                      </td>
                      <td class="p-1"><a href="tel:{{ $val->phone }}">{{ $val->phone }}</a></td>
                      <td class="p-1 text-capitalize text-red-600">{{ $val->type?->name }}</td>

                      <td class="p-1">
                        @if($val->idg)
                          <a href="{{ route('form.pdf', $val->idg->id) }}" class="btn btn-sm @if($val->idg->status == 'save') btn-success @else btn-primary @endif"> IDG </a>
                        @endif
                        @if($val->rpl)
                          <a href="{{ route('eligibility.rpl.without.score.pdf', $val->rpl->id) }}" class="btn btn-sm  @if($val->rpl->status == 'save') btn-success @else btn-primary @endif"> RPL </a>
                        @endif
                        @if($val->sc)
                          <a href="{{ route('eligibility.course.pdf', $val->sc->id) }}" class="btn btn-sm  @if($val->sc->status == 'save') btn-success @else btn-primary @endif"> SC </a>
                        @endif
                      </td>

                      @if(\App\Helper\CustomHelper::canView('Manage Institute', 'Super Admin'))
                        <td class="text-capitalize p-1" width="100">
                          <div class="onoffswitch">
                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"
                                   @checked($val->status == \App\Models\Institute::$statusArrays[1])
                                   data-id="{{ $val->id }}"
                                   id="myonoffswitch{{ ($key+1) }}">
                            <label class="onoffswitch-label" for="myonoffswitch{{ ($key+1) }}">
                              <span class="onoffswitch-inner"></span>
                              <span class="onoffswitch-switch"></span>
                            </label>
                          </div>
                        </td>
                      @else
                        <td class="p-1 text-capitalize">{{ $val->status }}</td>
                      @endif

                      @if(\App\Helper\CustomHelper::canView('Manage Institute|Delete Institute', 'Super Admin'))
                        <td class="center hidden-phone p-1" width="80">
                          @if(\App\Helper\CustomHelper::canView('Manage Institute', 'Super Admin'))
                            <a href="{{ route('admin.institute.manage', [$val->id]) }}"
                               class="btn btn-sm btn-success"> <i class="fa fa-edit"></i> </a>
                          @endif

                          @if(\App\Helper\CustomHelper::canView('Delete Institute', 'Super Admin'))
                            <span class="btn btn-sm btn-danger btn-delete delete_{{ $val->id }}" style="cursor: pointer"
                                  data-id="{{ $val->id }}"><i class="fa fa-trash-o"></i></span>
                          @endif
                        </td>
                      @endif
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <div class="row">
                <div class="col-sm-12">{{ $datas->links('vendor.pagination.bootstrap-4') }}</div>
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
          <h4>Delete Institute</h4>
        </div>
        <div class="modal-body">
          <strong>Are you sure to delete this institute?</strong>
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


      $(document).on('change', 'input[name="onoffswitch"]', function () {
        var status = 'inactive';
        var id = $(this).data('id')
        var isChecked = $(this).is(":checked");
        if (isChecked) {
          status = 'active';
        }
        $.ajax({
          url: "{{ route('admin.ajax.update.institute.status') }}",
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
          url: "{{ route('admin.institute.destroy') }}",
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
