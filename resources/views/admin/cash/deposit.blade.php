@extends('layout.admin')

@section('stylesheet')
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">--}}
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="panel-title">Online Payment</h2>
                        </header>


                        <div class="panel-body">



                            @if(session()->has('status'))
                                {!! session()->get('status') !!}
                            @endif

                                <div class="row">
                                    <div class="col-md-3 col-lg-3">
                                        <div class="product-list-box">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                                                <img src="{{asset('assets/admin/images/cash/1.png')}}" class="img-fluid" alt="work-thumbnail">
                                            </a>
                                            <div class="detail">
                                                <h4 class="font-16 text-center"><a href="" class="text-dark">bKash Agent</a> </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-lg-3">
                                        <div class="product-list-box">
                                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat" href="javascript:void(0);">
                                                <img src="{{asset('assets/admin/images/cash/2.png')}}" class="img-fluid" alt="work-thumbnail">
                                            </a>
                                            <div class="detail">
                                                <h4 class="font-16 text-center"><a href="" class="text-dark">bKash Personal</a> </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-lg-3">
                                        <div class="product-list-box">
                                            <a href="javascript:void(0);">
                                                <img src="{{asset('assets/admin/images/cash/3.png')}}" class="img-fluid" alt="work-thumbnail">
                                            </a>
                                            <div class="detail">
                                                <h4 class="font-16 text-center"><a href="" class="text-dark">Nagad Personal</a> </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-lg-3">
                                        <div class="product-list-box">
                                            <a href="javascript:void(0);">
                                                <img src="{{asset('assets/admin/images/cash/4.png')}}" class="img-fluid" alt="work-thumbnail">
                                            </a>
                                            <div class="detail">
                                                <h4 class="font-16 text-center"><a href="" class="text-dark">Rocket Personal</a> </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-lg-3">
                                        <div class="product-list-box">
                                            <a href="javascript:void(0);">
                                                <img src="{{asset('assets/admin/images/cash/5.png')}}" class="img-fluid" alt="work-thumbnail">
                                            </a>
                                            <div class="detail">
                                                <h4 class="font-16 text-center text-center"><a href="" class="text-dark">Upay Personal</a> </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

