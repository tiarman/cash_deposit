@extends('layout.admin')

@section('stylesheet')
    {{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <section class="panel">
                        {{-- <header class="panel-heading">
                            <h2 class="panel-title">Deposit List</h2>
                        </header> --}}
                        <div class="panel-body">
                            @if (session()->has('status'))
                                {!! session()->get('status') !!}
                            @endif

                            <header class="panel-heading">
                                <h2 class="panel-title">Deposit List</h2>
                            </header>
                            <?php 
                            $total = 0;
                            foreach ($total_deposits as $item) {
                                $total += intval($item->amount);
                            }
                            ?>
                            <h1 class="btn btn-primary mb-3 fw-bold">Total Deposit: {{ $total}}</h1>
                            <div class="panel-body">
                                @if (session()->has('status'))
                                    {!! session()->get('status') !!}
                                @endif

                                @if (\App\Helper\CustomHelper::canView('Create Sub Agent', 'Super Admin'))
                                @endif
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                    cellspacing="0" width="100%" style="font-size: 14px">

                                    <thead>
                                        <tr>
                                            <th width="10">#</th>
                                            <th>Date</th>
                                            <th>Transaction Type</th>
                                            <th>Transaction ID</th>
                                            <th>Payment Number</th>
                                            <th>Amount</th>
                                            {{-- <th>Coin Amount</th> --}}
                                            <th>Status</th>
                                            {{-- <th>screen</th>
                                            <th>Action</th> --}}
                                            {{-- @if (\App\Helper\CustomHelper::canView('Manage Sub Agent|Delete Sub Agent', 'Super Admin|Agent'))
                                                <th class="hidden-phone" width="40">Option</th>
                                            @endif --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allDeposits as $key => $val)
                                            <tr class="@if ($key % 2 == 0) gradeX @else gradeC @endif">
                                                <td class="p-1">{{ $key + 1 }}</td>
                                                <td width="200" class="p-1">
                                                    {{ date('F d, Y h:i A', strtotime($val->created_at)) }}</td>
                                                <td class="p-1 text-capitalize">{{ $val->transaction_type }}</td>
                                                <td class="p-1 text-capitalize">{{ $val->transaction_id }}</td>
                                                <td class="p-1 text-capitalize">{{ $val->payment_no }}</td>
                                                <td class="p-1">{{ $val->amount }}</td>
                                                {{-- <td class="p-1">{{ $val->status }}</td> --}}
                                                {{-- <td class="p-1">{{ $val->phone }}</td> --}}
                                                {{-- <td class="p-1 text-capitalize"> --}}
                                                {{-- {{ \App\Helper\CustomHelper::userRoleName($val) }}</td> --}}

                                                @if (\App\Helper\CustomHelper::canView('', 'Super Admin'))
                                                    <td class="text-capitalize p-1" width="100">
                                                        <div class="onoffswitch3">
                                                            <input type="checkbox" name="onoffswitch3"
                                                                class="onoffswitch3-checkbox" @checked($val->status == \App\Models\Deposit::$statusArrays[0])
                                                                data-id="{{ $val->id }}"
                                                                id="myonoffswitch{{ $key + 1 }}">
                                                            <label class="onoffswitch3-label"
                                                                for="myonoffswitch{{ $key + 1 }}">
                                                                <span class="onoffswitch3-inner"></span>
                                                                <span class="onoffswitch3-switch"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    {{-- @else
                                                    <td class="p-1 text-capitalize">{{ $val->status }}</td> --}}
                                                @endif
                                                {{-- @if (\App\Helper\CustomHelper::canView('Manage Sub Agent|Delete Sub Agent', 'Super Admin|Agent'))
                                                    <td class="text-center p-1" width="100">
                                                        @if (\App\Helper\CustomHelper::canView('Manage Sub Agent', 'Super Admin|Agent'))
                                                            <a href="{{ route('admin.subagent.manage', $val->id) }}"
                                                                class="btn btn-sm btn-success"> <i class="fa fa-edit"></i>
                                                            </a>
                                                        @endif
                                                        @if (\App\Helper\CustomHelper::canView('Delete Sub Agent', 'Super Admin|Agent'))
                                                            <span
                                                                class="btn btn-sm btn-danger btn-delete delete_{{ $val->id }}"
                                                                style="cursor: pointer" data-id="{{ $val->id }}"><i
                                                                    class="fa fa-trash-o"></i></span>
                                                        @endif
                                                    </td>
                                                @endif --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{--                                    <div class="row"> --}}
                                {{--                                        <div class="col-sm-12">{{ $sub_agent->links('vendor.pagination.bootstrap-4') }}</div> --}}
                                {{--                                    </div> --}}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            // $('#datatable-buttons').DataTable();

            // var table = $('#datatable-buttons').DataTable({
            //   lengthChange: false,
            //   buttons: ['copy', 'excel', 'pdf', 'colvis']
            // });
            //
            // table.buttons().container()
            //   .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');


            $(document).on('change', 'input[name="onoffswitch3"]', function() {
                console.log('ttttt')
                var status = 'pending';
                var id = $(this).data('id')
                var isChecked = $(this).is(":checked");
                if (isChecked) {
                    status = 'accepted';
                }
                $.ajax({
                    url: "{{ route('admin.ajax.update.deposit.status') }}",
                    method: "post",
                    dataType: "html",
                    data: {
                        'id': id,
                        'status': status
                    },
                    success: function(data) {
                        if (data === "success") {}
                    }
                });
            })


            {{-- $(document).on('click', '.yes-btn', function () { --}}
            {{--    var pid = $(this).data('id'); --}}
            {{--    var $this = $('.delete_' + pid) --}}
            {{--    $.ajax({ --}}
            {{--        url: "{{ route('admin.subagent.destroy') }}", --}}
            {{--        method: "delete", --}}
            {{--        dataType: "html", --}}
            {{--        data: {id: pid}, --}}
            {{--        success: function (data) { --}}
            {{--            if (data === "success") { --}}
            {{--                $('#userDeleteModal').modal('hide') --}}
            {{--                $this.closest('tr').css('background-color', 'red').fadeOut(); --}}
            {{--            } --}}
            {{--        } --}}
            {{--    }); --}}
            {{-- }) --}}

            {{-- $(document).on('click', '.btn-delete', function () { --}}
            {{--    var pid = $(this).data('id'); --}}
            {{--    $('.yes-btn').data('id', pid); --}}
            {{--    $('#userDeleteModal').modal('show') --}}
            {{-- }); --}}
        })
    </script>
@endsection
