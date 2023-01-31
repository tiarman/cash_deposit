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
              <h2 class="panel-title">Create Fiscal Period</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List Of Fiscal Period', 'Super Admin'))
              <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                  <a href="{{ route('admin.fiscalPeriod.list') }}" class="brn btn-success btn-sm">List of districts</a>
                </div>
              </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.fiscalPeriod.store') }}" method="post">
                @csrf
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label">Fiscal Year<span class="text-danger">*</span></label>
                      <select name="fiscal_year_id" class="form-control @error('fiscal_year_id') is-invalid @enderror" required>
                        <option value="">Choose a Fiscal Year</option>
                        @foreach($fiscalYears as $fiscalYear)
                        <option value="{{ $fiscalYear->id }}" @selected($fiscalYear->id == old('fiscal_year_id'))>{{ $fiscalYear->code }}</option>
                        @endforeach
                      </select>
                      @error('fiscal_year_id')
                      <strong class="text-danger">{{ $errors->first('fiscal_year_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Start Date<span class="text-danger">*</span></label>
                      <input type="date" name="start_date" placeholder="Start Date" autocomplete="off" required
                             value="{{ old('start_date') }}"
                             class="form-control @error('start_date') is-invalid @enderror">
                      @error('start_date')
                      <strong class="text-danger">{{ $errors->first('start_date') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">End Date<span class="text-danger">*</span></label>
                      <input type="date" name="end_date" placeholder="End Date" autocomplete="off" required
                             value="{{ old('end_date') }}"
                             class="form-control @error('end_date') is-invalid @enderror">
                      @error('end_date')
                      <strong class="text-danger">{{ $errors->first('end_date') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Month Name</label>
                      <input type="text" name="month_name" placeholder="Month Name" autocomplete="off"
                             value="{{ old('month_name') }}"
                             class="form-control @error('month_name') is-invalid @enderror">
                      @error('month_name')
                      <strong class="text-danger">{{ $errors->first('month_name') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Quarter Number<span class="text-danger">*</span></label>
                            <select name="quarter_no" required class="form-control @error('quarter_no') is-invalid @enderror">
                                <option value="">Choose a quarter_no</option>
                                @foreach(\App\Models\FiscalPeriod::$quarterNo as $quarter_no)
                                    <option value="{{ $quarter_no }}"
                                            @if(old('quarter_no') == $quarter_no) selected @endif>{{ ucfirst($quarter_no) }}</option>
                                @endforeach
                            </select>
                            @error('quarter_no')
                            <strong class="text-danger">{{ $errors->first('quarter_no') }}</strong>
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
