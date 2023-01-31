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
                  <a href="{{ route('admin.institute.building.list') }}" class="brn btn-success btn-sm">List of Assets</a>
                </div>
              </div>

                <div class="row">
                  <div class="col-md-6">
                    <h6 class="mb-2"><strong>Building Name: </strong>{{ $building->building_name }}</h6>
                    <h6 class="mb-2"><strong>Block Name: </strong>{{ $building->block_name }}</h6>
                    <h6 class="mb-2"><strong>Floor Name: </strong>{{ $building->floor_name }}</h6>
                    <h6 class="mb-2"><strong>Created At: </strong>{{ $building->created_at->format('d-m-Y') }}</h6>
                  </div>
                  <div class="col-md-6 text-right mb-3">
                    <h6 class="mb-2"><strong>Room Name: </strong>{{ $building->room_name }}</h6>
                    <h6 class="mb-2"><strong>Room No: </strong>{{ $building->room_no }}</h6>
                    <h6 class="mb-2"><strong>Serial No: </strong>{{ $building->sn }}</h6>
                    <h6 class="mb-2"><strong>Status: </strong>{{ ucfirst($building->status) }}</h6>
                  </div>
                </div>

              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                     cellspacing="0" width="100%" style="font-size: 14px">

                <thead>
                <tr>
                  <th width="10">#</th>
                  <th>Name</th>
                  <th>Accn no</th>
                  <th>Quantity</th>
                  <th width="50">Status</th>
                  <th class="hidden-phone" width="40">Option</th>
                </tr>
                </thead>
                <tbody>
                @foreach($building->items as $key => $val)
                  <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                    <td class="p-1">{{ ($key+1) }}</td>
                    <td class="p-1 text-capitalize">{{ $val->name }}</td>
                    <td class="p-1">{{ $val->accn_no }}</td>
                    <td class="p-1">{{ $val->quantity }}</td>
                    <td class="p-1 text-capitalize">{{ $val->status }}</td>
                    <td class="text-center p-1" width="100">
                      <a href="{{ route('admin.institute.building.item.manage', $val->id) }}" class="btn btn-sm btn-success"> <i
                          class="fa fa-edit"></i> </a>

                      <span class="btn btn-sm btn-danger btn-delete delete_{{$val->id}}" style="cursor: pointer"
                            data-id="{{ $val->id}}"><i
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
          <h4>Delete building item?</h4>
        </div>
        <div class="modal-body">
          <strong>Are you sure to delete building item?</strong>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-success yes-btn btn-sm">Yes</button>
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
        // let itemBuildingIntituteIdArray =  pid.split(' ');
        // console.log(itemBuildingIntituteIdArray[2])
        var $this = $('.delete_' + pid)
        $.ajax({
          url: "{{ route('admin.institute.building.item.Destroy') }}",
          method: "delete",
          dataType: "html",
          data: {id: pid},
          success: function (data) {
            if (data === "success") {
              $('#userDeleteModal').modal('hide')
              $this.closest('tr').css('background-color', 'red').fadeOut();
              // location.reload()
            }
          }
        });
      })

      $(document).on('click', '.btn-delete', function () {
        var pid = $(this).data('id');
        $('.yes-btn').data('id', pid);
        $('#userDeleteModal').modal('show')
        console.log('open')
      });
    })
  </script>
@endsection
