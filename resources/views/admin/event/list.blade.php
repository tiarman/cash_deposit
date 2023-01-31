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
            .workshop{
                background-color: #3bc3e9 ;
            }
            .workshop-date{
                background-color:#3BC3AA;
            }
            .venue{
               color: #ffff;
               background-color: rgb(36, 55, 224)
            }
            .fa-compass{
                font-size: 25px;
            }


/* CSS */
.report-button-2 {
  padding: 0.6em 1.8em;
  display: block;
  text-decoration: none;
  border: none;
  outline: none;
  color: rgb(255, 255, 255)!important;
  background: rgb(40, 218, 49)!important;
  /* background: #111; */
  cursor: pointer;
  position: relative;
  z-index: 0;
  border-radius: 10px;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.report-button-2:before {
  content: "";
  background: linear-gradient(
    45deg,
    #ff0000,
    #ff7300,
    #fffb00,
    #48ff00,
    #00ffd5,
    #002bff,
    #7a00ff,
    #ff00c8,
    #ff0000
  );
  position: absolute;
  top: -2px;
  left: -2px;
  background-size: 400%;
  z-index: -1;
  filter: blur(5px);
  -webkit-filter: blur(5px);
  width: calc(100% + 4px);
  height: calc(100% + 4px);
  animation: glowing-report-button-2 20s linear infinite;
  transition: opacity 0.3s ease-in-out;
  border-radius: 10px;
}

@keyframes glowing-report-button-2 {
  0% {
    background-position: 0 0;
  }
  50% {
    background-position: 400% 0;
  }
  100% {
    background-position: 0 0;
  }
}

.report-button-2:after {
  z-index: -1;
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  background: #222;
  /* background: #34A7C1; */
  /* background: rgb(32, 168, 39)!important; */

  left: 0;
  top: 0;
  border-radius: 10px;
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
                            <h2 class="panel-title">Event list</h2>
                        </header>
                        <div class="panel-body">
                            @if(session()->has('status'))
                                {!! session()->get('status') !!}
                            @endif
                            @if(\App\Helper\CustomHelper::canView('Create Fiscal Period', 'Super Admin'))
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                                        <a href="{{ route('admin.event.create') }}" class="brn btn-success btn-sm">New Event</a>
                                    </div>
                                </div>
                            @endif
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                   cellspacing="0" width="100%" style="font-size: 14px">

                                <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Event</th>
                                    <th>Venue</th>
                                    <th>Starts</th>
                                    <th>Ends</th>
                                    <th>Status</th>
                                    <th>Report</th>
                                    @if(\App\Helper\CustomHelper::canView('Manage Event|Delete Event', 'Super Admin'))
                                        <th class="hidden-phone" width="40">Action</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                {{-- @foreach($datas as $key => $val) --}}
                                    <tr class="">
                                        <td class="p-1">1</td>
                                        <td class="">Tech Conference</td>
                                        <td class="">Bangldesh Computer Council</td>
                                        <td class="p-1">10-12-2022</td>
                                        <td class="p-1">30-12-2022</td>
                                        <td class="p-1">On Going</td>
                                        <td class="p-1 " width="120">
                                            <a href="{{ route('admin.event.report') }}" class="mx-3 report-button-2 " id="">Generate</a>
                                        </td>
                                        <td class="text-capitalize p-1" width="100">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"
                                                           \App\Models\CoreModule::$statusArrays[0]
                                                               checked
                                                           data-id=""
                                                           id="myonoffswitch">
                                                    <label class="onoffswitch-label" for="myonoffswitch">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                        </td>
                                        {{-- <td class="p-1">{{ $val->start_date }}</td>
                                        <td class="p-1">{{ $val->end_date }}</td>
                                        <td class="p-1">{{ $val->month_name }}</td>
                                        <td class="p-1">{{ $val->quarter_no }}</td>
                                        <td class="p-1">{{ \App\Models\User::where('id',$val->created_by)->pluck('name_en')->first() }}</td> --}}
                                        {{-- <td class="p-1">{{ \App\Models\User::where('id',$val->updated_by)->pluck('name_en')->first() ?? 'N\A' }}</td>
                                        @if(\App\Helper\CustomHelper::canView('Manage Fiscal Period|Delete Fiscal Period', 'Super Admin'))
                                            <td class="center hidden-phone p-1" width="100">
                                                @if(\App\Helper\CustomHelper::canView('Manage Fiscal Period', 'Super Admin'))
                                                    <a href="{{ route('admin.fiscalPeriod.manage', [$val->id]) }}"
                                                       class="btn btn-sm btn-success"> <i class="fa fa-edit"></i> </a>
                                                @endif
                                                @if(\App\Helper\CustomHelper::canView('Delete Fiscal Period', 'Super Admin'))
                                                    <span class="btn btn-sm btn-danger btn-delete delete_{{ $val->id }}" style="cursor: pointer"
                                                          data-id="{{ $val->id }}"><i class="fa fa-trash-o"></i></span>
                                                @endif
                                            </td>
                                        @endif --}}
                                    </tr>
                                {{-- @endforeach --}}
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
                    <h4>Delete Fiscal Period</h4>
                </div>
                <div class="modal-body">
                    <strong>Are you sure to delete this Fiscal Period?</strong>
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


            // {{--$(document).on('change', 'input[code="onoffswitch"]', function () {--}}
            // {{--  var status = 'inactive';--}}
            // {{--  var id = $(this).data('id')--}}
            // {{--  var isChecked = $(this).is(":checked");--}}
            // {{--  if (isChecked) {--}}
            // {{--    status = 'active';--}}
            // {{--  }--}}
            // {{--  $.ajax({--}}
            // {{--    url: "{{ route('admin.ajax.update.user.status') }}",--}}
            // {{--    method: "post",--}}
            // {{--    dataType: "html",--}}
            // {{--    data: {'id': id, 'status': status},--}}
            // {{--    success: function (data) {--}}
            // {{--      if (data === "success") {--}}
            // {{--      }--}}
            // {{--    }--}}
            // {{--  });--}}
            // {{--})--}}


            $(document).on('click', '.yes-btn', function () {
                var pid = $(this).data('id');
                var $this = $('.delete_' + pid)
                $.ajax({
                    url: "{{ route('admin.fiscalPeriod.destroy') }}",
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
