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
              <h2 class="panel-title">Add Certificate</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.certificate.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <input type="text" name="user_id" value="{{ Auth::user()->id }}" autocomplete="off" required hidden>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="control-label">Name</label>
                          <input type="text" name="name" placeholder="Name" autocomplete="off" value="{{ old('name') }}"
                                 class="form-control @error('name') is-invalid @enderror">
                          @error('name')
                          <strong class="text-danger">{{ $errors->first('name') }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="control-label">Type</label>
                          <select name="type" class="form-control @error('type') is-invalid @enderror">
                            <option value="">Choose a type</option>
                            @foreach(\App\Models\Certificate::$typeArrays as $type)
                              <option value="{{ $type }}"
                                      @if(old('type') == $type) selected @endif>{{ ucfirst($type) }}</option>
                            @endforeach
                          </select>
                          @error('type')
                          <strong class="text-danger">{{ $errors->first('type') }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="control-label">Attachment</label>
                          <input type="file" name="attachment" placeholder="File" autocomplete="off"
                                 value="{{ old('attachment') }}"
                                 class="form-control @error('attachment') is-invalid @enderror">
                          @error('attachment')
                          <strong class="text-danger">{{ $errors->first('attachment') }}</strong>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 text-right">
                        <button class="btn btn-danger btn-sm" type="submit">Submit</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <header class="panel-heading">
            <h2 class="panel-title">Certificate Info</h2>
          </header>
          <div class="row">

            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                   cellspacing="0" width="100%" style="font-size: 14px">

              <thead>
              <tr>
                <th width="50">#</th>
                <th>Name</th>
                <th>Type</th>
                <th width="200">attachment</th>
                @if(\App\Helper\CustomHelper::canView('Manage Certificate|Delete Certificate', 'Super Admin'))
                  <th class="hidden-phone" width="40">Option</th>
                @endif
              </tr>
              </thead>
              <tbody>
              @foreach($certificates as $key => $val)
                <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                  <td class="p-1">{{ ($key+1) }}</td>
                  <td class="p-1 text-capitalize">{{ $val->name }}</td>
                  <td class="p-1">{{ $val->type }}</td>
                  <td class="p-1 text-center"><a class="btn btn-primary" href="{{ asset($val->attachment) }}" ><i class="fa fa-file-text-o fa-2x" aria-hidden="true"></i></a></td>
                  <td>
                    @if(\App\Helper\CustomHelper::canView('Delete Certificate', 'Super Admin'))
                      <span class="btn btn-sm btn-danger btn-delete delete_{{ $val->id }}" style="cursor: pointer"
                            data-id="{{ $val->id }}"><i class="fa fa-trash-o"></i></span>
                    @endif
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="userDeleteModal" tabindex="-1" role="dialog" aria-labelledby="userDeleteModal"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Delete Info</h4>
        </div>
        <div class="modal-body">
          <strong>Are you sure to delete this info?</strong>
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
          url: "{{ route('admin.certificate.destroy') }}",
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
