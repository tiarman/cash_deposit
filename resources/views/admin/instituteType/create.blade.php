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
              <h2 class="panel-title">Create New Institute Type</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.institute.type.store') }}" method="post">
                @csrf
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Name<span class="text-danger">*</span></label>
                      <input type="text" name="name" placeholder="Institute Type Name" autocomplete="off" required
                             value="{{ old('name') }}"
                             class="form-control @if(!old('id')) @error('name') is-invalid @enderror @endif">
                      @if(!old('id'))
                        @error('name')
                        <strong class="text-danger">{{ $errors->first('name') }}</strong>
                        @enderror
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 text-right">
                    <button class="btn btn-danger btn-sm" type="submit">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
  <div>
    <br><br>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">list of Institute Types</h2>
            </header>
            <div class="panel-body">

              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                     cellspacing="0" width="100%" style="font-size: 14px">

                <thead>
                <tr>
                  <th width="50">#</th>
                  <th>Name</th>
                  <th width="200">Created</th>
                  <th width="200">Created By</th>
                  <th width="200">Updated By</th>
                  @if(\App\Helper\CustomHelper::canView('', 'Super Admin'))
                    <th class="hidden-phone" width="40">Option</th>
                  @endif
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $key => $val)
                  <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                    <td class="p-1">{{ ($key+1) }}</td>
                    <td class="p-1 text-capitalize">{{ $val->name }}</td>
                    <td width="200" class="p-1">{{ date('F d, Y h:i A', strtotime($val->created_at)) }}</td>
                    <td class="p-1">{{ $val->createdBy->name_en?? 'N\A'}}</td>
                    <td class="p-1">{{ $val->updatedBy->name_en?? 'N\A'}}</td>
                    @if(\App\Helper\CustomHelper::canView('', 'Super Admin'))
                      <td class="center hidden-phone p-1" width="100">
                        @if($val->id != 1)

                          @if(\App\Helper\CustomHelper::canView('', 'Super Admin'))
                            <button onclick="editInstituteType({{ $val->id }})"
                                    class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>
                          @endif
                          @if(\App\Helper\CustomHelper::canView('', 'Super Admin'))
                            <span class="btn btn-sm btn-danger btn-delete delete_{{ $val->id }}" style="cursor: pointer"
                                  data-id="{{ $val->id }}"><i class="fa fa-trash-o"></i></span>
                          @endif
                        @endif
                      </td>
                    @endif
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
          <h4>Delete Institute Type</h4>
        </div>
        <div class="modal-body">
          <strong>Are you sure to delete this Institute Type?</strong>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-success btn-sm yes-btn">Yes</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editInstituteTypeModal" tabindex="-1" role="dialog" aria-labelledby="editInstituteTypeModal"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><b>Edit Institute Type</b></h4><br>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.institute.type.store') }}" method="post">
            @csrf
            <input type="hidden" class="dt form-control" name="id" id="id">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Name<span class="text-danger">*</span></label>
                  <input type="text" name="name" id="name" placeholder="Name" autocomplete="off" required value="{{ old('name') }}"
                         class="form-control @if(old('id')) @error('name') is-invalid @enderror  @endif">
                  @if(old('id'))
                    @error('name')
                    <strong class="text-danger">{{ $errors->first('name') }}</strong>
                    @enderror
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 text-right">
                <button class="btn btn-danger btn-sm" type="submit">Submit</button>
              </div>
            </div>
          </form>
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

      $(document).on('click', '.yes-btn', function () {
        var pid = $(this).data('id');
        var $this = $('.delete_' + pid)
        $.ajax({
          url: "{{ route('admin.institute.type.destroy') }}",
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

  <script>
    function editInstituteType(id) {
      var instituteTypeId = id;
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });
      $.ajax({
        type: 'GET',
        url: '{{ route("admin.institute.type.store") }}',
        data: {
          id: instituteTypeId
        },
        success: function (data) {
          $("#id").val(data.id);
          $("#name").val(data.name);
          $("#editInstituteTypeModal").modal('show');
        }
      });
    }
  </script>

  <script>
      @if (count($errors) > 0 && old('id')){
      $(document).ready(function () {
        $('#editInstituteTypeModal').modal('show');
      });
    }
    @endif
  </script>
@endsection
