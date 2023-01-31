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
          content: "Rejected";
          padding-right: 8px;
      }

      .onoffswitch-inner:before {
          content: "Accepted";
          padding-right: 0px;
          padding-left: 8px;
      }

      .details-btn {
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
              <h2 class="panel-title">Project Idea list</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              @if(\App\Helper\CustomHelper::canView('Create Project Idea', 'Super Admin'))
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.projectIdea.create') }}" class="brn btn-success btn-sm">New Project
                      Idea</a>
                  </div>
                </div>
              @endif
              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                     cellspacing="0" width="100%" style="font-size: 14px">

                <thead>
                <tr>
                  <th width="50">#</th>
                  <th>Title</th>
                  <th>Short Description</th>
                  <th>Keyword</th>
                  {{--                  <th>Address</th>--}}
                  <th width="50">Status</th>
                  @if(\App\Helper\CustomHelper::canView('Manage Project Idea|Delete Project Idea', 'Super Admin'))
                    <th class="hidden-phone" width="40">Option</th>
                  @endif
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $keyA => $valA)
                    <tr>{{ $keyA }}</tr>
                @foreach($valA as $key => $val)
                  <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                    <td class="p-1">{{ ($key+1) }}</td>
                    <td class="p-1">
                      <input type="checkbox" name="ideaCheck[]" value="{{ $val->id }}">
                    </td>
                    <td class="p-1 text-capitalize">{{ $val->title }}</td>
                    <td class="p-1">{{ $val->short_description }}</td>
                    <td class="p-1">{{ $val->keyword }}</td>

                      <td class="text-capitalize p-1" width="100">
                        @if(\App\Helper\CustomHelper::canView('', 'Mentor'))
                        {{--                                        hod_approval            --}}
                              <div class="onoffswitch">
                                  <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"
                                         @checked($val->status == \App\Models\ProjectIdea::$statusArrays[1])
                                         data-id="{{ $val->id }}"
                                         id="myonoffswitch{{ ($key+1) }}">
                                  <label class="onoffswitch-label" for="myonoffswitch{{ ($key+1) }}">
                                      <span class="onoffswitch-inner"></span>
                                      <span class="onoffswitch-switch"></span>
                                  </label>
                              </div>
                        @endif




                      </td>
                          @if(\App\Helper\CustomHelper::canView('Manage Project Idea', 'Super Admin'))
                      <td class="text-capitalize p-1" width="100">
                        <select name="statusCheck" data-id="{{ $val->id }}" class="statusCheck">
                          @foreach(\App\Models\ProjectIdea::$statusArrays as $key => $ddd)
                            <option @selected($val->status == $ddd) value="{{ $ddd }}">{{ $ddd }}</option>
                          @endforeach
                        </select>
                      </td>
                    @else
                      <td class="p-1 text-capitalize">{{ $val->status }}</td>
                    @endif
                    @if(\App\Helper\CustomHelper::canView('Manage Project Idea|Delete Project Idea', 'Super Admin'))
                      <td class="center hidden-phone p-1" width="100">
                        <a href="{{ route('admin.projectIdea.view', [$val->id]) }}"
                           class="btn btn-sm btn-brown"> <i class="fa fa-eye"></i> </a>
                        @if(\App\Helper\CustomHelper::canView('Manage Project Idea', 'Super Admin'))
                          <a href="{{ route('admin.projectIdea.manage', [$val->id]) }}"
                             class="btn btn-sm btn-success"> <i class="fa fa-edit"></i> </a>
                        @endif

                        @if(\App\Helper\CustomHelper::canView('Delete Project Idea', 'Super Admin'))
                          <span class="btn btn-sm btn-danger btn-delete delete_{{ $val->id }}" style="cursor: pointer"
                                data-id="{{ $val->id }}"><i class="fa fa-trash-o"></i></span>
                        @endif
                      </td>
                    @endif
                  </tr>
                @endforeach
                @endforeach
                </tbody>
              </table>
              <select name="status" class="status">
                @foreach(\App\Models\ProjectIdea::$statusArrays as $key => $ddd)
                  <option value="{{ $ddd }}">{{ $ddd }}</option>
                @endforeach
              </select>
              <button id="shortlist" type="submit" value="status_short_list" class="btn btn-info">shortlist</button>
                @if(\App\Helper\CustomHelper::canView('', 'Student'))

                @else
                  <div class="float-right" >

                    <select name="status" class="statusForeword">
                      @foreach($users as $key => $val)
                        <option value="{{ $val->id }}">{{ $val->name_en }}</option>
                      @endforeach
                    </select>
                    <button id="foreword" type="submit" value="status_foreword_list" class="btn btn-info">Foreword To</button>
                  </div>
                  @endif
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
          <h4>Delete Project Idea</h4>
        </div>
        <div class="modal-body">
          <strong>Are you sure to delete this project idea?</strong>
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




      $(document).on('change', 'input[name="hod_approval"]', function () {
        var status = 0;
        var id = $(this).data('id')
        var isChecked = $(this).is(":checked");
        if (isChecked) {
          status = 1;
        }
        $.ajax({
          url: "{{ route('admin.ajax.update.projectIdea.hod_approval') }}",
          method: "post",
          dataType: "html",
          data: {'id': id, 'status': status},
          success: function (data) {
            if (data === "success") {
              window.location.reload()
            }
          }
        });
      })




      $(document).on('change', 'input[name="vp_approval"]', function () {
        var status = 0;
        var id = $(this).data('id')
        var isChecked = $(this).is(":checked");
        if (isChecked) {
          status = 1;
        }
        $.ajax({
          url: "{{ route('admin.ajax.update.projectIdea.vp_approval') }}",
          method: "post",
          dataType: "html",
          data: {'id': id, 'status': status},
          success: function (data) {
            if (data === "success") {
              window.location.reload()
            }
          }
        });
      })



      $(document).on('change', 'input[name="p_approval"]', function () {
        var status = 0;
        var id = $(this).data('id')
        var isChecked = $(this).is(":checked");
        if (isChecked) {
          status = 1;
        }
        $.ajax({
          url: "{{ route('admin.ajax.update.projectIdea.p_approval') }}",
          method: "post",
          dataType: "html",
          data: {'id': id, 'status': status},
          success: function (data) {
            if (data === "success") {
              window.location.reload()
            }
          }
        });
      })

      $(document).on('change', 'input[name="pmu_approval"]', function () {
        var status = 0;
        var id = $(this).data('id')
        var isChecked = $(this).is(":checked");
        if (isChecked) {
          status = 1;
        }
        $.ajax({
          url: "{{ route('admin.ajax.update.projectIdea.pmu_approval') }}",
          method: "post",
          dataType: "html",
          data: {'id': id, 'status': status},
          success: function (data) {
            if (data === "success") {
              window.location.reload()
            }
          }
        });
      })


          $(document).on('change', 'input[name="onoffswitch"]', function () {
              var status = 'inactive';
              var id = $(this).data('id')
              var isChecked = $(this).is(":checked");
              if (isChecked) {
                  status = 'active';
              }
              $.ajax({
                  url: "{{ route('admin.ajax.update.projectIdea.status') }}",
                  method: "post",
                  dataType: "html",
                  data: {'id': id, 'status': status},
                  success: function (data) {
                      if (data === "success") {
                          window.location.reload()
                      }
                  }
              });
          })

      $(document).on('click', '#shortlist', function () {
        var statusArrayListID = [];
        var statusShortListButton = (($('#shortlist').val()));
        var status = (($('.status ').val()));
        $.each($("input[name='ideaCheck[]']:checked"), function () {
          statusArrayListID.push($(this).val());
        });
        if (statusArrayListID) {
          id = statusArrayListID;
          // var isChecked = $('.statusCheck').val();
          status = status;
        }
        $.ajax({
          url: "{{ route('admin.ajax.update.projectIdea.status') }}",
          method: "post",
          dataType: "html",
          data: {'id': id, 'status': status, 'button_name': statusShortListButton},
          success: function (data) {
            window.location.reload()
          }
        });
      })

      $(document).on('click', '#foreword', function () {
        var statusArrayListID = [];
        var statusforewordButton = (($('#foreword').val()));
        var status = (($('.statusForeword').val()));
        $.each($("input[name='ideaCheck[]']:checked"), function () {
          statusArrayListID.push($(this).val());
        });
        if (statusArrayListID) {
          id = statusArrayListID;
          // var isChecked = $('.statusCheck').val();
          status = status;
        }
        $.ajax({
          url: "{{ route('admin.ajax.update.projectIdea.foreword') }}",
          method: "post",
          dataType: "html",
          data: {'id': id, 'status': status, 'button_name': statusforewordButton},
          success: function (data) {
            window.location.reload()
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
