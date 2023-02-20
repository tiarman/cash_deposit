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
                            <h2 class="panel-title">Withdraw List</h2>
                        </header>
                        <div class="panel-body">
                            @if(session()->has('status'))
                                {!! session()->get('status') !!}
                            @endif
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                       cellspacing="0" width="100%" style="font-size: 14px">

                                    <thead>
                                    <tr>
                                        <th width="10">#</th>
                                        <th>Transaction Type</th>
                                        <th>Mobile/AC Number</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        {{--                                            <th>Status</th>--}}
                                        {{--                                            <th>Action</th>--}}
                                        @if(\App\Helper\CustomHelper::canView('Manage User|Delete User', 'Super Admin'))
                                            <th class="hidden-phone" width="40">Option</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($wid as $key => $val)
                                        <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                                            <td class="p-1">{{ ($key+1) }}</td>
                                            <td class="p-1 text-capitalize">trtype</td>
                                            <td class="p-1 text-capitalize">{{ $val->withdraw_id }}</td>
                                            <td class="p-1">{{ $val->amount }}</td>
                                            <td width="200" class="p-1">{{ date('F d, Y h:i A', strtotime($val->created_at)) }}</td>
                                            {{--                                                @if(\App\Helper\CustomHelper::canView('Manage User', 'Super Admin'))--}}
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
{{--=================--}}
{{--                                            <td class="text-capitalize p-1" width="150">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <select name="status" required class="form-control @error('status') is-invalid @enderror">--}}
{{--                                                        <option value="">Choose a status</option>--}}
{{--                                                        @foreach(\App\Models\Withdraw::$statusArrays as $status)--}}
{{--                                                            <option value="{{ $status }}"--}}
{{--                                                                    @if(old('status', $val->status) == $status) selected @endif>{{ ucfirst($status) }}</option>--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}
{{--                                                    @error('status')--}}
{{--                                                    <strong class="text-danger">{{ $errors->first('status') }}</strong>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
{{--                                            ================--}}
                                            @if(\App\Helper\CustomHelper::canView('Manage Withdraw', 'Super Admin|Agent'))
                                                <td class="text-capitalize p-1" width="100">
                                                    <div class="onoffswitch2">
                                                        <input type="checkbox" name="onoffswitch" class="onoffswitch2-checkbox"
                                                               @checked($val->status == \App\Models\Withdraw::$statusArrays[1])
                                                               data-id="{{ $val->id }}"
                                                               id="myonoffswitch{{ ($key+1) }}">
                                                        <label class="onoffswitch2-label" for="myonoffswitch{{ ($key+1) }}">
                                                            <span class="onoffswitch2-inner"></span>
                                                            <span class="onoffswitch2-switch"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            @endif

{{--                                            <td class="p-1 text-capitalize">{{ $val->status }}</td>--}}
                                            {{--                                                @endif--}}
                                            {{--                                                @if(\App\Helper\CustomHelper::canView('Manage User|Delete User', 'Super Admin'))--}}
                                            {{--                                                    <td class="text-center p-1" width="100">--}}
                                            {{--                                                        @if(\App\Helper\CustomHelper::canView('Manage User', 'Super Admin'))--}}
                                            {{--                                                            <a href="{{ route('admin.user.manage', $val->id) }}" class="btn btn-sm btn-success"> <i--}}
                                            {{--                                                                    class="fa fa-edit"></i> </a>--}}
                                            {{--                                                        @endif--}}
                                            {{--                                                        @if(\App\Helper\CustomHelper::canView('Delete User', 'Super Admin'))--}}
                                            {{--                                                            <span class="btn btn-sm btn-danger btn-delete delete_{{ $val->id }}" style="cursor: pointer"--}}
                                            {{--                                                                  data-id="{{ $val->id }}"><i--}}
                                            {{--                                                                    class="fa fa-trash-o"></i></span>--}}
                                            {{--                                                        @endif--}}
                                            {{--                                                    </td>--}}
                                            {{--                                                @endif--}}
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
                    <h4>Delete Division</h4>
                </div>
                <div class="modal-body">
                    <strong>Are you sure to delete this division?</strong>
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



    <script src="{{ asset('assets/admin/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

{{--    <script>--}}

{{--        $(document).ready(function () {--}}
{{--            $('#member-dropdown').select2()--}}
{{--            const Toast = Swal.mixin({--}}
{{--                toast: true,--}}
{{--                position: 'top-end',--}}
{{--                showConfirmButton: false,--}}
{{--                timer: 3000--}}
{{--            });--}}

{{--            $(document).on('change', 'select[name="status"]', function () {--}}
{{--                var id = $(this).data('id')--}}
{{--                var status = $(this).val()--}}
{{--                const $this = $(this);--}}
{{--                $.ajax({--}}
{{--                    url: "{{ route('admin.ajax.update.cashmanage.status') }}",--}}
{{--                    method: "post",--}}
{{--                    dataType: "html",--}}
{{--                    data: {'id': id, 'status': status},--}}
{{--                    success: function (data) {--}}
{{--                        console.log(data);--}}
{{--                        if (data === "exist") {--}}
{{--                            Toast.fire({--}}
{{--                                icon: 'warning',--}}
{{--                                text: 'Sorry. '+ type +' type exist in this group.'--}}
{{--                            })--}}
{{--                            setTimeout(function () {--}}
{{--                                document.location.reload(true)--}}
{{--                            }, 3000)--}}
{{--                        }--}}
{{--                        if (data === "success") {--}}
{{--                            Toast.fire({--}}
{{--                                icon: 'success',--}}
{{--                                text: 'Successfully changed.'--}}
{{--                            })--}}
{{--                        }--}}
{{--                    }--}}
{{--                });--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
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


            $(document).on('change', 'input[name="onoffswitch"]', function () {

              var status = 'pending';
              var id = $(this).data('id')

              var isChecked = $(this).is(":checked");

              if (isChecked) {
                status = 'accepted';
              }
              $.ajax({
                url: "{{ route('admin.ajax.update.cashmanage.status') }}",
                method: "post",
                dataType: "html",
                data: {'id': id, 'status': status},
                success: function (data) {
                  if (data === "success") {
                  }
                }
              });
            })





            $(document).on('click', '.yes-btn', function () {
                var pid = $(this).data('id');
                var $this = $('.delete_' + pid)
                $.ajax({
                    url: "{{ route('admin.division.destroy') }}",
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







            {{--$(document).ready(function () {--}}
            {{--    $('#member-dropdown').select2()--}}
            {{--    const Toast = Swal.mixin({--}}
            {{--        toast: true,--}}
            {{--        position: 'top-end',--}}
            {{--        showConfirmButton: false,--}}
            {{--        timer: 3000--}}
            {{--    });--}}
            {{--    --}}{{--$(document).on('click', '.btn-mail', function () {--}}
            {{--    --}}{{--    var pid = $(this).data('id');--}}
            {{--    --}}{{--    // var $this = $('.delete_' + pid)--}}
            {{--    --}}{{--    $.ajax({--}}
            {{--    --}}{{--        url: "{{ route('admin.ajax.send-mail') }}",--}}
            {{--    --}}{{--        method: "Post",--}}
            {{--    --}}{{--        dataType: "html",--}}
            {{--    --}}{{--        data: {id: pid},--}}
            {{--    --}}{{--        success: function (data) {--}}
            {{--    --}}{{--            console.log(data);--}}
            {{--    --}}{{--            if (data === "success") {--}}
            {{--    --}}{{--                Toast.fire({--}}
            {{--    --}}{{--                    icon: 'success',--}}
            {{--    --}}{{--                    text: 'Successfully Mail Send.'--}}
            {{--    --}}{{--                })--}}
            {{--    --}}{{--            }--}}
            {{--    --}}{{--        }--}}
            {{--    --}}{{--    });--}}
            {{--    --}}{{--})--}}
            {{--    $(document).on('change', 'select[name="status"]', function () {--}}
            {{--        console.log("click")--}}
            {{--        var id = $(this).data('id')--}}
            {{--        var status = $(this).val()--}}
            {{--        const $this = $(this);--}}
            {{--        $.ajax({--}}
            {{--            url: "{{ route('admin.ajax.update.cashmanage.status') }}",--}}
            {{--            method: "post",--}}
            {{--            dataType: "html",--}}
            {{--            data: {'id': id, 'status': status},--}}
            {{--            success: function (data) {--}}
            {{--                console.log(data);--}}
            {{--                if (data === "exist") {--}}
            {{--                    Toast.fire({--}}
            {{--                        icon: 'warning',--}}
            {{--                        text: 'Sorry. '+ type +' type exist in this group.'--}}
            {{--                    })--}}
            {{--                    setTimeout(function () {--}}
            {{--                        document.location.reload(true)--}}
            {{--                    }, 3000)--}}
            {{--                }--}}
            {{--                if (data === "success") {--}}
            {{--                    Toast.fire({--}}
            {{--                        icon: 'success',--}}
            {{--                        text: 'Successfully changed.'--}}
            {{--                    })--}}
            {{--                }--}}
            {{--            }--}}
            {{--        });--}}
            {{--    })--}}
            {{--})--}}
        })
    </script>

@endsection
