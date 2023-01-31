@extends('layout.site')
@section('stylesheet')
@endsection
@section('content')

  <section id="services" class="services section-bg">
    <div class="container " data-aos="fade-up">
      <h2 class="text-center" id="title">Job Seeker Registration Form</h2>
      <hr>
      @if(session()->has('status'))
        {!! session()->get('status') !!}
      @endif
      <form class="form-horizontal" action="" method="post">
        @csrf
        <div class="card" style=" margin: 10px 150px;">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name_en">Name <span class="text-danger">*</span></label>
                  <input type="name" name="name" id="name" placeholder="Enter Your Username" autocomplete="off"
                         class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                  <span class="spin"></span>
                  @error('name')
                  <strong class="text-danger">{{ $errors->first('name') }}</strong>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Gender<span class="text-danger">*</span></label>
                  <select name="gender" class="form-control @error('gender') is-invalid @enderror" required>
                    <option value="">Choose a gender</option>
                    <option value="">Male</option>
                    <option value="">Female</option>
                    <option value="">Others</option>

                    <option value="" @selected( old('gender'))></option>

                  </select>
                  @error('gender')
                  <strong class="text-danger">{{ $errors->first('gender') }}</strong>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nid">NID <span class="text-danger">*</span></label>
                  <input type="nid" nid="nid" id="nid" placeholder="Enter Your NID number" autocomplete="off"
                         class="form-control @error('nid') is-invalid @enderror" value="{{ old('nid') }}" required>
                  <span class="spin"></span>
                  @error('nid')
                  <strong class="text-danger">{{ $errors->first('nid') }}</strong>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Select your skill from following list<span class="text-danger">*</span></label>
                  <select name="skill" class="form-control @error('skill') is-invalid @enderror" required>
                    <option value="">Choose a skill</option>
                    <option value="">Data Entry/Operator/BPO</option>
                    <option value="">Garments</option>
                    <option value="">Others</option>

                    <option value="" @selected( old('skill'))></option>

                  </select>
                  @error('skill')
                  <strong class="text-danger">{{ $errors->first('gender') }}</strong>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Email <span class="text-danger">*</span></label>
                  <input type="email" name="email" id="email" placeholder="Enter Your email"
                         class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                  <span class="spin"></span>
                  @error('email')
                  <strong class="text-danger">{{ $errors->first('email') }}</strong>
                  @enderror
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone">Mobile Number<span class="text-danger">*</span></label>
                  <input type="mobile_no" name="mobile_no" id="mobile_no" placeholder="Enter Your Phone Number" autocomplete="off"
                         class="form-control @error('mobile_no') is-invalid @enderror" value="{{ old('mobile_no') }}" required>
                  <span class="spin"></span>
                  @error('mobile_no')
                  <strong class="text-danger">{{ $errors->first('mobile_no') }}</strong>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="password">Password <span class="text-danger">*</span></label>
                  <input type="password" name="password" id="password" placeholder="Enter Your Password" autocomplete="off"
                         class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}"
                         required>
                  <span class="spin"></span>
                  @error('password')
                  <strong class="text-danger">{{ $errors->first('password') }}</strong>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                  <input type="password" name="password_confirmation" id="password_confirmation"
                         placeholder="Confirm Your Password" autocomplete="off"
                         class="form-control @error('password_confirmation') is-invalid @enderror"
                         value="{{ old('password_confirmation') }}" required>
                  <span class="spin"></span>
                  @error('password_confirmation')
                  <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                  @enderror
                </div>
              </div>
            </div>
            <div class="form-group row m-3">
              <div class="col-sm-12 text-right">
                <button class="btn btn-success btn-sm w-100 text-center" type="submit">Create Account</button>
              </div>
            </div>
          </div>
        </div>
      </form>

    </div>


  </section><!-- End Services Section -->
@endsection



