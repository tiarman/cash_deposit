@extends('layout.admin')

@section('stylesheet')
    <link href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')


                        <header class="panel-heading">
                            <h2 class="panel-title">Transaction History</h2>
                        </header>
                        <div class="main-content">

                            <div class="page-content">
                                <div class="container-fluid">

                                    <div class="row">
                                        <div class="col-md-6 col-xl-6">


                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="mini-stat clearfix">
                                                        <span class="mini-stat-icon bg-pink float-start"><i class="mdi mdi-currency-usd"></i></span>
                                                        <div class="mini-stat-info text-end">
                                                            <span class="counter text-pink">Withdraw Total</span>
                                                            <?php
                                                            $total = 0;
                                                            foreach ($total_withdraw as $item) {
                                                                $total += intval($item->amount);
                                                            }
                                                            ?>
                                                            <strong style="font-size: 18px">Total: {{$total ?? " "}}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="mini-stat clearfix">
                                                        <span class="mini-stat-icon bg-success float-start"><i class="mdi mdi-currency-usd"></i></span>
                                                        <div class="mini-stat-info text-end">
                                                            <span class="counter text-success">Deposit Total</span>
                                                            <?php
                                                            $total = 0;
                                                            foreach ($total_deposits as $item) {
                                                                $total += intval($item->amount);
                                                            }
                                                            ?>
                                                            <strong style="font-size: 18px">Total: {{$total ?? " "}}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="mini-stat">
                                                        <span class="mini-stat-icon bg-primary float-start"><i class="mdi mdi-currency-usd"></i></span>
                                                        <div class="mini-stat-info text-end">
                                                            <?php
                                                            // total total calculate
                                                            $totalDeposit = 0;
                                                            foreach ($total_deposits as $item) {
                                                                $totalDeposit += intval($item->amount);
                                                            }
                                                            // total withdraw calculate
                                                            $totalWithdraw = 0;
                                                            foreach ($total_withdraw as $item) {
                                                                $totalWithdraw += intval($item->amount);
                                                            }
                                                            // total interest calculate
                                                            $totalInterest = 0;
                                                            foreach ($interest as $key => $value) {
                                                                $totalInterest += intval($value->interest_amount);
                                                                $totalIn = $totalInterest- $totalWithdraw;
                                                            }

                                                            ?>
                                                            <span class="counter text-primary">Curent Balance</span>
                                                            <strong style="font-size: 18px"> Total: {{($totalDeposit + $totalInterest) - $totalWithdraw ?? " "}}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="mini-stat">
                                                        <span class="mini-stat-icon bg-primary float-start"><i class="mdi mdi-currency-usd"></i></span>
                                                        <div class="mini-stat-info text-end">
                                                            <span class="counter text-primary">Interest</span>
                                                            <strong>Total: {{$totalIn}}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                        </div>







    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="panel-title">Transaction History</h2>
                        </header>
                        <div class="panel-body">
                            @if(session()->has('status'))
                                {!! session()->get('status') !!}
                            @endif

                            {{--<table class="table table-bordered table-striped mb-none" id="data-table">--}}
                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-bs-pattern="priority-columns">
                                        <table id="datatable-buttons" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%" style="font-size: 14px">
{{--                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"--}}
{{--                                       cellspacing="0" width="100%" style="font-size: 14px">--}}

                                    <thead>
                                    <tr>
{{--                                        <th width="10">#</th>--}}
                                        <th>Transaction Type</th>
                                        <th>Transaction Status</th>
                                        <th>Mobile/AC Number</th>
                                        <th>Amount</th>
                                        <th>Transaction ID</th>
                                        <th>Date</th>
                                        <th>Status</th>

                                        @if(\App\Helper\CustomHelper::canView('Manage User|Delete User', 'Super Admin'))
                                            <th class="hidden-phone" width="40">Option</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($wid as $key => $val)
                                        <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                                            <td class="p-1 text-capitalize">{{$val->transaction_type}}</td>
                                            <td class="p-1 text-capitalize">Withdraw</td>
                                            <td class="p-1 text-capitalize">{{ $val->withdraw_id }}</td>
                                            <td class="p-1">{{ $val->amount }}</td>
                                            <td class="p-1"></td>
                                            <td width="200" class="p-1">{{ date('F d, Y h:i A', strtotime($val->created_at)) }}</td>
                                            <td class="p-1 text-capitalize "><button class="btn text-capitalize @if($val->status == 'pending') btn-warning @else btn-success @endif">{{ $val->status }}</button></td>
                                        </tr>

                                            @endforeach
                                    @foreach($allDeposits as $key => $vals)
                                        <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                                            <td class="p-1 text-capitalize">{{$vals->transaction_type}}</td>
                                            <td class="p-1 text-capitalize">Deposit</td>
                                            <td class="p-1 text-capitalize">{{ $vals->payment_no }}</td>
                                            <td class="p-1">{{ $vals->amount }}</td>
                                            <td class="p-1">{{ $vals->transaction_id}}</td>
                                            <td width="200" class="p-1">{{ date('F d, Y h:i A', strtotime($vals->created_at)) }}</td>
                                            <td class="p-1 text-capitalize "><button class="btn text-capitalize @if($vals->status == 'pending') btn-warning @else btn-success @endif">{{ $vals->status }}</button></td>
                                        </tr>
                                    @endforeach

                                    <thead>
                                    <tr>
                                        <td></td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        {{-- <td>Total = <strong style="color: green">{{$sum_total ?? " "}}</strong></td> --}}
                                        <td></td>
                                        <td></td>

                                    </tr>
                                    </thead>
                                    </tbody>
                                </table>
                                    </div>
                                </div>
                            <div class="row">
{{--                                <div class="col-sm-12">{{ $sub_agent->links('vendor.pagination.bootstrap-4') }}</div>--}}
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
                    <h4>Delete Sub Agents</h4>
                </div>
                <div class="modal-body">
                    <strong>Are you sure to delete this Transaction?</strong>
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

            var table = $('#datatable-buttons').DataTable({
              lengthChange: false,
              buttons: ['copy', 'excel', 'pdf']
                // buttons: ['copy', 'excel', 'pdf', 'colvis']
            });

            table.buttons().container()
              .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

        })
    </script>
@endsection
