@extends('layout.admin')

@section('stylesheet')
  <!-- DataTables -->
  <link href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>
  <link href="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>

  <link href="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>

  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">

  <style>
    .bg {
      border-radius: 2px;
      padding: 0 4px;
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
              <h2 class="panel-title">Training Info</h2>
            </header>

            <div class="row">
              <div class="col-md-12">
                <h3 class="panel-sub-title text-center">{{ $training->title }}</h3>
              </div>
              <div class="col-md-6">
                <h6 class="mb-2">Start: <span class="bold-500">{{ $training->start_date }}</span></h6>
                <h6 class="mb-2">End: <span class="bold-500">{{ $training->start_date }}</span></h6>
                <h6 class="mb-2">Status: <span class="bold-500 bg bg-{{ $training->status }}">{{ $training->status }}</span></h6>
                <h6 class="mb-2">Type: <span class="bold-500">{{ $training->type->name }}</span></h6>
                <h6 class="mb-2">Participant Type: <span class="bold-500">
                    @foreach($training->participants as $type)
                      <span class="bg bg-success mr-2 text-white">{{$type->name}}</span>
                    @endforeach
                  </span></h6>
              </div>
              <div class="col-md-6 text-right">
                <h6 class="mb-2">Institute: <span class="bold-500">{{ $training->institute?->name }}</span></h6>
                <h6 class="mb-2">Creator: <span class="bold-500">{{ $training->user?->name_en }}</span></h6>
                <h6 class="mb-2">Trainee: <span class="bold-500">{{ count($training->members) }}</span></h6>
                <h6 class="mb-2">Created At: <span class="bold-500">{{ $training->created_at->format('Y-m-d') }}</span></h6>
                <h6 class="mb-2">Participant Limit: <span class="bold-500">{{ $training->participant_limit }}</span></h6>
              </div>
            </div>

            <header class="panel-heading">
              <h2 class="panel-title">Pending Trainee List</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                     cellspacing="0" width="100%" style="font-size: 14px">
                <thead>
                <tr>
                  <th width="50">SN</th>
                  <th>Name</th>
                  <th>Principal</th>
                  <th>Creator</th>
                  <th>Approver</th>
                  <th>Applied At</th>
                  <th class="hidden-phone" width="200">
                    <label for="all"> Select all <input type="checkbox" id="all"></label>
                    <span class="btn btn-sm btn-primary submitBtn" style="float: right" data-id="{{ $training->id }}">Submit</span>
                  </th>
                </tr>
                </thead>
                <tbody>
                @foreach($pendings as $key => $val)
                  <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                    <td class="p-1">{{ ($key+1) }}</td>
                    <td class="p-1 text-capitalize">{{ $val->name }}</td>
                    <td class="p-1">
                      @if($val->head)
                        <span class="text-capitalize">{{ $val->head->name_en ?? '' }}</span><br>
                        <span title="{{ \App\Helper\CustomHelper::makeDateFormat($val->institute_head_approve_at, '(h:i A) F d,Y') }}"
                              class="bg @if($val->institute_head_approve_status === \App\Models\TrainingMember::$approvalArrays[0]) bg-success @else bg-warning @endif">{{ ucfirst($val->institute_head_approve_status) }}</span>
                      @endif
                    </td>
                    <td class="p-1">
                      @if($val->creator)
                        <span class="text-capitalize">{{ $val->creator->name_en ?? '' }}</span><br>
                        <span title="{{ \App\Helper\CustomHelper::makeDateFormat($val->batch_creator_approve_at, '(h:i A) F d,Y') }}"
                              class="bg @if($val->batch_creator_approve_status === \App\Models\TrainingMember::$approvalArrays[0]) bg-success @else bg-warning @endif">{{ ucfirst($val->batch_creator_approve_status) }}</span>
                      @endif
                    </td>
                    <td class="p-1">
                      @if($val->approver)
                        <span class="text-capitalize">{{ $val->approver->name_en ?? '' }}</span><br>
                        <span title="{{ \App\Helper\CustomHelper::makeDateFormat($val->batch_approver_approve_at, '(h:i A) F d,Y') }}"
                              class="bg @if($val->batch_approver_approve_status === \App\Models\TrainingMember::$approvalArrays[0]) bg-success @else bg-warning @endif">{{ ucfirst($val->batch_approver_approve_status) }}</span>
                      @endif
                    </td>
                    <td class="p-1">{{ $val->created_at->format('(h:i A) F d,Y') }}</td>
                    <td class="text-center hidden-phone p-1" width="200">
                      <input type="checkbox" name="members[]" class="mr-2" value="{{ $val->id }}" @checked($val->status == \App\Models\Training::$statusArrays[1])>
                      @if($val->status != \App\Models\Training::$statusArrays[1])
                        <a href="{{ route('admin.training.approval.member.update', ['id'=>$val->id, 'status' => \App\Models\TrainingMember::$statusArrays[1]]) }}"
                           class="btn btn-sm btn-success btn-action action_{{ $val->id }}" style="cursor: pointer">Accept</a>
                      @endif
                      @if($val->status != \App\Models\Training::$statusArrays[2])
                        <a href="{{ route('admin.training.approval.member.update', ['id'=>$val->id, 'status' => \App\Models\TrainingMember::$statusArrays[2]]) }}"
                           class="btn btn-sm btn-danger btn-action action_{{ $val->id }}" style="cursor: pointer">Reject</a>
                      @endif
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
              <header class="panel-heading">
                <h2 class="panel-title">Accepted Trainee List</h2>
              </header>
              <div class="panel-body">
                @hasanyrole(['Super Admin', 'Batch Approver'])
                <div class="row">
                  <div class="col-md-12 mb-4">
                    <button class="btn btn-info btn-sm w-full text-center" id="add_member_btn">Add Trainee</button>
                  </div>
                </div>
{{--                <form action="{{ route('admin.training.approval.member.add', $training->id) }}" method="post" class="mb-5">--}}
{{--                  <div class="row">--}}
{{--                    @csrf--}}
{{--                    <div class="col-md-12">--}}
{{--                      <div class="form-group">--}}
{{--                        <label for="">Trainee</label>--}}
{{--                        <select name="members[]" multiple class="form-control select2">--}}
{{--                          @foreach($users as $user)--}}
{{--                            <option value="{{ $user->id }}">{{ $user->name . ' -- ('.$user->role.') -- '.$user->institute}}</option>--}}
{{--                          @endforeach--}}
{{--                        </select>--}}
{{--                      </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-12">--}}
{{--                      <button class="btn btn-success btn-sm text-center w-full" type="submit">Submit</button>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </form>--}}
                @endhasanyrole

                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                       cellspacing="0" width="100%" style="font-size: 14px">
                  <thead>
                  <tr>
                    <th width="10">SN</th>
                    <th>Name</th>
                    <th>Institute</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Applied At</th>
                    <th>Option</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($accepted as $key => $val)
                    <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif"
                        @if($val->replace_from) title="{{ $val->replacedfrom?->name_en }}" @endif
                    >
                      <td class="p-1">{{ ($key+1) }}</td>
                      <td class="p-1 text-capitalize">{{ $val->name }}</td>
                      <td class="p-1 text-capitalize">{{ $val->user->institute->name }}</td>
                      <td class="p-1 text-capitalize">{{ $val->phone }}</td>
                      <td class="p-1 text-capitalize">{{ $val->email }}</td>
                      <td class="p-1 text-capitalize">{{ $val->created_at->format('(h:i A) F d,Y') }}</td>
                      <td class="p-1 text-center">
                        @if($val->replace_by)
                          <span title="{{ $val->replacedby?->name_en }}">Replaced</span>
                        @else
                        <span class="btn btn-sm btn-info btn-replace replace_{{ $val->id }}" style="cursor: pointer"
                              data-id="{{ $val->id }}" data-name="{{ $val->name }}" data-institute="{{ $val->user->institute->name }}">
                          <i class="fa fa-recycle"></i></span>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
                <header class="panel-heading">
                  <h2 class="panel-title">Rejected Trainee List</h2>
                </header>
                <div class="panel-body">
                  <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                         cellspacing="0" width="100%" style="font-size: 14px">
                    <thead>
                    <tr>
                      <th width="50">SN</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Applied At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rejected as $key => $val)
                      <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                        <td class="p-1">{{ ($key+1) }}</td>
                        <td class="p-1 text-capitalize">{{ $val->name }}</td>
                        <td class="p-1 text-capitalize">{{ $val->phone }}</td>
                        <td class="p-1 text-capitalize">{{ $val->email }}</td>
                        <td class="p-1 text-capitalize">{{ $val->created_at->format('(h:i A) F d,Y') }}</td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModal"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 60%">
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="font-size: 25px;" class="text-center">Add Trainee</h4>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
              <path fill="none" d="M0 0h24v24H0z"></path>
              <path fill="currentColor" d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"></path>
            </svg>
          </button>
        </div>
        <form action="{{ route('admin.training.approval.member.add', $training->id) }}" method="post" class="mb-5">
          @csrf
        <div class="modal-body" style="font-size: 20px;">
          <div class="add-wrap">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Type</label>
                  <select name="add_member_type" class="form-control @error('add_member_type') is-invalid @enderror">
                    <option value="">Choose a type</option>
                    @foreach($types as $type)
                      <option  value="{{ $type->name }}" @selected($type->name == old('add_member_type'))>{{ $type->name }}</option>
                    @endforeach
                  </select>
                  @error('add_member_type')
                  <strong class="text-danger">{{ $errors->first('add_member_type') }}</strong>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Division</label>
                  <select name="add_member_repDivision" class="form-control @error('add_member_repDivision') is-invalid @enderror">
                    <option value="">Choose a division</option>
                    @foreach($divisions as $division)
                      <option value="{{ $division->id }}" @selected($division->id == old('add_member_repDivision'))>{{ $division->name }}</option>
                    @endforeach
                  </select>
                  @error('add_member_repDivision')
                  <strong class="text-danger">{{ $errors->first('add_member_repDivision') }}</strong>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Institute </label>
                  <select name="add_member_institute" class="form-control">
                    <option value="">Choose a institute</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Technology</label>
                  <input type="text" class="form-control" name="add_member_technology">
                  @error('add_member_technology')
                  <strong class="text-danger">{{ $errors->first('add_member_technology') }}</strong>
                  @enderror
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">Trainee</label>
                  <select name="members[]" multiple id="add_members" class="form-control select2" required></select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-sm yes-btn">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>


  <div class="modal fade" id="replaceModal" tabindex="-1" role="dialog" aria-labelledby="replaceModal"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 60%">
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="font-size: 25px;" class="text-center">Replace Member</h4>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
              <path fill="none" d="M0 0h24v24H0z"></path>
              <path fill="currentColor" d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"></path>
            </svg>
          </button>
        </div>
        <form action="{{ route('admin.training.approval.replace') }}" id="replaceForm" method="POST">
          @csrf
        <div class="modal-body" style="font-size: 20px;">
          <div class="add-wrap">
            <div class="row">
              <div class="col-md-12">
                <h6 class="mb-2">Replace To</h6>
                <h6 class="mb-2">Name: <span id="memberName"></span></h6>
                <h6 class="mb-4">Institute Name: <span id="instituteName"></span></h6>
              </div>
              <div class="col-md-12 mt-3">
                <h6 class="mb-2">Replace By</h6>
              </div>
              <div class="col-md-12">
                <input type="hidden" name="repId" id="member_id">
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Type<span class="text-danger">*</span></label>
                  <select name="type" class="form-control @error('type') is-invalid @enderror" required>
                    <option value="">Choose a type</option>
                    @foreach($types as $type)
                      <option  value="{{ $type->name }}" @selected($type->name == old('type'))>{{ $type->name }}</option>
                    @endforeach
                  </select>
                  @error('type')
                  <strong class="text-danger">{{ $errors->first('type') }}</strong>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Division<span class="text-danger">*</span></label>
                  <select name="repDivision" class="form-control @error('repDivision') is-invalid @enderror" required>
                    <option value="">Choose a division</option>
                    @foreach($divisions as $division)
                      <option value="{{ $division->id }}" @selected($division->id == old('repDivision'))>{{ $division->name }}</option>
                    @endforeach
                  </select>
                  @error('repDivision')
                  <strong class="text-danger">{{ $errors->first('repDivision') }}</strong>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Institute <span class="text-danger">*</span></label>
                  <select name="institute" class="form-control" required>
                    <option value="">Choose a institute</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Technology <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="technology">
                  @error('type')
                  <strong class="text-danger">{{ $errors->first('type') }}</strong>
                  @enderror
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">Trainee</label>
                  <select name="replaceMember" class="form-control select2"></select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-sm yes-btn">Submit</button>
        </div>
        </form>
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


  <script>
    $(document).ready(function () {
      $('.select2').select2()
      // $('#datatable-buttons').DataTable();

      // var table = $('#datatable-buttons').DataTable({
      //   lengthChange: false,
      //   buttons: ['copy', 'excel', 'pdf', 'colvis']
      // });
      //
      // table.buttons().container()
      //   .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

      $(document).on('click', '.btn-replace', function () {
        const $this = $(this);
        var name = $(this).data('name');
        var institute = $(this).data('institute');
        var id = $(this).data('id')

        $('#member_id').val(id)
        $('#memberName').text(name)
        $('#instituteName').text(institute)
        $('#replaceModal').modal('show')
      })

      $('.submitBtn').click(function () {
        let accepted = $.map($('input[name="members[]"]:checked'), function (c) {
          return c.value;
        })
        let rejected = $.map($('input[name="members[]"]:not(:checked)'), function (c) {
          return c.value;
        })
        if (accepted.length < 1) {
          accepted = [];
        }
        const id = $(this).data('id')
        $.ajax({
          url: "{{ route('admin.training.approval.member.list.update') }}",
          method: "post",
          dataType: "html",
          data: {'id': id, 'accepted': accepted, 'rejected': rejected},
          success: function (data) {
            // console.log(data)
            if (data === "success") {
              window.location.reload()
            }
          }
        });
      })

      $('#all').change(function () {
        if ($(this).is(':checked')) {
          $('input[name="members[]"]').prop("checked", true)
        } else {
          $('input[name="members[]"]').prop("checked", false)
        }
      })



      function add_member_populateInstitute() {
        const type = $('select[name="add_member_type"]').val()
        const division = $('select[name="add_member_repDivision"]').val()
        let data = {}
        if (type !== ''){
          data = {...data, type: type}
        }
        if (division !== ''){
          data = {...data, repDivision: division}
        }
        const $this = $('select[name="add_member_institute"]')
        $.ajax({
          url: "{{ route('admin.ajax.institute.from.type.and.division') }}",
          type: "GET",
          dataType: 'json',
          data: data,
          success: function (result) {
            $this.html('<option value="">Choose a institute</option>');
            $.each(result, function (key, value) {
              $this.append('<option value="' + value
                .id + '">' + value.name + '</option>');
            });
          }
        });
      }

      $('select[name="add_member_type"]').change(function () {
        add_member_populateInstitute()
      })
      $('select[name="add_member_repDivision"]').change(function () {
        add_member_populateInstitute()
      })


      $('select[name="add_member_institute"]').change(function () {
        const institute = $('select[name="add_member_institute"]').val()
        const $this = $('select[name="members[]"]')
        $.ajax({
          url: "{{ route('admin.ajax.user.from.institute') }}",
          type: "GET",
          dataType: 'json',
          data: {institute: institute},
          success: function (result) {
            $this.html('<option value="">Choose a member</option>');
            $.each(result, function (key, value) {

              $this.append('<option value="' + value
                .id + '">' + value.name + ' -- ('+value.role+') -- '+value.institute + '</option>');
            });
          }
        });
      })


      $('#add_member_replaceForm').submit(function (e) {
        e.preventDefault()
        const url = $(this).attr('action')
        const repId = $('select[name="members[]"]').val()
        console.log(repId)
        $.ajax({
          url: url,
          type: "POST",
          dataType: 'html',
          data: {id: id, repId: repId},
          success: function (result) {
            $('#addMemberModal').modal('hide')
            window.location.reload()
          }
        });
      })

      $('#add_member_btn').click(function () {
        $('#addMemberModal').modal('show')
      })





      function populateInstitute() {
        const type = $('select[name="type"]').val()
        const division = $('select[name="repDivision"]').val()
        let data = {}
        if (type !== ''){
          data = {...data, type: type}
        }
        if (division !== ''){
          data = {...data, repDivision: division}
        }
        const $this = $('select[name="institute"]')
        $.ajax({
          url: "{{ route('admin.ajax.institute.from.type.and.division') }}",
          type: "GET",
          dataType: 'json',
          data: data,
          success: function (result) {
            $this.html('<option value="">Choose a institute</option>');
            $.each(result, function (key, value) {
              $this.append('<option value="' + value
                .id + '">' + value.name + '</option>');
            });
          }
        });
      }

      $('select[name="type"]').change(function () {
        populateInstitute()
      })
      $('select[name="repDivision"]').change(function () {
        populateInstitute()
      })


      $('select[name="institute"]').change(function () {
        const institute = $('select[name="institute"]').val()
        const $this = $('select[name="replaceMember"]')
        $.ajax({
          url: "{{ route('admin.ajax.user.from.institute') }}",
          type: "GET",
          dataType: 'json',
          data: {institute: institute},
          success: function (result) {
            $this.html('<option value="">Choose a member</option>');
            $.each(result, function (key, value) {

              $this.append('<option value="' + value
                .id + '">' + value.name + ' -- ('+value.role+') -- '+value.institute + '</option>');
            });
          }
        });
      })


      $('#replaceForm').submit(function (e) {
        e.preventDefault()
        const url = $(this).attr('action')
        const id = $('input[name="repId"]').val()
        const repId = $('select[name="replaceMember"]').val()
        console.log(id)
        console.log(repId)
        $.ajax({
          url: url,
          type: "POST",
          dataType: 'html',
          data: {id: id, repId: repId},
          success: function (result) {

            $('#replaceModal').modal('hide')
            window.location.reload()
          }
        });
      })


    })
  </script>

@endsection
