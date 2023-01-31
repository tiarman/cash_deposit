@extends('layout.admin')
@section('stylesheet')
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
  <script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('assets\admin\plugins\summernote\summernote-bs4.css') }}">
  <script src="{{ asset('assets\admin\plugins\summernote\summernote-bs4.js') }}"></script>
@endsection
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Eligibility Application Form</h2>
              @if($form)
                <h4 class="text-right"><span class="btn btn-success btn-sm  mb-3">Total: {{ $form->mark }}</span></h4>
              @endif
            </header>
            <hr>
            <div class="panel-body">
              {{--    <p class="text-center">--}}
              {{--      <small id="passwordHelpInline" class="text-muted"> Developer: follow me on facebook <a href="https://www.facebook.com/JheanYu"> John niro yumang</a> inspired from <a href="https://p.w3layouts.com/">https://p.w3layouts.com/</a>.</small>--}}
              {{--    </p>--}}
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              <form role="form" method="post" id="ea-form" action="{{ route('form') }}" enctype="multipart/form-data">
                @csrf

                @if($form)
                  <input type="hidden" name="id" value="{{ $form->id }}">
                @endif
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="email">Email <span class="text-danger">*</span></label>
                      <input type="email" name="email" value="{{ old("email", $form ? $form->email : $institute->email) }}" id="email"
                             class="form-control @error("email") is-invalid @enderror" placeholder="Email">
                      @error("email")
                      <strong class="text-danger">{{ $errors->first("email") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="institute_name_en">Name of the Institute (English) <span
                          class="text-danger">*</span></label>
                      <input type="text" name="institute_name_en" value="{{ old("institute_name_en",  $form ? $form->institute_name_en : $institute->name) }}"
                             id="institute_name_en"
                             class="form-control @error("institute_name_en") is-invalid @enderror"
                             placeholder="Name of the Institute">
                      @error("institute_name_en")
                      <strong class="text-danger">{{ $errors->first("institute_name_en") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="institute_name_bn">ইনস্টিটিউটের নাম (বাংলা) <span
                          class="text-danger">*</span></label>
                      <input type="text" name="institute_name_bn" value="{{ old("institute_name_bn",  $form ? $form->institute_name_bn : '') }}"
                             id="institute_name_bn"
                             class="form-control @error("institute_name_bn") is-invalid @enderror"
                             placeholder="ইনস্টিটিউটের নাম">
                      @error("institute_name_bn")
                      <strong class="text-danger">{{ $errors->first("institute_name_bn") }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="institute_code">Institute Code (BTEB)<span class="text-danger">*</span></label>
                      <input type="number" name="institute_code" value="{{ old("institute_code", $form ? $form->institute_code : $institute->code) }}" id="institute_code"
                             class="form-control @error("institute_code") is-invalid @enderror"
                             placeholder="Institute Code (BTEB)">
                      @error("institute_code")
                      <strong class="text-danger">{{ $errors->first("institute_code") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="telephone">Telephone <span class="text-danger">*</span></label>
                      <input type="number" name="telephone" value="{{ old("telephone", $form ? $form->telephone : $institute->phone) }}" id="telephone"
                             class="form-control @error("telephone") is-invalid @enderror"
                             placeholder="Telephone no of the Institute">
                      @error("telephone")
                      <strong class="text-danger">{{ $errors->first("telephone") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="institute_website">Website of Institute <span class="text-primary">Ex. (www.asset-dte.gov.bd)</span></label>
                      <input type="text" name="institute_website" value="{{ old("institute_website", $form ? $form->institute_website : $institute->website ?? '') }}"
                             id="institute_website"
                             class="form-control @error("institute_website") is-invalid @enderror"
                             placeholder="Website of Institute">
                      <span id="invaild-url" class="text-danger d-none">Invaild URL</span>
                      @error("institute_website")
                      <strong class="text-danger">{{ $errors->first("institute_website") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <script>
                    // frontend url valid on time by
                    $(document).ready(function () {

                      function validURL(str) {
                        var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
                          '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
                          '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
                          '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
                          '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
                          '(\\#[-a-z\\d_]*)?$', 'i'); // fragment locator
                        return !!pattern.test(str);
                      }

                      $('#institute_website').change(function () {
                        console.log("institute_website")
                        // let expression = /^[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-zA-Z0-9()]{1,6}\\b(?:[-a-zA-Z0-9()@:%_\\+.~#?&\\/=]*)$/;
                        // let regex = new RegExp(expression);
                        const url = $('#institute_website').val();
                        // console.log(validURL(url))
                        if (validURL(url)) {
                          $('#invaild-url').addClass('d-none');
                          $('#institute_website').removeClass('is-invalid');
                          // console.log('tested url valid',url);
                        } else {
                          $('#invaild-url').removeClass('d-none');
                          $('#institute_website').addClass('is-invalid');
                          console.log("Getting error")
                          // console.log('tested url in-valid',url);
                        }

                      })
                    })
                  </script>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="institute_type">Institute type <span class="text-danger">*</span></label>
                      <select name="institute_type" id="institute_type"
                              class="form-control @error("institute_type") is-invalid @enderror">
                        @if(!$form)
                          <option value="government" @selected(old("institute_type", $form ? $form->institute_type : '') == 'government')>Government</option>
                          <option value="private" @selected(old("institute_type", $form ? $form->institute_type : '') == 'private')>Private</option>
                        @else
                          <option value="government" @selected(old("institute_type", $form ? $form->institute_type : '') == 'government')
                          @if(old("institute_type", $form ? $form->institute_type : '') != 'government') disabled @endif>Government
                          </option>
                          <option value="private" @selected(old("institute_type", $form ? $form->institute_type : '') == 'private')
                          @if(old("institute_type", $form ? $form->institute_type : '') != 'private') disabled @endif>Private
                          </option>
                        @endif
                      </select>
                      @error("institute_type")
                      <strong class="text-danger">{{ $errors->first("institute_type") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="institute_category">Institute category<span class="text-danger">*</span></label>
                      <select name="institute_category" id="institute_category"
                              class="form-control @error("institute_category") is-invalid @enderror">
                        <option value="">Choose a type</option>
                        @foreach(\App\Models\EligibilityApplicationFormIdg::$instituteTypes as $type)
                          <option
                            value="{{ $type }}" @selected(old("institute_category", $form ? $form->institute_category : "") == $type)>{{ $type }}</option>
                        @endforeach
                      </select>
                      @error("institute_category")
                      <strong class="text-danger">{{ $errors->first("institute_category") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="division_id">Division <span class="text-danger">*</span></label>
                      <select name="division_id" id="division_id"
                              class="form-control @error("division_id") is-invalid @enderror">
                        <option value="">Choose a division</option>
                        @foreach(\App\Models\Division::get() as $division)
                          <option
                            value="{{ $division->id }}" @selected(old("division_id", $form ? $form->division_id : $institute->division_id) == $division->id)>{{ $division->name }}</option>
                        @endforeach
                      </select>
                      @error("division_id")
                      <strong class="text-danger">{{ $errors->first("division_id") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="district_id">District <span class="text-danger">*</span></label>
                      <select name="district_id" id="district_id"
                              class="form-control @error("district_id") is-invalid @enderror">
                        <option value="">Choose a district</option>
                        @foreach(\App\Models\District::get() as $district)
                          <option
                            value="{{ $district->id }}" @selected(old("district_id", $form ? $form->district_id : $institute->district_id) == $district->id)>{{ $district->name }}</option>
                        @endforeach
                      </select>
                      @error("district_id")
                      <strong class="text-danger">{{ $errors->first("district_id") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="upazila_id">Upazila <span class="text-danger">*</span></label>
                      <select name="upazila_id" id="upazila_id"
                              class="form-control @error("upazila_id") is-invalid @enderror">
                        <option value="">Choose a upazila</option>
                        @foreach(\App\Models\Upazila::get() as $upazila)
                          <option
                            value="{{ $upazila->id }}" @selected(old("upazila_id", $form ? $form->upazila_id : $institute->upazila_id ?? '') == $upazila->id)>{{ $upazila->name }}</option>
                        @endforeach
                      </select>
                      @error("upazila_id")
                      <strong class="text-danger">{{ $errors->first("upazila_id") }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="principal_name">Name of Principal<span class="text-danger">*</span></label>
                      <input type="text" name="principal_name" value="{{ old("principal_name", $form ? $form->principal_name : '') }}" id="principal_name"
                             class="form-control @error("principal_name") is-invalid @enderror"
                             placeholder="Name of the principal">
                      @error("principal_name")
                      <strong class="text-danger">{{ $errors->first("principal_name") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="principal_phone">Mobile Number of Principal <span
                          class="text-danger">*</span></label>
                      <input type="number" name="principal_phone" value="{{ old("principal_phone", $form ? $form->principal_phone : '') }}"
                             id="principal_phone"
                             class="form-control @error("principal_phone") is-invalid @enderror"
                             placeholder="Phone no of principal">
                      @error("principal_phone")
                      <strong class="text-danger">{{ $errors->first("principal_phone") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="principal_email">Email of Principal <span class="text-danger">*</span></label>
                      <input type="email" name="principal_email" value="{{ old("principal_email", $form ? $form->principal_email : '') }}"
                             id="principal_email" class="form-control @error("principal_email") is-invalid @enderror"
                             placeholder="Email of principal">
                      @error("principal_email")
                      <strong class="text-danger">{{ $errors->first("principal_email") }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row bordered-p mb-3">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="establishment_year">Year of Establishment <span class="text-danger">*</span></label>
                      <input type="text" name="establishment_year" value="{{ old("establishment_year", $form ? $form->establishment_year : '') }}"
                             id="establishment_year"
                             class="yearPicker form-control @error("establishment_year") is-invalid @enderror"
                             placeholder="Year">
                      @error("establishment_year")
                      <strong class="text-danger">{{ $errors->first("establishment_year") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="score_for_establishment_year">Condition of Establishment) <span
                          class="text-danger">*</span></label>
                      <select name="score_for_establishment_year" id="score_for_establishment_year" readonly
                              class="form-control @error("score_for_establishment_year") is-invalid @enderror">
                        <option value="">Choose a type</option>
                        <optgroup label="Government Institutes" id="score_for_establishment_year_govt">
                          <option value="10">If established 7 years or more score = 10</option>
                          <option value="8">If established 6 years score = 8</option>
                          <option value="5">If established 5 years score = 5</option>
                          <option value="3">If established 3 - 4 years score = 3</option>
                          <option value="0">If established less than 3 years score = 0</option>
                        </optgroup>
                        <optgroup label="Private institute" id="score_for_establishment_year_private">
                          <option value="10">If established 10 years or more score = 10</option>
                          <option value="8">If established 8 - 9 years score = 8</option>
                          <option value="5">If established 7 years score = 5</option>
                          <option value="3">If established 5 - 6 years score = 3</option>
                          <option value="0">If established less than 5 years score = 0</option>
                        </optgroup>
                      </select>
                      @error("score_for_establishment_year")
                      <strong class="text-danger">{{ $errors->first("score_for_establishment_year") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="score_for_establishment_year_val">Score value <span class="text-danger">*</span></label>
                      <input type="text" disabled value="0"
                             id="score_for_establishment_year_val"
                             class="form-control @error("score_for_establishment_year_val") is-invalid @enderror"
                             placeholder="0.00">
                    </div>
                  </div>
                </div>

                <script>
                  $(document).ready(function () {
                    $('#institute_type').change(function () {
                      $('#establishment_year').val('')
                      $("#score_for_establishment_year").val('').change();
                    })
                    $('#institute_category').change(function () {
                      $('#student_intake_capacity_2020').val('')
                      $('#student_intake_capacity_2021').val('')
                      $('#student_intake_capacity_2022').val('')
                      $('#no_of_actual_student_2020').val('')
                      $('#no_of_actual_student_2021').val('')
                      $('#no_of_actual_student_2022').val('')
                      $("#score_for_intake_criterion").val('').change();
                    })
                    $('#establishment_year').change(function () {
                      checkEstablishmentYear()
                    })
                    checkEstablishmentYear()


                    function checkEstablishmentYear() {
                      const type = $('#institute_type').val();
                      const currentDate = new Date();
                      const currentYear = parseInt(currentDate.getFullYear());
                      const year = Number($('#establishment_year').val());
                      if (year === 0) {
                        return 0;
                      }
                      const diffYear = (currentYear - year);
                      $("#score_for_establishment_year").find('option[selected="selected"]').removeAttr('selected');
                      $("#score_for_establishment_year").find('option').attr('disabled', 'true');
                      if (type === 'private') {
                        if (diffYear >= 10) {
                          $("#score_for_establishment_year > optgroup[id='score_for_establishment_year_private']").find("option[value='10']").removeAttr("disabled");
                          $("#score_for_establishment_year > optgroup[id='score_for_establishment_year_private']").find("option[value='10']").prop("selected", true);
                          $("#score_for_establishment_year_val").val(10);
                          return 0;
                        } else if (diffYear == 9 || diffYear == 8) {
                          $("#score_for_establishment_year > optgroup[id='score_for_establishment_year_private']").find("option[value='8']").removeAttr("disabled");
                          $("#score_for_establishment_year > optgroup[id='score_for_establishment_year_private']").find("option[value='8']").prop("selected", true);
                          $("#score_for_establishment_year_val").val(8);
                          return 0;
                        } else if (diffYear == 7) {
                          $("#score_for_establishment_year > optgroup[id='score_for_establishment_year_private']").find("option[value='5']").removeAttr("disabled");
                          $("#score_for_establishment_year > optgroup[id='score_for_establishment_year_private']").find("option[value='5']").prop("selected", true);
                          $("#score_for_establishment_year_val").val(5);
                          return 0;
                        } else if (diffYear == 6 || diffYear == 5) {
                          $("#score_for_establishment_year > optgroup[id='score_for_establishment_year_private']").find("option[value='3']").removeAttr("disabled");
                          $("#score_for_establishment_year > optgroup[id='score_for_establishment_year_private']").find("option[value='3']").prop("selected", true);
                          $("#score_for_establishment_year_val").val(3);
                          return 0;
                        } else {
                          $("#score_for_establishment_year > optgroup[id='score_for_establishment_year_private']").find("option[value='0']").removeAttr("disabled");
                          $("#score_for_establishment_year > optgroup[id='score_for_establishment_year_private']").find("option[value='0']").prop("selected", true);
                          $("#score_for_establishment_year_val").val(0);
                          return 0;
                        }
                      } else {
                        if (diffYear >= 7) {
                          $("#score_for_establishment_year > optgroup[id='score_for_establishment_year_govt']").find("option[value='10']").removeAttr("disabled");
                          $("#score_for_establishment_year > optgroup[id='score_for_establishment_year_govt']").find("option[value='10']").prop("selected", true);
                          $("#score_for_establishment_year_val").val(10);
                          return 0;
                        } else if (diffYear == 6) {
                          $("#score_for_establishment_year > optgroup[id='score_for_establishment_year_govt']").find("option[value='8']").removeAttr("disabled");
                          $("#score_for_establishment_year > optgroup[id='score_for_establishment_year_govt']").find("option[value='8']").prop("selected", true);
                          $("#score_for_establishment_year_val").val(8);
                          return 0;
                        } else if (diffYear == 5) {
                          $("#score_for_establishment_year > optgroup[id='score_for_establishment_year_govt']").find("option[value='5']").removeAttr("disabled");
                          $("#score_for_establishment_year > optgroup[id='score_for_establishment_year_govt']").find("option[value='5']").prop("selected", true);
                          $("#score_for_establishment_year_val").val(5);
                          return 0;
                        } else if (diffYear == 4 || diffYear == 3) {
                          $("#score_for_establishment_year > optgroup[id='score_for_establishment_year_govt']").find("option[value='3']").removeAttr("disabled");
                          $("#score_for_establishment_year > optgroup[id='score_for_establishment_year_govt']").find("option[value='3']").prop("selected", true);
                          $("#score_for_establishment_year_val").val(3);
                          return 0;
                        } else {
                          $("#score_for_establishment_year > optgroup[id='score_for_establishment_year_govt']").find("option[value='0']").removeAttr("disabled");
                          $("#score_for_establishment_year > optgroup[id='score_for_establishment_year_govt']").find("option[value='0']").prop("selected", true);
                          $("#score_for_establishment_year_val").val(0);
                          return 0;
                        }
                      }
                    }
                  })
                </script>


                <div class="row bordered">
                  <div class="col-md-12">
                    <div class="row bordered-p">
                      <div class="col-md-12">
                        <h6 class="text-center">Student Enrollment / Intake Capacity</h6>
                      </div>
                      <div class="col-md-3">
                        <label for="student_intake_capacity_2022">2022 <span class="text-danger">*</span></label>
                        <input type="number" name="student_intake_capacity_2022"
                               value="{{ old("student_intake_capacity_2022", $form ? $form->student_intake_capacity_2022 : '') }}" id="student_intake_capacity_2022"
                               class="form-control @error("student_intake_capacity_2022") is-invalid @enderror"
                               placeholder="0">
                        @error("student_intake_capacity_2022")
                        <strong class="text-danger">{{ $errors->first("student_intake_capacity_2022") }}</strong>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="student_intake_capacity_2021">2021 <span class="text-danger">*</span></label>
                        <input type="number" name="student_intake_capacity_2021"
                               value="{{ old("student_intake_capacity_2021", $form ? $form->student_intake_capacity_2021 : '') }}" id="student_intake_capacity_2021"
                               class="form-control @error("student_intake_capacity_2021") is-invalid @enderror"
                               placeholder="0">
                        @error("student_intake_capacity_2021")
                        <strong class="text-danger">{{ $errors->first("student_intake_capacity_2021") }}</strong>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="student_intake_capacity_2020">2020 <span class="text-danger">*</span></label>
                        <input type="number" name="student_intake_capacity_2020"
                               value="{{ old("student_intake_capacity_2020", $form ? $form->student_intake_capacity_2020 : '') }}" id="student_intake_capacity_2020"
                               class="form-control @error("student_intake_capacity_2020") is-invalid @enderror"
                               placeholder="0">
                        @error("student_intake_capacity_2020")
                        <strong class="text-danger">{{ $errors->first("student_intake_capacity_2020") }}</strong>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="student_intake_capacity_2019">2019 <span class="text-danger">*</span></label>
                        <input type="number" name="student_intake_capacity_2019"
                               value="{{ old("student_intake_capacity_2019", $form ? $form->student_intake_capacity_2019 : '') }}" id="student_intake_capacity_2019"
                               class="form-control @error("student_intake_capacity_2019") is-invalid @enderror"
                               placeholder="0">
                        @error("student_intake_capacity_2019")
                        <strong class="text-danger">{{ $errors->first("student_intake_capacity_2019") }}</strong>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="row bordered-p">
                      <div class="col-md-12">
                        <h6 class="text-center">No. of Actual Student</h6>
                      </div>
                      <div class="col-md-3">
                        <label for="no_of_actual_student_2022">2022 <span class="text-danger">*</span></label>
                        <input type="number" name="no_of_actual_student_2022"
                               value="{{ old("no_of_actual_student_2022", $form ? $form->no_of_actual_student_2022 : '') }}" id="no_of_actual_student_2022"
                               class="form-control @error("no_of_actual_student_2022") is-invalid @enderror"
                               placeholder="0">
                        @error("no_of_actual_student_2022")
                        <strong class="text-danger">{{ $errors->first("no_of_actual_student_2022") }}</strong>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="no_of_actual_student_2021">2021 <span class="text-danger">*</span></label>
                        <input type="number" name="no_of_actual_student_2021"
                               value="{{ old("no_of_actual_student_2021", $form ? $form->no_of_actual_student_2021 : '') }}" id="no_of_actual_student_2021"
                               class="form-control @error("no_of_actual_student_2021") is-invalid @enderror"
                               placeholder="0">
                        @error("no_of_actual_student_2021")
                        <strong class="text-danger">{{ $errors->first("no_of_actual_student_2021") }}</strong>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="no_of_actual_student_2020">2020 <span class="text-danger">*</span></label>
                        <input type="number" name="no_of_actual_student_2020"
                               value="{{ old("no_of_actual_student_2020", $form ? $form->no_of_actual_student_2020 : '') }}" id="no_of_actual_student_2020"
                               class="form-control @error("no_of_actual_student_2020") is-invalid @enderror"
                               placeholder="0">
                        @error("no_of_actual_student_2020")
                        <strong class="text-danger">{{ $errors->first("no_of_actual_student_2020") }}</strong>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="no_of_actual_student_2019">2019 <span class="text-danger">*</span></label>
                        <input type="number" name="no_of_actual_student_2019"
                               value="{{ old("no_of_actual_student_2019", $form ? $form->no_of_actual_student_2019 : '') }}" id="no_of_actual_student_2019"
                               class="form-control @error("no_of_actual_student_2019") is-invalid @enderror"
                               placeholder="0">
                        @error("no_of_actual_student_2019")
                        <strong class="text-danger">{{ $errors->first("no_of_actual_student_2019") }}</strong>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                      <label for="score_for_intake_criterion">Score for Intake Criterion <span
                          class="text-danger">*</span></label>
                      <select name="score_for_intake_criterion" id="score_for_intake_criterion" readonly
                              class="form-control @error("score_for_intake_criterion") is-invalid @enderror">
                        <option value="">Choose a type</option>
                        <optgroup label="Polytechnic Institute" id="score_for_intake_criterion_polytechnic">
                          <option value="15">If annual intake is more than 350</option>
                          <option value="13">If annual intake is 301-350</option>
                          <option value="10" id="10-g">If annual intake is 200-300 (Gov)</option>
                          <option value="10" id="10-p">If annual intake is 250-300 (Private)</option>
                          <option value="0">If annual intake is less than 200</option>
                        </optgroup>
                        <optgroup label="Technical School and College" id="technical_school_and_college">
                          <option value="15">If annual intake is more than 250</option>
                          <option value="13">If annual intake is 201-250</option>
                          <option value="10">If annual intake is 151-200</option>
                          <option value="0">If annual intake is less than 151</option>
                        </optgroup>
                        <optgroup label="Institutes of Marine Technology (IMT)" id="score_for_intake_criterion_imt">
                          <option value="15">If annual intake is more than 70</option>
                          <option value="13">If annual intake is 61-70</option>
                          <option value="10">If annual intake is 50-60</option>
                          <option value="0">If annual intake is less than 50</option>
                        </optgroup>
                        <optgroup label="Institute of Health Technology (IHT)" id="score_for_intake_criterion_iht">
                          <option value="15">If annual intake is more than 150</option>
                          <option value="13">If annual intake is 131-150</option>
                          <option value="10">If annual intake is 100-130</option>
                          <option value="0">If annual intake is less than 100</option>
                        </optgroup>
                        <optgroup label="Medical Assistant Training School (MATS)" id="score_for_intake_criterion_mats">
                          <option value="15">If annual intake is more than 70</option>
                          <option value="13">If annual intake is 61-70</option>
                          <option value="10">If annual intake is 50-60</option>
                          <option value="0">If annual intake is less than 50</option>
                        </optgroup>
                        <optgroup label="Nursing College/Institute (Diploma-level)" id="score_for_intake_criterion_diploma">
                          <option value="15">If annual intake is more than 130</option>
                          <option value="13">If annual intake is 101-130</option>
                          <option value="10">If annual intake is 50-100</option>
                          <option value="0">If annual intake is less than 50</option>
                        </optgroup>
                      </select>
                      @error("score_for_intake_criterion")
                      <strong class="text-danger">{{ $errors->first("score_for_intake_criterion") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label for="score_for_intake_criterion_val">Score Value</label>
                    <input type="number" name="score_for_intake_criterion_val" disabled
                           value="{{ old("score_for_intake_criterion_val", 0) }}" id="score_for_intake_criterion_val"
                           class="form-control @error("score_for_intake_criterion_val") is-invalid @enderror"
                           placeholder="0">
                  </div>
                  <script>
                    $(document).ready(function () {
                      const ic22 = $('#student_intake_capacity_2022')
                      const ic21 = $('#student_intake_capacity_2021')
                      const ic20 = $('#student_intake_capacity_2020')
                      const ic19 = $('#student_intake_capacity_2019')


                      const nas22 = $('#no_of_actual_student_2022')
                      const nas21 = $('#no_of_actual_student_2021')
                      const nas20 = $('#no_of_actual_student_2020')
                      const nas19 = $('#no_of_actual_student_2019')
                      ic22.change(function () {
                        checkIC(2022)
                        setScoreForIntakeCriterion()
                        ic19.attr('readonly', true)
                        nas19.attr('readonly', true)
                      })
                      ic21.change(function () {
                        checkIC(2021)
                        setScoreForIntakeCriterion()
                      })
                      ic20.change(function () {
                        checkIC(2020)
                        setScoreForIntakeCriterion()
                      })
                      ic19.change(function () {
                        checkIC(2019)
                        setScoreForIntakeCriterion()
                        ic22.attr('readonly', true)
                        nas22.attr('readonly', true)
                      })

                      nas22.change(function () {
                        checkIC(2022)
                        ic19.attr('readonly', true)
                        nas19.attr('readonly', true)
                        setScoreForIntakeCriterion()
                      })
                      nas21.change(function () {
                        checkIC(2021)
                        setScoreForIntakeCriterion()
                      })
                      nas20.change(function () {
                        checkIC(2020)
                        setScoreForIntakeCriterion()
                      })
                      nas19.change(function () {
                        checkIC(2019)
                        ic22.attr('readonly', true)
                        nas22.attr('readonly', true)
                        setScoreForIntakeCriterion()
                      })

                      function setScoreForIntakeCriterion() {
                        const ic22val = ic22.val()
                        const ic21val = ic21.val()
                        const ic20val = ic20.val()
                        const ic19val = ic19.val()
                        const totalIc = (Number(ic22val) + Number(ic21val) + Number(ic20val) + Number(ic19val));
                        let countIc = 0;
                        if (ic19val > 0) {
                          countIc = (countIc + 1)
                        }
                        if (ic20val > 0) {
                          countIc = (countIc + 1)
                        }
                        if (ic21val > 0) {
                          countIc = (countIc + 1)
                        }
                        if (ic22val > 0) {
                          countIc = (countIc + 1)
                        }

                        const nas22val = nas22.val()
                        const nas21val = nas21.val()
                        const nas20val = nas20.val()
                        const nas19val = nas19.val()
                        let totalNas = 0;

                        let countNas = 0;
                        if (nas22val > 0) {
                          totalNas = (Number(totalNas) + Number(nas22val));
                          countNas = countNas + 1;
                        }

                        if (nas21val > 0) {
                          totalNas = (Number(totalNas) + Number(nas21val));
                          countNas = countNas + 1;
                        }

                        if (nas20val > 0) {
                          totalNas = (Number(totalNas) + Number(nas20val));
                          countNas = countNas + 1;
                        }

                        if (nas19val > 0) {
                          totalNas = (Number(totalNas) + Number(nas19val));
                          countNas = countNas + 1;
                        }

                        // console.log(totalIc)
                        // console.log(countIc)
                        // console.log(totalNas)
                        // const avgIc = Math.round(totalIc / countIc);
                        const avgIc = Math.round(totalNas / 3);
                        // console.log("total" + avgIc)
                        $("#score_for_intake_criterion").find('option[selected="selected"]').removeAttr('selected');
                        $("#score_for_intake_criterion").find('option').attr('disabled', 'true');

                        const category = $('#institute_category').val()
                        if (category === 'Institutes of Marine Technology (IMT)') {
                          if (avgIc > 70) {
                            $('#score_for_intake_criterion_val').val(15)
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_imt']").find("option[value='15']").removeAttr("disabled");
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_imt']").find("option[value='15']").prop("selected", true);
                            return 0;
                          }
                          if (71 > avgIc && avgIc > 60) {
                            $('#score_for_intake_criterion_val').val(13)
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_imt']").find("option[value='13']").removeAttr("disabled");
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_imt']").find("option[value='13']").prop("selected", true);
                            return 0;
                          }
                          if (61 > avgIc && avgIc > 49) {
                            $('#score_for_intake_criterion_val').val(10)
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_imt']").find("option[value='10']").removeAttr("disabled");
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_imt']").find("option[value='10']").prop("selected", true);
                            return 0;
                          }
                          $('#score_for_intake_criterion_val').val(0)
                          $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_imt']").find("option[value='0']").removeAttr("disabled");
                          $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_imt']").find("option[value='0']").prop("selected", true);
                          return 0;
                        } else if (category === 'Institute of Health Technology (IHT)') {
                          if (avgIc > 150) {
                            $('#score_for_intake_criterion_val').val(15)
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_iht']").find("option[value='15']").removeAttr("disabled");
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_iht']").find("option[value='15']").prop("selected", true);
                            return 0;
                          }
                          if (151 > avgIc && avgIc > 130) {
                            $('#score_for_intake_criterion_val').val(13)
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_iht']").find("option[value='13']").removeAttr("disabled");
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_iht']").find("option[value='13']").prop("selected", true);
                            return 0;
                          }
                          if (131 > avgIc && avgIc > 100) {
                            $('#score_for_intake_criterion_val').val(10)
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_iht']").find("option[value='10']").removeAttr("disabled");
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_iht']").find("option[value='10']").prop("selected", true);
                            return 0;
                          }
                          $('#score_for_intake_criterion_val').val(0)
                          $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_iht']").find("option[value='0']").removeAttr("disabled");
                          $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_iht']").find("option[value='0']").prop("selected", true);
                          return 0;

                        } else if (category === 'Medical Assistant Training School (MATS)') {
                          if (avgIc > 70) {
                            $('#score_for_intake_criterion_val').val(15)
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_mats']").find("option[value='15']").removeAttr("disabled");
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_mats']").find("option[value='15']").prop("selected", true);
                            return 0;
                          }
                          if (71 > avgIc && avgIc > 60) {
                            $('#score_for_intake_criterion_val').val(13)
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_mats']").find("option[value='13']").removeAttr("disabled");
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_mats']").find("option[value='13']").prop("selected", true);
                            return 0;
                          }
                          if (61 > avgIc && avgIc > 49) {
                            $('#score_for_intake_criterion_val').val(10)
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_mats']").find("option[value='10']").removeAttr("disabled");
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_mats']").find("option[value='10']").prop("selected", true);
                            return 0;
                          }
                          $('#score_for_intake_criterion_val').val(0)
                          $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_mats']").find("option[value='0']").removeAttr("disabled");
                          $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_mats']").find("option[value='0']").prop("selected", true);
                          return 0;
                        } else if (category === 'Nursing College/Institute (Diploma-level)') {
                          if (avgIc > 130) {
                            $('#score_for_intake_criterion_val').val(15)
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_diploma']").find("option[value='15']").removeAttr("disabled");
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_diploma']").find("option[value='15']").prop("selected", true);
                            return 0;
                          }
                          if (131 > avgIc && avgIc > 100) {
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_diploma']").find("option[value='13']").removeAttr("disabled");
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_diploma']").find("option[value='13']").prop("selected", true);
                            $('#score_for_intake_criterion_val').val(13)
                            return 0;
                          }
                          if (101 > avgIc && avgIc > 49) {
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_diploma']").find("option[value='10']").removeAttr("disabled");
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_diploma']").find("option[value='10']").prop("selected", true);
                            $('#score_for_intake_criterion_val').val(10)
                            return 0;
                          }
                          $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_diploma']").find("option[value='0']").removeAttr("disabled");
                          $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_diploma']").find("option[value='0']").prop("selected", true);
                          $('#score_for_intake_criterion_val').val(0)
                          return 0;
                        } else if (category === 'Govt. Technical School and College') {
                          if (avgIc > 250) {
                            $('#score_for_intake_criterion_val').val(15)
                            $("#score_for_intake_criterion > optgroup[id='technical_school_and_college']").find("option[value='15']").removeAttr("disabled");
                            $("#score_for_intake_criterion > optgroup[id='technical_school_and_college']").find("option[value='15']").prop("selected", true);
                            return 0;
                          }
                          if (251 > avgIc && avgIc > 200) {
                            $("#score_for_intake_criterion > optgroup[id='technical_school_and_college']").find("option[value='13']").removeAttr("disabled");
                            $("#score_for_intake_criterion > optgroup[id='technical_school_and_college']").find("option[value='13']").prop("selected", true);
                            $('#score_for_intake_criterion_val').val(13)
                            return 0;
                          }
                          if (201 > avgIc && avgIc > 150) {
                            $("#score_for_intake_criterion > optgroup[id='technical_school_and_college']").find("option[value='10']").removeAttr("disabled");
                            $("#score_for_intake_criterion > optgroup[id='technical_school_and_college']").find("option[value='10']").prop("selected", true);
                            $('#score_for_intake_criterion_val').val(10)
                            return 0;
                          }
                          $("#score_for_intake_criterion > optgroup[id='technical_school_and_college']").find("option[value='0']").removeAttr("disabled");
                          $("#score_for_intake_criterion > optgroup[id='technical_school_and_college']").find("option[value='0']").prop("selected", true);
                          $('#score_for_intake_criterion_val').val(0)
                          return 0;
                        } else {
                          if (avgIc > 350) {
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_polytechnic']").find("option[value='15']").removeAttr("disabled");
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_polytechnic']").find("option[value='15']").prop("selected", true);
                            $('#score_for_intake_criterion_val').val(15)
                            return 0;
                          }
                          if (351 > avgIc && avgIc > 300) {
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_polytechnic']").find("option[value='13']").removeAttr("disabled");
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_polytechnic']").find("option[value='13']").prop("selected", true);
                            $('#score_for_intake_criterion_val').val(13)
                            return 0;
                          }
                          if (301 > avgIc && avgIc > 199 && $('#institute_type').val() != 'private') {
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_polytechnic']").find("option[id='10-g']").removeAttr("disabled");
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_polytechnic']").find("option[id='10-g']").prop("selected", true);
                            $('#score_for_intake_criterion_val').val(10)
                            return 0;
                          }
                          if (301 > avgIc && avgIc > 250 && $('#institute_type').val() == 'private') {
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_polytechnic']").find("option[id='10-p']").removeAttr("disabled");
                            $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_polytechnic']").find("option[id='10-p']").prop("selected", true);
                            $('#score_for_intake_criterion_val').val(10)
                            return 0;
                          }
                          $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_polytechnic']").find("option[value='0']").removeAttr("disabled");
                          $("#score_for_intake_criterion > optgroup[id='score_for_intake_criterion_polytechnic']").find("option[value='0']").prop("selected", true);
                          $('#score_for_intake_criterion_val').val(0)
                          return 0;
                        }
                        $('#score_for_intake_criterion_val').val(0)
                      }

                      setScoreForIntakeCriterion()

                      function checkIC(year) {
                        const sic = $('#student_intake_capacity_' + year)
                        const nas = $('#no_of_actual_student_' + year)
                        if (Number(sic.val()) < Number(nas.val())) {
                          Swal.fire({
                            title: 'No. of Actual Student could not be greater than Student Intake Capacity.',
                            icon: 'warning',
                          })
                          nas.addClass('is-invalid')
                          return 0;
                        }
                        nas.removeClass('is-invalid')
                      }
                    })
                  </script>
                </div>

                <div class="row mt-4">
                  <div class="col-md-12 bordered">
                    <div class="row bordered-p">
                      <div class="col-md-12">
                        <h6 class="text-center">Number of Students (form fill-up) for exam</h6>
                      </div>
                      <div class="col-md-3">
                        <label for="no_students_form_fill_up_2022">2022 <span class="text-danger">*</span></label>
                        <input type="number" name="no_students_form_fill_up_2022"
                               value="{{ old("no_students_form_fill_up_2022", $form ? $form->no_students_form_fill_up_2022 : '') }}" id="no_students_form_fill_up_2022"
                               class="form-control @error("no_students_form_fill_up_2022") is-invalid @enderror"
                               placeholder="0">
                        @error("no_students_form_fill_up_2022")
                        <strong class="text-danger">{{ $errors->first("no_students_form_fill_up_2022") }}</strong>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="no_students_form_fill_up_2021">2021 <span class="text-danger">*</span></label>
                        <input type="number" name="no_students_form_fill_up_2021"
                               value="{{ old("no_students_form_fill_up_2021", $form ? $form->no_students_form_fill_up_2021 : '') }}" id="no_students_form_fill_up_2021"
                               class="form-control @error("no_students_form_fill_up_2021") is-invalid @enderror"
                               placeholder="0">
                        @error("no_students_form_fill_up_2021")
                        <strong class="text-danger">{{ $errors->first("no_students_form_fill_up_2021") }}</strong>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="no_students_form_fill_up_2020">2020 <span class="text-danger">*</span></label>
                        <input type="number" name="no_students_form_fill_up_2020"
                               value="{{ old("no_students_form_fill_up_2020", $form ? $form->no_students_form_fill_up_2020 : '') }}" id="no_students_form_fill_up_2020"
                               class="form-control @error("no_students_form_fill_up_2020") is-invalid @enderror"
                               placeholder="0">
                        @error("no_students_form_fill_up_2020")
                        <strong class="text-danger">{{ $errors->first("no_students_form_fill_up_2020") }}</strong>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="no_students_form_fill_up_2019">2019 <span class="text-danger">*</span></label>
                        <input type="number" name="no_students_form_fill_up_2019"
                               value="{{ old("no_students_form_fill_up_2019", $form ? $form->no_students_form_fill_up_2019 : '') }}" id="no_students_form_fill_up_2019"
                               class="form-control @error("no_students_form_fill_up_2019") is-invalid @enderror"
                               placeholder="0">
                        @error("no_students_form_fill_up_2019")
                        <strong class="text-danger">{{ $errors->first("no_students_form_fill_up_2019") }}</strong>
                        @enderror
                      </div>
                    </div>

                    <div class="row bordered-p total-pass">
                      <div class="col-md-12">
                        <h6 class="text-center">Number of Students (Passed) in exam</h6>
                      </div>
                      <div class="col-md-3">
                        <label for="no_students_passed_2022">2022 <span class="text-danger">*</span></label>
                        <input type="number" name="no_students_passed_2022" value="{{ old("no_students_passed_2022", $form ? $form->no_students_passed_2022 : '') }}"
                               id="no_students_passed_2022"
                               class="form-control no_students_passed @error("no_students_passed_2022") is-invalid @enderror"
                               placeholder="0">
                        @error("no_students_passed_2022")
                        <strong class="text-danger">{{ $errors->first("no_students_passed_2022") }}</strong>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="no_students_passed_2021">2021 <span class="text-danger">*</span></label>
                        <input type="number" name="no_students_passed_2021" value="{{ old("no_students_passed_2021", $form ? $form->no_students_passed_2021 : '') }}"
                               id="no_students_passed_2021"
                               class="form-control no_students_passed @error("no_students_passed_2021") is-invalid @enderror"
                               placeholder="0">
                        @error("no_students_passed_2021")
                        <strong class="text-danger">{{ $errors->first("no_students_passed_2021") }}</strong>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="no_students_passed_2020">2020 <span class="text-danger">*</span></label>
                        <input type="number" name="no_students_passed_2020" value="{{ old("no_students_passed_2020", $form ? $form->no_students_passed_2020 : '') }}"
                               id="no_students_passed_2020"
                               class="form-control no_students_passed @error("no_students_passed_2020") is-invalid @enderror"
                               placeholder="0">
                        @error("no_students_passed_2020")
                        <strong class="text-danger">{{ $errors->first("no_students_passed_2020") }}</strong>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="no_students_passed_2019">2019 <span class="text-danger">*</span></label>
                        <input type="number" name="no_students_passed_2019" value="{{ old("no_students_passed_2019", $form ? $form->no_students_passed_2019 : '') }}"
                               id="no_students_passed_2019"
                               class="form-control @error("no_students_passed_2019") is-invalid @enderror"
                               placeholder="0">
                        @error("no_students_passed_2019")
                        <strong class="text-danger">{{ $errors->first("no_students_passed_2019") }}</strong>
                        @enderror
                      </div>
                    </div>

                    <div class="row">

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="average_passed_students_last_3_year" title="(Passed (Y1+Y2+Y3)/3 )">AVG passed
                            students last three years</label>
                          <input type="number" name="average_passed_students_last_3_year"
                                 value="{{ old("average_passed_students_last_3_year") }}"
                                 id="average_passed_students_last_3_year" readonly
                                 class="form-control @error("average_passed_students_last_3_year") is-invalid @enderror"
                                 placeholder="0">
                          @error("average_passed_students_last_3_year")
                          <strong class="text-danger">{{ $errors->first("average_passed_students_last_3_year") }}</strong>
                          @enderror
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="average_passed_rate_last_3_year"
                                 title="(in % {Passed in (Y1+Y2+Y3)/Form Fill Up in (Y1+Y2+Y3)})">Average passed rates
                            last three years <span
                              class="text-danger">*</span></label>
                          <input type="number" name="average_passed_rate_last_3_year" readonly
                                 value="{{ old("average_passed_rate_last_3_year") }}" id="average_passed_rate_last_3_year"
                                 class="form-control @error("average_passed_rate_last_3_year") is-invalid @enderror"
                                 placeholder="0">
                          @error("average_passed_rate_last_3_year")
                          <strong class="text-danger">{{ $errors->first("average_passed_rate_last_3_year") }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="score_of_students_passed_rates">Score for (Students passed rates) <span
                              class="text-danger">*</span></label>
                          <select name="score_of_students_passed_rates" id="score_of_students_passed_rates" readonly
                                  class="form-control @error("score_of_students_passed_rates") is-invalid @enderror">
                            <option value="">Choose a type</option>
                            <optgroup label="Average passed rates last three years in Board assessment examination">
                              <option value="15">If student passed rate is above 60%</option>
                              <option value="10">If student passed rate is 51%-60%</option>
                              <option value="8">If student passed rate is 41%-50%</option>
                              <option value="5">If student passed rate is below 40%</option>
                            </optgroup>
                          </select>
                          @error("score_of_students_passed_rates")
                          <strong class="text-danger">{{ $errors->first("score_of_students_passed_rates") }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-3">
                        <label for="score_of_students_passed_rates_val">Score Value</label>
                        <input type="number" name="score_of_students_passed_rates_val" disabled
                               value="{{ old("score_of_students_passed_rates_val", 0) }}" id="score_of_students_passed_rates_val"
                               class="form-control @error("score_of_students_passed_rates_val") is-invalid @enderror"
                               placeholder="0">
                      </div>
                      <script>
                        $(document).ready(function () {
                          const form_fill_up_2022 = $('#no_students_form_fill_up_2022')
                          const form_fill_up_2021 = $('#no_students_form_fill_up_2021')
                          const form_fill_up_2020 = $('#no_students_form_fill_up_2020')
                          const form_fill_up_2019 = $('#no_students_form_fill_up_2019')
                          const passed_2022 = $('#no_students_passed_2022')
                          const passed_2021 = $('#no_students_passed_2021')
                          const passed_2020 = $('#no_students_passed_2020')
                          const passed_2019 = $('#no_students_passed_2019')

                          passed_2022.change(function () {
                            checkIC(2022)
                            autoFillStudentScore()
                            form_fill_up_2019.attr('readonly', true)
                            passed_2019.attr('readonly', true)
                          })

                          passed_2021.change(function () {
                            checkIC(2021)
                            autoFillStudentScore()
                          })

                          passed_2020.change(function () {
                            checkIC(2020)
                            autoFillStudentScore()
                          })

                          passed_2019.change(function () {
                            checkIC(2019)
                            autoFillStudentScore()
                            form_fill_up_2022.attr('readonly', true)
                            passed_2022.attr('readonly', true)
                          })

                          form_fill_up_2022.change(function () {
                            form_fill_up_2019.attr('readonly', true)
                            passed_2019.attr('readonly', true)
                            checkIC(2022)
                            autoFillStudentScore()
                          })
                          form_fill_up_2021.change(function () {
                            checkIC(2021)
                            autoFillStudentScore()
                          })
                          form_fill_up_2020.change(function () {
                            checkIC(2020)
                            autoFillStudentScore()
                          })
                          form_fill_up_2019.change(function () {
                            form_fill_up_2022.attr('readonly', true)
                            passed_2022.attr('readonly', true)
                            checkIC(2019)
                            autoFillStudentScore()
                          })

                          function checkIC(year) {
                            const sic = $('#no_students_form_fill_up_' + year)
                            const nas = $('#no_students_passed_' + year)
                            if (Number(sic.val()) < Number(nas.val())) {
                              Swal.fire({
                                title: 'Form fill up student will be greater than passed student.',
                                icon: 'warning',
                              })
                              nas.addClass('is-invalid')
                              return 0;
                            }
                            nas.removeClass('is-invalid')
                          }

                          autoFillStudentScore()

                          function autoFillStudentScore() {
                            const nsVal22 = form_fill_up_2022.val()
                            const nsVal21 = form_fill_up_2021.val()
                            const nsVal20 = form_fill_up_2020.val()
                            const nsVal19 = form_fill_up_2019.val()

                            const pVal22 = passed_2022.val()
                            const pVal21 = passed_2021.val()
                            const pVal20 = passed_2020.val()
                            const pVal19 = passed_2019.val()

                            let nsCount = 0;
                            let totalNs = 0;
                            let totalP = 0;
                            if (nsVal22 > 0) {
                              totalNs = totalNs + Number(nsVal22);
                              totalP = totalP + Number(pVal22);
                              nsCount = nsCount + 1;
                            }
                            if (nsVal21 > 0) {
                              totalNs = totalNs + Number(nsVal21);
                              totalP = totalP + Number(pVal21);
                              nsCount = nsCount + 1;
                            }
                            if (nsVal20 > 0) {
                              totalNs = totalNs + Number(nsVal20);
                              totalP = totalP + Number(pVal20);
                              nsCount = nsCount + 1;
                            }
                            if (nsVal19 > 0) {
                              totalNs = totalNs + Number(nsVal19);
                              totalP = totalP + Number(pVal19);
                              nsCount = nsCount + 1;
                            }

                            const avgPass = (totalP / 3);
                            const nsPass = (totalNs / 3);

                            $('#average_passed_students_last_3_year').val(avgPass)
                            const pp = ((avgPass * 100) / nsPass);
                            // const pp = ((avgPass * 100) / 3);
                            const final = Math.round(pp);
                            $('#average_passed_rate_last_3_year').val(final)

                            $("#score_of_students_passed_rates").find('option').attr('disabled', 'true');
                            if (final > 60) {
                              $('#score_of_students_passed_rates_val').val(15)
                              $('#score_of_students_passed_rates').find('option[value="15"]').removeAttr("disabled");
                              $('#score_of_students_passed_rates').find('option[value="15"]').prop("selected", true);
                            } else if (60 >= final && final >= 51) {
                              $('#score_of_students_passed_rates_val').val(10)
                              $('#score_of_students_passed_rates').find('option[value="10"]').removeAttr("disabled");
                              $('#score_of_students_passed_rates').find('option[value="10"]').prop("selected", true);
                            } else if (50 >= final && final >= 40) {
                              $('#score_of_students_passed_rates_val').val(8)
                              $('#score_of_students_passed_rates').find('option[value="8"]').removeAttr("disabled");
                              $('#score_of_students_passed_rates').find('option[value="8"]').prop("selected", true);
                            } else {
                              $('#score_of_students_passed_rates_val').val(5)
                              $('#score_of_students_passed_rates').find('option[value="5"]').removeAttr("disabled");
                              $('#score_of_students_passed_rates').find('option[value="5"]').prop("selected", true);
                            }
                          }
                        })
                      </script>
                    </div>
                  </div>
                </div>

                <div class="row mt-4 mb-2">
                  <div class="col-md-12 bordered">
                    <div class="row bordered-p">
                      <div class="col-md-12">
                        <h6 class="text-center">Total number of students</h6>
                      </div>
                      <div class="col-md-3">
                        <label for="total_students_2022">2022 <span class="text-danger">*</span></label>
                        <input type="number" name="total_students_2022" value="{{ old("total_students_2022", $form ? $form->total_students_2022 : '') }}"
                               id="total_students_2022"
                               class="form-control total_students  @error("total_students_2022") is-invalid @enderror"
                               placeholder="0">
                        @error("total_students_2022")
                        <strong class="text-danger">{{ $errors->first("total_students_2022") }}</strong>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="total_students_2021">2021 <span class="text-danger">*</span></label>
                        <input type="number" name="total_students_2021" value="{{ old("total_students_2021", $form ? $form->total_students_2021 : '') }}"
                               id="total_students_2021"
                               class="form-control total_students @error("total_students_2021") is-invalid @enderror"
                               placeholder="0">
                        @error("total_students_2021")
                        <strong class="text-danger">{{ $errors->first("total_students_2021") }}</strong>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="total_students_2020">2020 <span class="text-danger">*</span></label>
                        <input type="number" name="total_students_2020" value="{{ old("total_students_2020", $form ? $form->total_students_2020 : '') }}"
                               id="total_students_2020"
                               class="form-control total_students @error("total_students_2020") is-invalid @enderror"
                               placeholder="0">
                        @error("total_students_2020")
                        <strong class="text-danger">{{ $errors->first("total_students_2020") }}</strong>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="total_students_2019">2019 <span class="text-danger">*</span></label>
                        <input type="number" name="total_students_2019" value="{{ old("total_students_2019", $form ? $form->total_students_2019 : '') }}"
                               id="total_students_2019"
                               class="form-control total_students @error("total_students_2019") is-invalid @enderror"
                               placeholder="0">
                        @error("total_students_2019")
                        <strong class="text-danger">{{ $errors->first("total_students_2019") }}</strong>
                        @enderror
                      </div>
                    </div>

                    <div class="row bordered-p">
                      <div class="col-md-12">
                        <h6 class="text-center">Total number of female students</h6>
                      </div>
                      <div class="col-md-3">
                        <label for="total_female_students_2022">2022 <span class="text-danger">*</span></label>
                        <input type="number" name="total_female_students_2022"
                               value="{{ old("total_female_students_2022", $form ? $form->total_female_students_2022 : '') }}" id="total_female_students_2022"
                               class="form-control total_students  @error("total_female_students_2022") is-invalid @enderror"
                               placeholder="0">
                        @error("total_female_students_2022")
                        <strong class="text-danger">{{ $errors->first("total_female_students_2022") }}</strong>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="total_female_students_2021">2021 <span class="text-danger">*</span></label>
                        <input type="number" name="total_female_students_2021"
                               value="{{ old("total_female_students_2021", $form ? $form->total_female_students_2021 : '') }}" id="total_female_students_2021"
                               class="form-control total_students @error("total_female_students_2021") is-invalid @enderror"
                               placeholder="0">
                        @error("total_female_students_2021")
                        <strong class="text-danger">{{ $errors->first("total_female_students_2021") }}</strong>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="total_female_students_2020">2020 <span class="text-danger">*</span></label>
                        <input type="number" name="total_female_students_2020"
                               value="{{ old("total_female_students_2020", $form ? $form->total_female_students_2020 : '') }}" id="total_female_students_2020"
                               class="form-control total_students @error("total_female_students_2020") is-invalid @enderror"
                               placeholder="0">
                        @error("total_female_students_2020")
                        <strong class="text-danger">{{ $errors->first("total_female_students_2020") }}</strong>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="total_female_students_2019">2019 <span class="text-danger">*</span></label>
                        <input type="number" name="total_female_students_2019"
                               value="{{ old("total_female_students_2019", $form ? $form->total_female_students_2019 : '') }}" id="total_female_students_2019"
                               class="form-control total_students @error("total_female_students_2019") is-invalid @enderror"
                               placeholder="0">
                        @error("total_female_students_2019")
                        <strong class="text-danger">{{ $errors->first("total_female_students_2019") }}</strong>
                        @enderror
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="avg_student_of_last_3_year">Average total students last three year <span
                              class="text-danger">*</span></label>
                          <input type="number" name="avg_student_of_last_3_year" readonly
                                 value="{{ old("avg_student_of_last_3_year") }}" id="avg_student_of_last_3_year"
                                 class="form-control @error("avg_student_of_last_3_year") is-invalid @enderror"
                                 placeholder="0">
                          @error("avg_student_of_last_3_year")
                          <strong class="text-danger">{{ $errors->first("avg_student_of_last_3_year") }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="avg_female_student_of_last_3_year">Average total female students last three years
                            <span class="text-danger">*</span></label>
                          <input type="number" name="avg_female_student_of_last_3_year" readonly
                                 value="{{ old("avg_female_student_of_last_3_year") }}"
                                 id="avg_female_student_of_last_3_year"
                                 class="form-control @error("avg_female_student_of_last_3_year") is-invalid @enderror"
                                 placeholder="0">
                          @error("avg_female_student_of_last_3_year")
                          <strong class="text-danger">{{ $errors->first("avg_female_student_of_last_3_year") }}</strong>
                          @enderror
                        </div>
                      </div>

                      <div class="col-md-8">
                        <div class="form-group">
                          <label for="score_of_student_population">Score of Student Population <span
                              class="text-danger">*</span></label>
                          <select name="score_of_student_population" id="score_of_student_population" readonly
                                  class="form-control @error("score_of_student_population") is-invalid @enderror">
                            <option value="">Choose a population</option>
                            <optgroup label="Polytechnic (Govt)" id="score_of_student_population_polytechnic_govt">
                              <option value="15">If the total number of students in the last 3 years is above 800</option>
                              <option value="10">If the total number of students in the last 3 years is 701-800</option>
                              <option value="5">If the total number of students in the last 3 years is 600-700</option>
                              <option value="0">If the total number of students in the last 3 years is less than 600</option>
                            </optgroup>
                            <optgroup label="Polytechnic (Private)" id="score_of_student_population_polytechnic_private">
                              <option value="15">If the total number of students in the last 3 years is above 850</option>
                              <option value="10">If the total number of students in the last 3 years is 701-850</option>
                              <option value="5">If the total number of students in the last 3 years is 500-700</option>
                              <option value="0">If the total number of students in the last 3 years is less than 500</option>
                            </optgroup>
                            <optgroup label="Technical school and college" id="score_of_student_population_tsc">
                              <option value="15">If the total number of students in the last 3 years is above 550</option>
                              <option value="10">If the total number of students in the last 3 years is 501-550</option>
                              <option value="5">If the total number of students in the last 3 years is 450-500</option>
                              <option value="0">If the total number of students in the last 3 years is less than 450</option>
                            </optgroup>
                            <optgroup
                              label="Institute of Marine Technology (IMT), Medical Assistant Training School (MATS), Nursing College/Institute (Diploma-level)"
                              id="score_of_student_population_all">
                              <option value="15">If the total number of students in the last 3 years is
                                above 200
                              </option>
                              <option value="10">If the total number of students in the last 3 years is
                                151-200
                              </option>
                              <option value="5">If the total number of students in the last 3 years is
                                100-150
                              </option>
                              <option value="0">If the total number of students in the last 3 years is
                                less than 100
                              </option>
                            </optgroup>
                            <optgroup label="Institute of Health Technology (IHT)" id="score_of_student_population_iht">
                              <option value="15">If the total number of students in the last 3 years is
                                above 400
                              </option>
                              <option value="10">If the total number of students in the last 3 years is
                                301-400
                              </option>
                              <option value="5">If the total number of students in the last 3 years is
                                200-300
                              </option>
                              <option value="0">If the total number of students in the last 3 years is
                                less than 200
                              </option>
                            </optgroup>
                          </select>
                          @error("score_of_student_population")
                          <strong class="text-danger">{{ $errors->first("score_of_student_population") }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <label for="score_of_student_population_val">Score Value</label>
                        <input type="number" name="score_of_student_population_val" disabled
                               value="{{ old("score_of_student_population_val", 0) }}" id="score_of_student_population_val"
                               class="form-control @error("score_of_student_population_val") is-invalid @enderror"
                               placeholder="0">
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <label for="score_of_female_student_population">Score of Female student <span
                              class="text-danger">*</span></label>
                          <select name="score_of_female_student_population" id="score_of_female_student_population" readonly
                                  class="form-control @error("score_of_female_student_population") is-invalid @enderror">
                            <option value="">Choose a option</option>
                            <optgroup label="Female student average(%) last three years in institute" id="score_of_female_student_population_opt">
                              <option value="5">If average female student rate is above 40%</option>
                              <option value="4">If average female student rate is 31%-39%</option>
                              <option value="3">If average female student rate is 15%-30%</option>
                              <option value="2">If average female student rate is below 15%</option>
                            </optgroup>
                          </select>
                          @error("score_of_female_student_population")
                          <strong class="text-danger">{{ $errors->first("score_of_female_student_population") }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <label for="score_of_female_student_population_val">Score Value</label>
                        <input type="number" name="score_of_female_student_population_val" readonly
                               value="{{ old("score_of_female_student_population_val", 0) }}" id="score_of_female_student_population_val"
                               class="form-control @error("score_of_female_student_population_val") is-invalid @enderror"
                               placeholder="0">
                      </div>

                      <script>
                        $(document).ready(function () {
                          const total_2022 = $('#total_students_2022')
                          const total_2021 = $('#total_students_2021')
                          const total_2020 = $('#total_students_2020')
                          const total_2019 = $('#total_students_2019')
                          const female_2022 = $('#total_female_students_2022')
                          const female_2021 = $('#total_female_students_2021')
                          const female_2020 = $('#total_female_students_2020')
                          const female_2019 = $('#total_female_students_2019')

                          autoFillStudentAndFemaleScore()
                          female_2022.change(function () {
                            checkFemale(2022)
                            autoFillStudentAndFemaleScore()
                            total_2019.attr('readonly', true)
                            female_2019.attr('readonly', true)
                          })
                          female_2021.change(function () {
                            checkFemale(2021)
                            autoFillStudentAndFemaleScore()
                          })
                          female_2020.change(function () {
                            checkFemale(2020)
                            autoFillStudentAndFemaleScore()
                          })
                          female_2019.change(function () {
                            checkFemale(2019)
                            autoFillStudentAndFemaleScore()
                            total_2022.attr('readonly', true)
                            female_2022.attr('readonly', true)
                          })
                          total_2019.change(function () {
                            total_2022.attr('readonly', true)
                            female_2022.attr('readonly', true)
                            checkFemale(2019)
                            autoFillStudentAndFemaleScore()
                          })
                          total_2020.change(function () {
                            checkFemale(2020)
                            autoFillStudentAndFemaleScore()
                          })
                          total_2021.change(function () {
                            checkFemale(2021)
                            autoFillStudentAndFemaleScore()
                          })
                          total_2022.change(function () {
                            total_2019.attr('readonly', true)
                            female_2019.attr('readonly', true)
                            checkFemale(2022)
                            autoFillStudentAndFemaleScore()
                          })

                          function checkFemale(year) {
                            const sic = $('#total_students_' + year)
                            const nas = $('#total_female_students_' + year)
                            if (Number(sic.val()) < Number(nas.val())) {
                              Swal.fire({
                                title: 'Female student will be less than total student.',
                                icon: 'warning',
                              })
                              nas.addClass('is-invalid')
                              return 0;
                            }
                            nas.removeClass('is-invalid')
                          }


                          function autoFillStudentAndFemaleScore() {
                            const totalVal22 = total_2022.val()
                            const totalVal21 = total_2021.val()
                            const totalVal20 = total_2020.val()
                            const totalVal19 = total_2019.val()

                            const femalVal22 = female_2022.val()
                            const femalVal21 = female_2021.val()
                            const femalVal20 = female_2020.val()
                            const femalVal19 = female_2019.val()

                            let totalCount = 0;
                            let totalVal = 0;
                            let totalFemal = 0;
                            if (totalVal22 > 0) {
                              totalVal = totalVal + Number(totalVal22);
                              totalFemal = totalFemal + Number(femalVal22);
                              totalCount = totalCount + 1;
                            }
                            if (totalVal21 > 0) {
                              totalVal = totalVal + Number(totalVal21);
                              totalFemal = totalFemal + Number(femalVal21);
                              totalCount = totalCount + 1;
                            }
                            if (totalVal20 > 0) {
                              totalVal = totalVal + Number(totalVal20);
                              totalFemal = totalFemal + Number(femalVal20);
                              totalCount = totalCount + 1;
                            }
                            if (totalVal19 > 0) {
                              totalVal = totalVal + Number(totalVal19);
                              totalFemal = totalFemal + Number(femalVal19);
                              totalCount = totalCount + 1;
                            }

                            const avgFemale = (totalFemal / totalCount);
                            const totalAvg = (totalVal / totalCount);
                            const totalAvgt = (totalVal / 4);
                            $('#avg_student_of_last_3_year').val(totalAvg.toFixed(2))
                            const pp = ((avgFemale * 100) / totalAvg);
                            const final = Math.round(pp);
                            $('#avg_female_student_of_last_3_year').val(avgFemale.toFixed(2))

                            $("#score_of_student_population").find('option[selected="selected"]').removeAttr('selected');
                            $("#score_of_student_population").find('option').attr('disabled', 'true');

                            const category = $('#institute_category').val();
                            if (category === 'Govt. Polytechnic Institute') {
                              if (totalVal > 800) {
                                $('#score_of_student_population_val').val(15)
                                $("#score_of_student_population > optgroup[id='score_of_student_population_polytechnic_govt']").find('option[value="15"]').removeAttr("disabled");
                                $("#score_of_student_population > optgroup[id='score_of_student_population_polytechnic_govt']").find('option[value="15"]').prop("selected", true);
                              } else if (800 >= totalVal && totalVal > 700) {
                                $('#score_of_student_population_val').val(10)
                                $("#score_of_student_population > optgroup[id='score_of_student_population_polytechnic_govt']").find('option[value="10"]').removeAttr("disabled");
                                $("#score_of_student_population > optgroup[id='score_of_student_population_polytechnic_govt']").find('option[value="10"]').prop("selected", true);
                              } else if (700 >= totalVal && totalVal >= 600) {
                                $('#score_of_student_population_val').val(5)
                                $("#score_of_student_population > optgroup[id='score_of_student_population_polytechnic_govt']").find('option[value="5"]').removeAttr("disabled");
                                $("#score_of_student_population > optgroup[id='score_of_student_population_polytechnic_govt']").find('option[value="5"]').prop("selected", true);
                              } else {
                                $('#score_of_student_population_val').val(0)
                                $("#score_of_student_population > optgroup[id='score_of_student_population_polytechnic_govt']").find('option[value="0"]').removeAttr("disabled");
                                $("#score_of_student_population > optgroup[id='score_of_student_population_polytechnic_govt']").find('option[value="0"]').prop("selected", true);
                              }
                            } else if (category === 'Private Polytechnic Institute') {
                              if (totalVal > 850) {
                                $('#score_of_student_population_val').val(15)
                                $("#score_of_student_population > optgroup[id='score_of_student_population_polytechnic_private']").find('option[value="15"]').removeAttr("disabled");
                                $("#score_of_student_population > optgroup[id='score_of_student_population_polytechnic_private']").find('option[value="15"]').prop("selected", true);
                              } else if (850 >= totalVal && totalVal > 700) {
                                $('#score_of_student_population_val').val(10)
                                $("#score_of_student_population > optgroup[id='score_of_student_population_polytechnic_private']").find('option[value="10"]').removeAttr("disabled");
                                $("#score_of_student_population > optgroup[id='score_of_student_population_polytechnic_private']").find('option[value="10"]').prop("selected", true);
                              } else if (500 >= totalVal && totalVal >= 500) {
                                $('#score_of_student_population_val').val(5)
                                $("#score_of_student_population > optgroup[id='score_of_student_population_polytechnic_private']").find('option[value="5"]').removeAttr("disabled");
                                $("#score_of_student_population > optgroup[id='score_of_student_population_polytechnic_private']").find('option[value="5"]').prop("selected", true);
                              } else {
                                $('#score_of_student_population_val').val(0)
                                $("#score_of_student_population > optgroup[id='score_of_student_population_polytechnic_private']").find('option[value="0"]').removeAttr("disabled");
                                $("#score_of_student_population > optgroup[id='score_of_student_population_polytechnic_private']").find('option[value="0"]').prop("selected", true);
                              }
                            } else if (category === 'Govt. Technical School and College') {
                              if (totalVal > 550) {
                                $('#score_of_student_population_val').val(15)
                                $("#score_of_student_population > optgroup[id='score_of_student_population_tsc']").find('option[value="15"]').removeAttr("disabled");
                                $("#score_of_student_population > optgroup[id='score_of_student_population_tsc']").find('option[value="15"]').prop("selected", true);
                              } else if (550 >= totalVal && totalVal > 500) {
                                $('#score_of_student_population_val').val(10)
                                $("#score_of_student_population > optgroup[id='score_of_student_population_tsc']").find('option[value="10"]').removeAttr("disabled");
                                $("#score_of_student_population > optgroup[id='score_of_student_population_tsc']").find('option[value="10"]').prop("selected", true);
                              } else if (500 >= totalVal && totalVal >= 450) {
                                $('#score_of_student_population_val').val(5)
                                $("#score_of_student_population > optgroup[id='score_of_student_population_tsc']").find('option[value="5"]').removeAttr("disabled");
                                $("#score_of_student_population > optgroup[id='score_of_student_population_tsc']").find('option[value="5"]').prop("selected", true);
                              } else {
                                $('#score_of_student_population_val').val(0)
                                $("#score_of_student_population > optgroup[id='score_of_student_population_tsc']").find('option[value="0"]').removeAttr("disabled");
                                $("#score_of_student_population > optgroup[id='score_of_student_population_tsc']").find('option[value="0"]').prop("selected", true);
                              }
                            } else if (category === 'Institute of Health Technology (IHT)') {
                              if (totalVal > 400) {
                                $('#score_of_student_population_val').val(15)
                                $("#score_of_student_population > optgroup[id='score_of_student_population_iht']").find('option[value="15"]').removeAttr("disabled");
                                $("#score_of_student_population > optgroup[id='score_of_student_population_iht']").find('option[value="15"]').prop("selected", true);
                              } else if (400 >= totalVal && totalVal > 300) {
                                $('#score_of_student_population_val').val(10)
                                $("#score_of_student_population > optgroup[id='score_of_student_population_iht']").find('option[value="10"]').removeAttr("disabled");
                                $("#score_of_student_population > optgroup[id='score_of_student_population_iht']").find('option[value="10"]').prop("selected", true);
                              } else if (300 >= totalVal && totalVal >= 200) {
                                $('#score_of_student_population_val').val(5)
                                $("#score_of_student_population > optgroup[id='score_of_student_population_iht']").find('option[value="5"]').removeAttr("disabled");
                                $("#score_of_student_population > optgroup[id='score_of_student_population_iht']").find('option[value="5"]').prop("selected", true);
                              } else {
                                $('#score_of_student_population_val').val(0)
                                $("#score_of_student_population > optgroup[id='score_of_student_population_iht']").find('option[value="0"]').removeAttr("disabled");
                                $("#score_of_student_population > optgroup[id='score_of_student_population_iht']").find('option[value="0"]').prop("selected", true);
                              }
                            } else {
                              if (totalVal > 200) {
                                $('#score_of_student_population_val').val(15)
                                $("#score_of_student_population > optgroup[id='score_of_student_population_all']").find('option[value="15"]').removeAttr("disabled");
                                $("#score_of_student_population > optgroup[id='score_of_student_population_all']").find('option[value="15"]').prop("selected", true);
                              } else if (200 >= totalVal && totalVal > 150) {
                                $('#score_of_student_population_val').val(10)
                                $("#score_of_student_population > optgroup[id='score_of_student_population_all']").find('option[value="10"]').removeAttr("disabled");
                                $("#score_of_student_population > optgroup[id='score_of_student_population_all']").find('option[value="10"]').prop("selected", true);
                              } else if (150 >= totalVal && totalVal >= 100) {
                                $('#score_of_student_population_val').val(5)
                                $("#score_of_student_population > optgroup[id='score_of_student_population_all']").find('option[value="5"]').removeAttr("disabled");
                                $("#score_of_student_population > optgroup[id='score_of_student_population_all']").find('option[value="5"]').prop("selected", true);
                              } else {
                                $('#score_of_student_population_val').val(0)
                                $("#score_of_student_population > optgroup[id='score_of_student_population_all']").find('option[value="0"]').removeAttr("disabled");
                                $("#score_of_student_population > optgroup[id='score_of_student_population_all']").find('option[value="0"]').prop("selected", true);
                              }
                            }


                            $("#score_of_female_student_population").find('option[selected="selected"]').removeAttr('selected');
                            $("#score_of_female_student_population").find('option').attr('disabled', 'true');

                            if (final > 40) {
                              $("#score_of_female_student_population > optgroup[id='score_of_female_student_population_opt']").find('option[value="5"]').removeAttr("disabled");
                              $("#score_of_female_student_population > optgroup[id='score_of_female_student_population_opt']").find('option[value="5"]').prop("selected", true);
                              $("#score_of_female_student_population_val").val(5)
                            } else if (39 >= final && final > 30) {
                              $("#score_of_female_student_population > optgroup[id='score_of_female_student_population_opt']").find('option[value="4"]').removeAttr("disabled");
                              $("#score_of_female_student_population > optgroup[id='score_of_female_student_population_opt']").find('option[value="4"]').prop("selected", true);
                              $("#score_of_female_student_population_val").val(4)
                            } else if (30 >= final && final >= 15) {
                              $("#score_of_female_student_population > optgroup[id='score_of_female_student_population_opt']").find('option[value="3)"]').removeAttr("disabled");
                              $("#score_of_female_student_population > optgroup[id='score_of_female_student_population_opt']").find('option[value="3)"]').prop("selected", true);
                              $("#score_of_female_student_population_val").val(3)
                            } else {
                              $("#score_of_female_student_population > optgroup[id='score_of_female_student_population_opt']").find('option[value="2)"]').removeAttr("disabled");
                              $("#score_of_female_student_population > optgroup[id='score_of_female_student_population_opt']").find('option[value="2)"]').prop("selected", true);
                              $("#score_of_female_student_population_val").val(2)
                            }
                          }
                        })
                      </script>
                    </div>

                  </div>
                </div>

                <div class="row bordered-p mb-3">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="total_number_of_approved_teachers">Total Number of Approved Teachers <span
                              class="text-danger">*</span></label>
                          <input type="number" name="total_number_of_approved_teachers"
                                 value="{{ old("total_number_of_approved_teachers", $form ? $form->total_number_of_approved_teachers : '') }}"
                                 id="total_number_of_approved_teachers"
                                 class="form-control @error("total_number_of_approved_teachers") is-invalid @enderror"
                                 placeholder="0">
                          @error("total_number_of_approved_teachers")
                          <strong class="text-danger">{{ $errors->first("total_number_of_approved_teachers") }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="total_number_of_reguler_teachers">Total Number of Regular Teachers <span
                              class="text-danger">*</span></label>
                          <input type="number" name="total_number_of_reguler_teachers"
                                 value="{{ old("total_number_of_reguler_teachers", $form ? $form->total_number_of_reguler_teachers : '') }}"
                                 id="total_number_of_reguler_teachers"
                                 class="form-control @error("total_number_of_reguler_teachers") is-invalid @enderror"
                                 placeholder="0">
                          @error("total_number_of_reguler_teachers")
                          <strong class="text-danger">{{ $errors->first("total_number_of_reguler_teachers") }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="total_number_of_contractual_teachers">Total Number of Contractual Teachers <span
                              class="text-danger">*</span></label>
                          <input type="number" name="total_number_of_contractual_teachers"
                                 value="{{ old("total_number_of_contractual_teachers", $form ? $form->total_number_of_contractual_teachers : '') }}"
                                 id="total_number_of_contractual_teachers"
                                 class="form-control @error("total_number_of_contractual_teachers") is-invalid @enderror"
                                 placeholder="0">
                          @error("total_number_of_contractual_teachers")
                          <strong
                            class="text-danger">{{ $errors->first("total_number_of_contractual_teachers") }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="teacher_vacancy_ratio" title="">Teacher vacancy ratio <span
                              class="text-danger">*</span></label>
                          <input type="text" name="teacher_vacancy_ratio" value="{{ old("teacher_vacancy_ratio") }}"
                                 id="teacher_vacancy_ratio" readonly
                                 class="form-control @error("teacher_vacancy_ratio") is-invalid @enderror"
                                 placeholder="0">
                          @error("teacher_vacancy_ratio")
                          <strong class="text-danger">{{ $errors->first("teacher_vacancy_ratio") }}</strong>
                          @enderror
                        </div>
                      </div>
                      <script>
                        $(document).ready(function () {

                          const approved = $('#total_number_of_approved_teachers')
                          const reguler = $('#total_number_of_reguler_teachers')
                          const contractual = $('#total_number_of_contractual_teachers')

                          approved.change(function () {
                            vacancyRatio()
                          });

                          reguler.change(function () {
                            checkVacancyRatio()
                          });
                          checkVacancyRatio()
                          contractual.change(function () {
                            vacancyRatio()
                          });

                          function checkVacancyRatio() {
                            vacancyRatio()
                            const f22 = $('#total_students_2022')
                            const f21 = $('#total_students_2021')
                            const f20 = $('#total_students_2020')
                            const f19 = $('#total_students_2019')
                            const totalStudent = (Number(f22.val()) + Number(f21.val()) + Number(f20.val()) + Number(f19.val()));
                            const teacher = Number(reguler.val())
                            const ratio = (totalStudent / teacher);
                            if (ratio < 30) {
                              $('#score_for_student_teacher_ratio_val').val(10)
                              $('#score_for_student_teacher_ratio').val('10')
                            } else {
                              $('#score_for_student_teacher_ratio_val').val(2)
                              $('#score_for_student_teacher_ratio').val('2')
                            }
                          }

                          function vacancyRatio() {
                            // const ttNotRound = (Number(reguler.val()) + Number(contractual.val())) / Number(approved.val());
                            const ttNotRoundRatio = ((Number(reguler.val()) / Number(approved.val())) * 100);
                            const tt = (100 - ttNotRoundRatio.toFixed(2))
                            // console.log(ttNotRound)
                            $('#teacher_vacancy_ratio').val(tt + ' %')
                            // $('#teacher_vacancy_ratio').val('2.22 %')
                            if (tt < 10) {
                              $('#score_of_teacher_vacancy_ratio_val').val(10)
                              $('#score_of_teacher_vacancy_ratio').val('10')
                            } else if (15 >= tt && tt >= 10) {
                              $('#score_of_teacher_vacancy_ratio_val').val(8)
                              $('#score_of_teacher_vacancy_ratio').val('8')
                            } else if (20 >= tt && tt > 15) {
                              $('#score_of_teacher_vacancy_ratio_val').val(5)
                              $('#score_of_teacher_vacancy_ratio').val('5')
                            } else if (tt > 20) {
                              $('#score_of_teacher_vacancy_ratio_val').val(3)
                              $('#score_of_teacher_vacancy_ratio').val('3')
                            }
                          }
                        })
                      </script>
                    </div>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="score_of_teacher_vacancy_ratio">Score for Teacher vacancy ratio <span
                              class="text-danger">*</span></label>
                          <select name="score_of_teacher_vacancy_ratio" id="score_of_teacher_vacancy_ratio" readonly
                                  class="form-control @error("score_of_teacher_vacancy_ratio") is-invalid @enderror">
                            <option value="">Choose a type</option>
                            <option value="10">If teacher vacancy is less than 10%</option>
                            <option value="8">If teacher vacancy is 10%-15%</option>
                            <option value="5">If teacher vacancy is 15%-20%</option>
                            <option value="3">If teacher vacancy is > 20%</option>
                          </select>
                          @error("score_of_teacher_vacancy_ratio")
                          <strong class="text-danger">{{ $errors->first("score_of_teacher_vacancy_ratio") }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-3">
                        <label for="score_of_teacher_vacancy_ratio_val">Score Value</label>
                        <input type="number" name="score_of_teacher_vacancy_ratio_val" disabled
                               value="{{ old("score_of_teacher_vacancy_ratio_val", 0) }}" id="score_of_teacher_vacancy_ratio_val"
                               class="form-control @error("score_of_teacher_vacancy_ratio_val") is-invalid @enderror"
                               placeholder="0">
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="score_for_student_teacher_ratio">Score for Student Teacher Ratio <span
                              class="text-danger">*</span></label>
                          <select name="score_for_student_teacher_ratio" id="score_for_student_teacher_ratio" readonly
                                  class="form-control @error("score_for_student_teacher_ratio") is-invalid @enderror">
                            <option value="">Choose a type</option>
                            <option value="10">If STR less than 1:30</option>
                            <option value="2">If STR = 1:30 or more</option>
                          </select>
                          @error("score_for_student_teacher_ratio")
                          <strong class="text-danger">{{ $errors->first("score_for_student_teacher_ratio") }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-3">
                        <label for="score_for_student_teacher_ratio_val">Score Value</label>
                        <input type="number" name="score_for_student_teacher_ratio_val" disabled
                               value="{{ old("score_for_student_teacher_ratio_val", 0) }}" id="score_for_student_teacher_ratio_val"
                               class="form-control @error("score_for_student_teacher_ratio_val") is-invalid @enderror"
                               placeholder="0">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row bordered-p mb-3">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="no_of_technology_or_trade_courses">No of Technology/ Trade courses <span
                          class="text-danger">*</span></label>
                      <input type="number" name="no_of_technology_or_trade_courses"
                             value="{{ old("no_of_technology_or_trade_courses", $form ? $form->no_of_technology_or_trade_courses : '') }}"
                             id="no_of_technology_or_trade_courses"
                             class="form-control @error("no_of_technology_or_trade_courses") is-invalid @enderror"
                             placeholder="0">
                      @error("no_of_technology_or_trade_courses")
                      <strong class="text-danger">{{ $errors->first("no_of_technology_or_trade_courses") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="score_no_of_technology_or_trade_courses">Score on No of Technology/ Trade courses
                        <span class="text-danger">*</span></label>
                      <select name="score_no_of_technology_or_trade_courses" readonly=""
                              id="score_no_of_technology_or_trade_courses"
                              class="form-control @error("score_no_of_technology_or_trade_courses") is-invalid @enderror">
                        <option value="0">Choose a type</option>
                        <optgroup
                          label="Polytechnic ,Technical school and college, Institute of Health Technology (IHT)" id="score_no_of_technology_or_trade_courses_piht">
                          <option value="5">If courses more than 5</option>
                          <option value="4">If course no 3-5</option>
                          <option value="0">Otherwise 0</option>
                        </optgroup>
                        <optgroup
                          label="Institutes of Marine Technology (IMT), Nursing College/Institute (Diploma-level)" id="score_no_of_technology_or_trade_courses_mtd">
                          <option value="5">If courses no ≥ 2;</option>
                          <option value="4">If course no 1</option>
                          <option value="0">Otherwise 0</option>
                        </optgroup>
                        <optgroup label="Medical Assistant Training School (MATS)" id="score_no_of_technology_or_trade_courses_mats">
                          <option value="5">If courses number ≥ 1;</option>
                          <option value="0">Otherwise 0</option>
                        </optgroup>
                      </select>
                      @error("score_no_of_technology_or_trade_courses")
                      <strong
                        class="text-danger">{{ $errors->first("score_no_of_technology_or_trade_courses") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="score_no_of_technology_or_trade_courses_val">Score Value</label>
                    <input type="number" name="score_no_of_technology_or_trade_courses_val" disabled
                           value="{{ old("score_no_of_technology_or_trade_courses_val", 0) }}" id="score_no_of_technology_or_trade_courses_val"
                           class="form-control @error("score_no_of_technology_or_trade_courses_val") is-invalid @enderror"
                           placeholder="0">
                  </div>
                  <script>
                    $(document).ready(function () {
                      $('#no_of_technology_or_trade_courses').change(function () {
                        checkTechnology()
                      })
                      checkTechnology()

                      function checkTechnology() {
                        const cate = $('#institute_category').val()
                        const value = Number($('#no_of_technology_or_trade_courses').val())

                        $("#score_no_of_technology_or_trade_courses").find('option[selected="selected"]').removeAttr('selected');
                        $("#score_no_of_technology_or_trade_courses").find('option').prop("selected", false);
                        $("#score_no_of_technology_or_trade_courses").find('option').attr('disabled', 'true');
                        $("#score_no_of_technology_or_trade_courses").val();


                        if (cate === 'Nursing College/Institute (Diploma-level)' || cate === 'Institutes of Marine Technology (IMT)') {
                          if (value >= 2) {
                            $('#score_no_of_technology_or_trade_courses_val').val(5)
                            $("#score_no_of_technology_or_trade_courses > optgroup[id='score_no_of_technology_or_trade_courses_mtd']").find('option[value="5"]').removeAttr("disabled");
                            $("#score_no_of_technology_or_trade_courses > optgroup[id='score_no_of_technology_or_trade_courses_mtd']").find('option[value="5"]').prop("selected", true);
                            return null;
                          } else if (value == 1) {
                            $('#score_no_of_technology_or_trade_courses_val').val(4)
                            $("#score_no_of_technology_or_trade_courses > optgroup[id='score_no_of_technology_or_trade_courses_mtd']").find('option[value="4"]').removeAttr("disabled");
                            $("#score_no_of_technology_or_trade_courses > optgroup[id='score_no_of_technology_or_trade_courses_mtd']").find('option[value="4"]').prop("selected", true);
                            return null;
                          } else {
                            $('#score_no_of_technology_or_trade_courses_val').val(0)
                            $("#score_no_of_technology_or_trade_courses > optgroup[id='score_no_of_technology_or_trade_courses_mtd']").find('option[value="0"]').removeAttr("disabled");
                            $("#score_no_of_technology_or_trade_courses > optgroup[id='score_no_of_technology_or_trade_courses_mtd']").find('option[value="0"]').prop("selected", true);
                            return null;
                          }
                        } else if (cate === 'Medical Assistant Training School (MATS)') {
                          if (value >= 1) {
                            $('#score_no_of_technology_or_trade_courses_val').val(5)
                            $("#score_no_of_technology_or_trade_courses > optgroup[id='score_no_of_technology_or_trade_courses_mats']").find('option[value="5"]').removeAttr("disabled");
                            $("#score_no_of_technology_or_trade_courses > optgroup[id='score_no_of_technology_or_trade_courses_mats']").find('option[value="5"]').prop("selected", true);
                            return null;
                          } else {
                            $('#score_no_of_technology_or_trade_courses_val').val(0)
                            $("#score_no_of_technology_or_trade_courses > optgroup[id='score_no_of_technology_or_trade_courses_mats']").find('option[value="0"]').removeAttr("disabled");
                            $("#score_no_of_technology_or_trade_courses > optgroup[id='score_no_of_technology_or_trade_courses_mats']").find('option[value="0"]').prop("selected", true);
                            return null;
                          }
                        } else {
                          if (value > 5) {
                            $('#score_no_of_technology_or_trade_courses_val').val(5)
                            $("#score_no_of_technology_or_trade_courses > optgroup[id='score_no_of_technology_or_trade_courses_piht']").find('option[value="5"]').removeAttr("disabled");
                            $("#score_no_of_technology_or_trade_courses > optgroup[id='score_no_of_technology_or_trade_courses_piht']").find('option[value="5"]').prop("selected", true);
                            return null;
                          }
                          if (5 >= value && value >= 3) {
                            $('#score_no_of_technology_or_trade_courses_val').val(4)
                            $("#score_no_of_technology_or_trade_courses > optgroup[id='score_no_of_technology_or_trade_courses_piht']").find('option[value="4"]').removeAttr("disabled");
                            $("#score_no_of_technology_or_trade_courses > optgroup[id='score_no_of_technology_or_trade_courses_piht']").find('option[value="4"]').prop("selected", true);
                            return null;
                          } else {
                            $('#score_no_of_technology_or_trade_courses_val').val(0)
                            $("#score_no_of_technology_or_trade_courses > optgroup[id='score_no_of_technology_or_trade_courses_piht']").find('option[value="0"]').removeAttr("disabled");
                            $("#score_no_of_technology_or_trade_courses > optgroup[id='score_no_of_technology_or_trade_courses_piht']").find('option[value="0"]').prop("selected", true);
                            return null;
                          }
                        }
                      }
                    })
                  </script>
                </div>

                <div class="row bordered-p mb-3">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="premise_type">Premises Type <span class="text-danger">*</span></label>
                      <select name="premise_type" id="premise_type"
                              class="form-control @error("premise_type") is-invalid @enderror">
                        <option value="">Choose a type</option>
                        @foreach(\App\Models\EligibilityApplicationFormIdg::$premiseTypes as $typ)
                          <option value="{{ $typ }}" @selected(old("premise_type", $form ? $form->premise_type : '') == $typ)>{{ $typ }}</option>
                        @endforeach
                      </select>
                      @error("premise_type")
                      <strong class="text-danger">{{ $errors->first("premise_type") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="score_for_infrastructure">Score for Infrastructure <span
                          class="text-danger">*</span></label>
                      <select name="score_for_infrastructure" id="score_for_infrastructure" readonly
                              class="form-control @error("score_for_infrastructure") is-invalid @enderror">
                        <option value="">Choose a infrastructure</option>
                        <option value="10" @selected(old("score_for_infrastructure", $form ? $form->score_for_infrastructure : '') == '10')>If operating exclusively from owned land
                          premises; 10
                        </option>
                        <option value="7" @selected(old("score_for_infrastructure", $form ? $form->score_for_infrastructure : '') == '7.5')>Partly owned premises; 7</option>
                        <option value="5" @selected(old("score_for_infrastructure", $form ? $form->score_for_infrastructure : '') == '5')>Rented premises; 5</option>
                      </select>
                      @error("score_for_infrastructure")
                      <strong class="text-danger">{{ $errors->first("score_for_infrastructure") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <script>
                    $(document).ready(function () {
                      $('#premise_type').change(function () {
                        $("#score_for_infrastructure").find('option[selected="selected"]').removeAttr('selected');
                        $("#score_for_infrastructure").find('option').prop("selected", false);
                        $("#score_for_infrastructure").find('option').attr('disabled', 'true');
                        $("#score_for_infrastructure").val();

                        if ($(this).val() === 'Own premises') {
                          $('#score_for_infrastructure').val(10).change()
                          $("#score_for_infrastructure").find('option[value="10"]').removeAttr("disabled");
                          $("#score_for_infrastructure").find('option[value="10"]').prop("selected", true);
                          $('#score_for_infrastructure_val').val(10)
                        }
                        if ($(this).val() === 'Partly owned premises') {
                          $('#score_for_infrastructure').val(7).change()
                          $("#score_for_infrastructure").find('option[value="7"]').removeAttr("disabled");
                          $("#score_for_infrastructure").find('option[value="7"]').prop("selected", true);
                          $('#score_for_infrastructure_val').val(7)
                        }
                        if ($(this).val() === 'Rented premises') {
                          $('#score_for_infrastructure').val(5).change()
                          $("#score_for_infrastructure").find('option[value="5"]').removeAttr("disabled");
                          $("#score_for_infrastructure").find('option[value="5"]').prop("selected", true);
                          $('#score_for_infrastructure_val').val(5)
                        }
                      })
                    })
                  </script>
                  <div class="col-md-3">
                    <label for="score_for_infrastructure_val">Score Value</label>
                    <input type="number" name="score_for_infrastructure_val" id="score_for_infrastructure_val" disabled
                           value="{{ old("score_for_infrastructure_val",  $form ? $form->score_for_infrastructure : 0) }}" id="score_for_infrastructure_val"
                           class="form-control"
                           placeholder="0">
                  </div>
                </div>


                <div class="row bordered-p mb-3">
                  <div class="col-md-12">
                    <div class="row">
                      {{--                  <div class="col-md-12">--}}
                      {{--                    <div class="form-group">--}}
                      {{--                      <label for="institute_have_own_land">Institute have own Land(As per the policy of the--}}
                      {{--                        institution establishment amount of land) <span--}}
                      {{--                          class="text-danger">*</span></label>--}}
                      {{--                      <textarea rows="4" name="institute_have_own_land" id="institute_have_own_land"--}}
                      {{--                                class="form-control @error("institute_have_own_land") is-invalid @enderror">{{ old("institute_have_own_land", $form? $form->institute_have_own_land : '') }}</textarea>--}}
                      {{--                      <strong class="text-danger" id="institute_have_own_land_error"></strong>--}}
                      {{--                      @error("institute_have_own_land")--}}
                      {{--                      <strong class="text-danger">{{ $errors->first("institute_have_own_land") }}</strong>--}}
                      {{--                      @enderror--}}
                      {{--                    </div>--}}

                      <div class="col-md-12 d-none">
                        <div class="form-group">
                          <label for="institute_have_own_land">Institute have own land<span class="text-danger">*</span></label>
                          <select name="institute_have_own_land"
                                  id="institute_have_own_land"
                                  class="form-control @error("institute_have_own_land") is-invalid @enderror">
                            <option value="">Choose one</option>
                            @foreach(\App\Models\EligibilityApplicationFormIdg::$boolTypes as $bool)
                              <option
                                value="{{ $bool['id'] }}" @selected(1 == $bool['id'])>{{ $bool['name'] }}</option>
                            @endforeach
                          </select>
                          @error("institute_have_own_land")
                          <strong
                            class="text-danger">{{ $errors->first("institute_have_own_land") }}</strong>
                          @enderror
                        </div>
                      </div>
                      <script>
                        $(document).ready(function () {
                          $('#institute_have_own_land').change(function () {
                            checkInstituteHasLand()
                          })
                          checkInstituteHasLand()

                          function checkInstituteHasLand() {
                            if ($('#institute_have_own_land').val() == '1') {
                              $('input[name="score_of_land"]').val(5);
                              $('#institute_have_own_land_details').removeClass('d-none')
                            } else {
                              $('input[name="score_of_land"]').val(0);
                              $('#institute_have_own_land_details').addClass('d-none')
                            }
                          }
                        })
                      </script>
                    </div>

                    <div class="row d-none" id="institute_have_own_land_details">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="amount_of_total_land">Amount of total land (Decimal) <span class="text-danger">*</span></label>
                          <input type="text" name="amount_of_total_land" value="{{ old("amount_of_total_land", $form ? $form->amount_of_total_land : '') }}"
                                 id="amount_of_total_land"
                                 class="form-control @error("amount_of_total_land") is-invalid @enderror"
                                 placeholder="Amount of total land">
                          @error("amount_of_total_land")
                          <strong class="text-danger">{{ $errors->first("amount_of_total_land") }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="price_of_land">Price of land (BDT in Lakh)<span class="text-danger">*</span></label>
                          <input type="text" name="price_of_land" value="{{ old("price_of_land", $form ? $form->price_of_land : '') }}"
                                 id="price_of_land"
                                 class="form-control @error("price_of_land") is-invalid @enderror"
                                 placeholder="Price of land">
                          @error("price_of_land")
                          <strong class="text-danger">{{ $errors->first("price_of_land") }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="date_of_purchase_or_ownership">Date of purchase or ownership <span class="text-danger">*</span></label>
                          <input type="date" name="date_of_purchase_or_ownership"
                                 value="{{ old("date_of_purchase_or_ownership", $form ? $form->date_of_purchase_or_ownership : '') }}"
                                 id="date_of_purchase_or_ownership"
                                 class="form-control @error("date_of_purchase_or_ownership") is-invalid @enderror"
                                 placeholder="Price of land">
                          @error("date_of_purchase_or_ownership")
                          <strong class="text-danger">{{ $errors->first("date_of_purchase_or_ownership") }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="location_of_land">Location of land <span class="text-danger">*</span></label>
                          <input type="text" name="location_of_land" value="{{ old("location_of_land", $form ? $form->location_of_land : '') }}"
                                 id="location_of_land"
                                 class="form-control @error("location_of_land") is-invalid @enderror"
                                 placeholder="Location of land">
                          @error("location_of_land")
                          <strong class="text-danger">{{ $errors->first("location_of_land") }}</strong>
                          @enderror
                        </div>
                      </div>


                      <script>
                        $(document).ready(function () {
                          // $('#institute_have_own_land').keyup(function () {
                          //   checkDetails('institute_have_own_land', 100, 500)
                          // });
                          $('#outcomes').keyup(function () {
                            checkDetails('outcomes', 100, 500)
                          });

                          function checkDetails($id, $min, $max) {
                            const $this = $('#' + $id)
                            var $regex = /\s+/gi;
                            var $wordcount = $.trim($this.val()).replace($regex, ' ').split(' ').length;
                            if ($min > $wordcount) {
                              $this.addClass('is-invalid')
                              $('#' + $id + '_error').text('Minimum ' + $min + ' word required.')
                            } else if ($wordcount > $max) {
                              $this.addClass('is-invalid')
                              $('#' + $id + '_error').text('Maximum ' + $max + ' word allow.')
                            } else {
                              $('#' + $id + '_error').text('')
                              $this.removeClass('is-invalid')
                            }
                          }
                        })
                      </script>
                    </div>
                  </div>
                </div>

                <div class="row bordered-p mb-3">
                  <div class="col-md-12">

                    <div class="row mt-3">
                      <div class="col-md-12">
                        <h6 class="text-center">External Audit performed</h6>
                      </div>
                      <div class="col-md-10">
                        <div class="row">

                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="external_audit_performed_2022">2022<span class="text-danger">*</span></label>
                              <select name="external_audit_performed_2022" id="external_audit_performed_2022"
                                      class="form-control @error("external_audit_performed_2022") is-invalid @enderror">
                                <option value="">Choose one</option>
                                @foreach(\App\Models\EligibilityApplicationFormIdg::$boolTypes as $bool)
                                  <option
                                    value="{{ $bool['id'] }}" @selected(old("external_audit_performed_2022", $form ? $form->external_audit_performed_2022 : '') == $bool['id'])>{{ $bool['name'] }}</option>
                                @endforeach
                              </select>
                              @error("external_audit_performed_2022")
                              <strong class="text-danger">{{ $errors->first("external_audit_performed_2022") }}</strong>
                              @enderror
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="external_audit_performed_2021">2021<span class="text-danger">*</span></label>
                              <select name="external_audit_performed_2021" id="external_audit_performed_2021"
                                      class="form-control @error("external_audit_performed_2021") is-invalid @enderror">
                                <option value="">Choose one</option>
                                @foreach(\App\Models\EligibilityApplicationFormIdg::$boolTypes as $bool)
                                  <option
                                    value="{{ $bool['id'] }}" @selected(old("external_audit_performed_2021", $form ? $form->external_audit_performed_2021 : '') == $bool['id'])>{{ $bool['name'] }}</option>
                                @endforeach
                              </select>
                              @error("external_audit_performed_2021")
                              <strong class="text-danger">{{ $errors->first("external_audit_performed_2021") }}</strong>
                              @enderror
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="external_audit_performed_2020">2020<span class="text-danger">*</span></label>
                              <select name="external_audit_performed_2020" id="external_audit_performed_2020"
                                      class="form-control @error("external_audit_performed_2020") is-invalid @enderror">
                                <option value="">Choose one</option>
                                @foreach(\App\Models\EligibilityApplicationFormIdg::$boolTypes as $bool)
                                  <option
                                    value="{{ $bool['id'] }}" @selected(old("external_audit_performed_2020", $form ? $form->external_audit_performed_2020 : '') == $bool['id'])>{{ $bool['name'] }}</option>
                                @endforeach
                              </select>
                              @error("external_audit_performed_2020")
                              <strong class="text-danger">{{ $errors->first("external_audit_performed_2020") }}</strong>
                              @enderror
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="external_audit_performed_2019">2019<span class="text-danger">*</span></label>
                              <select name="external_audit_performed_2019" id="external_audit_performed_2019"
                                      class="form-control @error("external_audit_performed_2019") is-invalid @enderror">
                                <option value="">Choose one</option>
                                @foreach(\App\Models\EligibilityApplicationFormIdg::$boolTypes as $bool)
                                  <option
                                    value="{{ $bool['id'] }}" @selected(old("external_audit_performed_2019", $form ? $form->external_audit_performed_2019 : '') == $bool['id'])>{{ $bool['name'] }}</option>
                                @endforeach
                              </select>
                              @error("external_audit_performed_2019")
                              <strong class="text-danger">{{ $errors->first("external_audit_performed_2019") }}</strong>
                              @enderror
                            </div>
                          </div>

                        </div>
                      </div>
                      <div class="col-md-2">
                        <label for="score_of_audit">Score Value</label>
                        <input type="number" name="score_of_audit" readonly
                               value="{{ old("score_of_audit", $form ? $form->score_of_audit : 0) }}" id="score_of_audit"
                               class="form-control @error("score_of_audit") is-invalid @enderror"
                               placeholder="0">
                      </div>
                      <script>
                        $(document).ready(function () {
                          $('#external_audit_performed_2022').change(function () {
                            // setAudit(2022)
                            calculateValueForAudit()
                            $('#external_audit_performed_2019').attr('readonly', true)
                            $('#external_audit_performed_2019').attr('disabled', true)
                          })
                          $('#external_audit_performed_2021').change(function () {
                            // setAudit(2021)
                            calculateValueForAudit()
                          })
                          $('#external_audit_performed_2020').change(function () {
                            // setAudit(2020)
                            calculateValueForAudit()
                          })
                          $('#external_audit_performed_2019').change(function () {
                            // setAudit(2019)
                            $('#external_audit_performed_2022').attr('readonly', true)
                            $('#external_audit_performed_2022').attr('disabled', true)
                            calculateValueForAudit()
                          })


                          function calculateValueForAudit() {
                            const audit1 = $('#external_audit_performed_2022').val()
                            const audit2 = $('#external_audit_performed_2021').val()
                            const audit3 = $('#external_audit_performed_2020').val()
                            const audit4 = $('#external_audit_performed_2019').val()
                            const total = (Number(audit1) + Number(audit2) + Number(audit3) + Number(audit4))
                            if (total < 3) {
                              $('input[name="score_of_audit"]').val('0')
                            } else {
                              $('input[name="score_of_audit"]').val('5')
                            }
                          }

                          //
                          // function setAudit(year) {
                          //   const extAudit = Number($('#external_audit_performed_' + year).val());
                          //   const opiAudit = $('#opinions_of_external_audit_' + year)
                          //   if (extAudit === 0) {
                          //     opiAudit.attr('readonly', true)
                          //     opiAudit.find('option[value=""]').attr('disabled', true)
                          //     opiAudit.find('option[value="1"]').attr('disabled', true)
                          //     opiAudit.val(0)
                          //   } else {
                          //     opiAudit.removeAttr('readonly')
                          //     opiAudit.find('option[value=""]').removeAttr('disabled')
                          //     opiAudit.find('option[value="1"]').removeAttr('disabled')
                          //     opiAudit.val('')
                          //   }
                          // }
                        })
                      </script>
                    </div>

                    {{--                    <div class="row mt-3">--}}
                    {{--                      <div class="col-md-12">--}}
                    {{--                        <h6 class="text-center">Opinions of External Audit</h6>--}}
                    {{--                      </div>--}}
                    {{--                      <div class="col-md-3">--}}
                    {{--                        <div class="form-group">--}}
                    {{--                          <label for="opinions_of_external_audit_2022">2022<span class="text-danger">*</span></label>--}}
                    {{--                          <select name="opinions_of_external_audit_2022" id="opinions_of_external_audit_2022"--}}
                    {{--                                  class="form-control @error("opinions_of_external_audit_2022") is-invalid @enderror">--}}
                    {{--                            <option value="">Choose one</option>--}}
                    {{--                            @foreach(\App\Models\EligibilityApplicationFormIdg::$externalAuditTypes as $bool)--}}
                    {{--                              <option--}}
                    {{--                                value="{{ $bool['id'] }}" @selected(old("opinions_of_external_audit_2022", $form ? $form->opinions_of_external_audit_2022 : '') == $bool['id'])>{{ $bool['name'] }}</option>--}}
                    {{--                            @endforeach--}}
                    {{--                          </select>--}}
                    {{--                          @error("opinions_of_external_audit_2022")--}}
                    {{--                          <strong class="text-danger">{{ $errors->first("opinions_of_external_audit_2022") }}</strong>--}}
                    {{--                          @enderror--}}
                    {{--                        </div>--}}
                    {{--                      </div>--}}
                    {{--                      <div class="col-md-3">--}}
                    {{--                        <div class="form-group">--}}
                    {{--                          <label for="opinions_of_external_audit_2021">2021<span class="text-danger">*</span></label>--}}
                    {{--                          <select name="opinions_of_external_audit_2021" id="opinions_of_external_audit_2021"--}}
                    {{--                                  class="form-control @error("opinions_of_external_audit_2021") is-invalid @enderror">--}}
                    {{--                            <option value="">Choose one</option>--}}
                    {{--                            @foreach(\App\Models\EligibilityApplicationFormIdg::$externalAuditTypes as $bool)--}}
                    {{--                              <option--}}
                    {{--                                value="{{ $bool['id'] }}" @selected(old("opinions_of_external_audit_2021", $form ? $form->opinions_of_external_audit_2021 : '') == $bool['id'])>{{ $bool['name'] }}</option>--}}
                    {{--                            @endforeach--}}
                    {{--                          </select>--}}
                    {{--                          @error("opinions_of_external_audit_2021")--}}
                    {{--                          <strong class="text-danger">{{ $errors->first("opinions_of_external_audit_2021") }}</strong>--}}
                    {{--                          @enderror--}}
                    {{--                        </div>--}}
                    {{--                      </div>--}}
                    {{--                      <div class="col-md-3">--}}
                    {{--                        <div class="form-group">--}}
                    {{--                          <label for="opinions_of_external_audit_2020">2020<span class="text-danger">*</span></label>--}}
                    {{--                          <select name="opinions_of_external_audit_2020" id="opinions_of_external_audit_2020"--}}
                    {{--                                  class="form-control @error("opinions_of_external_audit_2020") is-invalid @enderror">--}}
                    {{--                            <option value="">Choose one</option>--}}
                    {{--                            @foreach(\App\Models\EligibilityApplicationFormIdg::$externalAuditTypes as $bool)--}}
                    {{--                              <option--}}
                    {{--                                value="{{ $bool['id'] }}" @selected(old("opinions_of_external_audit_2020", $form ? $form->opinions_of_external_audit_2020 : '') == $bool['id'])>{{ $bool['name'] }}</option>--}}
                    {{--                            @endforeach--}}
                    {{--                          </select>--}}
                    {{--                          @error("opinions_of_external_audit_2020")--}}
                    {{--                          <strong class="text-danger">{{ $errors->first("opinions_of_external_audit_2020") }}</strong>--}}
                    {{--                          @enderror--}}
                    {{--                        </div>--}}
                    {{--                      </div>--}}
                    {{--                      <div class="col-md-3">--}}
                    {{--                        <div class="form-group">--}}
                    {{--                          <label for="opinions_of_external_audit_2019">2019<span class="text-danger">*</span></label>--}}
                    {{--                          <select name="opinions_of_external_audit_2019" id="opinions_of_external_audit_2019"--}}
                    {{--                                  class="form-control @error("opinions_of_external_audit_2019") is-invalid @enderror">--}}
                    {{--                            <option value="">Choose one</option>--}}
                    {{--                            @foreach(\App\Models\EligibilityApplicationFormIdg::$externalAuditTypes as $bool)--}}
                    {{--                              <option--}}
                    {{--                                value="{{ $bool['id'] }}" @selected(old("opinions_of_external_audit_2019", $form ? $form->opinions_of_external_audit_2019 : '') == $bool['id'])>{{ $bool['name'] }}</option>--}}
                    {{--                            @endforeach--}}
                    {{--                          </select>--}}
                    {{--                          @error("opinions_of_external_audit_2019")--}}
                    {{--                          <strong class="text-danger">{{ $errors->first("opinions_of_external_audit_2019") }}</strong>--}}
                    {{--                          @enderror--}}
                    {{--                        </div>--}}
                    {{--                      </div>--}}
                    {{--                    </div>--}}


                  </div>
                </div>

                <div class="row bordered-p mb-3">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="institute_accreditation_from_competent_authority">Institute have Accreditation from
                        competent authority<span class="text-danger">*</span></label>
                      <select name="institute_accreditation_from_competent_authority"
                              id="institute_accreditation_from_competent_authority"
                              class="form-control @error("institute_accreditation_from_competent_authority") is-invalid @enderror">
                        <option value="">Choose one</option>
                        @foreach(\App\Models\EligibilityApplicationFormIdg::$boolTypes as $bool)
                          <option
                            value="{{ $bool['id'] }}" @selected(old("institute_accreditation_from_competent_authority", $form ? $form->institute_accreditation_from_competent_authority : '') == $bool['id'])>{{ $bool['name'] }}</option>
                        @endforeach
                      </select>
                      @error("institute_accreditation_from_competent_authority")
                      <strong
                        class="text-danger">{{ $errors->first("institute_accreditation_from_competent_authority") }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row  bordered-p mb-3">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="have_you_receive_idg_from_step">Have you receive IDG from STEP?<span
                          class="text-danger">*</span></label>
                      <select name="have_you_receive_idg_from_step" id="have_you_receive_idg_from_step"
                              class="form-control @error("have_you_receive_idg_from_step") is-invalid @enderror">
                        <option value="">Choose one</option>
                        @foreach(\App\Models\EligibilityApplicationFormIdg::$boolTypes as $bool)
                          <option
                            value="{{ $bool['id'] }}" @selected(old("have_you_receive_idg_from_step", $form ? $form->have_you_receive_idg_from_step : '') == $bool['id'])>{{ $bool['name'] }}</option>
                        @endforeach
                      </select>
                      @error("have_you_receive_idg_from_step")
                      <strong class="text-danger">{{ $errors->first("have_you_receive_idg_from_step") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4 idg_amount" style="display: none;">
                    <div class="form-group">
                      <label for="idg_amount_awarded_from_step" title="BDT in crore">IDG Amount awarded from STEP (BDT in crore)
                        <span class="text-danger">*</span></label>
                      <input type="number" name="idg_amount_awarded_from_step" step="any"
                             value="{{ old("idg_amount_awarded_from_step", $form ? $form->idg_amount_awarded_from_step : '') }}" id="idg_amount_awarded_from_step"
                             class="form-control @error("idg_amount_awarded_from_step") is-invalid @enderror"
                             placeholder="0">
                      <strong class="text-danger" id="idg_amount_awarded_from_step_error"></strong>
                      @error("idg_amount_awarded_from_step")
                      <strong class="text-danger">{{ $errors->first("idg_amount_awarded_from_step") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4 idg_amount" style="display: none;">
                    <div class="form-group">
                      <label for="idg_amount_utilized_under_step" title="BDT in crore">IDG Amount utilized under
                        STEP (BDT in crore)<span class="text-danger">*</span></label>
                      <input type="number" name="idg_amount_utilized_under_step" step="any"
                             value="{{ old("idg_amount_utilized_under_step", $form ? $form->idg_amount_utilized_under_step : '') }}" id="idg_amount_utilized_under_step"
                             class="form-control @error("idg_amount_utilized_under_step") is-invalid @enderror"
                             placeholder="0">
                      <strong class="text-danger" id="idg_amount_utilized_under_step_error"></strong>
                      @error("idg_amount_utilized_under_step")
                      <strong class="text-danger">{{ $errors->first("idg_amount_utilized_under_step") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-12 idg_amount" style="display: none;">
                    <div class="form-group">
                      <label for="has_objections_or_lawsuit">Any audit objections/Lawsuit of the previous STEP Project<span class="text-danger">*</span></label>
                      <select name="has_objections_or_lawsuit" id="has_objections_or_lawsuit"
                              class="form-control @error("has_objections_or_lawsuit") is-invalid @enderror">
                        <option value="">Choose one</option>
                        @foreach(\App\Models\EligibilityApplicationFormIdg::$boolTypes as $bool)
                          <option
                            value="{{ $bool['id'] }}" @selected(old("has_objections_or_lawsuit", $form ? $form->has_objections_or_lawsuit : '') == $bool['id'])>{{ $bool['name'] }}</option>
                        @endforeach
                      </select>
                      @error("has_objections_or_lawsuit")
                      <strong class="text-danger">{{ $errors->first("has_objections_or_lawsuit") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <script>
                    $(document).ready(function () {
                      $('#idg_amount_awarded_from_step').change(function () {
                        checkIDGAmount()
                      })
                      $('#idg_amount_utilized_under_step').change(function () {
                        checkIDGAmount()
                      })

                      $('#have_you_receive_idg_from_step').change(function () {
                        check_idg_form_step()
                      })
                      check_idg_form_step()
                      checkIDGAmount()

                      function check_idg_form_step() {
                        const check_idg = $('#have_you_receive_idg_from_step').val();
                        if (check_idg == 1) {
                          $('.idg_amount').show();
                        } else {
                          $('.idg_amount').hide();
                        }
                      }

                      function checkIDGAmount() {
                        const $awardAmount = $('#idg_amount_awarded_from_step')
                        const $awardAmountErrou = $('#idg_amount_awarded_from_step_error')
                        const $utilAmount = $('#idg_amount_utilized_under_step')
                        const $utilAmountError = $('#idg_amount_utilized_under_step_error')
                        if (Number($awardAmount.val()) < Number($utilAmount.val())) {
                          $awardAmount.addClass('is-invalid')
                          $awardAmountErrou.text('IDG Amount awarded can\'t be less than IDG Amount utilized')
                          $utilAmount.addClass('is-invalid')
                          $utilAmountError.text('IDG Amount utilized can\'t be greater than IDG Amount awarded')
                        } else {
                          $awardAmount.removeClass('is-invalid')
                          $awardAmountErrou.text('')
                          $utilAmount.removeClass('is-invalid')
                          $utilAmountError.text('')
                        }
                      }
                    })
                  </script>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="idg_received_from_any_other_gob_project_or_budget">IDG received from any other GoB
                        Project/Budget<span class="text-danger">*</span></label>
                      <select name="idg_received_from_any_other_gob_project_or_budget"
                              id="idg_received_from_any_other_gob_project_or_budget"
                              class="form-control @error("idg_received_from_any_other_gob_project_or_budget") is-invalid @enderror">
                        <option value="">Choose one</option>
                        @foreach(\App\Models\EligibilityApplicationFormIdg::$boolTypes as $bool)
                          <option
                            value="{{ $bool['id'] }}" @selected(old("idg_received_from_any_other_gob_project_or_budget", $form ? $form->idg_received_from_any_other_gob_project_or_budget : '', '') == $bool['id'])>{{ $bool['name'] }}</option>
                        @endforeach
                      </select>
                      @error("idg_received_from_any_other_gob_project_or_budget")
                      <strong
                        class="text-danger">{{ $errors->first("idg_received_from_any_other_gob_project_or_budget") }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row idg_received_from_gob_project_or_budget" style="display: none;">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="name_of_the_project">Name of the Project <span class="text-danger">*</span></label>
                      <input type="text" name="name_of_the_project" value="{{ old("name_of_the_project", $form ? $form->name_of_the_project : '') }}"
                             id="name_of_the_project"
                             class="form-control @error("name_of_the_project") is-invalid @enderror"
                             placeholder="Name of the Project">
                      @error("name_of_the_project")
                      <strong class="text-danger">{{ $errors->first("name_of_the_project") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="year_of_financing">Year of financing <span class="text-danger">*</span></label>
                      <input type="text" name="year_of_financing" value="{{ old("year_of_financing", $form ? $form->year_of_financing : '') }}"
                             id="year_of_financing"
                             class="form-control yearPicker @error("year_of_financing") is-invalid @enderror"
                             placeholder="yyyy">
                      @error("year_of_financing")
                      <strong class="text-danger">{{ $errors->first("year_of_financing") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="duration_of_financing">Duration of Financing (Year)<span
                          class="text-danger">*</span></label>
                      <input type="number" name="duration_of_financing" value="{{ old("duration_of_financing", $form ? $form->duration_of_financing : '') }}"
                             id="duration_of_financing"
                             class="form-control @error("duration_of_financing") is-invalid @enderror"
                             placeholder="Duration of Financing">
                      @error("duration_of_financing")
                      <strong class="text-danger">{{ $errors->first("duration_of_financing") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="amount_received" title="BDT in crore">Amount received (BDT in Crore)<span
                          class="text-danger">*</span></label>
                      <input type="number" name="amount_received" value="{{ old("amount_received", $form ? $form->amount_received : '') }}"
                             id="amount_received" step="any"
                             class="form-control @error("amount_received") is-invalid @enderror" placeholder="0">
                      @error("amount_received")
                      <strong class="text-danger">{{ $errors->first("amount_received") }}</strong>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="outcomes">Outcomes <span
                          class="text-danger">*</span></label>
                      <textarea rows="4" name="outcomes" id="outcomes"
                                class="form-control @error("outcomes") is-invalid @enderror">{{ old("outcomes", $form ? $form->outcomes : '') }}</textarea>
                      <strong class="text-danger" id="outcomes_error"></strong>
                      @error("outcomes")
                      <strong class="text-danger">{{ $errors->first("outcomes") }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="institute_have_rto">Institute have RTO?<span class="text-danger">*</span></label>
                      <select name="institute_have_rto" id="institute_have_rto"
                              class="form-control @error("institute_have_rto") is-invalid @enderror">
                        <option value="">Choose one</option>
                        @foreach(\App\Models\EligibilityApplicationFormIdg::$boolTypes as $bool)
                          <option
                            value="{{ $bool['id'] }}" @selected(old("institute_have_rto", $form ? $form->institute_have_rto : '') == $bool['id'])>{{ $bool['name'] }}</option>
                        @endforeach
                      </select>
                      @error("institute_have_rto")
                      <strong class="text-danger">{{ $errors->first("institute_have_rto") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <script>
                    $(document).ready(function () {
                      $('#institute_type').change(function () {
                        checkInstituteForm()
                      })
                      checkInstituteForm()

                      function checkInstituteForm() {
                        const idself = $('.idself')
                        const self = $('#self_finance_at_least_15_of_the_cash')
                        if ($('#institute_type').val() === 'private') {
                          idself.removeClass('hidden')
                          self.removeAttr('disabled')
                        } else {
                          idself.addClass('hidden')
                          self.attr('disabled', true)
                        }
                      }
                    })
                  </script>
                  <div class="idself col-md-8 hidden">
                    <div class="form-group">
                      <label for="self_finance_at_least_15_of_the_cash">Can you self-finance at least 15% of the cash
                        expenditure of proposed activities?<span
                          class="text-danger">*</span></label>
                      <select name="self_finance_at_least_15_of_the_cash" id="self_finance_at_least_15_of_the_cash" disabled
                              class="form-control @error("self_finance_at_least_15_of_the_cash") is-invalid @enderror">
                        <option value="">Choose one</option>
                        @foreach(\App\Models\EligibilityApplicationFormIdg::$boolTypes as $bool)
                          <option
                            value="{{ $bool['id'] }}" @selected(old("self_finance_at_least_15_of_the_cash", $form ? $form->self_finance_at_least_15_of_the_cash : '') == $bool['id'])>{{ $bool['name'] }}</option>
                        @endforeach
                      </select>
                      @error("self_finance_at_least_15_of_the_cash")
                      <strong
                        class="text-danger">{{ $errors->first("self_finance_at_least_15_of_the_cash") }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4 single-area single-area2">
                    <h5>List of Documents to be uploaded For Government</h5>
                    <p>1. বছরভিত্তিক ভর্তিকৃত শিক্ষার্থীর তথ্য (সর্বশেষ তিন বছরের)</p>
                    <p>2. বছরভিত্তিক ভর্তিকৃত মহিলা শিক্ষার্থীর তথ্য (সর্বশেষ তিন বছরের)</p>
                    <p>3. বোর্ড/যথাযথ কর্তৃপক্ষের চূড়ান্ত পরীক্ষায় ফরম ফিলাপের তথ্য (সর্বশেষ তিন বছরের/ছয় সেমিষ্টার)</p>
                    <p>4. বোর্ড/যথাযথ কর্তৃপক্ষের চূড়ান্ত পরীক্ষার ফলাফলের তথ্য (সর্বশেষ তিন বছরের/ছয় সেমিষ্টার)</p>
                    <p>5. শিক্ষক সংখ্যার তথ্য (মোট পদ সংখ্যা, নিয়মিত ও খন্ডকালীন শিক্ষকের সংখ্যা, শূণ্য পদের সংখ্যা)</p>
                    <p>6. STEP প্রজেক্ট থেকে প্রতিষ্ঠান গ্রান্ট পেয়ে থাকলে গ্রান্টের পরিমানসহ তার ডকুমেন্ট</p>
                    <p>7. STEP বাদে অন্য কোন সরকারি প্রজেক্ট হতে গ্রান্ট/ বাজেট পেয়ে থাকলে গ্রান্ট/বাজেটের পরিমানসহ তার ডকুমেন্ট</p>
                    <p>8. সমাপ্ত স্টেপ প্রকল্পের অডিট আপত্তি আছে/নাই এই মর্মে প্রত্যয়ন পত্র জমা দিতে হবে (স্টেপ প্রকল্প থেকে গ্র্যান্ট পেয়েছিলেন এমন প্রতিষ্ঠানের ক্ষেত্রে
                      প্রযোজ্য)</p>
                    <p>9. ডাউনলোডকৃত EAF এর স্বাক্ষরিত কপি</p>
                  </div>
                  <div class="col-md-8 single-area single-area2">
                    <h5>List of Documents to be uploaded For Private</h5>

                    <p>1. প্রতিষ্ঠান স্থাপনের বয়স পাঁচ বছরের বেশি হতে হবে (BTEB এবং অন্যান্য কর্তৃপক্ষের প্রথম কোর্সের স্বীকৃতির তারিখ থেকে প্রতিষ্ঠার বছর গণনা করা হবে, বাংলাদেশ
                      কারিগরি শিক্ষা বোর্ড/যথাযথ কর্তৃপক্ষ কর্তৃক ইস্যুকৃত প্রতিষ্ঠানে সর্বপ্রথম কোর্স/টেকনোলজি চালু করার স্বীকৃতি পত্র)</p>
                    <p>2. টেকনোলজিসমূহের স্বীকৃতি পত্র (বোর্ড/যথাযথ কর্তৃপক্ষ কর্তৃক ইস্যুকৃত)</p>
                    <p>3. বছরভিত্তিক ভর্তিকৃত শিক্ষার্থীর তথ্য (সর্বশেষ তিন বছরের)</p>
                    <p>4. বছরভিত্তিক ভর্তিকৃত মহিলা শিক্ষার্থীর তথ্য (সর্বশেষ তিন বছরের)</p>
                    <p>5. বোর্ড/যথাযথ কর্তৃপক্ষের চূড়ান্ত পরীক্ষায় ফরম ফিলাপের তথ্য (সর্বশেষ তিন বছরের/ছয় সেমিষ্টার)</p>
                    <p>6. বোর্ড/যথাযথ কর্তৃপক্ষের চূড়ান্ত পরীক্ষার ফলাফলের তথ্য (সর্বশেষ তিন বছরের/ছয় সেমিষ্টার)</p>
                    <p>7. প্রতিষ্ঠানের নামে নিজস্ব জমি থাকতে হবে (জমির দলিল, নামজারী ও সর্বশেষ হালনাগাদ খাজনা পরিষদের, জমি আছে কিন্তু ভাড়া বাড়ি হলে চুক্তিনামা, প্রতিষ্ঠানের নামে
                      বিদ্যুৎ সংযোগ ও হাল নাগাদ বিল পরিশোধের রশিদ/কপি দাখিল করতে হবে)</p>
                    <p>8. শিক্ষক শূন্য পদের সংখ্যা শতকরা ২০ ভাগের কম হতে হবে [শিক্ষক সংখ্যার তথ্য (মোট পদ সংখ্যা, কর্মরত ও শূণ্য পদের সংখ্যা),শিক্ষকদের নিয়োগপত্র ও বেতন পরিশোধের
                      ব্যাংকের কপি বা অন্যান্য যথাযথ প্রমাণ সংযুক্ত করতে হবে, শুধুমাত্র নিয়মিত শিক্ষক যারা কমপক্ষে এক বছর কর্মরত আছে]</p>
                    <p>9. মোট আইডিজি গ্রান্টের কমপক্ষে শতকরা ১৫ ভাগ টাকা প্রতিষ্ঠান নিজস্ব তহবিল হতে খরচ করতে পারবে এমন প্রত্যয়ন পত্র সহ প্রতিষ্ঠানের ব্যাংক স্টেটমেন্ট)</p>
                    <p>10. STEP প্রজেক্ট থেকে প্রতিষ্ঠান গ্রান্ট পেয়ে থাকলে গ্রান্টের পরিমানসহ তার ডকুমেন্ট (স্টেপ প্রকল্প থেকে গ্র্যান্ট পেয়েছিলেন এমন প্রতিষ্ঠানের ক্ষেত্রে
                      প্রযোজ্য)</p>
                    <p>11. সমাপ্ত স্টেপ প্রকল্পের অডিট আপত্তি নিষ্পত্তি সাপেক্ষে আবেদন করা যাবে, সেক্ষেত্রে অডিট আপত্তি নাই এই মর্মে প্রত্যয়ন পত্র জমা দিতে হবে (স্টেপ প্রকল্প থেকে
                      গ্র্যান্ট পেয়েছিলেন এমন প্রতিষ্ঠানের ক্ষেত্রে প্রযোজ্য)</p>
                    <p>12. একই জাতীয় (কোর্সের) প্রতিষ্ঠানের ক্ষেত্রে শুধুমাত্র একটি প্রতিষ্ঠানের জন্য এর জন্য গ্রান্ট এর আবেদন করতে পারবেন। (যেমন একই মালিকের/কোম্পানির তিনটি
                      পলিটেকনিক আছে এবং আরও দুটি পলিটেকনিকে শেয়ার আছে, এই পাঁচটি পলিটেকনিক হতে শুধুমাত্র একটি প্রতিষ্ঠান আবেদন করতে পারবেন। একই মালিকানাধীন/সংগঠন/প্রতিষ্ঠানের
                      একাধিক প্রতিষ্ঠানে একই জাতীয় কোর্স পরিচালিত হলে শুধুমাত্র একটি প্রতিষ্ঠানের জন্য আবেদন করা হয়েছে মর্মে প্রত্যয়ন পত্র জমা দিতে হবে।</p>
                    <p>13. ডাউনলোডকৃত EAF এর স্বাক্ষরিত কপি</p>
                  </div>
                </div>

                @if($form && count($form->files) > 0)
                  <div class="row">
                    <div class="col-md-12 single-area single-area2">
                      <h5>Uploaded File</h5>
                      <div class="row">
                        @foreach($form->files as $file)
                          <div class="col-md-12 mb-2">
                            <a href="{{ route('form.file.delete', ['formId'=>$form->id, 'id'=>$file->id]) }}" class="btn btn-danger">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path
                                  d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                <path fill-rule="evenodd"
                                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                              </svg>
                            </a>
                            <a href="{{ asset($file->file) }}" target="_blank" class="btn btn-success" title="{{ $file->type. ' _ ' .$file->size  }}">Download</a>
                            <span>{{ $file->description.$file->type }}&nbsp&nbsp,&nbsp&nbsp{{ "Size: ".$file->size  }}&nbsp&nbsp,&nbsp&nbsp{{ "Time: ".$file->created_at->format('h:i A, d F, Y') }}</span>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                @endif

                <div id="attributes">
                  <div class="row child">
                    <div class="col-md 3">
                      <div class="form-group">
                        <label for="image_upload">File Upload <span class="text-danger">*</span></label>
                        <input type="file" name="image_upload[]" id="image_upload"
                               class="form-control @error("image_upload") is-invalid @enderror">
                        @error("image_upload")
                        <strong class="text-danger">{{ $errors->first("image_upload") }}</strong>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md 3">
                      <div class="form-group">
                        <label for="image_type" class="imageType">File type <span
                            class="text-danger">*</span></label>
                        <input type="text" name="image_type[]" id="image_type"
                               class="form-control type @error("image_type") is-invalid @enderror">
                        @error("image_type")
                        <strong class="text-danger">{{ $errors->first("image_type") }}</strong>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md 3">
                      <div class="form-group">
                        <label for="image_filename">File Description<span class="text-danger">*</span></label>
                        <input type="text" name="image_filename[]" id="image_filename"
                               class="form-control filename @error("image_filename") is-invalid @enderror">
                        @error("image_filename")
                        <strong class="text-danger">{{ $errors->first("image_filename") }}</strong>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md 2">
                      <div class="form-group">
                        <label for="image_size">Size <span class="text-danger">*</span></label>
                        <input type="text" name="image_size[]" id="image_size"
                               class="form-control size @error("image_size") is-invalid @enderror">
                        @error("image_size")
                        <strong class="text-danger">{{ $errors->first("image_size") }}</strong>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-1">
                      <div class="form-group" style="margin-top:28px!important;display: flex">
                        <a class="btn btn-danger text-light hidden clear-file" id="clear-file" style="padding: 4px 2px; margin-right: 2px">
                          <i class="fa fa-trash-o"></i>
                        </a>
                        <a class="btn btn-secondary text-light add"><i class="fa fa-plus"></i></a>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="row submit-button mt-3">
                  <div class="col-md-12">
                    <label for="agree_upload"><input type="checkbox" id="agree_upload"> I, do hereby declare that I have uploaded all supporting documents.</label>
                  </div>
                  <div class="col-md-12">
                    <label for="agree_info"><input type="checkbox" id="agree_info"> I, do hereby agree that the above information is correct.</label>
                  </div>
                  <div class="col-md-12">
                    <label for="agree_cancel"><input type="checkbox" id="agree_cancel"> I, do hereby declare that, if the submitted information is found incorrect, competent
                      authority has the right to cancel my application at any stages of the selection process without any explanation.</label>
                  </div>
                  <input type="hidden" name="saveSubmit" value="save">
                  <div class="col-md-6 text-center">
                    @if($form && $form->status == 'save')
                      <button type="submit" class="btn btn-success btn-sm btn-block" id="saveBtn">Update as Draft</button>
                    @elseif($form && $form->status == 'submited')
                    @else
                      <button type="submit" class="btn btn-success btn-sm btn-block" id="saveBtn">Save as Draft</button>
                    @endif
                  </div>
                  @if(!($form && $form->status == 'submited'))
                    <div class="col-md-6 text-center">
                      <span type="button" class="btn btn-primary btn-sm btn-block" id="submitBtn" style="    background-color: #67a8e4;">Submit</span>
                      <small class="text-danger blink">Only once can be submitted</small>
                    </div>
                  @endif
                  @if($form)
                    <div class="col-md-12 mt-1 text-center">
                      <a href="{{ route('form.pdf', $form->id) }}" target="_blank" class="btn btn-info btn-sm btn-block">Download</a>
                    </div>
                  @endif
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>

  {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>--}}
  <script src="{{ asset('assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

  <script>

    $(document).ready(function () {
      let fileUploaded = false;
      $('#saveBtn').hover(function () {
        $('input[name="saveSubmit"]').val('save')
      })

      $('#submitBtn').click(function () {
        $('input[name="saveSubmit"]').val('submited')
        if (!$('#agree_upload').is(":checked") || !$('#agree_info').is(":checked") || !$('#agree_cancel').is(":checked")) {
          Swal.fire({
            title: 'Please accept the terms & conditions.',
            icon: 'warning',
          })
          return 0;
        }

        const files = '{{ $form?->files->count() }}';

        if(!(files > 0)){
          console.log('No file saved.')
          if(document.getElementById('image_upload').files.length === 0){
            Swal.fire({
              title: 'Please upload file.',
              icon: 'warning',
            })
            return 0;
            }
        }


        Swal.fire({
          title: 'Are you sure to submit?',
          text: "Only once can be submitted.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Submit!'
        }).then((result) => {
          if (result.value) {
            $('#ea-form').submit()
          }
        })

      })


      $(".yearPicker").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        startDate: '-200y',
        endDate: '+30y',
        autoclose: true
      });


      // Depend Division district upazila
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
            $("#upazila_id").html('');
            $('#upazila_id').html('<option value="">-- Select Upazila --</option>');
          }
        });
      });


      $('#district_id').change(function () {
        var idupazila = this.value;
        $("#upazila_id").html('');
        $.ajax({
          url: "{{url('api/fetch-upazilas')}}/" + idupazila,
          type: "GET",
          dataType: 'json',
          success: function (res) {
            $('#upazila_id').html('<option value="">-- Select Upazila --</option>');
            $.each(res.upazilas, function (key, value) {
              console.log(value)
              $("#upazila_id").append('<option value="' + value
                .id + '">' + value.name + '</option>');
            });
          }
        });
      });


      $('#idg_received_from_any_other_gob_project_or_budget').change(function () {
        checkIdgReceivedFormAnyOtherGobProjectOrBudget()
      });
      checkIdgReceivedFormAnyOtherGobProjectOrBudget()

      function checkIdgReceivedFormAnyOtherGobProjectOrBudget() {
        const check_idg = $('#idg_received_from_any_other_gob_project_or_budget').val();
        if (check_idg == 1) {
          $('.idg_received_from_gob_project_or_budget').show();
        } else {
          $('.idg_received_from_gob_project_or_budget').hide();
        }
      }

      $('#self_finance_at_least_15_of_the_cash').change(function () {
        const check_idg = $('#self_finance_at_least_15_of_the_cash').val();
        if (check_idg == 1) {
          $('.submit-button').show();
        } else {
          $('.submit-button').hide();
        }
      });

      $('.clear-file').click(function () {
        $('#image_upload').val('').change()
        $('#image_filename').val('')
        $('#image_type').val('')
        $('#image_size').val('')
        $('#clear-file').addClass('hidden')
      })

      //    multiple row crate

      /* Variables */
      var row = $(".attr");

      function addRow() {
        row.clone(true, true).appendTo("#attributes");
      }

      function removeRow(button) {
        button.closest("div.attr").remove();
      }

      $('#attributes .attr:first-child').find('.remove').hide();

      /* Doc ready */
      $(".add").on('click', function () {
        let content = `<div class="row child" >
            <div class="col-md 3">
                <div class="form-group">
                    <label for="image_upload">File Upload <span class="text-danger">*</span></label>
                    <input type="file" name="image_upload[]"
                         class="form-control">
                  </div>
              </div>
              <div class="col-md 3">
                  <div class="form-group">
                      <label for="image_type">File type <span class="text-danger">*</span></label>
                      <input type="text" name="image_type[]"
                             class="form-control type">
                  </div>
              </div>
              <div class="col-md 3">
                  <div class="form-group">
                      <label for="image_filename">File Description<span class="text-danger">*</span></label>
                      <input type="text" name="image_filename[]"
                             class="form-control filename">
                  </div>
              </div>
              <div class="col-md 2">
                  <div class="form-group">
                      <label for="image_size">Size <span class="text-danger">*</span></label>
                      <input type="text" name="image_size[]"
                             class="form-control size">
                  </div>
              </div>
              <div class="col-md-1">
                  <div class="form-group" style="margin-top:30px!important;">
                      <label for="image_size" ></label>
                    <span class="btn btn-danger child-remove"><i class="fa fa-trash-o"></i></span>
                  </div>
              </div>
          </div>`;
        $('#attributes').append(content)
      });


      $(document).on('click', '.child-remove', function () {
        $(this).closest('.child').remove()
      });

      $(document).on('change', 'input[type="file"]', function (e) {
        if (e.target.id === 'image_upload') {
          $('#clear-file').removeClass('hidden')
        }
        const filename = $(this)[0].files.length ? $(this)[0].files[0].name : "";
        var file_name_array = filename.split(".");
        var ext = file_name_array[file_name_array.length - 1];
        const size = Math.round($(this)[0].files.length ? ($(this)[0].files[0].size / 1024) : 0);
        $(this).closest('.child').find('.type').val('.' + ext)
        $(this).closest('.child').find('.type').attr('readonly', 'true')
        $(this).closest('.child').find('.filename').val(filename.split('.').slice(0, -1).join('.'))
        $(this).closest('.child').find('.size').val(size + ' KB')
        $(this).closest('.child').find('.size').attr('readonly', 'true')
      })
    });
  </script>
@endsection

@section('script')
  <script>
    $(document).ready(function () {
      $('#outcomes').summernote()
    })

  </script>
@endsection
