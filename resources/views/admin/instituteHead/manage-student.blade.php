@extends('layout.admin')

@section('stylesheet')
@endsection

@section('content')
  <div class="row">
    {{--        <div class="float-right">--}}
    {{--            @if ($errors->any())--}}
    {{--                <div class="alert alert-danger">--}}
    {{--                    <ul>--}}
    {{--                        @foreach ($errors->all() as $error)--}}
    {{--                            <li>{{ $error }}</li>--}}
    {{--                        @endforeach--}}
    {{--                    </ul>--}}
    {{--                </div><br />--}}
    {{--            @endif--}}
    {{--        </div>--}}
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Manage Graduates/Student</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List Of Institute', 'Super Admin|Institute Head'))
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.institute.head.list') }}" class="brn btn-success btn-sm">List of institute Graduates/Students</a>
                  </div>
                </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.institute.head.student.store') }}" method="post">
                @csrf

                <div>
                  <h4 class="p-2 text-light form-sub-section">Graduates Information</h4>
                </div>
                <div  class="row pb-3 mt-3 border-bottom">
                  <input type="hidden" class="dt form-control" name="id" value="{{ $user->id }}">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Trade/Technology/Department</label>
                      <select name="department" class="form-control @error('department') is-invalid @enderror">
                        <option value="">Choose a Department</option>
                        <option value="1">Computer Science and Engineering</option>
                        <option value="2">Physics</option>
                        <option value="3">Chemical Engineering</option>
                        {{-- @foreach($divisions as $division)
                          <option value="{{ $division->id }}" @selected($division->id == old('department'))>{{ $division->name }}</option>
                        @endforeach --}}
                      </select>
                      @error('department')
                      <strong class="text-danger">{{ $errors->first('department') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="shift">Shift</label>
                      <select name="shift" id="shift" class="form-control @error('shift') is-invalid @enderror">
                        <option value="">Choose a Shift</option>
                        @foreach ($departments as $item)
                          <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                      </select>
                      @error('shift')
                      <strong class="text-danger">{{$error->first('shift')}}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="section">Section (optional) </label>
                      <select name="section" id="section" class="form-control @error('section') is-invalid @enderror">
                        <option value="">Choose a Section</option>
                        @foreach ($departments as $item)
                          <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                      </select>
                      @error('section')
                      <strong class="text-danger">{{$error->first('section')}}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Semester</label>
                      <select id="semester" name="semester" class="form-control select-or-disable @error('semester') is-invalid @enderror">
                        <option value="">Choose a Semester</option>
                        <option value="1">Semester 1</option>
                        @foreach($semesters as $item)
                          <option value="{{ $item->id }}" @selected($item->id == old('semester'))>{{ $item->name }}</option>
                        @endforeach
                      </select>
                      @error('semester')
                      <strong class="text-danger">{{ $errors->first('semester') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Year</label>
                      <select id="year"  name="year" class="form-control select-or-disable @error('year') is-invalid @enderror">
                        <option value="">Choose a Year</option>
                        <option value="1">Year 1</option>
                        <option value="2">Year 2</option>
                        <option value="3">Year 3</option>
                        <option value="4">Year 4</option>
                        {{-- @foreach($divisions as $division)
                          <option value="{{ $division->id }}" @selected($division->id == old('year'))>{{ $division->name }}</option>
                        @endforeach --}}
                      </select>
                      @error('year')
                      <strong class="text-danger">{{ $errors->first('year') }}</strong>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="s_session">Session<span class="text-danger">*</span></label>
                      <input type="text" name="s_session" id="s_session" placeholder="Ex: 2021-2022" autocomplete="off"
                             class=" form-control @error('s_session') is-invalid @enderror" value="{{ old('s_session',$user->s_session) }}">
                      <span class="spin"></span>
                      @error('s_session')
                      <strong class="text-danger">{{ $errors->first('s_session') }}</strong>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="board_roll">Board Roll<span class="text-danger">*</span></label>
                      <input type="text" name="board_roll" id="board_roll" placeholder="Enter Board Roll No" autocomplete="off"
                             class="form-control select-or-disable @error('board_roll') is-invalid @enderror" value="{{ old('board_roll',$user->board_roll) }}">
                      <span class="spin"></span>
                      @error('board_roll')
                      <strong class="text-danger">{{ $errors->first('board_roll') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="running_board_roll">Running Board Roll<span class="text-danger">*</span></label>
                      <input type="text" name="running_board_roll" id="running_board_roll" placeholder="Enter Running Board Roll No" autocomplete="off"
                             class="form-control select-or-disable @error('running_board_roll') is-invalid @enderror" value="{{ old('running_board_roll',$user->running_board_roll) }}">
                      <span class="spin"></span>
                      @error('running_board_roll')
                      <strong class="text-danger">{{ $errors->first('running_board_roll') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="admission_year">Admission Year <span class="text-danger">*</span></label>
                      <input type="text" name="admission_year" id="admission_year" placeholder="Enter Admission Year" autocomplete="off"
                             class="form-control @error('admission_year') is-invalid @enderror" value="{{ old('admission_year',$user->admission_year) }}">
                      <span class="spin"></span>
                      @error('admission_year')
                      <strong class="text-danger">{{ $errors->first('admission_year') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row mb-3 mt-3">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">NID<span class="text-danger">*</span></label>
                      <input id="nid" type="text" name="nid" placeholder="Your NID NO." required value="{{ old('nid',$user->nid) }}"
                             class="form-control select-or-disable @error('nid') is-invalid @enderror">
                      @error('nid')
                      <strong class="text-danger">{{ $errors->first('nid') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Birth-Certificate<span class="text-danger">*</span></label>
                      <input type="text" id="birth_certificate" name="birth_certificate" placeholder="Your Birth Certificate NO." required value="{{ old('birth_certificate',$user->birth_certificate) }}"
                             class="form-control select-or-disable @error('birth_certificate') is-invalid @enderror">
                      @error('birth_certificate')
                      <strong class="text-danger">{{ $errors->first('birth_certificate') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Full name [English]<span class="text-danger">*</span></label>
                      <input type="text" name="name_en" placeholder="Full name in english" required value="{{ old('name_en',$user->name_en) }}"
                             class="form-control @error('name_en') is-invalid @enderror">
                      @error('name_en')
                      <strong class="text-danger">{{ $errors->first('name_en') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">নাম [বাংলায়]<span class="text-danger">*</span></label>
                      <input type="text" name="name_bn" placeholder="বাংলায় পুরো নাম" required value="{{ old('name_bn',$user->name_bn) }}"
                             class="form-control @error('name_bn') is-invalid @enderror">
                      @error('name_bn')
                      <strong class="text-danger">{{ $errors->first('name_bn') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Username<span class="text-danger">*</span></label>
                      <input type="text" name="username" placeholder="Username" required value="{{ old('username',$user->username) }}"
                             class="form-control @error('username') is-invalid @enderror">
                      @error('username')
                      <strong class="text-danger">{{ $errors->first('username') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="phone">Phone <span class="text-danger">*</span></label>
                      <input type="number" name="phone" id="phone" placeholder="Enter Your Phone Number" autocomplete="off"
                             class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone',$user->phone) }}">
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
                             class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$user->email) }}">
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
                  {{--                  <div class="col-sm-4 mt-3">--}}
                  {{--                    <div class="form-group">--}}
                  {{--                      <label for="image">Image (Upload)</label>--}}
                  {{--                      <input type="file" name="image" id="image" placeholder="" autocomplete="off"--}}
                  {{--                             class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}">--}}
                  {{--                      <span class="spin"></span>--}}
                  {{--                      @error('image')--}}
                  {{--                      <strong class="text-danger">{{ $errors->first('image') }}</strong>--}}
                  {{--                      @enderror--}}
                  {{--                    </div>--}}
                  {{--                  </div>--}}
                  {{--                  <div class="col-md-4 " >--}}
                  {{--                    <div class="image_preview_container text-center mx-auto" >--}}
                  {{--                      <p id="preview_text">Image Preview</p>--}}
                  {{--                      <img class="d-none mt-2"  id="image_preview" alt="your image" width="85" height="85" />--}}
                  {{--                    </div>--}}
                  {{--                  </div>--}}

                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Employment Status<span class="text-danger">*</span></label>
                      <select name="employment_status" required class="form-control @error('employment_status') is-invalid @enderror">
                        <option value="">Choose an Option</option>
                        @foreach(\App\Models\User::$employmentArrays as $employment_status)
                          <option value="{{ $employment_status }}"
                                  @if(old('employment_status',$user->employment_status) == $employment_status) selected @endif>{{ ucfirst($employment_status) }}</option>
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
                      <input type="text" name="employing_company" id="employing_company" placeholder="Company/Industry Name" autocomplete="off"
                             class="form-control @error('employing_company') is-invalid @enderror" value="{{ old('employing_company',$user->employing_company) }}">
                      <span class="spin"></span>
                      @error('employing_company')
                      <strong class="text-danger">{{ $errors->first('employing_company') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
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
                <div class="row">
                  <div class="col-sm-12 text-right">
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
  <script>
    $('select[name="division_id"]').change(function () {
      const $this = $('select[name="district_id"]')
      var idDivision = this.value;
      $this.html('');
      $.ajax({
        url: "{{url('api/fetch-districts')}}/" + idDivision,
        type: "GET",
        dataType: 'json',
        success: function (result) {
          $this.html('<option value="">-- Select District --</option>');
          $.each(result.districts, function (key, value) {
            $this.append('<option value="' + value
              .id + '">' + value.name + '</option>');
          });

        }
      });
    });


  </script>
@endsection
