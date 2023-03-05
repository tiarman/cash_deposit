@extends('layout.admin')

@section('stylesheet')
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="panel-title">Withdraw</h2>
                        </header>


                        <div class="panel-body">



                            @if(session()->has('status'))
                                {!! session()->get('status') !!}
                            @endif

                            <div class="row">

                                @foreach ($agent_payment_numbers as $val)

                                <div class="col-md-3 col-lg-3">
                                    <div class="product-list-box">
                                        <a data-bs-toggle="modal" data-bs-target="#exampleModal{{$val->id}}" data-bs-whatever="@fat" href="javascript:void(0);">
                                            <img src="{{$val->image}}" class="img-fluid" alt="work-thumbnail">
                                        </a>
                                        <div class="detail">

                                            <h4 class="font-16 text-center"><a href="" class="text-dark">{{$val->name_key}}</a> </h4>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>

                            <header class="panel-heading">
                                <h2 class="panel-title">Withdraw List</h2>
                            </header>


                            <div class="panel-body">
                                @if(session()->has('status'))
                                    {!! session()->get('status') !!}
                                @endif

                                @if(\App\Helper\CustomHelper::canView('Create Sub Agent', 'Super Admin|Agent'))
                                    {{--                                        <div class="row">--}}
                                    {{--                                            <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">--}}
                                    {{--                                                <a href="{{ route('admin.subagent.create') }}" class="brn btn-success btn-sm">New Agent</a>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                @endif
                                {{--<table class="table table-bordered table-striped mb-none" id="data-table">--}}
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                           cellspacing="0" width="100%" style="font-size: 14px">

                                        <thead>
                                        <tr>
                                            <th width="10">#</th>
                                            <th>Transaction Type</th>
                                            <th>Mobile/AC Number</th>
                                            <th>Amount</th>
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
                                                <td class="p-1">{{ ($key+1) }}</td>
                                                <td class="p-1 text-capitalize">{{$val->transaction_type}}</td>
                                                <td class="p-1 text-capitalize">{{ $val->withdraw_id }}</td>
                                                <td class="p-1">{{ $val->amount }}</td>
                                                <td width="200" class="p-1">{{ date('F d, Y h:i A', strtotime($val->created_at)) }}</td>
                                                <td class="p-1 text-capitalize "><button class="btn text-capitalize @if($val->status == 'pending') btn-warning @else btn-success @endif">{{ $val->status }}</button></td>

                                        @endforeach
                                            </tr>
                                        <thead>
                                            <tr>
                                                <td></td>
                                                <td></td>

                                                    <td></td>
                                                <?php
                                                $total = 0;
                                                foreach ($total_withdraw as $item) {
                                                    $total += intval($item->amount);
                                                }
                                                ?>

                                                <td><strong>Total = </strong><strong style="color: green">{{$total ?? ""}}</strong></td>
                                                <td></td>
                                                <td></td>

                                            </tr>
                                        </thead>
                                        </tbody>
                                    </table>

                            </div>







                                {{--Model Start--}}
                                @foreach (json_decode($agent_payment_numbers) as $val)

                            <div class="modal fade" id="exampleModal{{$val->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">

                                            <h5 class="modal-title" id="exampleModalLabel"><strong>{{$val->name_key}}</strong></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if(session()->has('status'))
                                                {!! session()->get('status') !!}
                                            @endif
                                            <form action="{{route('admin.withdraw.store')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Transaction Type<span
                                                                    class="text-danger">*</span></label>
                                                            <select name="transaction_type"
                                                                    class="form-control @error('transaction_type') is-invalid @enderror">
                                                                <option value="bkash personal">{{$val->name_key}}</option>
                                                                /
                                                            </select>
                                                            @error('transaction_type')
                                                            <strong
                                                                class="text-danger">{{ $errors->first('transaction_type') }}</strong>
                                                            @enderror
                                                            <strong class="text-danger" id="name_error"></strong>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Mobile Number:<span class="text-danger">*</span></label>
                                                            <select name="withdraw_id" required class="form-control @error('withdraw_id') is-invalid @enderror">
                                                                 <option value="">Choose a mobile number</option>

                                                                @foreach (($val->agents_numbers) as $num)
                                                                    <option value="{{ $num->number }}"
                                                                            @if (old('mobile') == $num->user_id) selected @endif>
                                                                        {{ ucfirst($num->number) }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('data')
                                                            <strong class="text-danger">{{ $errors->first('withdraw_id') }}</strong>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Amount<span class="text-danger">*</span></label>
                                                            <input type="number" name="amount" placeholder="00.00" value="{{ old('amount') }}"
                                                                   class="form-control @error('amount') is-invalid @enderror" required>
                                                            @error('amount')
                                                            <strong class="text-danger">{{ $errors->first('amount') }}</strong>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="col-sm-12 text-right">
                                                        <button class="btn btn-danger btn-sm" type="submit">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
{{--                                        <div class="modal-footer">--}}
{{--                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}
{{--                                            <button type="button" class="btn btn-outline-brown">Submit</button>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        @endforeach

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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


        <script>
            $(document).on("click", ".edit", function () {
                // Use $(this) to reference the clicked button
                $(".modal-body #value").val($(this).data('id'));
            });
            $(document).ready(function () {
            $('#datatable-buttons').DataTable();

            // var table = $('#datatable-buttons').DataTable({
            //   lengthChange: false,
            //   buttons: ['copy', 'excel', 'pdf', 'colvis']
            // });
            //
            // table.buttons().container()
            //   .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

        })
    </script>
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


            {{--$(document).on('change', 'input[name="onoffswitch"]', function () {--}}
            {{--    var status = 'inactive';--}}
            {{--    var id = $(this).data('id')--}}
            {{--    var isChecked = $(this).is(":checked");--}}
            {{--    if (isChecked) {--}}
            {{--        status = 'active';--}}
            {{--    }--}}
            {{--    $.ajax({--}}
            {{--        url: "{{ route('admin.ajax.update.subagent.status') }}",--}}
            {{--        method: "post",--}}
            {{--        dataType: "html",--}}
            {{--        data: {'id': id, 'status': status},--}}
            {{--        success: function (data) {--}}
            {{--            if (data === "success") {--}}
            {{--            }--}}
            {{--        }--}}
            {{--    });--}}
            {{--})--}}


            {{--$(document).on('click', '.yes-btn', function () {--}}
            {{--    var pid = $(this).data('id');--}}
            {{--    var $this = $('.delete_' + pid)--}}
            {{--    $.ajax({--}}
            {{--        url: "{{ route('admin.subagent.destroy') }}",--}}
            {{--        method: "delete",--}}
            {{--        dataType: "html",--}}
            {{--        data: {id: pid},--}}
            {{--        success: function (data) {--}}
            {{--            if (data === "success") {--}}
            {{--                $('#userDeleteModal').modal('hide')--}}
            {{--                $this.closest('tr').css('background-color', 'red').fadeOut();--}}
            {{--            }--}}
            {{--        }--}}
            {{--    });--}}
            {{--})--}}

            {{--$(document).on('click', '.btn-delete', function () {--}}
            {{--    var pid = $(this).data('id');--}}
            {{--    $('.yes-btn').data('id', pid);--}}
            {{--    $('#userDeleteModal').modal('show')--}}
            {{--});--}}
        })
    </script>

@endsection
