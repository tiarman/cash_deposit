@extends('layout.site')

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <style>
        .form-sub-section{
            background-color:  rgb(16,38,74)!important;
            color: white !important;
        }
        .image_preview_container{
            width: 100px;
            height: 100px;
            background-color: lightgrey;
            margin-top: 12px;
  }
  .btn-register{
      background-color: rgb(16,38,74);
      color: white;
    }
    .btn-register:hover{
      background-color: #0D6EFD;
      color: white;
    }

    </style>
@endsection
@section('content')
  <div class="institute_body_align">

    <div class="container institute_head_alignment">
      <h2 class="text-center" id="title">Graduate Registration Form</h2>
      <hr>
      @if(session()->has('status'))
        {!! session()->get('status') !!}
      @endif
      <x-registration-header />
      <form id="show_student" class="form-horizontal toggleForm" action="{{ route('register')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
          <h4 class="p-2 text-light form-sub-section">Graduate Information</h4>
        </div>
        <div  class="row pb-3 mt-3 ">

          {{-- <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="institute_type">Institute Type</label>
              <select name="institute_type" id="institute_type" class="form-control @error('institute_type') is-invalid @enderror">
                <option value="">Choose a type</option>
                @foreach ($institutes_type as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
              </select>
              @error('institute_type')
              <strong class="text-danger">{{$error->first('institute_type')}}</strong>
              @enderror
            </div>
          </div> --}}
    {{-- <div class="col-md-4">
            <div class="form-group">
              <label for="institute_id">Institute</label>
              <select name="institute_id" id="institute_id" class="form-control @error('institute_id') is-invalid @enderror">
                <option value="">Choose a Institute</option>
                @foreach ($institutes as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
              </select>
              @error('institute_id')
              <strong class="text-danger">{{$error->first('institute_id')}}</strong>
              @enderror
            </div>
          </div> --}}
          <div class="col-md-4">
            <div class="form-group">
              <label for="trade_technology_id">Trade / Technology / Department</label>
              <select name="trade_technology_id" id="trade_technology_id" class="form-control @error('trade_technology_id') is-invalid @enderror">
                <option value="">Choose a Trade/Technology</option>
                @foreach ($technologies as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
              </select>
              @error('trade_technology_id')
              <strong class="text-danger">{{$error->first('trade_technology_id')}}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="shift_id">Shift</label>
              <select name="shift_id" id="shift_id" class="form-control @error('shift_id') is-invalid @enderror">
                <option value="">Choose a Shift</option>
                {{-- <option value="1">First Shift</option>
                <option value="2">Second Shift</option> --}}
                @foreach ($datas as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
              </select>
              @error('shift_id')
              <strong class="text-danger">{{$error->first('shift_id')}}</strong>
              @enderror
            </div>
          </div>
          {{-- <div class="col-md-4">
            <div class="form-group">
              <label for="section">Section (optional) </label>
              <select name="section" id="section" class="form-control @error('section') is-invalid @enderror">
                <option value="">Choose a Section</option>
                <option value="1">Section- A</option>
                <option value="2">Section- B</option>
                <option value="3">Section- C</option>
                <option value="4">Section- D</option>
                <option value="5">Section- E</option>

              </select>
              @error('section')
              <strong class="text-danger">{{$error->first('section')}}</strong>
              @enderror
            </div>
          </div> --}}
          {{-- <div class="col-sm-4">
            <div class="form-group">
              <label class="control-label">Department</label>
              <select name="department" class="form-control @error('department') is-invalid @enderror">
                <option value="">Choose a Department</option>
                <option value="1">Computer Science and Engineering</option>
                <option value="2">Physics</option>
                <option value="3">Chemical Engineering</option>
                @foreach($divisions as $division)
                  <option value="{{ $division->id }}" @selected($division->id == old('department'))>{{ $division->name }}</option>
                @endforeach
              </select>
              @error('department')
              <strong class="text-danger">{{ $errors->first('department') }}</strong>
              @enderror
            </div>
          </div> --}}
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Semester</label>
              <select id="semester_id" name="semester_id" class="form-control select-or-disable @error('semester_id') is-invalid @enderror">
                <option value="">Choose a Semester</option>
                {{-- <option value="1">Semester 1</option>
                <option value="2">Semester 2</option>
                <option value="3">Semester 3</option>
                <option value="4">Semester 4</option>
                <option value="5">Semester 5</option>
                <option value="6">Semester 6</option>
                <option value="7">Semester 7</option>
                <option value="8">Semester 8</option> --}}
                @foreach($semester as $item)
                  <option value="{{ $item->id }}" @selected($item->id == old('semester_id'))>{{ $item->name }}</option>
                @endforeach
              </select>
              @error('semester_id')
              <strong class="text-danger">{{ $errors->first('semester_id') }}</strong>
              @enderror
            </div>
          </div>
          {{-- <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Year</label>
              <select id="year"  name="year" class="form-control select-or-disable @error('year') is-invalid @enderror">
                <option value="">Choose a Year</option>
                <option value="1">Year 1</option>
                <option value="2">Year 2</option>
                <option value="3">Year 3</option>
                <option value="4">Year 4</option>
                @foreach($divisions as $division)
                  <option value="{{ $division->id }}" @selected($division->id == old('year'))>{{ $division->name }}</option>
                @endforeach
              </select>
              @error('year')
              <strong class="text-danger">{{ $errors->first('year') }}</strong>
              @enderror
            </div>
          </div> --}}

          <div class="col-md-4">
            <div class="form-group">
              <label for="session">Session<span class="text-danger">*</span></label>
              <input type="text" name="s_session" id="s_session" placeholder="2021-2022" autocomplete="off"
                     class=" form-control @error('s_session') is-invalid @enderror" value="{{ old('s_session') }}">
              <span class="spin"></span>
              @error('s_session')
              <strong class="text-danger">{{ $errors->first('s_session') }}</strong>
              @enderror
            </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label for="board_roll">SSC Board Roll / ID<span class="text-danger">*</span></label>
            <input type="number" name="board_roll" id="board_roll" placeholder="Enter Your SSC Board Roll" autocomplete="off"
                   class="form-control select-or-disable @error('board_roll') is-invalid @enderror" value="{{ old('board_roll') }}">
            <span class="spin"></span>
            @error('board_roll')
            <strong class="text-danger">{{ $errors->first('board_roll') }}</strong>
            @enderror
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="running_board_roll">Running Board Roll / ID<span class="text-danger">*</span></label>
            <input type="number" name="running_board_roll" id="running_board_roll" placeholder="Enter Your Running Board Roll" autocomplete="off"
                   class="form-control select-or-disable @error('running_board_roll') is-invalid @enderror" value="{{ old('running_board_roll') }}">
            <span class="spin"></span>
            @error('running_board_roll')
            <strong class="text-danger">{{ $errors->first('running_board_roll') }}</strong>
            @enderror
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="admission_year">Admission Year <span class="text-danger">*</span></label>
            <input type="text" name="admission_year" id="admission_year" placeholder="Admission Year" autocomplete="off"
                   class="form-control @error('admission_year') is-invalid @enderror" value="{{ old('admission_year') }}">
            <span class="spin"></span>
            @error('admission_year')
            <strong class="text-danger">{{ $errors->first('admission_year') }}</strong>
            @enderror
          </div>
        </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label class="control-label">Employment Status<span class="text-danger">*</span></label>
              <select name="employment_status" required class="form-control @error('employment_status') is-invalid @enderror">
                <option value="">Choose an Option</option>
                @foreach(\App\Models\User::$employmentArrays as $employment_status)
                  <option value="{{ $employment_status }}"
                          @if(old('employment_status') == $employment_status) selected @endif>{{ ucfirst($employment_status) }}</option>
                @endforeach
              </select>
              @error('employment_status')
              <strong class="text-danger">{{ $errors->first('employment_status') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="employing_company">Work For(Optional)</label>
              <input type="text" name="employing_company" id="employing_company" placeholder="Company Name" autocomplete="off"
                     class="form-control @error('employing_company') is-invalid @enderror" value="{{ old('employing_company') }}">
              <span class="spin"></span>
              @error('employing_company')
              <strong class="text-danger">{{ $errors->first('employing_company') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label for="cv">CV(Optional)</label>
              <input type="file" name="cv" id="cv" placeholder="" autocomplete="off"
                     class="form-control @error('cv') is-invalid @enderror" value="{{ old('cv') }}">
              <span class="spin"></span>
              @error('cv')
              <strong class="text-danger">{{ $errors->first('cv') }}</strong>
              @enderror
            </div>
          </div>
        </div>
        <div class="mt-3">
          <h4 class="p-2 text-light form-sub-section">Login Information</h4>
        </div>
        <div class="row mb-3 mt-3">
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">NID<span class="">(Optional)</span></label>
              <input id="nid" type="text" name="nid" placeholder="Your NID NO." required value="{{ old('nid') }}"
                     class="form-control select-or-disable @error('nid') is-invalid @enderror">
              @error('nid')
              <strong class="text-danger">{{ $errors->first('nid') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Birth-Certificate<span class="">(Optional)</span></label>
              <input type="text" id="birth_certificate" name="birth_certificate" placeholder="Your Birth Certificate NO." required value="{{ old('birth_certificate') }}"
                     class="form-control select-or-disable @error('birth_certificate') is-invalid @enderror">
              @error('birth_certificate')
              <strong class="text-danger">{{ $errors->first('birth_certificate') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Full name [English]<span class="text-danger">*</span></label>
              <input type="text" name="name_en" placeholder="Full name in english" required value="{{ old('name_en') }}"
                     class="form-control @error('name_en') is-invalid @enderror">
              @error('name_en')
              <strong class="text-danger">{{ $errors->first('name_en') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">নাম [বাংলায়]<span class="text-danger">*</span></label>
              <input type="text" name="name_bn" placeholder="বাংলায় পুরো নাম" required value="{{ old('name_bn') }}"
                     class="form-control @error('name_bn') is-invalid @enderror">
              @error('name_bn')
              <strong class="text-danger">{{ $errors->first('name_bn') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Username<span class="text-danger">*</span></label>
              <input type="text" name="username" placeholder="Username" required value="{{ old('username') }}"
                     class="form-control @error('username') is-invalid @enderror">
              @error('username')
              <strong class="text-danger">{{ $errors->first('username') }}</strong>
              @enderror
            </div>
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
          <div class="col-md-4">
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
          <div class="col-sm-4 mt-3">
            <div class="form-group">
              <label for="profile_photo_path">Image (Upload)</label>
              <input type="file" name="profile_photo_path" id="profile_photo_path" placeholder="" autocomplete="off"
                     class="form-control @error('profile_photo_path') is-invalid @enderror" value="{{ old('profile_photo_path') }}">
              <span class="spin"></span>
              @error('profile_photo_path')
              <strong class="text-danger">{{ $errors->first('profile_photo_path') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-4 " >
            <div class="image_preview_container text-center mx-auto" >
                <p id="preview_text">Image Preview</p>
                <img class="d-none mt-2"  id="image_preview" alt="your image" width="85" height="85" />
            </div>
        </div>


        </div>

        <div style="text-align: center" class="row mt-3">
          <div class="text-right d-flex justify-content-center">
            <button class="btn btn-register text-center w-full" type="submit">Register</button>
          </div>
        </div>
      </form>

    </div>
  </div>
@endsection

@section('script')
{{-- nid or birth-certificate, year or semester one select from two   --}}
<script>
  $(document).ready(function(){
    $('.select-or-disable').change(function(e){
      const targetElementId = e.target.id;
      if(targetElementId == 'semester'){
        $('#year').attr('disabled','true');
        $(`#${targetElementId}`).removeAttr('disabled');
      }
      else if(targetElementId == 'year'){

        $('#semester').attr('disabled','true');
        $(`#${targetElementId}`).removeAttr('disabled');
      }
      else if(targetElementId == 'board_roll'){

        $('#running_board_roll').attr('disabled','disabled');
        $(`#${targetElementId}`).removeAttr('disabled');
      }
      else if(targetElementId == 'running_board_roll'){

        $('#board_roll').attr('disabled','disabled');
        $(`#${targetElementId}`).removeAttr('disabled');
      }
      else if(targetElementId == 'birth_certificate'){

        $('#nid').attr('disabled','disabled');
        $(`#${targetElementId}`).removeAttr('disabled');
      }
      else {
        $('#birth_certificate').attr('disabled','disabled');
        $(`#${targetElementId}`).removeAttr('disabled');
      }
      console.log('select or disable', e.target.id)

    })
  })
</script>
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
     if(codeValue.length < 7){
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


    {{-- date picker --}}
    <script src="{{ asset('assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script>
    $(document).ready(function () {
      $(".yearPicker").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        startDate: '-50y',
        endDate: '+30y',
        autoclose: true
      });
    });
  </script>
  <script>
 $(document).ready(function(){
    $('#profile_photo_path').change(function(e){
        {
            $('#image_preview').attr('src', window.URL.createObjectURL(e.target.files[0]));
            $('#image_preview').removeClass('d-none');
            $('#preview_text').addClass('d-none');
        console.log("image selected", e.target.files.name);
    }
    })
 })

  </script>
@endsection

