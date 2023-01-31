@extends('layout.admin')

@section('stylesheet')
  <link href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">List of Assets</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                  <a href="{{ route('admin.institute.building.create') }}" class="brn btn-success btn-sm">New Asset</a>
                </div>
                <div class="col-md-12">
                  <form action="{{ route('admin.institute.building.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-2">
                      <div class="col-md-2">
                        <label for="">Import asset</label>
                      </div>
                      <div class="col-md-4">
                        <input type="file" name="file" class="form-control">
                      </div>
                      <div class="col-md-2">
                        <button class="btn btn-success btn-ms w-full text-center">Submit</button>
                      </div>
                      <div class="col-md-4" style="display: flex; justify-content: space-between">
                        <a class="btn btn-warning btn-sm ml-4 p-2" href="{{ asset('assets/imp/InstituteFixedAssetRegister.xlsx') }}" download>Download Import Format</a>
                        <span class="btn btn-primary btn-sm p-2">Export Assets</span>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                     cellspacing="0" width="100%" style="font-size: 14px">

                <thead>
                <tr>
                  <th width="10">#</th>
                  <th>Building Name</th>
                  <th>Block Name</th>
                  <th>Floor Name</th>
                  <th>Room</th>
                  <th>Serial No</th>
                  <th>Items</th>
                  <th width="50">Status</th>
                  <th class="hidden-phone" width="40">Option</th>
                </tr>
                </thead>
                <tbody>
                @foreach($buildings as $key => $val)
                  <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                    <td class="p-1">{{ ($key+1) }}</td>
                    <td class="p-1 text-capitalize">{{ $val->building_name }}</td>
                    <td class="p-1">{{ $val->block_name }}</td>
                    <td class="p-1">{{ $val->floor_name }}</td>
                    <td class="p-1">{{ $val->room_name }} <br> {{ $val->room_no }}</td>
                    <td class="p-1">{{ $val->sn }}</td>
                    <td class="p-1">{{ $val->items_count }}</td>
                    <td class="p-1 text-capitalize">{{ $val->status }}</td>
                    <td class="text-center p-1" width="100">
                      <a href="{{ route('admin.institute.building.item.list', $val->id) }}" class="btn btn-sm btn-info"> <i
                          class="fa fa-info"></i> </a>

                      <a href="{{ route('admin.institute.building.manage', $val->id) }}" class="btn btn-sm btn-success"> <i
                          class="fa fa-edit"></i> </a>

                      <span class="btn btn-sm btn-danger btn-delete delete_{{ $val->id }}" style="cursor: pointer"
                            data-id="{{ $val->id }}"><i
                          class="fa fa-trash-o"></i></span>
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
          <h4>Delete Building</h4>
        </div>
        <div class="modal-body">
          <strong>Are you sure to delete this building?</strong>
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
      $('#datatable-buttons').DataTable();

      // var table = $('#datatable-buttons').DataTable({
      //   lengthChange: false,
      //   buttons: ['copy', 'excel', 'pdf', 'colvis']
      // });
      //
      // table.buttons().container()
      //   .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

      $(document).on('click', '.yes-btn', function () {
        var pid = $(this).data('id');
        var $this = $('.delete_' + pid)
        $.ajax({
          url: "{{ route('admin.institute.building.destroy') }}",
          method: "delete",
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
