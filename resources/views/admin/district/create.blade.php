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
              <h2 class="panel-title">Create district</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List Of District', 'Super Admin'))
              <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                  <a href="{{ route('admin.district.list') }}" class="brn btn-success btn-sm">List of districts</a>
                </div>
              </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.district.store') }}" method="post">
                @csrf
                <div class="row">
                  <div class="col-sm-6 offset-md-3">
                    <div class="form-group">
                      <label class="control-label">Division<span class="text-danger">*</span></label>
                      <select name="division_id" class="form-control @error('division_id') is-invalid @enderror" required>
                        <option value="">Choose a division</option>
                        @foreach($divisions as $division)
                        <option value="{{ $division->id }}" @selected($division->id == old('division_id'))>{{ $division->name }}</option>
                        @endforeach
                      </select>
                      @error('division_id')
                      <strong class="text-danger">{{ $errors->first('division_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Name<span class="text-danger">*</span></label>
                      <input type="text" name="name" placeholder="Name" autocomplete="off" required
                             value="{{ old('name') }}"
                             class="form-control @error('name') is-invalid @enderror">
                      @error('name')
                      <strong class="text-danger">{{ $errors->first('name') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Name bn</label>
                      <input type="text" name="name_bn" placeholder="Name bangla" autocomplete="off"
                             value="{{ old('name_bn') }}"
                             class="form-control @error('name_bn') is-invalid @enderror">
                      @error('name_bn')
                      <strong class="text-danger">{{ $errors->first('name_bn') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label">Url</label>
                      <input type="url" name="url" placeholder="Url" autocomplete="off"
                             value="{{ old('url') }}"
                             class="form-control @error('url') is-invalid @enderror">
                      @error('url')
                      <strong class="text-danger">{{ $errors->first('url') }}</strong>
                      @enderror
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
@endsection
@section('script')
@endsection
