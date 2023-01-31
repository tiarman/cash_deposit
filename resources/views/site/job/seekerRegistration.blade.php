@extends('layout.site')
@section('stylesheet')
@endsection
@section('content')

  <section id="services" class="services section-bg" style="margin-top:50px">
    <div class="container " data-aos="fade-up">
      <h2 class="text-center" id="title">Job Seeker Registration Form</h2>
      <hr>
      @if(session()->has('status'))
        {!! session()->get('status') !!}
      @endif
      <form class="form-horizontal" action="" method="post">
        @csrf
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="name">Name <span class="text-danger">*</span></label>
              <input type="name" name="name" id="name" placeholder="Enter Your Username" autocomplete="off"
                     class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
              <span class="spin"></span>
              @error('name')
              <strong class="text-danger">{{ $errors->first('name') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="gender">Gender <span class="text-danger">*</span></label>
              <br>
              <span style="margin: 5px;"></span>
              <input type="radio" name="gender" id="gender" placeholder="Enter Your Usergender" autocomplete="off"
                     class="@error('gender') is-invalid @enderror" value="{{ old('gender','male') }}"> Male
              <span class="spin"></span>
              <input type="radio" name="gender" id="gender" placeholder="Enter Your Usergender" autocomplete="off"
                     class="@error('gender') is-invalid @enderror" value="{{ old('gender','female') }}"> Female
              <span class="spin"></span>
              @error('gender')
              <strong class="text-danger">{{ $errors->first('gender') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
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
          <div class="col-md-4">
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
          <div class="col-md-4">
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
          <div class="col-md-4">
            <div class="form-group">
              <label for="phone">Phone <span class="text-danger">*</span></label>
              <input type="phone" name="phone" id="phone" placeholder="Enter Your Phone Number" autocomplete="off"
                     class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
              <span class="spin"></span>
              @error('phone')
              <strong class="text-danger">{{ $errors->first('phone') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="po">P.O.</label>
              <input type="po" name="po" id="po" placeholder="Enter P.O. " autocomplete="off"
                     class="form-control @error('po') is-invalid @enderror" value="{{ old('po') }}" required>
              <span class="spin"></span>
              @error('po')
              <strong class="text-danger">{{ $errors->first('po') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Division<span class="text-danger">*</span></label>
              <select name="division_id" class="form-control @error('division_id') is-invalid @enderror" required>
                <option value="">Choose a division</option>

                <option value="" @selected( old('division_id'))>Division names</option>

              </select>
              @error('division_id')
              <strong class="text-danger">{{ $errors->first('division_id') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">District<span class="text-danger">*</span></label>
              <select name="district_id" class="form-control @error('district_id') is-invalid @enderror" required>
                <option value="">Choose a district</option>

                <option value="" @selected(old('district_id'))>district</option>

              </select>
              @error('district_id')
              <strong class="text-danger">{{ $errors->first('district_id') }}</strong>
              @enderror
            </div>
          </div>
        </div>
        <div class="form-group row m-3">
          <div class="col-sm-12 text-right">
            <button class="btn btn-success btn-sm w-100 text-center" type="submit">Register</button>
          </div>
        </div>
      </form>

    </div>


  </section><!-- End Services Section -->
@endsection



