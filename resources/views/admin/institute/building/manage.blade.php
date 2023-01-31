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
              <h2 class="panel-title">Manage Asset</h2>
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

              <form action="{{ route('admin.institute.building.store') }}" method="post">
                @csrf
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Building name <span class="text-danger">*</span></label>
                      <input type="text" name="name" placeholder="Building name" required value="{{ old('name') }}"
                             class="form-control @error('name') is-invalid @enderror">
                      @error('name')
                      <strong class="text-danger">{{ $errors->first('name') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Block name <span class="text-danger">*</span></label>
                      <input type="text" name="block_name" placeholder="Block block name" required value="{{ old('block_name') }}"
                             class="form-control @error('block_name') is-invalid @enderror">
                      @error('block_name')
                      <strong class="text-danger">{{ $errors->first('block_name') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Floor name <span class="text-danger">*</span></label>
                      <input type="text" name="floor_name" placeholder="Floor floor name" required value="{{ old('floor_name') }}"
                             class="form-control @error('floor_name') is-invalid @enderror">
                      @error('floor_name')
                      <strong class="text-danger">{{ $errors->first('floor_name') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Room name <span class="text-danger">*</span></label>
                      <input type="text" name="room_name" placeholder="Room name" required value="{{ old('room_name') }}"
                             class="form-control @error('room_name') is-invalid @enderror">
                      @error('room_name')
                      <strong class="text-danger">{{ $errors->first('room_name') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Room number <span class="text-danger">*</span></label>
                      <input type="text" name="room_no" placeholder="Room number" required value="{{ old('room_no') }}"
                             class="form-control @error('room_no') is-invalid @enderror">
                      @error('room_no')
                      <strong class="text-danger">{{ $errors->first('room_no') }}</strong>
                      @enderror
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
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">Item Information</div>
                </div>
                <div class="row">
                  <div class="col-">
                    <div class="form-group">
                      <label class="control-label">Name of Item <span class="text-danger">*</span></label>
                      <input type="text" name="name_of_item" placeholder="Name of item" required value="{{ old('name_of_item') }}"
                             class="form-control @error('name_of_item') is-invalid @enderror">
                      @error('name_of_item')
                      <strong class="text-danger">{{ $errors->first('name_of_item') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-">
                    <div class="form-group">
                      <label class="control-label">Prefix<span class="text-danger">*</span></label>
                      <input type="text" name="prefix" placeholder="Prefix" required value="{{ old('prefix') }}"
                             class="form-control @error('prefix') is-invalid @enderror">
                      @error('prefix')
                      <strong class="text-danger">{{ $errors->first('prefix') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-">
                    <div class="form-group">
                      <label class="control-label">Serial No<span class="text-danger">*</span></label>
                      <input type="number" name="serial" placeholder="serial no" required value="{{ old('serial') }}"
                             class="form-control @error('serial') is-invalid @enderror">
                      @error('serial')
                      <strong class="text-danger">{{ $errors->first('serial') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-">
                    <div class="form-group">
                      <label class="control-label">Quantity <span class="text-danger">*</span></label>
                      <input type="number" name="quantity" placeholder="Floor floor name" required value="{{ old('quantity') }}"
                             class="form-control @error('quantity') is-invalid @enderror">
                      @error('quantity')
                      <strong class="text-danger">{{ $errors->first('quantity') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-">
                    <div class="form-group">
                      <label class="control-label">Status<span class="text-danger">*</span></label>
                      <select name="status" required class="form-control @error('status') is-invalid @enderror">
                        <option value="">Choose a status</option>
                        @foreach(\App\Models\InstituteBuilding::$statusArrays as $status)
                          <option value="{{ $status }}"
                                  @if(old('status') == $status) selected @endif>{{ ucfirst($status) }}</option>
                        @endforeach
                      </select>
                      @error('status')
                      <strong class="text-danger">{{ $errors->first('status') }}</strong>
                      @enderror
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
                  </div>
                </div>
                <div class="row mt-4">
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
@endsection
@section('script')
@endsection
