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
              <h2 class="panel-title">Manage Education</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List Of Education', 'Super Admin'))
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.education.create') }}" class="brn btn-success btn-sm">Add Education</a>
                  </div>
                </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.education.store') }}" method="post">
                @csrf
                <input type="hidden" class="dt form-control" name="id" value="{{ $education->id }}">

                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="control-label">Exam Name</label>
                          <input type="text" name="exam_name" placeholder="Exam Name" autocomplete="off"
                                 value="{{ old('exam_name', $education->exam_name) }}"
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
                                 value="{{ old('institute', $education->institute) }}"
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
                                 value="{{ old('board', $education->board) }}"
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
                                 value="{{ old('department', $education->department) }}"
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
                                 value="{{ old('year', $education->year) }}"
                                 class="form-control @error('year') is-invalid @enderror">
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
    </div>
  </div>
@endsection
@section('script')
@endsection
