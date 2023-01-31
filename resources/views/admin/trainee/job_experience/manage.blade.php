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
              <h2 class="panel-title">Edit Job Experience</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.job.experience.store') }}" method="post">
                @csrf
                <div class="row">
                  <input type="hidden" class="dt form-control" name="id" value="{{ $job_experience->id }}">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="control-label">Organization Name</label>
                          <input type="text" name="organization_name" placeholder="Exam Name" autocomplete="off"
                                 value="{{ old('organization_name',$job_experience->organization_name) }}"
                                 class="form-control @error('organization_name') is-invalid @enderror">
                          @error('organization_name')
                          <strong class="text-danger">{{ $errors->first('organization_name') }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="control-label">Designation</label>
                          <input type="text" name="designation" placeholder="Designation" autocomplete="off"
                                 value="{{ old('designation',$job_experience->designation) }}"
                                 class="form-control @error('designation') is-invalid @enderror">
                          @error('designation')
                          <strong class="text-danger">{{ $errors->first('designation') }}</strong>
                          @enderror
                        </div>
                      </div>


                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="control-label">Start date</label>
                          <input type="date" name="start_date" placeholder="Start Date" autocomplete="off"
                                 value="{{ old('start_date',$job_experience->start_date) }}"
                                 class="form-control @error('start_date') is-invalid @enderror">
                          @error('start_date')
                          <strong class="text-danger">{{ $errors->first('start_date') }}</strong>

                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="control-label">End Date</label>
                          <input type="date" name="end_date" placeholder="End Date" autocomplete="off"
                                 value="{{ old('end_date',$job_experience->end_date) }}"
                                 class="form-control @error('end_date') is-invalid @enderror">
                          @error('end_date')
                          <strong class="text-danger">{{ $errors->first('end_date') }}</strong>
                          @enderror
                        </div>
                      </div>

                      <div class="col-sm-12">
                        <div class="form-group">
                          <label class="control-label">Work Info</label>
                          <textarea type="text" name="role" placeholder="Work Info" autocomplete="off"
                                    class="form-control @error('role') is-invalid @enderror">{{ $job_experience->role }}</textarea>
                          @error('role')
                          <strong class="text-danger">{{ $errors->first('role') }}</strong>
                          @enderror
                        </div>
                      </div>


                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="control-label">Contact Person Name</label>
                          <input type="text" name="contact_name" placeholder="Contact Person Name" autocomplete="off"
                                 value="{{ old('contact_name',$job_experience->contact_name) }}"
                                 class="form-control @error('contact_name') is-invalid @enderror">
                          @error('contact_name')
                          <strong class="text-danger">{{ $errors->first('contact_name') }}</strong>
                          @enderror
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="control-label">Contact Person Designation</label>
                          <input type="text" name="contact_designation" placeholder="Contact Person Designation" autocomplete="off"
                                 value="{{ old('contact_designation',$job_experience->contact_designation) }}"
                                 class="form-control @error('contact_designation') is-invalid @enderror">
                          @error('contact_designation')
                          <strong class="text-danger">{{ $errors->first('contact_designation') }}</strong>
                          @enderror
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="control-label">Contact Person Phone</label>
                          <input type="text" name="contact_phone" placeholder="Contact Person Phone" autocomplete="off"
                                 value="{{ old('contact_phone',$job_experience->contact_phone) }}"
                                 class="form-control @error('contact_phone') is-invalid @enderror">
                          @error('contact_phone')
                          <strong class="text-danger">{{ $errors->first('contact_phone') }}</strong>
                          @enderror
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="control-label">Contact Person Email</label>
                          <input type="text" name="contact_email" placeholder="Contact Person Email" autocomplete="off"
                                 value="{{ old('contact_email',$job_experience->contact_email) }}"
                                 class="form-control @error('contact_email') is-invalid @enderror">
                          @error('contact_email')
                          <strong class="text-danger">{{ $errors->first('contact_email') }}</strong>
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
