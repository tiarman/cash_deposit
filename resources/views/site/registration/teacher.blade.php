@extends('layout.site')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
    <style>
        .form-sub-section {
            background-color: rgb(16, 38, 74) !important;
            color: white !important;
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
            <h2 class="text-center" id="title">Teacher Registration Form</h2>
            <hr>
            @if (session()->has('status'))
                {!! session()->get('status') !!}
            @endif
            <x-registration-header />
            <form id="show_student" class="form-horizontal toggleForm" action="{{ route('teacher.registration') }}"
                method="post" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <div>
                        <h4 class="p-2 text-light form-sub-section">Teacher Basic Information</h4>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">NID<span class="text-danger">*</span></label>
                            <input type="number" name="nid"
                                class="form-control @error('nid') is-invalid" @enderror id="nid">
                            @error('nid')
                                <strong class="text-danger">{{ $errors->first('nid') }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Institute Type<span class="text-danger">*</span></label>
                            <select name="institute_type_id"
                                class="select2 form-control @error('institute_type_id') is-invalid @enderror" required>
                                <option value="">Choose a Type</option>
                                @foreach ($institute_types as $institute_type)
                                    <option value="{{ $institute_type->id }}" @selected($institute_type->id == old('institute_type_id'))>
                                        {{ $institute_type->name }}</option>
                                @endforeach
                            </select>
                            @error('institute_type_id')
                                <strong class="text-danger">{{ $errors->first('institute_type_id') }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="institute_id" class="control-label">Institute<span
                                    class="text-danger">*</span></label>
                            <select name="institute_id"
                                class="select2 form-control @error('institute_id') is-invalid @enderror" required>
                                <option value="">Choose a Institute</option>
                                @foreach ($institutes as $institute)
                                    <option value="{{ $institute->id }}" @selected($institute->id == old('institute_id'))>{{ $institute->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('institute_id')
                                <strong class="text-danger">{{ $errors->first('institute_id') }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Designation<span class="text-danger">*</span></label>
                            <input type="text" name="designation"
                                class="form-control @error('designation') is-invalid" @enderror id="designation">
                            @error('designation')
                                <strong class="text-danger">{{ $errors->first('designation') }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="section_id" class="control-label">Department/Section<span
                                    class="text-danger">*</span></label>
                            <select name="section_id" class="select2 form-control @error('section_id') is-invalid @enderror"
                                required>
                                <option value="">Choose a Department/Section</option>
                                <option value="1">Science</option>
                                <option value="2">Commerce</option>
                                <option value="3">Technical Education</option>
                                {{-- @foreach ($institutes as $institute)
                  <option value="{{ $institute->id }}" @selected($institute->id == old('section_id'))>{{ $institute->name }}</option>
                @endforeach --}}
                            </select>
                            @error('section_id')
                                <strong class="text-danger">{{ $errors->first('section_id') }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-9">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name_en">Full Name (English)<span class="text-danger">*</span></label>
                                    <input type="text" name="name_en" id="name_en" placeholder="Enter Your Name"
                                        autocomplete="off" class="form-control @error('name_en') is-invalid @enderror"
                                        value="{{ old('name_en') }}">
                                    <span class="spin"></span>
                                    @error('name_en')
                                        <strong class="text-danger">{{ $errors->first('name_en') }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name_bn">পুরো নাম [বাংলায়]</label>
                                    <input type="text" name="name_bn" id="name_bn" placeholder="বাংলায় পুরো নাম"
                                        autocomplete="off" class="form-control @error('name_bn') is-invalid @enderror"
                                        value="{{ old('name_bn') }}">
                                    <span class="spin"></span>
                                    @error('name_bn')
                                        <strong class="text-danger">{{ $errors->first('name_bn') }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" name="dob" id="dob"
                                        placeholder="Enter Your Date of Birth" autocomplete="off"
                                        class="form-control @error('dob') is-invalid @enderror"
                                        value="{{ old('dob') }}">
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
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" placeholder="Enter Your E-mail"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}">
                                    <span class="spin"></span>
                                    @error('email')
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="phone">Mobile No <span class="text-danger">*</span></label>
                                    <input type="number" name="phone" id="phone"
                                        placeholder="Enter Your Phone Number" autocomplete="off"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone') }}">
                                    <span class="spin"></span>
                                    @error('phone')
                                        <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password">Password<span class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password"
                                        placeholder="Enter Your Password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        value="{{ old('password') }}">
                                    <span class="spin"></span>
                                    @error('password')
                                        <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password<span
                                            class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        placeholder="Confirm Your Password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        value="{{ old('password_confirmation') }}">
                                    <span class="spin"></span>
                                    @error('password_confirmation')
                                        <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row mb-3">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="profile_photo_path">Photo (Upload)</label>
                                    <input type="file" name="profile_photo_path" id="profile_photo_path"
                                        placeholder="Enter Your Name" autocomplete="off"
                                        class="form-control @error('profile_photo_path') is-invalid @enderror"
                                        value="{{ old('profile_photo_path') }}">
                                    <span class="spin"></span>
                                    @error('profile_photo_path')
                                        <strong class="text-danger">{{ $errors->first('profile_photo_path') }}</strong>
                                    @enderror
                                    <div class="img-holder mb-4 d-flex justify-content-center">
                                        <img src="{{ asset('assets/placeholder.png') }}" alt="example placeholder"
                                            style="width: 131px; margin-top: 26px;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">

                </div>
                {{--        <div class="row mb-3"> --}}
                {{--          <div class="col-sm-4"> --}}
                {{--            <div class="form-group"> --}}
                {{--              <label class="control-label">Designation</label> --}}
                {{--              <select name="designation" class="form-control @error('designation') is-invalid @enderror"> --}}
                {{--                <option value="">Choose an Designation</option> --}}
                {{--                <option value="1">Asst. Teacher</option> --}}
                {{--                <option value="1">Junior Teacher</option> --}}
                {{--                --}}{{-- @foreach ($institutes as $institute) --}}
                {{--                --}}{{-- <option value="{{ $institute->id }}" @selected($institute->id == old('designation'))>{{ $institute->name }}</option> --}}
                {{--                --}}{{-- @endforeach --}}
                {{--              </select> --}}
                {{--              @error('designation') --}}
                {{--              <strong class="text-danger">{{ $errors->first('designation') }}</strong> --}}
                {{--              @enderror --}}
                {{--            </div> --}}
                {{--          </div> --}}
                {{--          <div class="col-sm-4"> --}}
                {{--            <div class="form-group"> --}}
                {{--              <label class="control-label">Curriculum Name</label> --}}
                {{--              <select name="curriculum_name" class="form-control @error('curriculum_name') is-invalid @enderror"> --}}
                {{--                <option value="">Choose an Curriculum</option> --}}
                {{--                <option value="1">Semester</option> --}}
                {{--                <option value="2">Trimemester</option> --}}
                {{--                --}}{{-- @foreach ($institutes as $institute) --}}
                {{--                --}}{{-- <option value="{{ $institute->id }}" @selected($institute->id == old('curriculum_name'))>{{ $institute->name }}</option> --}}
                {{--                --}}{{-- @endforeach --}}
                {{--              </select> --}}
                {{--              @error('curriculum_name') --}}
                {{--              <strong class="text-danger">{{ $errors->first('designation') }}</strong> --}}
                {{--              @enderror --}}
                {{--            </div> --}}
                {{--          </div> --}}
                {{--          <div class="col-sm-4"> --}}
                {{--            <div class="form-group"> --}}
                {{--              <label class="control-label">Trade/Technology</label> --}}
                {{--              <select name="trade_technology" class="form-control @error('trade_technology') is-invalid @enderror"> --}}
                {{--                <option value="">Choose a trade/technology</option> --}}
                {{--                <option value="1">PHP</option> --}}
                {{--                <option value="1">JavaScript</option> --}}
                {{--                --}}{{-- @foreach ($institutes as $institute) --}}
                {{--                --}}{{-- <option value="{{ $institute->id }}" @selected($institute->id == old('trade_technology'))>{{ $institute->name }}</option> --}}
                {{--                --}}{{-- @endforeach --}}
                {{--              </select> --}}
                {{--              @error('trade_technology') --}}
                {{--              <strong class="text-danger">{{ $errors->first('trade_technology') }}</strong> --}}
                {{--              @enderror --}}
                {{--            </div> --}}
                {{--          </div> --}}
                {{--        </div> --}}
                {{--        <div class="row mb-3"> --}}
                {{--          <div class="col-sm-4"> --}}
                {{--            <div class="form-group"> --}}
                {{--              <label class="control-label">Subject</label> --}}
                {{--              <select name="subject" class="form-control @error('subject') is-invalid @enderror"> --}}
                {{--                <option value="">Choose an Subject</option> --}}
                {{--                <option value="1">Artificial Intelligence</option> --}}
                {{--                <option value="1">Machine Learning</option> --}}
                {{--                --}}{{-- @foreach ($institutes as $institute) --}}
                {{--                --}}{{-- <option value="{{ $institute->id }}" @selected($institute->id == old('subject'))>{{ $institute->name }}</option> --}}
                {{--                --}}{{-- @endforeach --}}
                {{--              </select> --}}
                {{--              @error('subject') --}}
                {{--              <strong class="text-danger">{{ $errors->first('subject') }}</strong> --}}
                {{--              @enderror --}}
                {{--            </div> --}}
                {{--          </div> --}}
                {{--          <div class="col-sm-4"> --}}
                {{--            <div class="form-group"> --}}
                {{--              <label for="name_en">Photo (Upload)</label> --}}
                {{--              <input type="file" name="image" id="image" placeholder="Enter Your Name" autocomplete="off" --}}
                {{--                     class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}"> --}}
                {{--              <span class="spin"></span> --}}
                {{--              @error('image') --}}
                {{--              <strong class="text-danger">{{ $errors->first('image') }}</strong> --}}
                {{--              @enderror --}}
                {{--            </div> --}}
                {{--          </div> --}}
                {{--          <div class="col-sm-4"> --}}
                {{--            <div class="form-group"> --}}
                {{--              <label class="control-label">Institute Category</label> --}}
                {{--              <select name="institute_category" class="form-control @error('institute_category') is-invalid @enderror"> --}}
                {{--                <option value="">Choose a Institute Category</option> --}}
                {{--                --}}{{-- @foreach ($districts as $district) --}}
                {{--                  <option value="{{ $district->id }}" @selected($district->id == old('institute_category'))>{{ $district->name }}</option> --}}
                {{--                @endforeach --}}
                {{--              </select> --}}
                {{--              @error('institute_category') --}}
                {{--              <strong class="text-danger">{{ $errors->first('institute_category') }}</strong> --}}
                {{--              @enderror --}}
                {{--            </div> --}}
                {{--          </div> --}}
                {{--        </div> --}}
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
    <script src="{{ asset('assets/admin/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2()
            $(".tabClick").click(function(e) {
                $('.toggleForm').hide();
                $('#show_' + e.target.id).show()
                $('.tabClick').removeClass('btn-success')
                $(this).addClass('btn-success')
            });
        });
        //Image preview
        $('input[type="file"][name="profile_photo_path"]').on('change', function() {
            var img_path = $(this)[0].value;
            var img_holder = $('.img-holder');
            var extension = img_path.substring(img_path.lastIndexOf('.') + 1).toLowerCase();
            if (extension == 'jpeg' || extension == 'jpg' || extension == 'png') {
                if (typeof(FileReader) != 'undefined') {
                    img_holder.empty();
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('<img/>', {
                            'src': e.target.result,
                            'class': 'img-fluid',
                            'style': 'max-width:100px;margin-bottom:10px; margin-top: 26px;'
                        }).appendTo(img_holder);
                    }
                    img_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    $(img_holder).html('This browser does not support FileReader');
                }
            } else {
                $(img_holder).empty();
            }
        });
    </script>
@endsection
