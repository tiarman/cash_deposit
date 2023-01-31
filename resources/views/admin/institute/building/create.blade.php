@extends('layout.admin')

@section('stylesheet')
  <link rel="stylesheet" href="{{ asset('assets/admin/css/jquery-ui.min.css') }}">
  <style>
    .col- {
      padding-left: 10px;
      padding-right: 10px;
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
              <h2 class="panel-title">Create new asset</h2>
            </header>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                  <a href="{{ route('admin.institute.building.list') }}" class="brn btn-success btn-sm">List of Assets</a>
                </div>
              </div>
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              <form action="{{ route('admin.institute.building.store') }}" id="form-root" method="post">
                @csrf
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Building name <span class="text-danger">*</span></label>
                      <input type="text" name="building_name" placeholder="Building name" required value="{{ old('building_name') }}"
                             class="form-control @error('building_name') is-invalid @enderror"
                             data-url="{{ route('admin.ajax.search.building.name') }}">
                      @error('building_name')
                      <strong class="text-danger">{{ $errors->first('building_name') }}</strong>
                      @enderror
                      <strong class="text-danger" id="building_name_error"></strong>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Block name <span class="text-danger">*</span></label>
                      <input type="text" name="block_name" placeholder="Block block name" required value="{{ old('block_name') }}"
                             class="form-control @error('block_name') is-invalid @enderror"
                             data-url="{{ route('admin.ajax.search.block.name') }}">
                      @error('block_name')
                      <strong class="text-danger">{{ $errors->first('block_name') }}</strong>
                      @enderror
                      <strong class="text-danger" id="block_name_error"></strong>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Floor name <span class="text-danger">*</span></label>
                      <input type="text" name="floor_name" placeholder="Floor floor name" required value="{{ old('floor_name') }}"
                             class="form-control @error('floor_name') is-invalid @enderror"
                             data-url="{{ route('admin.ajax.search.floor.name') }}">
                      @error('floor_name')
                      <strong class="text-danger">{{ $errors->first('floor_name') }}</strong>
                      @enderror
                      <strong class="text-danger" id="floor_name_error"></strong>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Room name <span class="text-danger">*</span></label>
                      <input type="text" name="room_name" placeholder="Room name" required value="{{ old('room_name') }}"
                             class="form-control @error('room_name') is-invalid @enderror"
                             data-url="{{ route('admin.ajax.search.room.name') }}">
                      @error('room_name')
                      <strong class="text-danger">{{ $errors->first('room_name') }}</strong>
                      @enderror
                      <strong class="text-danger" id="room_name_error"></strong>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Room number <span class="text-danger">*</span></label>
                      <input type="text" name="room_no" placeholder="Room number" required value="{{ old('room_no') }}"
                             class="form-control @error('room_no') is-invalid @enderror"
                             data-url="{{ route('admin.ajax.search.room.no') }}">
                      @error('room_no')
                      <strong class="text-danger">{{ $errors->first('room_no') }}</strong>
                      @enderror
                      <strong class="text-danger" id="room_no_error"></strong>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">SN <span class="text-danger">*</span></label>
                      <input type="number" name="sn" placeholder="Serial no" required value="{{ old('sn') }}"
                             class="form-control @error('sn') is-invalid @enderror">
                      @error('sn')
                      <strong class="text-danger">{{ $errors->first('sn') }}</strong>
                      @enderror
                      <strong class="text-danger" id="sn_error"></strong>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 h4">Item Information</div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Name of Item <span class="text-danger">*</span></label>
                      <input type="text" name="name_of_item" placeholder="Name of item" required value="{{ old('name_of_item') }}"
                             class="form-control @error('name_of_item') is-invalid @enderror"
                             data-url="{{ route('admin.ajax.search.item.name') }}">
                      @error('name_of_item')
                      <strong class="text-danger">{{ $errors->first('name_of_item') }}</strong>
                      @enderror
                      <strong class="text-danger" id="name_of_item_error"></strong>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Prefix<span class="text-danger">*</span></label>
                      <input type="text" name="prefix" placeholder="Prefix" required value="{{ old('prefix') }}"
                             class="form-control @error('prefix') is-invalid @enderror">
                      @error('prefix')
                      <strong class="text-danger">{{ $errors->first('prefix') }}</strong>
                      @enderror
                      <strong class="text-danger" id="prefix_error"></strong>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">SN From<span class="text-danger">*</span></label>
                          <input type="number" name="serial" placeholder="From" required value="{{ old('serial') }}"
                                 class="form-control @error('serial') is-invalid @enderror">
                          @error('serial')
                          <strong class="text-danger">{{ $errors->first('serial') }}</strong>
                          @enderror
                          <strong class="text-danger" id="serial_error"></strong>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">SN To</label>
                          <input type="number" name="serial_to" placeholder="To" value="{{ old('serial_to') }}"
                                 class="form-control @error('serial_to') is-invalid @enderror">
                          @error('serial_to')
                          <strong class="text-danger">{{ $errors->first('serial_to') }}</strong>
                          @enderror
                          <strong class="text-danger" id="serial_to_error"></strong>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Quantity <span class="text-danger">*</span></label>
                          <input type="number" name="quantity" placeholder="Quantity" required value="{{ old('quantity') }}"
                                 class="form-control @error('quantity') is-invalid @enderror">
                          @error('quantity')
                          <strong class="text-danger">{{ $errors->first('quantity') }}</strong>
                          @enderror
                          <strong class="text-danger" id="quantity_error"></strong>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Status<span class="text-danger">*</span></label>
                      <select name="status" required class="form-control @error('status') is-invalid @enderror">
                        <option value="">Choose a status</option>
                        @foreach(\App\Models\InstituteBuildingItem::$statusArrays as $status)
                          <option value="{{ $status }}"
                                  @if(old('status') == $status) selected @endif>{{ ucfirst($status) }}</option>
                        @endforeach
                      </select>
                      @error('status')
                      <strong class="text-danger">{{ $errors->first('status') }}</strong>
                      @enderror
                      <strong class="text-danger" id="status_error"></strong>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label class="control-label">Remarks </label>
                    <textarea name="remarks" rows="3" class="form-control @error('remarks') is-invalid @enderror">{{ old('remarks') }}</textarea>
                    @error('remarks')
                    <strong class="text-danger">{{ $errors->first('remarks') }}</strong>
                    @enderror
                    <strong class="text-danger" id="remarks_error"></strong>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-sm-12 text-right">
                    <button class="btn btn-danger btn-sm" type="submit">Submit</button>
                  </div>
                </div>
              </form>

              <div class="row mt-2 d-none" id="table">
                <div class="col-md-12 table-responsive">
                  <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                         cellspacing="0" width="100%" style="font-size: 14px">

                    <thead>
                    <tr>
                      <th width="10">#</th>
                      <th>Name of Item</th>
                      <th>Accn No</th>
                      <th>Quantity</th>
                      <th width="50">Status</th>
                      <th class="hidden-phone" width="40">Option</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">

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
  <div class="modal fade" id="userDeleteModal" tabindex="-1" role="dialog" aria-labelledby="userDeleteModal"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Delete building item?</h4>
        </div>
        <div class="modal-body">
          <strong>Are you sure to delete building item?</strong>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-success yes-btn btn-sm">Yes</button>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('script')
  <script src="{{ asset('assets/admin/js/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/custom.js') }}"></script>
  <script>
    $(document).ready(function () {
      const buildingName = $('input[name="building_name"]');
      const buildingNameError = $('#building_name_error');
      const blockName = $('input[name="block_name"]');
      const blockNameError = $('#block_name_error');
      const floorName = $('input[name="floor_name"]');
      const floorNameError = $('#floor_name_error');
      const roomName = $('input[name="room_name"]');
      const roomNameError = $('#room_name_error');
      const roomNo = $('input[name="room_no"]');
      const roomNoError = $('#room_no_error');
      const sn = $('input[name="sn"]');
      const snError = $('#sn_error');
      const itemName = $('input[name="name_of_item"]');
      const itemNameError = $('#name_of_item_error');
      const prefix = $('input[name="prefix"]');
      const prefixError = $('#prefix_error');
      const serial = $('input[name="serial"]');
      const serialError = $('#serial_error');
      const serialTo = $('input[name="serial_to"]');
      const serialToError = $('#serial_to_error');
      const quantity = $('input[name="quantity"]');
      const quantityError = $('#quantity_error');
      const status = $('select[name="status"]');
      const statusError = $('#status_error');
      const remarks = $('textarea[name="remarks"]');
      const remarksError = $('#remarks_error');

      let buildingId = 0;
      let instituteId = 0;

      function resetItem() {
        itemName.val('');
        itemNameError.text('');
        prefix.val('');
        prefixError.text('');
        serial.val('');
        serialError.text('');
        serialTo.val('');
        serialToError.text('');
        quantity.val('');
        quantityError.text('');
        status.val('').change();
        statusError.text('');
        remarks.val('');
        remarksError.text('');
      }

      function renderTable(data) {
        $('#table').removeClass('d-none')
        let content = '';
        $.each(data, function (index, item) {
          content += '<tr>' +
            '<td class="p-1">' + (index + 1) + '</td>' +
            '<td class="p-1">' + item.name + '</td>' +
            '<td class="p-1">' + item.accn_no + '</td>' +
            '<td class="p-1">' + item.quantity + '</td>' +
            '<td class="text-capitalize p-1">' + item.status + '</td>' +
            '<td class="text-center p-1" width="100">' +
            '<a href="' + item.edit_url + '" class="btn btn-sm btn-success"> <i class="fa fa-edit"></i> </a>' +
            '<span class="btn btn-sm btn-danger btn-delete delete_' + item.id + '" style="cursor: pointer" data-id="' + item.id + '">' +
            '<i class="fa fa-trash-o"></i></span>' +
            '</td>' +
            '</tr>';
        })
        $('#tbody').empty()
        $('#tbody').append(content)
      }

      $('#form-root').submit(function (e) {
        e.preventDefault();
        const $url = $(this).attr('action');
        const $method = $(this).attr('method');
        const form = $(this);
        const $formData = {
          building_name: buildingName.val(),
          block_name: blockName.val(),
          floor_name: floorName.val(),
          room_name: roomName.val(),
          room_no: roomNo.val(),
          sn: sn.val(),
          name_of_item: itemName.val(),
          prefix: prefix.val(),
          serial: serial.val(),
          serial_to: serialTo.val(),
          quantity: quantity.val(),
          status: status.val(),
          remarks: remarks.val(),
        };
        $.ajax({
          url: $url,
          method: "POST",
          dataType: "html",
          data: $formData,
          success: data => {
            data = JSON.parse(data)
            if ($.isEmptyObject(data.error)) {
              resetItem()
              renderTable(data.datas)
              console.log(typeof data)
              console.log(data)
            } else {
              buildingNameError.text(data.error.building_name);
              blockNameError.text(data.error.block_name);
              floorNameError.text(data.error.floor_name);
              roomNameError.text(data.error.room_name);
              roomNoError.text(data.error.room_no);
              snError.text(data.error.sn);
              itemNameError.text(data.error.name_of_item);
              prefixError.text(data.error.prefix);
              serialError.text(data.error.serial);
              quantityError.text(data.error.quantity);
              statusError.text(data.error.status);
              remarksError.text(data.error.remarks);

              buildingId = data.institute_buildings_id;
              instituteId = data.instituteId;

            }
            // if (data === "success") {
            // $('#userDeleteModal').modal('hide')
            // $this.closest('tr').css('background-color', 'red').fadeOut();
            // }
          }
        });
      })

      $('input[name="name_of_item"]').focusout(function () {
        const name = $(this).val()
        $.ajax({
          url: "{{ route('admin.ajax.get.item.prefix') }}",
          method: "GET",
          dataType: "html",
          data: { name: name },
          success: data => {
            prefix.val(data)
          }
        })
      })


      // delete building item
      $(document).on('click', '.yes-btn', function () {
        var pid = $(this).data('id');
        // let itemBuildingIntituteIdArray =  pid.split(' ');
        // console.log(itemBuildingIntituteIdArray[2])
        var $this = $('.delete_' + pid)
        $.ajax({
          url: "{{ route('admin.institute.building.item.Destroy') }}",
          method: "delete",
          dataType: "html",
          data: {id: pid},
          success: function (data) {
            if (data === "success") {
              $('#userDeleteModal').modal('hide')
              $this.closest('tr').css('background-color', 'red').fadeOut();
              // location.reload()
            }
          }
        });
      })

      // open delete modal
      $(document).on('click', '.btn-delete', function () {
        var pid = $(this).data('id');
        $('.yes-btn').data('id', pid);
        $('#userDeleteModal').modal('show')

      });
    })


  </script>
@endsection
