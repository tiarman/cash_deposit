@extends('layout.admin')

@section('stylesheet')
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Post A Job</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List Of Post', 'Super Admin'))
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    {{--                    <a href="{{ route('admin.division.list') }}" class="brn btn-success btn-sm">List of divisions</a>--}}
                  </div>
                </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.job.post.store') }}" method="post">
                @csrf
                <input type="text" name="job_event_id" value="{{ $event_id ?? ''}}" hidden>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label" for="job_title">Job Title</label>
                      <input type="text" name="job_title" placeholder="Job Title" autocomplete="off"
                             value="{{ old('job_title') }}"
                             class="form-control @error('job_title') is-invalid @enderror">
                      @error('job_title')
                      <strong class="text-danger">{{ $errors->first('job_title') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label" for="position">Position</label>
                      <input type="text" name="position" placeholder="Position" autocomplete="off"
                             value="{{ old('position') }}"
                             class="form-control @error('position') is-invalid @enderror">
                      @error('position')
                      <strong class="text-danger">{{ $errors->first('position') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label" for="vacancy">Number of Vacancy</label>
                      <input type="number" name="vacancy" placeholder="Number of Vacancy" autocomplete="off"
                             value="{{ old('vacancy') }}"
                             class="form-control @error('vacancy') is-invalid @enderror">
                      @error('vacancy')
                      <strong class="text-danger">{{ $errors->first('vacancy') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Job Location</label>
                      <input type="text" name="job_location" placeholder="Job Location" autocomplete="off"
                             value="{{ old('job_location') }}"
                             class="form-control @error('job_location') is-invalid @enderror">
                      @error('job_location')
                      <strong class="text-danger">{{ $errors->first('job_location') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Employment Status</label>
                      <select name="employment_status" class="form-control @error('employment_status') is-invalid @enderror">
                        <option value="">Choose an option</option>
                        <option value="fulltime">Full Time</option>
                        <option value="halftime">Half Time</option>
                      </select>
                      @error('employment_status')
                      <strong class="text-danger">{{ $errors->first('employment_status') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">NTVQF/BQF Level</label>
                      <select name="ntvqf_level" class="form-control @error('ntvqf_level') is-invalid @enderror">
                        <option value="">Choose an option</option>
                        <option value="level1">level1</option>
                        <option value="level2">level2</option>
                      </select>
                      @error('ntvqf_level')
                      <strong class="text-danger">{{ $errors->first('ntvqf_level') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label">Job Context</label>
                      <textarea type="text" id="job_context" name="job_context" placeholder="Job Context" autocomplete="off"
                                value="{{ old('job_context') }}"
                                class="form-control @error('job_context') is-invalid @enderror"></textarea>
                      @error('job_context')
                      <strong class="text-danger">{{ $errors->first('job_context') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label">Educational Requirement</label>
                      <textarea type="text" id="educational_requirement" name="educational_requirement" placeholder="Educational Requirement" autocomplete="off"
                                value="{{ old('educational_requirement') }}"
                                class="form-control @error('educational_requirement') is-invalid @enderror"></textarea>
                      @error('educational_requirement')
                      <strong class="text-danger">{{ $errors->first('educational_requirement') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label">Job Responsibility</label>
                      <textarea type="text" id="job_responsibility" name="job_responsibility" placeholder="Job Context" autocomplete="off"
                                value="{{ old('job_responsibility') }}"
                                class="form-control @error('job_responsibility') is-invalid @enderror"></textarea>
                      @error('job_responsibility')
                      <strong class="text-danger">{{ $errors->first('job_responsibility') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label">Additional Requirements</label>
                      <textarea type="text" id="additional_requirements" name="additional_requirements" placeholder="Additional Requirements" autocomplete="off"
                                value="{{ old('additional_requirements') }}"
                                class="form-control @error('additional_requirements') is-invalid @enderror"></textarea>
                      @error('additional_requirements')
                      <strong class="text-danger">{{ $errors->first('additional_requirements') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label">Compensation & Other Benefits</label>
                      <textarea type="text" id="compensation" name="compensation" placeholder="Compensation & Other Benefits" autocomplete="off"
                                value="{{ old('compensation') }}"
                                class="form-control @error('compensation') is-invalid @enderror"></textarea>
                      @error('compensation')
                      <strong class="text-danger">{{ $errors->first('compensation') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label" for="salary">Salary</label>
                      <input type="number" name="salary" placeholder="Salary" autocomplete="off"
                             value="{{ old('salary') }}"
                             class="form-control @error('salary') is-invalid @enderror">
                      @error('salary')
                      <strong class="text-danger">{{ $errors->first('salary') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Experience Requirements(In Years)</label>
                      {{--                      <select name="experience_requirement" class="form-control @error('experience_requirement') is-invalid @enderror">--}}
                      {{--                        <option value="">Choose an option</option>--}}
                      {{--                        <option value="">freshers</option>--}}
                      {{--                        <option value="">0-6 months</option>--}}
                      {{--                        <option value="">At least 1 years</option>--}}
                      {{--                        <option value="">At least 3 years</option>--}}
                      {{--                      </select>--}}
                      <input type="text" name="experience_requirement" placeholder="Experience Requirement" autocomplete="off"
                             value="{{ old('experience_requirement') }}"
                             class="form-control @error('experience_requirement') is-invalid @enderror">
                      @error('experience_requirement')
                      <strong class="text-danger">{{ $errors->first('experience_requirement') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Application Deadline</label>
                      <input type="date" name="application_deadline" placeholder="Date" autocomplete="off"
                             value="{{ old('date') }}"
                             class="form-control @error('date') is-invalid @enderror">
                      @error('date')
                      <strong class="text-danger">{{ $errors->first('date') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 text-right">
                    <button class="btn btn-success btn-sm" type="submit">Save as Draft</button>
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
  <script src="{{ asset('assets/admin/plugins/select2/js/select2.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.js') }}"></script>
  <script>
    $(document).ready(function () {
      $('.select2').select2()
      $(document).ready(function() {
        $('#job_responsibility').summernote({
          'height': 100,
        });
        $('#additional_requirements').summernote({
          'height': 100,
        });
        $('#job_context').summernote({
          'height': 100,
        });
        $('#educational_requirement').summernote({
          'height': 100,
        });
      });
    });
  </script>
@endsection
