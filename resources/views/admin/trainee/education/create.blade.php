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
              <h2 class="panel-title">Add Education</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.education.store') }}" method="post">
                @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="control-label">Exam Name</label>
                          <input type="text" name="exam_name" placeholder="Exam Name" autocomplete="off"
                                 value="{{ old('exam_name') }}"
                                 class="form-control @error('exam_name') is-invalid @enderror">
                          @error('exam_name')
                          <strong class="text-danger">{{ $errors->first('exam_name') }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="control-label">Institute</label>
                          <input type="text" name="institute" placeholder="Institute" autocomplete="off"
                                 value="{{ old('institute') }}"
                                 class="form-control @error('institute') is-invalid @enderror">
                          @error('institute')
                          <strong class="text-danger">{{ $errors->first('institute') }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="control-label">Education Board</label>
                          <input type="text" name="board" placeholder="Education Board" autocomplete="off"
                                 value="{{ old('board') }}"
                                 class="form-control @error('board') is-invalid @enderror">
                          @error('board')
                          <strong class="text-danger">{{ $errors->first('board') }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="control-label">Department</label>
                          <input type="text" name="department" placeholder="Department" autocomplete="off"
                                 value="{{ old('department') }}"
                                 class="form-control @error('department') is-invalid @enderror">
                          @error('department')
                          <strong class="text-danger">{{ $errors->first('department') }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="control-label">Year</label>
                          <input type="text" name="year" placeholder="Year" autocomplete="off"
                                 value="{{ old('year') }}"
                                 class="year-picker form-control @error('year') is-invalid @enderror">
                          @error('year')
                          <strong class="text-danger">{{ $errors->first('year') }}</strong>
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
      <header class="panel-heading">
        <h2 class="panel-title">Education Info</h2>
      </header>
      @foreach($educations as $val)
        <div class="card" id="education-list">
          <div class="card-body">
            <div class="col-md-12 text-center row" style="display: flex;justify-content: space-between;">
              <div class="col-md-5">
                <ul class="text-left">
                  <li><strong>Exam Name :</strong>{{ $val->exam_name }}</li>
                  <li><strong>Institute :</strong> {{ $val->institute }}</li>
                  <li><strong>Board :</strong> {{ $val->board }}</li>
                  <li><strong>Department :</strong> {{ $val->department }}</li>
                  <li><strong>Year :</strong> {{ $val->year }}</li>
                </ul>
              </div>
              <div class="col-md-2">
                <div class="text-center mt-5 mr-5">
                  @if(\App\Helper\CustomHelper::canView('Manage Education', 'Super Admin'))
                    <a href="{{ route('admin.education.manage', [$val->id]) }}"
                       class="btn btn-sm btn-success"> <i class="fa fa-edit"></i> </a>
                  @endif
                  @if(\App\Helper\CustomHelper::canView('Delete Education', 'Super Admin'))
                    <span class="btn btn-sm btn-danger btn-delete delete_{{ $val->id }}" style="cursor: pointer"
                          data-id="{{ $val->id }}"><i class="fa fa-trash-o"></i></span>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
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
          url: "{{ route('admin.education.destroy') }}",
          method: "DELETE",
          dataType: "html",
          data: {id: pid},
          success: function (data) {
            if (data === "success") {
              $('#userDeleteModal').modal('hide')
              $this.closest('#education-list').css('background-color', 'red').fadeOut();
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
