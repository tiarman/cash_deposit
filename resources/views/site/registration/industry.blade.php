@extends('layout.site')

@section('stylesheet')
  <style>
    .form-sub-section {
      background-color: rgb(16,38,74)!important;
      color: white !important;
    }

    .image_preview_container {
      width: 100px;
      height: 100px;
      background-color: lightgrey;
      margin-top: 12px;
    }

    .preview_text {
      padding-top: 22px
    }
    .btn-register {
            background-color: rgb(16, 38, 74);
            color: white;
        }

        .btn-register:hover {
            background-color: #0D6EFD;
            color: white;
        }
  </style>
@endsection

@section('content')
  <div class="institute_body_align">

    <div class="container institute_head_alignment">
      <h2 class="text-center" id="title">Industry Registration Form</h2>
      <hr>
      @if(session()->has('status'))
        {!! session()->get('status') !!}
      @endif
      <x-registration-header/>

      <form id="show_student" class="form-horizontal toggleForm" enctype="multipart/form-data" action="{{ route('industry.registration')}}" method="post">
        @csrf
        <div>
          <h4 class="p-2 text-light form-sub-section">Industry Information</h4>
        </div>
        <div class="row mb-3 justify-content-center">

        </div>
        <div class="row mb-3">
          <div class="col-md-4">
            <div class="form-group">
              <label for="name_en">Name of Industry (English)<span class="text-danger">*</span></label>
              <input type="text" required name="name_en" id="name_en" placeholder="Enter Your Industry Name" autocomplete="off"
                     class="form-control @error('name_en') is-invalid @enderror" value="{{ old('name_en') }}">
              <span class="spin"></span>
              @error('name_en')
              <strong class="text-danger">{{ $errors->first('name_en') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="name_bn">Name of Industry (Bangla)</label>
              <input type="text" name="name_bn" id="name_bn" placeholder="Enter Your Industry Name (Bangla)" autocomplete="off"
                     class="form-control @error('name_bn') is-invalid @enderror" value="{{ old('name_bn') }}">
              <span class="spin"></span>
              @error('name_bn')
              <strong class="text-danger">{{ $errors->first('name_bn') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label class="control-label">Website</label>
              <input type="text" name="website" id="website" placeholder="Enter Your Website" autocomplete="off"
                     class="form-control @error('website') is-invalid @enderror" value="{{ old('website') }}">
              <span class="spin"></span>
              @error('website')
              <strong class="text-danger">{{ $errors->first('website') }}</strong>
              @enderror
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-4">
            <div class="form-group">
              <label for="phone">Mobile Number <span class="text-danger">*</span></label>
              <input type="number" required name="phone" id="phone" placeholder="Enter Your Mobile Number" autocomplete="off"
                     class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
              <span class="spin"></span>
              @error('phone')
              <strong class="text-danger">{{ $errors->first('phone') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="alt_phone">Phone Number </label>
              <input type="number" name="alt_phone" id="alt_phone" placeholder="Enter Your Phone Number" autocomplete="off"
                     class="form-control @error('alt_phone') is-invalid @enderror" value="{{ old('alt_phone') }}">
              <span class="spin"></span>
              @error('alt_phone')
              <strong class="text-danger">{{ $errors->first('alt_phone') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label for="email">Email <span class="text-danger">*</span></label>
              <input type="email" required name="email" id="email" placeholder="Enter Your E-mail"
                     class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
              <span class="spin"></span>
              @error('email')
              <strong class="text-danger">{{ $errors->first('email') }}</strong>
              @enderror
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-4">
            <div class="form-group">
              <label for="username">Username<span class="text-danger">*</span></label>
              <input type="text" required name="username" id="username" placeholder="Enter Username" autocomplete="off"
                     class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
              <span class="spin"></span>
              @error('username')
              <strong class="text-danger">{{ $errors->first('username') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Password<span class="text-danger">*</span></label>
              <input type="password" required name="password" placeholder="Password" required
                     value="{{ old('password') }}"
                     class="form-control @error('password') is-invalid @enderror">
              <small id="realtime-password-error" class="text-danger d-none">Password must be at least one uppercase letter, one lowercase letter, one number and one special
                character </small>
              @error('password')
              <strong class="text-danger">{{ $errors->first('password') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="form-group">
              <label class="control-label">Confirm Password<span class="text-danger">*</span></label>
              <input type="password" required name="password_confirmation" placeholder="Confirm Password" required
                     value="{{ old('password_confirmation') }}"
                     class="form-control @error('password_confirmation') is-invalid @enderror">
              @error('password_confirmation')
              <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
              @enderror
              <small id="confirm-password-error" class="text-danger d-none">Enter the correct password</small>
            </div>
          </div>
          <div class="col-md-4 mt-3">
            <div class="form-group">
              <label for="image">Image (Upload)</label>
              <input type="file" name="image" id="image" placeholder="" autocomplete="off"
                     class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}">
              <span class="spin"></span>
              @error('image')
              <strong class="text-danger">{{ $errors->first('image') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="image_preview_container text-center mx-auto">
              <p id="preview_text">Image Preview</p>
              <img class="d-none mt-2" id="image_preview" alt="your image" width="85" height="85"/>
            </div>
          </div>
          <div style="text-align: center" class="row mt-3">
            <div class="text-right d-flex justify-content-center">
              <button class="btn btn-register text-center w-full" type="submit">Register</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function () {
      $('#image').change(function (e) {
        {
          $('#image_preview').attr('src', window.URL.createObjectURL(e.target.files[0]));
          $('#image_preview').removeClass('d-none');
          $('#preview_text').addClass('d-none');
          console.log("image selected", e.target.files.name);
        }
      })
      // password
      $(document).on('keyup', 'input[name="password"]', function (e) {
        let password = e.target.value;
        // Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character
        const regExp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        // console.log('passRegex ', password)

        if (password.match(regExp)) {
          $('#realtime-password-error').addClass('d-none');
        } else {
          $('#realtime-password-error').removeClass('d-none');
        }

      })

      // confirm password event handler
      $('input[name="password_confirmation"]').keyup(function () {
        const confirmPassword = $('input[name="password_confirmation"]').val();
        const password = $('input[name="password"]').val();
        let confirmPasswordError = $('#confirm-password-error');

        if (confirmPassword != password) {
          confirmPasswordError.removeClass('d-none')
        } else {
          confirmPasswordError.addClass('d-none')
        }
      });

    })


  </script>
@endsection
