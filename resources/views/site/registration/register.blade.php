@extends('layout.site')

@section('stylesheet')

@endsection
@section('content')
  <div class="institute_body_align">

    <div class="container institute_head_alignment">
      <h2 class="text-center" id="title">User Registration Form</h2>
      <hr>
      @if(session()->has('status'))
        {!! session()->get('status') !!}
      @endif
      <x-registration-header />
      <form id="show_student" class="form-horizontal toggleForm" action="{{ route('register')}}" method="post">
        @csrf
        <div  class="row mb-3">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="control-label">Institute</label>
              <select name="institute_id" class="form-control @error('institute_id') is-invalid @enderror">
                <option value="">Choose an institute</option>
                @foreach($institutes as $institute)
                  <option value="{{ $institute->id }}" @selected($institute->id == old('institute_id'))>{{ $institute->name }}</option>
                @endforeach
              </select>
              @error('institute_id')
              <strong class="text-danger">{{ $errors->first('institute_id') }}</strong>
              @enderror
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-4">
            <div class="form-group">
              <label for="name_en">Name (English)<span class="text-danger">*</span></label>
              <input type="text" name="name_en" id="name_en" placeholder="Enter Your Name" autocomplete="off"
                     class="form-control @error('name_en') is-invalid @enderror" value="{{ old('name_en') }}">
              <span class="spin"></span>
              @error('name_en')
              <strong class="text-danger">{{ $errors->first('name_en') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="name_bn">Name (Bangla)</label>
              <input type="text" name="name_bn" id="name_bn" placeholder="Enter Your Name" autocomplete="off"
                     class="form-control @error('name_bn') is-invalid @enderror" value="{{ old('name_bn') }}">
              <span class="spin"></span>
              @error('name_bn')
              <strong class="text-danger">{{ $errors->first('name_bn') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="name_en">Username <span class="text-danger">*</span></label>
              <input type="text" name="username" id="username" placeholder="Enter Your Username" autocomplete="off"
                     class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
              <span class="spin"></span>
              @error('username')
              <strong class="text-danger">{{ $errors->first('username') }}</strong>
              @enderror
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-sm-4">
            <div class="form-group">
              <label for="email">Email <span class="text-danger">*</span></label>
              <input type="email" name="email" id="email" placeholder="Enter Your E-mail"
                     class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
              <span class="spin"></span>
              @error('email')
              <strong class="text-danger">{{ $errors->first('email') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label for="password">Password <span class="text-danger">*</span></label>
              <input type="password" name="password" id="password" placeholder="Enter Your Password" autocomplete="off"
                     class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
              <span class="spin"></span>
              @error('password')
              <strong class="text-danger">{{ $errors->first('password') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
              <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Your Password" autocomplete="off"
                     class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}">
              <span class="spin"></span>
              @error('password_confirmation')
              <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
              @enderror
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-4">
            <div class="form-group">
              <label for="father_name">Father's Name</label>
              <input type="text" name="father_name" id="father_name" placeholder="Enter Your Father's Name" autocomplete="off"
                     class="form-control @error('father_name') is-invalid @enderror" value="{{ old('father_name') }}">
              <span class="spin"></span>
              @error('father_name')
              <strong class="text-danger">{{ $errors->first('father_name') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="mother_name">Mother's Name</label>
              <input type="text" name="mother_name" id="mother_name" placeholder="Enter Your Mother's Name" autocomplete="off"
                     class="form-control @error('mother_name') is-invalid @enderror" value="{{ old('mother_name') }}">
              <span class="spin"></span>
              @error('mother_name')
              <strong class="text-danger">{{ $errors->first('mother_name') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="dob">Date of Birth</label>
              <input type="date" name="dob" id="dob" placeholder="Enter Your Date of Birth" autocomplete="off"
                     class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}">
              <span class="spin"></span>
              @error('dob')
              <strong class="text-danger">{{ $errors->first('dob') }}</strong>
              @enderror
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-4">
            <div class="form-group">
              <label for="phone">Mobile No <span class="text-danger">*</span></label>
              <input type="number" name="phone" id="phone" placeholder="Enter Your Phone Number" autocomplete="off"
                     class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
              <span class="spin"></span>
              @error('phone')
              <strong class="text-danger">{{ $errors->first('phone') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="alt_phone">Alternative Phone Number</label>
              <input type="number" name="alt_phone" id="alt_phone" placeholder="Enter Your Phone Number" autocomplete="off"
                     class="form-control @error('alt_phone') is-invalid @enderror" value="{{ old('alt_phone') }}">
              <span class="spin"></span>
              @error('alt_phone')
              <strong class="text-danger">{{ $errors->first('alt_phone') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="nid">NID</label>
              <input type="number" name="nid" id="nid" placeholder="Enter Your NID Number" autocomplete="off"
                     class="form-control @error('nid') is-invalid @enderror" value="{{ old('nid') }}">
              <span class="spin"></span>
              @error('nid')
              <strong class="text-danger">{{ $errors->first('nid') }}</strong>
              @enderror
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-sm-4">
            <div class="form-group">
              <label for="village">Village</label>
              <input type="text" name="village" id="village" placeholder="Enter Your Village Name" autocomplete="off"
                     class="form-control @error('village') is-invalid @enderror" value="{{ old('village') }}">
              <span class="spin"></span>
              @error('village')
              <strong class="text-danger">{{ $errors->first('village') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label for="ps">P.S.</label>
              <input type="text" name="ps" id="ps" placeholder="Enter Your P.S." autocomplete="off"
                     class="form-control @error('ps') is-invalid @enderror" value="{{ old('ps') }}">
              <span class="spin"></span>
              @error('ps')
              <strong class="text-danger">{{ $errors->first('ps') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label for="po">P.O.</label>
              <input type="text" name="po" id="po" placeholder="Enter Your P.O." autocomplete="off"
                     class="form-control @error('po') is-invalid @enderror" value="{{ old('po') }}">
              <span class="spin"></span>
              @error('po')
              <strong class="text-danger">{{ $errors->first('po') }}</strong>
              @enderror
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-sm-6">
            <div class="form-group">
              <label class="control-label">Division</label>
              <select name="division_id" class="form-control @error('division_id') is-invalid @enderror">
                <option value="">Choose a Division</option>
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
              <label class="control-label">District</label>
              <select name="district_id" class="form-control @error('district_id') is-invalid @enderror">
                <option value="">Choose a District</option>
                @foreach($districts as $district)
                  <option value="{{ $district->id }}" @selected($district->id == old('district_id'))>{{ $district->name }}</option>
                @endforeach
              </select>
              @error('district_id')
              <strong class="text-danger">{{ $errors->first('district_id') }}</strong>
              @enderror
            </div>
          </div>
        </div>
        <div style="text-align: center" class="row mt-3">
          <div class="text-right d-flex justify-content-center">
            <button class="btn btn-success text-center w-full" type="submit">Register</button>
          </div>
        </div>
      </form>

    </div>
  </div>
@endsection

@section('script')
@endsection

