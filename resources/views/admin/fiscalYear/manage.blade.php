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
              <h2 class="panel-title">Manage Fiscal Year</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List Of Fiscal Year', 'Super Admin'))
              <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                  <a href="{{ route('admin.fiscal.year.list') }}" class="brn btn-success btn-sm">List of Fiscal Years</a>
                </div>
              </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.fiscal.year.store') }}" method="post">
                  @csrf
                  <input type="hidden" class="dt form-control" name="id" value="{{ $fiscalYear->id }}">
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label class="control-label">Code</label>
                              <input type="text" min="0" name="code" placeholder="Code" autocomplete="off"
                                     value="{{ old('code', $fiscalYear->code) }}"
                                     class="form-control @error('code') is-invalid @enderror">
                              @error('code')
                              <strong class="text-danger">{{ $errors->first('code') }}</strong>
                              @enderror
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label class="control-label">Start Date<span class="text-danger">*</span></label>
                              <input type="date" name="start_date" placeholder="Start Date" autocomplete="off" required
                                     value="{{ old('start_date', $fiscalYear->start_date) }}"
                                     class="form-control @error('start_date') is-invalid @enderror">
                              @error('start_date')
                              <strong class="text-danger">{{ $errors->first('start_date') }}</strong>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label class="control-label">End Date<span class="text-danger">*</span></label>
                              <input type="date" name="end_date" placeholder="End Date" autocomplete="off" required
                                     value="{{ old('end_date', $fiscalYear->end_date) }}"
                                     class="form-control @error('end_date') is-invalid @enderror">
                              @error('end_date')
                              <strong class="text-danger">{{ $errors->first('end_date') }}</strong>
                              @enderror
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label class="control-label">Status<span class="text-danger">*</span></label>
                              <select name="status" required class="form-control @error('status') is-invalid @enderror">
                                  <option value="">Choose a status</option>
                                  @foreach(\App\Models\FiscalYear::$statusArrayss as $status)
                                      <option value="{{ $status }}"
                                              @if(old('status', $fiscalYear->status) == $status) selected @endif>{{ ucfirst($status) }}</option>
                                  @endforeach
                              </select>
                              @error('status')
                              <strong class="text-danger">{{ $errors->first('status') }}</strong>
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
