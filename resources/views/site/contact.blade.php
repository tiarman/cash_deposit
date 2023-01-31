@extends('layout.site')

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <style>
        .form-sub-section{
            background-color: rgba(25, 135, 84, 0.726) !important;
            /* color: black !important; */
        }
    </style>
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')
  <div class="institute_body_align">

    <div class="container institute_head_alignment">
      <h2 class="text-center" id="title">Contact</h2>
      <hr>
        <div class="row mt-3 mb-3">

            <div class="col-sm-9">
                <div class="form-group">
                    <br><h6 size="+2"><b>Whatsapp:</b> <a href="https://bit.ly/FKKxK">https://bit.ly/FKKxK</a></h6>
                    <h6 size="+2"><b>FB Link:</b> <a href="https://www.facebook.com/asset.dte">https://www.facebook.com/asset.dte</a></h6>
                    <h6 size="+2"><b>Zoom Link:</b> <a href="https://bdren.zoom.us/j/5924557856">https://bdren.zoom.us/j/5924557856</a></h6>
                    <h6 size="+2"><b>Call Hotline:</b> 01325073614, Programmer, ASSET Project</h6>
                    <h6 size="+2"><b>Email:</b> pd@asset-dte.gov.bd; info@asset-dte.gov.bd</h6>
                    <h6 size="+2"><b>Postal Address:</b> Level-4, Directorate of Technical Education, F-4/B, Agargaon, Administrative Area, Sher-E-Banglanagar, Dhaka-1207</h6>
                    <h6 size="+2"><b>Phone:</b> 0241025457</h6>

                </div>
            </div>
            <div class="col-sm-3" >
                <div class="text-left" >
{{--                    <p id="preview_text">Image Preview</p>--}}
                    <img class="mt-2 w-100 h-100"  src="assets/QR/code.png" width="200" height="200"/>
                </div>
            </div>
        </div>
      @if(session()->has('status'))
        {!! session()->get('status') !!}
      @endif
{{--      <x-registration-header />--}}
      <form class="form-horizontal toggleForm" action="" method="post" enctype="multipart/form-data">
      @csrf
        <div>
          <h4 class="p-2 text-light form-sub-section">Your Information</h4>
        </div>
        <div  class="row mt-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Full name [English]<span class="text-danger">*</span></label>
                    <input type="text" name="name_en" placeholder="Full name in english" required value="{{ old('name_en') }}"
                           class="form-control @error('name_en') is-invalid @enderror">
                    @error('name_en')
                    <strong class="text-danger">{{ $errors->first('name_en') }}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">নাম [বাংলায়]<span class="text-danger">*</span></label>
                    <input type="text" name="name_bn" placeholder="বাংলায় পুরো নাম" required value="{{ old('name_bn') }}"
                           class="form-control @error('name_bn') is-invalid @enderror">
                    @error('name_bn')
                    <strong class="text-danger">{{ $errors->first('name_bn') }}</strong>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-3 mb-1">
            <div class="col-md-6" id="ins">
                <div class="form-group">
                    <label for="institute" >Institute</label><br>
                    <select name="institute" id="institute" class="dropdownParent select2 form-control @error('institute') is-invalid @enderror">
                        <option></option>
                        @foreach ($institutes as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    @error('institute')
                    <strong class="text-danger">{{$error->first('institute')}}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-md-6" id="des">
                <div class="form-group" >
                    <label class="control-label" >Designation</label><br>
                    <select name="designation" id="designation" class="select2 form-control @error('designation') is-invalid @enderror">
                        {{-- @foreach($institutes as $institute)
                          <option value="{{ $institute->id }}" @selected($institute->id == old('designation'))>{{ $institute->name }}</option>
                        @endforeach --}}
                        <option></option>
                        <option value="1">DG</option>
                        <option value="2">Director</option>
                        <option value="3">AD</option>
                        <option value="4">EO</option>
                        <option value="5">ATO</option>
                    </select>
                    @error('designation')
                    <strong class="text-danger">{{ $errors->first('designation') }}</strong>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-3 mb-1">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="phone">Mobile Number <span class="text-danger">*</span></label>
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
                    <label for="alt_phone">Alternate Mobile Number <span class="text-danger">*</span></label>
                    <input type="number" name="alt_phone" id="alt_phone" placeholder="Enter Your Alt. Phone Number" autocomplete="off"
                           class="form-control @error('alt_phone') is-invalid @enderror" value="{{ old('alt_phone') }}">
                    <span class="spin"></span>
                    @error('alt_phone')
                    <strong class="text-danger">{{ $errors->first('alt_phone') }}</strong>
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
        </div>
        <div class="mt-3">
          <h4 class="p-2 text-light form-sub-section">Contact Information</h4>
        </div>
          <div  class="row mt-3 mb-1">
              <div class="col-md-4">
                  <div class="form-group" id="typ">
                      <label class="control-label">Type</label><br>
                      <select name="type" id="type" class="select2 form-control @error('type') is-invalid @enderror">
{{--                          <option value="">Choose Type of Contact</option>--}}
                          {{-- @foreach($institutes as $institute)
                            <option value="{{ $institute->id }}" @selected($institute->id == old('type'))>{{ $institute->name }}</option>
                          @endforeach --}}
                          <option></option>
                          <option value="1">DD</option>
                          <option value="2">Information</option>
                          <option value="1">Suggestion</option>
                          <option value="2">Complain</option>
                          <option value="2">Others</option>
                      </select>
                      @error('type')
                      <strong class="text-danger">{{ $errors->first('type') }}</strong>
                      @enderror
                  </div>
              </div>

          </div>
          <div  class="row mt-3 mb-1">
              <div class="col-md-12">
                  <div class="form-group">
                      <label class="control-label">Subject<span class="text-danger">*</span></label>
                      <input type="text" name="subject" placeholder="Enter Subject of Contact" required value="{{ old('subject') }}"
                             class="form-control @error('subject') is-invalid @enderror">
                      @error('subject')
                      <strong class="text-danger">{{ $errors->first('subject') }}</strong>
                      @enderror
                  </div>
              </div>
          </div>
          <div  class="row pb-3 mt-3 mt-3 mb-1">
              <div class="col-md-12">
                  <div class="form-group">
                      <label for="description" class="control-label">Description</label>
                      <textarea name="description" placeholder="Name" autocomplete="off" id="summernote"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                      @error('description')
                      <strong class="text-danger">{{ $errors->first('description') }}</strong>
                      @enderror
                  </div>
              </div>
          </div>
          <div  class="row pb-3 mt-3 mt-3 mb-1" style="overflow:hidden;">
              <div class="col-md-6" id="pm">
                  <div class="form-group">
                      <label for="pmu" >Reply Expected From (PMU)</label><br>
                      <select name="pmu" id="pmu" class="select2 form-control @error('pmu') is-invalid @enderror">
{{--                          <option value="">Choose Desired PMU</option>--}}
                          <option></option>
                          @foreach ($pmus as $item)
                              <option value="{{$item->id}}">{{$item->name_en}}</option>
                          @endforeach
                      </select>
                      @error('pmu')
                      <strong class="text-danger">{{$error->first('pmu')}}</strong>
                      @enderror
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label class="control-label">Reply Expectation in (Days)</label>
                      <input id="expected_days" type="number" name="expected_days" placeholder="Enter Your Expectation in (Days)" required value="{{ old('expected_days') }}"
                             class="form-control select-or-disable @error('expected_days') is-invalid @enderror">
                      @error('expected_days')
                      <strong class="text-danger">{{ $errors->first('expected_days') }}</strong>
                      @enderror
                  </div>
              </div>
          </div>
          <div  class="row pb-3 mt-3 mt-3 mb-1">
              <div class="col-sm-4">
                  <div class="form-group">
                      <label for="contact_file">File Upload</label>
                      <input type="file" name="contact_file" id="contact_file" placeholder="" autocomplete="off"
                             class="form-control @error('contact_file') is-invalid @enderror" value="{{ old('contact_file') }}">
                      <span class="spin"></span>
                      @error('contact_file')
                      <strong class="text-danger">{{ $errors->first('contact_file') }}</strong>
                      @enderror
                  </div>
              </div>
          </div>
        <div style="text-align: center" class="row mt-3">
          <div class="text-right d-flex justify-content-center">
            <button class="btn btn-success text-center w-full" type="submit">Contact</button>
          </div>
        </div>
      </form>

    </div>
  </div>
@endsection

@section('script')
{{-- nid or birth-certificate, year or semester one select from two   --}}
<script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/select2/js/select2.min.js') }}"></script>

<script>
  $(document).ready(function(){
      $('#summernote').summernote({
          placeholder: 'Write here ...',
          tabSize: 2,
          height: 150
      });
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

    // fucntion call for word count-from site blade
    $('#summernote').keyup(function(){
      checkWordValidation('summernote', 200, 500)
    })
  })

  </script>


    {{-- date picker --}}
    <script src="{{ asset('assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script>
    $(document).ready(function () {
        $('#institute').select2({
            placeholder: "Pick Your Institute",
            allowClear: true,
            dropdownParent: $('#ins')
        });
        $('#designation').select2({
            placeholder: "Pick Your Designation",
            allowClear: true,
            dropdownParent: $('#des')
        });
        $('#pmu').select2({
            placeholder: "Choose Desired PMU",
            allowClear: true,
            dropdownParent: $('#pm')

        });
        $('#type').select2({
            placeholder: "Choose Type of Contact",
            allowClear: true,
            dropdownParent: $('#typ')
        });
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