{{--                            <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">--}}
{{--                                @csrf--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-sm-4">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="control-label">Full name <span class="text-danger">*</span></label>--}}
{{--                                            <input type="text" name="name" placeholder="Full name" required value="{{ old('name') }}"--}}
{{--                                                   class="form-control @error('name') is-invalid @enderror">--}}
{{--                                            @error('name')--}}
{{--                                            <strong class="text-danger">{{ $errors->first('name') }}</strong>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-4">--}}

{{--                                    </div>--}}
{{--                                    <div class="col-sm-4">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="control-label">Email <span class="text-danger">*</span></label>--}}
{{--                                            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"--}}
{{--                                                   class="form-control @error('email') is-invalid @enderror" required>--}}
{{--                                            @error('email')--}}
{{--                                            <strong class="text-danger">{{ $errors->first('email') }}</strong>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-4">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="control-label">Phone No <span class="text-danger">*</span></label>--}}
{{--                                            <input type="number" name="phone" placeholder="Phone No" value="{{ old('phone') }}"--}}
{{--                                                   class="form-control @error('phone') is-invalid @enderror" required>--}}
{{--                                            @error('phone')--}}
{{--                                            <strong class="text-danger">{{ $errors->first('phone') }}</strong>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}



{{--                                </div>--}}
{{--                                <div class="row mt-4">--}}
{{--                                    <div class="col-sm-12 text-right">--}}
{{--                                        <button class="btn btn-danger btn-sm" type="submit">Submit</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}

                                <header class="panel-heading">
                                    <h2 class="panel-title">Deposit List</h2>
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
                                            <th>Date</th>
                                            <th>Transaction Type</th>
                                            <th>Transaction Number</th>
                                            <th>TrxID/Number</th>
                                            <th>Transaction Amount</th>
                                            <th>Coin Amount</th>
                                            <th>Status</th>
                                            <th>screen</th>
                                            <th>Action</th>
{{--                                            <th width="30">Status</th>--}}
{{--                                            <th width="200">screen</th>--}}
{{--                                            <th width="50">Action</th>--}}
                                            @if(\App\Helper\CustomHelper::canView('Manage Sub Agent|Delete Sub Agent', 'Super Admin|Agent'))
                                                <th class="hidden-phone" width="40">Option</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
{{--                                        @foreach($sub_agent as $key => $val)--}}
{{--                                            <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">--}}
{{--                                                <td class="p-1">{{ ($key+1) }}</td>--}}
{{--                                                <td class="p-1 text-capitalize">{{ $val->name_en }}</td>--}}
{{--                                                <td class="p-1 text-capitalize">{{ $val->username }}</td>--}}
{{--                                                <td class="p-1">{{ $val->agent_id }}</td>--}}
{{--                                                <td class="p-1">{{ $val->email }}</td>--}}
{{--                                                <td class="p-1">{{ $val->phone }}</td>--}}
{{--                                                <td class="p-1 text-capitalize">{{ \App\Helper\CustomHelper::userRoleName($val) }}</td>--}}
{{--                                                <td width="200" class="p-1">{{ date('F d, Y h:i A', strtotime($val->created_at)) }}</td>--}}
{{--                                                @if(\App\Helper\CustomHelper::canView('Manage Sub Agent', 'Super Admin|Agent'))--}}
{{--                                                    <td class="text-capitalize p-1" width="100">--}}
{{--                                                        <div class="onoffswitch">--}}
{{--                                                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"--}}
{{--                                                                   @checked($val->status == \App\Models\User::$statusArrays[1])--}}
{{--                                                                   data-id="{{ $val->id }}"--}}
{{--                                                                   id="myonoffswitch{{ ($key+1) }}">--}}
{{--                                                            <label class="onoffswitch-label" for="myonoffswitch{{ ($key+1) }}">--}}
{{--                                                                <span class="onoffswitch-inner"></span>--}}
{{--                                                                <span class="onoffswitch-switch"></span>--}}
{{--                                                            </label>--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}
{{--                                                @else--}}
{{--                                                    <td class="p-1 text-capitalize">{{ $val->status }}</td>--}}
{{--                                                @endif--}}
{{--                                                @if(\App\Helper\CustomHelper::canView('Manage Sub Agent|Delete Sub Agent', 'Super Admin|Agent'))--}}
{{--                                                    <td class="text-center p-1" width="100">--}}
{{--                                                        @if(\App\Helper\CustomHelper::canView('Manage Sub Agent', 'Super Admin|Agent'))--}}
{{--                                                            <a href="{{ route('admin.subagent.manage', $val->id) }}" class="btn btn-sm btn-success"> <i--}}
{{--                                                                    class="fa fa-edit"></i> </a>--}}
{{--                                                        @endif--}}
{{--                                                        @if(\App\Helper\CustomHelper::canView('Delete Sub Agent', 'Super Admin|Agent'))--}}
{{--                                                            <span class="btn btn-sm btn-danger btn-delete delete_{{ $val->id }}" style="cursor: pointer"--}}
{{--                                                                  data-id="{{ $val->id }}"><i--}}
{{--                                                                    class="fa fa-trash-o"></i></span>--}}
{{--                                                        @endif--}}
{{--                                                    </td>--}}
{{--                                                @endif--}}
{{--                                            </tr>--}}
{{--                                        @endforeach--}}
                                        </tbody>
                                    </table>
{{--                                    <div class="row">--}}
{{--                                        <div class="col-sm-12">{{ $sub_agent->links('vendor.pagination.bootstrap-4') }}</div>--}}
{{--                                    </div>--}}
                                </div>








                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><strong>bKash Agent</strong></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Trx Number:</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="message-text" class="col-form-label">Amount:</label>
                                                        <textarea class="form-control" id="message-text"></textarea>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-outline-brown">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


{{--                            Model--}}
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="message-text" class="col-form-label">Message:</label>
                                                        <textarea class="form-control" id="message-text"></textarea>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Send message</button>
                                            </div>
                                        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
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
