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
              <h2 class="panel-title">Manage Item</h2>
            </header>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                  <a href="{{ route('admin.institute.building.item.list', $item->institute_buildings_id) }}" class="brn btn-success btn-sm">List of Items</a>
                </div>
              </div>
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.institute.building.item.manage', $item->id) }}" method="post">
                @csrf
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label class="control-label">Name <span class="text-danger">*</span></label>
                      <input type="text" name="name" placeholder="name" required value="{{ old('name', $item->name) }}"
                             class="form-control @error('name') is-invalid @enderror">
                      @error('name')
                      <strong class="text-danger">{{ $errors->first('name') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label class="control-label">Accn No <span class="text-danger">*</span></label>
                      <input type="text" name="accn_no" placeholder="Accn No" required value="{{ old('accn_no', $item->accn_no) }}"
                             class="form-control @error('accn_no') is-invalid @enderror">
                      @error('accn_no')
                      <strong class="text-danger">{{ $errors->first('accn_no') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label class="control-label">Quantity <span class="text-danger">*</span></label>
                      <input type="number" name="quantity" placeholder="Floor floor name" required value="{{ old('quantity', $item->quantity) }}"
                             class="form-control @error('quantity') is-invalid @enderror">
                      @error('quantity')
                      <strong class="text-danger">{{ $errors->first('quantity') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label class="control-label">Status<span class="text-danger">*</span></label>
                      <select name="status" required class="form-control @error('status') is-invalid @enderror">
                        <option value="">Choose a status</option>
                        @foreach(\App\Models\InstituteBuildingItem::$statusArrays as $status)
                          <option value="{{ $status }}"
                            @selected(old('status', $item->status) == $status)>{{ ucfirst($status) }}</option>
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
                    <textarea name="remarks" rows="3" class="form-control @error('remarks') is-invalid @enderror">{{ old('remarks', $item->remarks) }}</textarea>
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
