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
              <h2 class="panel-title">Add Job Experience</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.job.experience.store') }}" method="post">

                @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="control-label">Organization Name</label>
                          <input type="text" name="organization_name" placeholder="Organization Name" autocomplete="off"
                                 value="{{ old('organization_name') }}"
                                 class="form-control @error('organization_name') is-invalid @enderror">
                          @error('organization_name')
                          <strong class="text-danger">{{ $errors->first('organization_name') }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="control-label">Designation</label>
                          <input type="text" name="designation" placeholder="Designation" autocomplete="off"
                                 value="{{ old('designation') }}"
                                 class="form-control @error('designation') is-invalid @enderror">
                          @error('designation')
                          <strong class="text-danger">{{ $errors->first('designation') }}</strong>
                          @enderror
                        </div>
                      </div>


                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="control-label">Start date</label>
                          <input type="date" name="start_date" placeholder="Start Date" autocomplete="off"
                                 value="{{ old('start_date') }}"
                                 class="form-control @error('start_date') is-invalid @enderror">
                          @error('start_date')
                          <strong class="text-danger">{{ $errors->first('start_date') }}</strong>

                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="control-label">End Date</label>
                          <input type="date" name="end_date" placeholder="End Date" autocomplete="off"
                                 value="{{ old('end_date') }}"
                                 class="form-control @error('end_date') is-invalid @enderror">
                          @error('end_date')
                          <strong class="text-danger">{{ $errors->first('end_date') }}</strong>
                          @enderror
                        </div>
                      </div>

                      <div class="col-sm-12">
                        <div class="form-group">
                          <label class="control-label">Work Info</label>
                          <textarea type="text" name="role" placeholder="Work Info" autocomplete="off"
                                    value="{{ old('role') }}"
                                    class="form-control @error('role') is-invalid @enderror"></textarea>
                          @error('role')
                          <strong class="text-danger">{{ $errors->first('role') }}</strong>
                          @enderror
                        </div>
                      </div>


                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="control-label">Contact Person Name</label>
                          <input type="text" name="contact_name" placeholder="Contact Person Name" autocomplete="off"
                                 value="{{ old('contact_name') }}"
                                 class="form-control @error('contact_name') is-invalid @enderror">
                          @error('contact_name')
                          <strong class="text-danger">{{ $errors->first('contact_name') }}</strong>
                          @enderror
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="control-label">Contact Person Designation</label>
                          <input type="text" name="contact_designation" placeholder="Contact Person Designation" autocomplete="off"
                                 value="{{ old('contact_designation') }}"
                                 class="form-control @error('contact_designation') is-invalid @enderror">
                          @error('contact_designation')
                          <strong class="text-danger">{{ $errors->first('contact_designation') }}</strong>
                          @enderror
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="control-label">Contact Person Phone</label>
                          <input type="text" name="contact_phone" placeholder="Contact Person Phone" autocomplete="off"
                                 value="{{ old('contact_phone') }}"
                                 class="form-control @error('contact_phone') is-invalid @enderror">
                          @error('contact_phone')
                          <strong class="text-danger">{{ $errors->first('contact_phone') }}</strong>
                          @enderror
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="control-label">Contact Person Email</label>
                          <input type="text" name="contact_email" placeholder="Contact Person Email" autocomplete="off"
                                 value="{{ old('contact_email') }}"
                                 class="form-control @error('contact_email') is-invalid @enderror">
                          @error('contact_email')
                          <strong class="text-danger">{{ $errors->first('contact_email') }}</strong>
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
        <h2 class="panel-title">Job Experience Info</h2>
      </header>
      @foreach($job_experiences as $val)
      <div class="card" id="job-experience-list">
        <div class="card-body">
          <div class="col-md-12 text-center row" style="display: flex;justify-content: space-between;">
           <div class="col-md-5">
             <ul class="text-left">
               <li><strong>Organization Name :</strong>{{ $val->organization_name }}</li>
               <li><strong>Designation :</strong> {{ $val->designation }}</li>
               <li><strong>Job Description :</strong> {{ $val->role }}</li>
               <li><strong>Start date :</strong> {{ $val->start_date }}</li>
               <li><strong>End date :</strong> {{ $val->end_date }}</li>
             </ul>
           </div>
           <div class="col-md-5">
             <ul class="text-left">
               <li><strong>Contact Person Name</strong> : {{ $val->contact_name }}</li>
               <li><strong>Contact Person Designation</strong> {{ $val->contact_designation }}</li>
               <li><strong>Contact Person Phone</strong> {{ $val->contact_phone }}</li>
               <li><strong>Contact Person Email</strong> {{ $val->contact_email }}</li>
             </ul>
           </div>
           <div class="col-md-2">
             <div class="text-center mt-5 mr-5">
               @if(\App\Helper\CustomHelper::canView('Manage Job Experience', 'Super Admin'))
                 <a href="{{ route('admin.job.experience.manage', [$val->id]) }}"
                    class="btn btn-sm btn-success"> <i class="fa fa-edit"></i> </a>
               @endif
               @if(\App\Helper\CustomHelper::canView('Delete Job Experience', 'Super Admin'))
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
          url: "{{ route('admin.job.experience.destroy') }}",
          method: "DELETE",
          dataType: "html",
          data: {id: pid},
          success: function (data) {
            if (data === "success") {
              $('#userDeleteModal').modal('hide')
              $this.closest('#job-experience-list').css('background-color', 'red').fadeOut();
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
