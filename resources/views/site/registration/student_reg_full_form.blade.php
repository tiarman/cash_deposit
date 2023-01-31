@extends('layout.site')

@section('stylesheet')
    <style>
        .form-sub-section{
            background-color: rgba(25, 135, 84, 0.726) !important;
            /* color: black !important; */
        }
    </style>
@endsection
@section('content')
  <div class="institute_body_align">

    <div class="container institute_head_alignment">
      <h2 class="text-center" id="title">Student Registration Form</h2>
      <hr>
      @if(session()->has('status'))
        {!! session()->get('status') !!}
      @endif
      <x-registration-header />
      <form id="show_student" class="form-horizontal toggleForm" action="{{ route('register')}}" method="post">
        @csrf
        <div  class="row mb-3 mt-3">
            <div class="col-md-4">
                <div class="form-group">
                  <label for="institute_name">Institute name<span class="text-danger">*</span></label>
                  <input type="text" name="institute_name" id="institute_name" placeholder="Enter Institute name" autocomplete="off"
                         class="form-control @error('institute_name') is-invalid @enderror" value="{{ old('institute_name') }}">
                  <span class="spin"></span>
                  @error('institute_name')
                  <strong class="text-danger">{{ $errors->first('institute_name') }}</strong>
                  @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                  <label for="trade_technology">Trade/Technology<span class="text-danger">*</span></label>
                  <input type="text" name="trade_technology" id="trade_technology" placeholder="Enter Trade/Technology" autocomplete="off"
                         class="form-control @error('trade_technology') is-invalid @enderror" value="{{ old('trade_technology') }}">
                  <span class="spin"></span>
                  @error('trade_technology')
                  <strong class="text-danger">{{ $errors->first('trade_technology') }}</strong>
                  @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                  <label for="student_name">Student Name<span class="text-danger">*</span></label>
                  <input type="text" name="student_name" id="student_name" placeholder="Enter Your Name" autocomplete="off"
                         class="form-control @error('student_name') is-invalid @enderror" value="{{ old('student_name') }}">
                  <span class="spin"></span>
                  @error('student_name')
                  <strong class="text-danger">{{ $errors->first('student_name') }}</strong>
                  @enderror
                </div>
            </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-4">
            <div class="form-group">
              <label for="father_name">Father Name<span class="text-danger">*</span></label>
              <input type="text" name="father_name" id="father_name" placeholder="Enter Your Father Name" autocomplete="off"
                     class="form-control @error('father_name') is-invalid @enderror" value="{{ old('father_name') }}">
              <span class="spin"></span>
              @error('father_name')
              <strong class="text-danger">{{ $errors->first('father_name') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="mother_name">Mother Name</label>
              <input type="text" name="mother_name" id="mother_name" placeholder="Enter Your Mother Name" autocomplete="off"
                     class="form-control @error('mother_name') is-invalid @enderror" value="{{ old('mother_name') }}">
              <span class="spin"></span>
              @error('mother_name')
              <strong class="text-danger">{{ $errors->first('mother_name') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="dob">Date of Birth<span class="text-danger">*</span></label>
              <input type="date" name="dob" id="dob" placeholder="Enter Your Username" autocomplete="off"
                     class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}">
              <span class="spin"></span>
              @error('dob')
              <strong class="text-danger">{{ $errors->first('dob') }}</strong>
              @enderror
            </div>
          </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="image">Student Photo</label>
                    <input type="file" name="image" id="" class="form-control @error('image') is-invalid @enderror" value="{{old('image')}}">
                    @error('image')
                        <strong class="text-danger">{{$error->first('image')}}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Board Role</label>
                  <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                    <option value="">Choose a Board Role</option>
                    <option value="1">Role 1</option>
                    <option value="2">Role 2</option>
                    {{-- @foreach($divisions as $division)
                      <option value="{{ $division->id }}" @selected($division->id == old('gender'))>{{ $division->name }}</option>
                    @endforeach --}}
                  </select>
                  @error('gender')
                  <strong class="text-danger">{{ $errors->first('gender') }}</strong>
                  @enderror
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Gender</label>
                  <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                    <option value="">Choose a Gender</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                    {{-- @foreach($divisions as $division)
                      <option value="{{ $division->id }}" @selected($division->id == old('gender'))>{{ $division->name }}</option>
                    @endforeach --}}
                  </select>
                  @error('gender')
                  <strong class="text-danger">{{ $errors->first('gender') }}</strong>
                  @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Religion</label>
                  <select name="religion" class="form-control @error('religion') is-invalid @enderror">
                    <option value="">Choose a Religion</option>
                    <option value="1">Islam</option>
                    <option value="2">Hindu</option>
                    {{-- @foreach($divisions as $division)
                      <option value="{{ $division->id }}" @selected($division->id == old('religion'))>{{ $division->name }}</option>
                    @endforeach --}}
                  </select>
                  @error('religion')
                  <strong class="text-danger">{{ $errors->first('religion') }}</strong>
                  @enderror
                </div>
            </div>
        </div>
        <div class="row mb-3">

            <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Blood Group</label>
                  <select name="blood_group" class="form-control @error('blood_group') is-invalid @enderror">
                    <option value="">Choose a Blood Group</option>
                    <option value="1">B+</option>
                    <option value="2">O+</option>
                    {{-- @foreach($divisions as $division)
                      <option value="{{ $division->id }}" @selected($division->id == old('blood_group'))>{{ $division->name }}</option>
                    @endforeach --}}
                  </select>
                  @error('blood_group')
                  <strong class="text-danger">{{ $errors->first('blood_group') }}</strong>
                  @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Marital Status</label>
                  <select name="marital_status" class="form-control @error('marital_status') is-invalid @enderror">
                    <option value="">Choose a Marital Status</option>
                    <option value="1">Married</option>
                    <option value="2">Unmarried</option>
                    {{-- @foreach($divisions as $division)
                      <option value="{{ $division->id }}" @selected($division->id == old('marital_status'))>{{ $division->name }}</option>
                    @endforeach --}}
                  </select>
                  @error('marital_status')
                  <strong class="text-danger">{{ $errors->first('marital_status') }}</strong>
                  @enderror
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div>
                <h4 class="p-2 text-light form-sub-section">Permanent Address</h4>
            </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="permanent_address">Permanent Address</label>
              <input type="text" name="permanent_address" id="permanent_address" placeholder="Enter Your Permanent Address" autocomplete="off"
                     class="form-control @error('permanent_address') is-invalid @enderror" value="{{ old('permanent_address') }}">
              <span class="spin"></span>
              @error('permanent_address')
              <strong class="text-danger">{{ $errors->first('permanent_address') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label class="control-label">Country<span class="text-danger">*</span></label>
              <select name="country_id" class="form-control @error('country_id') is-invalid @enderror" required>
                <option value="">Choose a country</option>
                {{-- @foreach($countries as $country)
                  <option value="{{ $country->id }}" @selected($country->id == old('country_id', 19))>{{ $country->name }}</option>
                @endforeach --}}
              </select>
              @error('country_id')
              <strong class="text-danger">{{ $errors->first('country_id') }}</strong>
              @enderror
            </div>
          </div>
            <div class="col-sm-4">
                <div class="form-group">
                  <label class="control-label">Division</label>
                  <select name="division_id" class="form-control @error('division_id') is-invalid @enderror">
                    <option value="">Choose a Division</option>
                    {{-- @foreach($divisions as $division)
                      <option value="{{ $division->id }}" @selected($division->id == old('division_id'))>{{ $division->name }}</option>
                    @endforeach --}}
                  </select>
                  @error('division_id')
                  <strong class="text-danger">{{ $errors->first('division_id') }}</strong>
                  @enderror
                </div>
            </div>
          </div>
          <div class="row mb-3">
              <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label">District</label>
                    <select name="district_id" class="form-control @error('district_id') is-invalid @enderror">
                      <option value="">Choose a District</option>
                      {{-- @foreach($districts as $district)
                        <option value="{{ $district->id }}" @selected($district->id == old('district_id'))>{{ $district->name }}</option>
                      @endforeach --}}
                    </select>
                    @error('district_id')
                    <strong class="text-danger">{{ $errors->first('district_id') }}</strong>
                    @enderror
                  </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                <label class="control-label">Upazila<span class="text-danger">*</span></label>
                <select name="upazila_id" class="form-control @error('upazila_id') is-invalid @enderror" required>
                    <option value="">Choose a Upazila</option>
                    {{-- @foreach($upazilas as $upazila)
                    <option value="{{ $upazila->id }}" @selected($upazila->id == old('upazila_id'))>{{ $upazila->name }}</option>
                    @endforeach --}}
                </select>
                @error('upazila_id')
                <strong class="text-danger">{{ $errors->first('upazila_id') }}</strong>
                @enderror
                </div>
             </div>
            <div class="col-md-4">
                <div class="form-group">
                  <label for="village_house">Village/House</label>
                  <input type="text" name="village_house" id="village_house" placeholder="Enter Village/House" autocomplete="off"
                         class="form-control @error('village_house') is-invalid @enderror" value="{{ old('village_house') }}">
                  <span class="spin"></span>
                  @error('village_house')
                  <strong class="text-danger">{{ $errors->first('village_house') }}</strong>
                  @enderror
                </div>
              </div>
        </div>
        <div class="row mb-3">
            <div>
                <h4 class="p-2 text-light form-sub-section">Contact Information</h4>
            </div>
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
              <label for="nationality">Nationality <span class="text-danger">*</span></label>
              <input type="nationality" name="nationality" id="nationality" placeholder="Enter Your Nationality"
                     class="form-control @error('nationality') is-invalid @enderror" value="{{ old('nationality') }}">
              <span class="spin"></span>
              @error('nationality')
              <strong class="text-danger">{{ $errors->first('nationality') }}</strong>
              @enderror
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
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
          <div class="col-md-6">
            <div class="form-group">
              <label for="birth_certificate">Birth Certificate No</label>
              <input type="number" name="birth_certificate" id="birth_certificate" placeholder="Enter Your birth certificate Number" autocomplete="off"
                     class="form-control @error('birth_certificate') is-invalid @enderror" value="{{ old('birth_certificate') }}">
              <span class="spin"></span>
              @error('birth_certificate')
              <strong class="text-danger">{{ $errors->first('birth_certificate') }}</strong>
              @enderror
            </div>
          </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-4">
                <div class="form-group">
                  <label class="control-label">Quota</label>
                  <select name="quota" class="form-control @error('quota') is-invalid @enderror">
                    <option value="">Choose an Quota</option>
                    {{-- @foreach($institutes as $institute)
                      <option value="{{ $institute->id }}" @selected($institute->id == old('quota'))>{{ $institute->name }}</option>
                    @endforeach --}}
                  </select>
                  @error('quota')
                  <strong class="text-danger">{{ $errors->first('quota') }}</strong>
                  @enderror
                </div>
              </div>
              <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label">Curriculum</label>
                        <select name="curriculum" class="form-control @error('curriculum') is-invalid @enderror">
                          <option value="">Choose an curriculum</option>
                          {{-- @foreach($institutes as $institute)
                            <option value="{{ $institute->id }}" @selected($institute->id == old('curriculum'))>{{ $institute->name }}</option>
                          @endforeach --}}
                        </select>
                        @error('curriculum')
                        <strong class="text-danger">{{ $errors->first('curriculum') }}</strong>
                        @enderror
                      </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                    <label for="registration">Registration</label>
                    <input type="number" name="registration" id="registration" placeholder="Enter Your Registration number" autocomplete="off"
                            class="form-control @error('registration') is-invalid @enderror" value="{{ old('registration') }}">
                    <span class="spin"></span>
                    @error('registration')
                    <strong class="text-danger">{{ $errors->first('registration') }}</strong>
                    @enderror
                    </div>
                </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-4">
                <div class="form-group">
                <label for="roll_no">Roll No</label>
                <input type="number" name="roll_no" id="roll_no" placeholder="Enter Your Roll Number" autocomplete="off"
                        class="form-control @error('roll_no') is-invalid @enderror" value="{{ old('roll_no') }}">
                <span class="spin"></span>
                @error('roll_no')
                <strong class="text-danger">{{ $errors->first('roll_no') }}</strong>
                @enderror
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                <label for="passing_year">Passing Year</label>
                <input type="date" name="passing_year" id="passing_year" placeholder="Enter Your passing year" autocomplete="off"
                        class="form-control @error('passing_year') is-invalid @enderror" value="{{ old('passing_year') }}">
                <span class="spin"></span>
                @error('passing_year')
                <strong class="text-danger">{{ $errors->first('passing_year') }}</strong>
                @enderror
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                <label for="gpa">Final CGPA</label>
                <input type="number" name="gpa" id="gpa" placeholder="Enter Your CGPA" autocomplete="off"
                        class="form-control @error('gpa') is-invalid @enderror" value="{{ old('gpa') }}">
                <span class="spin"></span>
                @error('gpa')
                <strong class="text-danger">{{ $errors->first('gpa') }}</strong>
                @enderror
                </div>
            </div>
          </div>
          <div class="row mb-3 ">
            <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Shift</label>
                  <select name="shift" class="form-control @error('shift') is-invalid @enderror">
                    <option value="">Choose a Shift</option>
                    {{-- @foreach($divisions as $division)
                      <option value="{{ $division->id }}" @selected($division->id == old('shift'))>{{ $division->name }}</option>
                    @endforeach --}}
                  </select>
                  @error('shift')
                  <strong class="text-danger">{{ $errors->first('shift') }}</strong>
                  @enderror
                </div>
              </div>
            <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Status</label>
                  <select name="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="">Choose a status</option>
                    {{-- @foreach($divisions as $division)
                      <option value="{{ $division->id }}" @selected($division->id == old('status'))>{{ $division->name }}</option>
                    @endforeach --}}
                  </select>
                  @error('status')
                  <strong class="text-danger">{{ $errors->first('status') }}</strong>
                  @enderror
                </div>
              </div>
          </div>
          <div class="row mb-3">
            <div>
                <h4 class="p-2 text-light form-sub-section">Scholarship & Special Training Information</h4>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Special Training</label>
                  <select name="special_training" class="form-control @error('special_training') is-invalid @enderror">
                    <option value="">Choose a Special Training</option>
                    {{-- @foreach($divisions as $division)
                      <option value="{{ $division->id }}" @selected($division->id == old('special_training'))>{{ $division->name }}</option>
                    @endforeach --}}
                  </select>
                  @error('special_training')
                  <strong class="text-danger">{{ $errors->first('special_training') }}</strong>
                  @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Scholarship</label>
                  <select name="scholarship" class="form-control @error('scholarship') is-invalid @enderror">
                    <option value="">Choose a Scholarship</option>
                    {{-- @foreach($divisions as $division)
                      <option value="{{ $division->id }}" @selected($division->id == old('scholarship'))>{{ $division->name }}</option>
                    @endforeach --}}
                  </select>
                  @error('scholarship')
                  <strong class="text-danger">{{ $errors->first('scholarship') }}</strong>
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

