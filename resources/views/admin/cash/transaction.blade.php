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
                            <h2 class="panel-title">Transaction History</h2>
                        </header>
                        <div class="panel-body">
                            @if(session()->has('status'))
                                {!! session()->get('status') !!}
                            @endif

                            {{--<table class="table table-bordered table-striped mb-none" id="data-table">--}}
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                   cellspacing="0" width="100%" style="font-size: 14px">

                                <thead>
                                <tr>
                                    <th width="10">#</th>
                                    <th>Approve Date</th>
                                    <th>Trx Type</th>
                                    <th>Trx Number</th>
                                    <th>Trx ID</th>
                                    <th>Amount</th>
                                    <th width="30">Remark</th>
                                    @if(\App\Helper\CustomHelper::canView('Manage Sub Agent|Delete Sub Agent', 'Super Admin|Agent'))
                                        <th class="hidden-phone" width="40">Option</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
{{--                                @foreach($sub_agent as $key => $val)--}}
{{--                                    <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">--}}
{{--                                        <td class="p-1">{{ ($key+1) }}</td>--}}
{{--                                        <td class="p-1 text-capitalize">{{ $val->name_en }}</td>--}}
{{--                                        <td class="p-1 text-capitalize">{{ $val->username }}</td>--}}
{{--                                        <td class="p-1">{{ $val->agent_id }}</td>--}}
{{--                                        <td class="p-1">{{ $val->email }}</td>--}}
{{--                                        <td class="p-1">{{ $val->phone }}</td>--}}
{{--                                        <td class="p-1 text-capitalize">{{ \App\Helper\CustomHelper::userRoleName($val) }}</td>--}}
{{--                                        <td width="200" class="p-1">{{ date('F d, Y h:i A', strtotime($val->created_at)) }}</td>--}}
{{--                                        @if(\App\Helper\CustomHelper::canView('Manage Sub Agent', 'Super Admin|Agent'))--}}
{{--                                            <td class="text-capitalize p-1" width="100">--}}
{{--                                                <div class="onoffswitch">--}}
{{--                                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"--}}
{{--                                                           @checked($val->status == \App\Models\User::$statusArrays[1])--}}
{{--                                                           data-id="{{ $val->id }}"--}}
{{--                                                           id="myonoffswitch{{ ($key+1) }}">--}}
{{--                                                    <label class="onoffswitch-label" for="myonoffswitch{{ ($key+1) }}">--}}
{{--                                                        <span class="onoffswitch-inner"></span>--}}
{{--                                                        <span class="onoffswitch-switch"></span>--}}
{{--                                                    </label>--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
{{--                                        @else--}}
{{--                                            <td class="p-1 text-capitalize">{{ $val->status }}</td>--}}
{{--                                        @endif--}}
{{--                                        @if(\App\Helper\CustomHelper::canView('Manage Sub Agent|Delete Sub Agent', 'Super Admin|Agent'))--}}
{{--                                            <td class="text-center p-1" width="100">--}}
{{--                                                @if(\App\Helper\CustomHelper::canView('Manage Sub Agent', 'Super Admin|Agent'))--}}
{{--                                                    <a href="{{ route('admin.subagent.manage', $val->id) }}" class="btn btn-sm btn-success"> <i--}}
{{--                                                            class="fa fa-edit"></i> </a>--}}
{{--                                                @endif--}}
{{--                                                @if(\App\Helper\CustomHelper::canView('Delete Sub Agent', 'Super Admin|Agent'))--}}
{{--                                                    <span class="btn btn-sm btn-danger btn-delete delete_{{ $val->id }}" style="cursor: pointer"--}}
{{--                                                          data-id="{{ $val->id }}"><i--}}
{{--                                                            class="fa fa-trash-o"></i></span>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
{{--                                        @endif--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
                                </tbody>
                            </table>
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
@endsection
