@extends('layout.site')
@section('stylesheet')
<style>
  .form-sub-section{
            background-color: rgb(16,38,74)!important;
            color: white !important;
        }
</style>
@endsection
@section('content')
  <div class="institute_body_align">

    <div class="container institute_head_alignment">
      <h2 class="text-center" id="title">Institute Registration Form</h2>
      <hr>
      @if(session()->has('status'))
        {!! session()->get('status') !!}
      @endif
      <x-registration-header />

      <form action="{{ route('institute.registration') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{-- <h4 class="panel-sub-title mb-3 mt-3">New User As Institute Head</h4> --}}
        <div>
          <h4 class="p-2 text-light form-sub-section">New User As Institute Head</h4>
        </div>
        <div class="row mb-3">
          <div class="col-sm-4">
            <div class="form-group">
              <label class="control-label">Full name [English]<span class="text-danger">*</span></label>
              <input type="text" name="name_en" placeholder="Full name in english" required value="{{ old('name_en') }}"
                     class="form-control @error('name_en') is-invalid @enderror">
              @error('name_en')
              <strong class="text-danger">{{ $errors->first('name_en') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label class="control-label">নাম [বাংলায়]</label>
              <input type="text" name="name_bn" placeholder="বাংলায় পুরো নাম"  value="{{ old('name_bn') }}"
                     class="form-control @error('name_bn') is-invalid @enderror">
              @error('name_bn')
              <strong class="text-danger">{{ $errors->first('name_bn') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label class="control-label">Username<span class="text-danger">*</span></label>
              <input type="text" name="username" placeholder="Username" required value="{{ old('username') }}"
                     class="form-control @error('username') is-invalid @enderror">
              @error('username')
              <strong class="text-danger">{{ $errors->first('username') }}</strong>
              @enderror
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Email <span class="text-danger">*</span></label>
              <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                     class="form-control @error('email') is-invalid @enderror" required>
              @error('email')
              <strong class="text-danger">{{ $errors->first('email') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Mobile No <span class="text-danger">*</span></label>
              <input type="number" name="phone" placeholder="Phone No" value="{{ old('phone') }}"
                     class="form-control @error('phone') is-invalid @enderror" required>
              @error('phone')
              <strong class="text-danger">{{ $errors->first('phone') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Date of birth </label>
              <input type="date" name="dob" value="{{ old('dob') }}"
                     class="form-control @error('dob') is-invalid @enderror" >
              @error('dob')
              <strong class="text-danger">{{ $errors->first('dob') }}</strong>
              @enderror
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">NID </label>
              <input type="text" name="nid" value="{{ old('nid') }}" placeholder="Enter your NID no"
                     class="form-control @error('nid') is-invalid @enderror" >
              @error('nid')
              <strong class="text-danger">{{ $errors->first('nid') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Password<span class="text-danger">*</span></label>
              <input type="password" name="password" placeholder="Password" required
                     value="{{ old('password') }}"
                     class="form-control @error('password') is-invalid @enderror">
                     <small id="realtime-password-error" class="text-danger d-none">Password must be at least one uppercase letter, one lowercase letter, one number and one special character </small>
              @error('password')
              <strong class="text-danger">{{ $errors->first('password') }}</strong>
              @enderror
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Confirm Password<span class="text-danger">*</span></label>
              <input type="password" name="password_confirmation" placeholder="Password" required
                     value="{{ old('password_confirmation') }}"
                     class="form-control @error('password_confirmation') is-invalid @enderror">
              @error('password_confirmation')
              <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
              @enderror
              <small id="confirm-password-error" class="text-danger d-none">Enter the correct password</small>
            </div>
          </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="user_image" class="control-label">Photo</label>
                    <input type="file" name="user_image"
                           class="form-control @error('user_image') is-invalid @enderror">
                    @error('user_image')
                    <strong class="text-danger">{{ $errors->first('user_image') }}</strong>
                    @enderror
                </div>
            </div>

        </div>
        {{-- <hr class="mt-3 mb-2"> --}}
        {{-- <h4 class="panel-sub-title institute-form-align mt-3 mb-3">Institute Registration Information</h4> --}}
        <div>
          <h4 class="mt-3 p-2 text-light form-sub-section">Institute Registration Information</h4>
        </div>

        <div class="row mb-3">
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Name [English]<span class="text-danger">*</span></label>
              <input type="text" name="institute_name" placeholder="Institute Name in English" autocomplete="off" required
                     value="{{ old('institute_name') }}"
                     class="form-control @error('institute_name') is-invalid @enderror">
              @error('institute_name')
              <strong class="text-danger">{{ $errors->first('institute_name') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="institute_name_bn" class="control-label">নাম [বাংলায়]</label>
              <input type="text" id="institute_name_bn" name="institute_name_bn" placeholder="ইনস্টিটিউটের নাম বাংলায়" value="{{ old('institute_name_bn') }}"
                     class="form-control @error('institute_name_bn') is-invalid @enderror">
              @error('institute_name_bn')
              <strong class="text-danger">{{ $errors->first('institute_name_bn') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="code" class="control-label">Code<span class="text-danger">*</span></label>
              <input type="number" min="0" name="code" placeholder="Institute Code" autocomplete="off" required
                     value="{{ old('code') }}"
                     class="form-control @error('code') is-invalid @enderror">
                     <small id="realtime-code-error" class="text-danger d-none">The Code must be  5 to 7 characters </small>
              @error('code')
              <strong class="text-danger">{{ $errors->first('code') }}</strong>
              @enderror
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Mobile</label>
              <input type="number" min="0" name="institute_phone" placeholder="Institute Phone" autocomplete="off"
                     value="{{ old('institute_phone') }}"
                     class="form-control @error('institute_phone') is-invalid @enderror">
              @error('institute_phone')
              <strong class="text-danger">{{ $errors->first('institute_phone') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Email</label>
              <input type="email" name="institute_email" placeholder="Institute Email" autocomplete="off"
                     value="{{ old('institute_email') }}"
                     class="form-control @error('institute_email') is-invalid @enderror">
              @error('institute_email')
              <strong class="text-danger">{{ $errors->first('institute_email') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Website <span class="text-primary">Ex. (www.ims.touchandsolve.com)</span></label>
              <input type="text" name="website" placeholder="Institute website" autocomplete="off"
                     value="{{ old('website') }}"
                     class="form-control @error('website') is-invalid @enderror">
              @error('website')
              <strong class="text-danger">{{ $errors->first('website') }}</strong>
              @enderror
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-4">
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
          <div class="col-md-4">
            <div class="form-group">
              <label for="district_id" class="control-label">District<span class="text-danger">*</span></label>
              <select name="district_id" class="form-control @error('district_id') is-invalid @enderror" required>
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
          <div class="col-md-4">
            <div class="form-group">
              <label for="upazila_id" class="control-label">Upazila<span class="text-danger">*</span></label>
              <select name="upazila_id" class="form-control @error('upazila_id') is-invalid @enderror" required>
                <option value="">Choose a Upazila</option>
                @foreach($upazilas as $upazila)
                  <option value="{{ $upazila->id }}" @selected($upazila->id == old('upazila_id'))>{{ $upazila->name }}</option>
                @endforeach
              </select>
              @error('upazila_id')
              <strong class="text-danger">{{ $errors->first('upazila_id') }}</strong>
              @enderror
            </div>
          </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Institute Type<span class="text-danger">*</span></label>
                    <select name="institute_type_id" class="form-control @error('institute_type_id') is-invalid @enderror" required>
                        <option value="">Choose a type</option>
                        @foreach($types as $type)
                            <option  value="{{ $type->id }}" @selected($type->id == old('institute_type_id', 1))>{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('institute_type_id')
                    <strong class="text-danger">{{ $errors->first('institute_type_id') }}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Address</label>
              <input type="text" name="address" placeholder="Full Address" value="{{ old('address') }}"
                     class="form-control @error('address') is-invalid @enderror">
              @error('address')
              <strong class="text-danger">{{ $errors->first('address') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Image (Optional)</label>
              <input type="file" name="photo"
                     class="form-control @error('photo') is-invalid @enderror">
              @error('photo')
              <strong class="text-danger">{{ $errors->first('photo') }}</strong>
              @enderror
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-12">
            <div class="form-group">
              <label for="description" class="control-label">Description (Optional)</label>
              <textarea name="description" placeholder="Description" autocomplete="off" id="summernote"
                        class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
              @error('description')
              <strong class="text-danger">{{ $errors->first('description') }}</strong>
              @enderror
              <strong class="text-danger" id="summernote_error"></strong>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-sm-12 text-center">
            <button class="btn btn-success w-full text-center" type="submit">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
@section('script')
<script>
$(document).ready(function(){
  $(document).on('keyup','input[name="password"]',function(e){
    let password = e.target.value;
    // Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character
    const regExp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    // console.log('passRegex ', password)

    if(password.match(regExp)){
      $('#realtime-password-error').addClass('d-none');
    }
    else{
      $('#realtime-password-error').removeClass('d-none');
    }

  })

  // confirm password event handler
  $('input[name="password_confirmation"]').keyup(function(){
    const confirmPassword =  $('input[name="password_confirmation"]').val();
    const password =  $('input[name="password"]').val();
    let confirmPasswordError =  $('#confirm-password-error');

    if(confirmPassword != password){
      confirmPasswordError.removeClass('d-none')
    }
    else{
      confirmPasswordError.addClass('d-none')
    }
  });

  // for code
  $(document).on('keyup','input[name="code"]',function(e){
   let codeValue = $('input[name = "code"]').val();
   if(codeValue.length < 5){
    $('#realtime-code-error').removeClass('d-none');
   } else if(codeValue.length > 7){
    $('#realtime-code-error').removeClass('d-none');
   }
   else{
    $('#realtime-code-error').addClass('d-none')
   }
  })

  // fucntion call for word count- from site blade
  $('#summernote').keyup(function(){
    checkWordValidation('summernote', 200, 500)
  })
})
</script>

@endsection
