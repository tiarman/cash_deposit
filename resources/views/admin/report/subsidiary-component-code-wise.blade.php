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
                  <h2 class="panel-title">Subsidiary Component code wise Report</h2>
                </div>
                <div class="col-2 text-right">
                  {{--                                    <a href="{{ request()->fullUrlWithQuery(['print'=>'pdf']) }}" class="btn btn-sm btn-info">Print</a>--}}
                </div>
              </div>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              <form action="" class=" form-group">
                <div class="row mt-3 mb-3">
                  <div class="col-md-4">
                    <input name="from_date" type="date" class="form-control">
                  </div>
                  <div class="col-md-4">
                    <input type="date" name="to_date" class="form-control">
                  </div>
                  <div class="col-md-4">
                    <button type="submit" class="btn btn-danger btn-sm w-50 text-center">Filter</button>
                  </div>
                </div>
              </form>

              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                     cellspacing="0" width="100%" style="font-size: 14px">

                <thead>
                <tr>
                  <th class="text-center" width="10">Code</th>
                  <th >Component</th>
                  <th class="text-center" style="width: 105px">DR Amount</th>
                  <th class="text-center" style="width: 105px">CR Amount</th>
                  <th class="text-center" style="width: 105px">Balance</th>
                </tr>
                </thead>
                <tbody>
                <?php $totalCr = 0; $totalDr = 0; $total = 0;?>
                @foreach($report as $key => $val)
                  <tr>
                    <td>{{ $key }}</td>
                    <td colspan="4">
                      @foreach($val as $compK => $comp)
                        <table width="100%">
                          <tr>
                            <td>{{ $comp->first()->component->name }}</td>
                            <?php $subTotalCr = 0; $subTotalDr = 0;?>
                            @foreach($comp as $scompK => $scomp)
                              @foreach($scomp->voucherinfo as $voucher)
                                <?php $subTotalCr += $voucher->cr_amount; ?>
                                <?php $subTotalDr += $voucher->dr_amount; ?>
                              @endforeach
                            @endforeach
                            <td class="text-right" style="width: 100px">{{ \App\Helper\CustomHelper::makePriceFormat($subTotalDr) }} Tk.</td>
                            <td class="text-right" style="width: 100px">{{ \App\Helper\CustomHelper::makePriceFormat($subTotalCr) }} Tk.</td>
                            <td class="text-right" style="width: 100px">{{ \App\Helper\CustomHelper::makePriceFormat($subTotalDr-$subTotalCr) }} Tk.</td>

                            <?php $totalCr += $subTotalCr; $totalDr += $subTotalDr; ?>
                          </tr>
                        </table>
                      @endforeach
                    </td>
                  </tr>
                @endforeach
                <tr>
                  <td class="p-1 text-right" colspan="3"><strong>{{ \App\Helper\CustomHelper::makePriceFormat($totalDr) }} TK.</strong></td>
                  <td class="p-1 text-right"><strong>{{ \App\Helper\CustomHelper::makePriceFormat($totalCr) }} TK.</strong></td>
                  <td class="p-1 text-right"><strong>{{ \App\Helper\CustomHelper::makePriceFormat($totalDr-$totalCr) }} TK.</strong></td>
                </tr>
                </tbody>
              </table>

              <div class="row mt-2">
                <div class="col-md-12 text-right">
                  {{--                                    In Words: <span>{{ \App\Helper\CustomHelper::numToEnglishWord($report->amount) }}</span> Taka Only--}}
                </div>
              </div>
            </div>
          </section>
        </div>
        <div class="col-2 text-right">
          {{--                                    <a href="{{ request()->fullUrlWithQuery(['print'=>'pdf']) }}" class="btn btn-sm btn-info">Print</a>--}}
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
