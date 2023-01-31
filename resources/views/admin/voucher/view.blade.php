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
              <div class="row">
                <div class="col-10">

              <h2 class="panel-title">Voucher {{ $voucher->no }}</h2>
                </div>
                <div class="col-2 text-right">
              <a href="{{ request()->fullUrlWithQuery(['print'=>'pdf']) }}" class="btn btn-sm btn-info">Print</a>
              </div>
              </div>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              <div class="row mt-3 mb-3">
                <div class="col-md-4">
                  <h3 class="font-18 border-bottom mb-1 bg-gray-200 pl-1 rounded">Institute Info</h3>
                  <h5>{{ $voucher->institute->name }}</h5>
                  <h5>Phone: {{ $voucher->institute->phone }}</h5>
                  <h5>Email: {{ $voucher->institute->email }}</h5>
                </div>
                <div class="col-md-4">
                  <h3 class="font-18 border-bottom mb-1 bg-gray-200 pl-1 rounded">Voucher Info</h3>
                  <h5><strong>{{ $voucher->no }}</strong></h5>
                  <h5>Year: {{ date('Y', strtotime($voucher->year->start_date)) }}</h5>
                  <h5>Type: {{ $voucher->type->name }}</h5>
                </div>
                <div class="col-md-4">
                  <h3 class="font-18 border-bottom mb-1 bg-gray-200 pl-1 rounded">Creator Info</h3>
                  <h5>{{ $voucher->creator->name_en  }}</h5>
                  <h5>Phone: {{ $voucher->creator->phone }}</h5>
                  <h5>Email: {{ $voucher->creator->email }}</h5>
                </div>
              </div>

              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                     cellspacing="0" width="100%" style="font-size: 14px">

                <thead>
                <tr>
                  <th class="text-center" width="50">#</th>
                  <th class="text-center">Component</th>
                  <th class="text-center">Sub-Component</th>
                  <th class="text-center">Subsidiary Component</th>
                  <th class="text-center">DR Amount</th>
                  <th class="text-center">CR Amount</th>
                </tr>
                </thead>
                <tbody>
                <?php $totalCr = 0; $totalDr = 0; ?>
                @foreach($voucher->details as $key => $val)
                  <?php $totalDr = ($totalDr + $val->dr_amount); $totalCr = ($totalCr + $val->cr_amount);?>
                  <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                    <td class="p-1 text-center">{{ $loop->iteration }}</td>
                    <td class="p-1">{{ $val->component->name }}</td>
                    <td class="p-1">{{ $val->subComponent->name }}</td>
                    <td class="p-1">{{ $val->subsidaryComponent->name }}</td>
                    <td class="p-1 text-right">{{ \App\Helper\CustomHelper::makePriceFormat($val->dr_amount) }}</td>
                    <td class="p-1 text-right">{{ \App\Helper\CustomHelper::makePriceFormat($val->cr_amount) }}</td>
                  </tr>
                @endforeach
                <tr>
                  <td class="border-0" colspan="4"></td>
                  <td class="p-1 text-right"><strong>{{ \App\Helper\CustomHelper::makePriceFormat($totalDr) }}</strong></td>
                  <td class="p-1 text-right"><strong>{{ \App\Helper\CustomHelper::makePriceFormat($totalCr) }}</strong></td>
                </tr>
                </tbody>
              </table>

              <div class="row mt-2">
                <div class="col-md-12 text-right">
                  In Words: <span>{{ \App\Helper\CustomHelper::numToEnglishWord($totalDr) }}</span> Taka Only
                </div>
              </div>
            </div>
          </section>
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
          url: "{{ route('admin.voucher.destroy') }}",
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
