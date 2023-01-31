@extends('layout.admin')

@section('stylesheet')
  <!-- DataTables -->
  <link href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>
  <link href="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>
  <link href="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>
  <style>
      .onoffswitch {
          position: relative; width: 90px;
          -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
      }
      .onoffswitch-checkbox {
          position: absolute;
          opacity: 0;
          pointer-events: none;
      }
      .onoffswitch-label {
          display: block; overflow: hidden; cursor: pointer;
          border: 2px solid #999999; border-radius: 20px;
      }
      .onoffswitch-inner {
          display: block; width: 200%; margin-left: -100%;
          transition: margin 0.3s ease-in 0s;
      }
      .onoffswitch-inner:before, .onoffswitch-inner:after {
          display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
          font-size: 12px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
          box-sizing: border-box;
      }
      .onoffswitch-inner:before {
          content: "Approve";
          padding-left: 10px;
          background-color: #4ac180; color: #FFFFFF;
      }
      .onoffswitch-inner:after {
          content: "Reject";
          padding-right: 10px;
          background-color: #dc4835; color: #FFFFFF;
          text-align: right;
      }
      .onoffswitch-switch {
          display: block; width: 18px; margin: 6px;
          background: #FFFFFF;
          position: absolute; top: 0; bottom: 0;
          right: 56px;
          border: 2px solid #999999; border-radius: 20px;
          transition: all 0.3s ease-in 0s;
      }
      .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
          margin-left: 0;
      }
      .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
          right: 0px;
      }
  </style>

@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Industry list</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                     cellspacing="0" width="100%" style="font-size: 14px">

                <thead>
                <tr>
                  <th width="50">#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Contact No</th>
                  <th>Option</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($industries[0]->jobFairHasParticipant as $item => $val)
                <tr>
                  <td>{{$item+1}}</td>
                  <td>{{$val->participant->name_en}}</td>
                  <td>{{$val->participant->email}}</td>
                  <td>{{$val->participant->phone}}</td>
                  <td class="text-capitalize p-1 " width="200px" >
                    {{-- <div class="onoffswitch">
                      <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"
                             @checked( \App\Models\User::$statusArrays[1])
                             data-id=""
                             id="myonoffswitch">
                      <label class="onoffswitch-label" for="myonoffswitch">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                      </label>
                    </div> --}}
                    <div >
                      <select name="status" @if (($val->status == 'accepted'))
                        class="bg-success form-control"
                      @elseif(($val->status == 'pending'))
                      class="bg-warning form-control"
                      @else
                      class="bg-danger form-control"
                      @endif  id="">
                        <option   @if ($val->status == 'accepted')
                          @selected(true) 
                      @endif value="{{($val->status )}}">{{App\Models\jobFairHasParticipant::$status[1]}}</option>
                        <option  @if ($val->status == 'pending')
                          @selected(true) 
                        @endif value="{{($val->status )}}">{{App\Models\jobFairHasParticipant::$status[0]}}</option>
                        <option @if ($val->status == 'reject')
                          @selected(true) 
                        @endif value="{{($val->status )}}">{{App\Models\jobFairHasParticipant::$status[2]}}</option>
                      </select>
                    </div>
                  </td>
                </tr>
                @endforeach
                {{--                @foreach($datas as $key => $val)--}}
                {{--                  <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">--}}
                {{--                    <td class="p-1">{{ ($key+1) }}</td>--}}
                {{--                    <td class="p-1 text-capitalize"><a href="{{ route('institute.trainings.details', $val->training_id) }}">{{ $val->training?->title }}</a></td>--}}
                {{--                    <td class="p-1 text-capitalize">{{ $val->training?->institute?->name }}</td>--}}
                {{--                    <td class="p-1">{{ $val->training?->start_date . ' to ' . $val->training?->end_date }}</td>--}}
                {{--                    <td class="p-1">{{ $val->created_at->format('h:i A F d, Y') }}</td>--}}
                {{--                    <td class="p-1 text-capitalize">{{ $val->status }}</td>--}}
                {{--                    <td class="p-0">--}}
                {{--                      @if($val->created_at == $val->updated_at && $val->status == \App\Models\TrainingMember::$statusArrays[0] )--}}
                {{--                        <a href="{{ route('admin.my.training.withdraw', $val->id) }}" class="btn btn-sm btn-warning" style="cursor: pointer">Withdraw</a>--}}
                {{--                      @endif--}}
                {{--                    </td>--}}
                {{--                  </tr>--}}
                {{--                @endforeach--}}
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
          <h4>Delete Training</h4>
        </div>
        <div class="modal-body">
          <strong>Are you sure to delete this training?</strong>
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
          url: "{{ route('admin.training.destroy') }}",
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
