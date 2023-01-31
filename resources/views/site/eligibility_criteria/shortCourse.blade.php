@extends('layout.admin')

@section('stylesheet')
  <script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title mb-5">Eligibility Criteria for Short Course</h2>
              @if($form)
                <h4 class="text-right"><span class="btn btn-success btn-sm  mb-3">Total: {{ $form->mark }}</span></h4>
              @endif
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              <form role="form" method="post" id="ea-form" action="{{ route('eligibility.course.createOrStore') }}" enctype="multipart/form-data">
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
                        <option value="government" @selected(old("institute_type", $form ? $form->institute_type : '') == 'government')>Government</option>
                        <option value="private" @selected(old("institute_type", $form ? $form->institute_type : '') == 'private')>Private</option>
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
                        @foreach(\App\Models\EafShortCourse::$instituteTypes as $type)
                          <option
                            value="{{ $type }}" @selected(old("institute_category", $form ? $form->institute_category : "") == $type)>{{ $type }}</option>
                        @endforeach
                      </select>
                      @error("institute_category")
                      <strong class="text-danger">{{ $errors->first("institute_category") }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row">
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

                <div class="row mb-2">
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
                  <div class="col-sm-7">
                    <div class="form-group">
                      <label for="">Years of Institute Establishment<span class="text-danger">*</span></label>
                      <input type="text" name="years_of_institute_establishment" id="years_of_institute_establishment"
                             value="{{old("years_of_institute_establishment", $form ? $form->years_of_institute_establishment : '')}}"
                             placeholder="" required
                             class="form-control yearPicker @error('years_of_institute_establishment') is-invalid @enderror"
                      >
                      @error("years_of_institute_establishment")
                      <strong class="text-danger">{{ $errors->first("years_of_institute_establishment") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Condition</label>
                      <select name="years_of_institute_establishment_condition" id="years_of_institute_establishment_condition" disabled
                              class="form-control @error("years_of_institute_establishment_condition") is-invalid @enderror">
                        <option value="">Choose a type</option>
                        <option value="10">Established 9 years ago or more = 10 points</option>
                        <option value="8">Established 8 to 7 years = 8 points</option>
                        <option value="6">Established 6 to 5 years = 6 points</option>
                        <option value="0">Established 5 or less years = 0 point</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-grou">
                      <label for="">Score</label>
                      <input type="text"
                             readonly
                             name="years_of_institute_establishment_score" id="years_of_institute_establishment_score"
                             placeholder="0"
                             class="form-control @error('years_of_institute_establishment_score') is-invalid @enderror"
                      >
                      @error("years_of_institute_establishment_score")
                      <strong class="text-danger">{{ $errors->first("years_of_institute_establishment_score") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <script>
                    $(document).ready(function () {
                      // function create for- wordsheet serial number: 1, 2
                      $('#years_of_institute_establishment').change(function (e) {
                        checkEstablishAndRtoYear()
                      })

                      checkEstablishAndRtoYear()


                      function checkEstablishAndRtoYear() {
                        const currentDate = new Date();
                        const currentYear = parseInt(currentDate.getFullYear());
                        let year = $('#years_of_institute_establishment').val()
                        if (year < 1) {
                          year = currentYear;
                        }
                        $(`#years_of_institute_establishment_condition`).find('option[selected="selected"]').removeAttr('selected');

                        if ((currentYear - year) >= 9) {
                          $(`#years_of_institute_establishment_condition > option[value='10']`).removeAttr("disabled");
                          $(`#years_of_institute_establishment_condition > option[value='10']`).prop("selected", true);
                          $(`#years_of_institute_establishment_score`).val(10);
                          // console.log('est option = ', opt)
                          return 0;
                        } else if ((currentYear - year) >= 7) {
                          $(`#years_of_institute_establishment_condition > option[value='8']`).removeAttr("disabled");
                          $(`#years_of_institute_establishment_condition > option[value='8']`).prop("selected", true);
                          $(`#years_of_institute_establishment_score`).val(8);
                          // console.log('est option = ', opt)
                          return 0;
                        } else if ((currentYear - year) > 5) {
                          $(`#years_of_institute_establishment_condition > option[value='6']`).removeAttr("disabled");
                          $(`#years_of_institute_establishment_condition > option[value='6']`).prop("selected", true);
                          $(`#years_of_institute_establishment_score`).val(6);
                          // console.log('est option = ', opt)
                          return 0;
                        } else {
                          $(`#years_of_institute_establishment_condition > option[value='0']`).removeAttr("disabled");
                          $(`#years_of_institute_establishment_condition > option[value='0']`).prop("selected", true);
                          $(`#years_of_institute_establishment_score`).val(0);
                          // console.log('est option = ', opt)
                          return 0;
                        }
                      }
                    })
                  </script>
                </div>

                <div class="row bordered-p mb-3">
                  <div class="col-md-7">
                    <div class="form-group">
                      <label for="annual_intake">Annual Intake<span class="text-danger">*</span></label>
                      <input type="number" name="annual_intake"
                             id="annual_intake" required value="{{ old('annual_intake', $form ? $form->annual_intake : '') }}"
                             class="form-control @error("annual_intake") is-invalid @enderror"
                             placeholder="0">
                      @error("annual_intake")
                      <strong class="text-danger">{{ $errors->first("annual_intake") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="annual_intake_condition">Condition</label>
                      <select name="annual_intake_condition" disabled
                              id="annual_intake_condition"
                              class="form-control @error("annual_intake_condition") is-invalid @enderror">
                        <option value="">Choose a type</option>
                        <option value="10">Intake is 100 and above = 10 points</option>
                        <option value="8">Intake between 91-99 = 8 points</option>
                        <option value="6">Intake between 80-90 = 6 points</option>
                        <option value="0">Intake below 80</option>
                      </select>
                      @error("annual_intake_condition")
                      <strong
                        class="text-danger">{{ $errors->first("annual_intake_condition") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label for="annual_intake_score">Score</label>
                    <input type="number" name="annual_intake_score" readonly
                           id="annual_intake_score"
                           class="form-control @error("annual_intake_score") is-invalid @enderror"
                           placeholder="0">
                  </div>
                  <script>
                    $(document).ready(function () {
                      $('#annual_intake').change(function () {
                        checkTechnology()
                      })
                      checkTechnology()

                      function checkTechnology() {
                        const value = Number($('#annual_intake').val())

                        $("#annual_intake_condition").find('option[selected="selected"]').removeAttr('selected');
                        $("#annual_intake_condition").find('option').prop("selected", false);
                        $("#annual_intake_condition").find('option').attr('disabled', 'true');
                        $("#annual_intake_condition").val();
                        if (value >= 100) {
                          $('#annual_intake_score').val(10)
                          $("#annual_intake_condition").find('option[value="10"]').removeAttr("disabled");
                          $("#annual_intake_condition").find('option[value="10"]').prop("selected", true);
                          return null;
                        }
                        if (99 >= value && value >= 91) {
                          $('#annual_intake_score').val(8)
                          $("#annual_intake_condition").find('option[value="8"]').removeAttr("disabled");
                          $("#annual_intake_condition").find('option[value="8"]').prop("selected", true);
                          return null;
                        }
                        if (90 >= value && value >= 80) {
                          $('#annual_intake_score').val(6)
                          $("#annual_intake_condition").find('option[value="6"]').removeAttr("disabled");
                          $("#annual_intake_condition").find('option[value="6"]').prop("selected", true);
                          return null;
                        }
                        if (value <= 79) {
                          $('#annual_intake_score').val(0)
                          $("#annual_intake_condition").find('option[value="0"]').removeAttr("disabled");
                          $("#annual_intake_condition").find('option[value="0"]').prop("selected", true);
                          return null;
                        }
                      }
                    })
                  </script>
                </div>

                <div class="row bordered-p mb-3">
                  <div class="col-md-7">
                    <div class="form-group">
                      <label for="">Years of accreditation with BTEB/NSDA/Ministries <span class="text-danger">*</span></label>
                      <input type="text" name="years_of_accredited_with_bteb" id="years_of_accredited_with_bteb"
                             value="{{old("years_of_accredited_with_bteb", $form ? $form->years_of_accredited_with_bteb : '')}}"
                             placeholder="" required
                             class="form-control yearPicker @error('years_of_accredited_with_bteb') is-invalid @enderror"
                      >
                      @error("years_of_accredited_with_bteb")
                      <strong class="text-danger">{{ $errors->first("years_of_accredited_with_bteb") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Condition</label>
                      <select name="years_of_accredited_with_bteb_condition" id="years_of_accredited_with_bteb_condition" disabled
                              class="form-control @error("years_of_accredited_with_bteb_condition") is-invalid @enderror">
                        <option value="">Choose a type</option>
                        <option value="10">Established 6 years ago or more = 10 points</option>
                        <option value="8">Established 5 to 4 years = 8 points</option>
                        <option value="6">Established 3 years = 6 points</option>
                        <option value="0">Established 2 or fewer years = 0 point</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">Score</label>
                      <input type="text"
                             readonly
                             name="years_of_accredited_with_bteb_score" id="years_of_accredited_with_bteb_score"
                             placeholder="0"
                             class="form-control @error('years_of_accredited_with_bteb_score') is-invalid @enderror"
                      >
                      @error("years_of_accredited_with_bteb_score")
                      <strong class="text-danger">{{ $errors->first("years_of_accredited_with_bteb_score") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <script>
                    $(document).ready(function () {
                      // function create for- wordsheet serial number: 1, 2
                      $('#years_of_accredited_with_bteb').change(function (e) {
                        checkEstablishAndRtoYearBTEB()
                      })

                      checkEstablishAndRtoYearBTEB()


                      function checkEstablishAndRtoYearBTEB(e) {
                        const currentDate = new Date();
                        const currentYear = parseInt(currentDate.getFullYear());
                        let year = $(`#years_of_accredited_with_bteb`).val()
                        if (year < 1) {
                          year = currentYear;
                        }
                        $(`#years_of_accredited_with_bteb_condition`).find('option[selected="selected"]').removeAttr('selected');
                        if ((currentYear - year) >= 6) {
                          $(`#years_of_accredited_with_bteb_condition > option[value='10']`).removeAttr("disabled");
                          $(`#years_of_accredited_with_bteb_condition > option[value='10']`).prop("selected", true);
                          $(`#years_of_accredited_with_bteb_score`).val(10);
                          // console.log('est option = ', opt)
                          return 0;
                        } else if ((currentYear - year) >= 5) {
                          $(`#years_of_accredited_with_bteb_condition > option[value='8']`).removeAttr("disabled");
                          $(`#years_of_accredited_with_bteb_condition > option[value='8']`).prop("selected", true);
                          $(`#years_of_accredited_with_bteb_score`).val(8);
                          // console.log('est option = ', opt)
                          return 0;
                        } else if ((currentYear - year) >= 3) {
                          $(`#years_of_accredited_with_bteb_condition > option[value='6']`).removeAttr("disabled");
                          $(`#years_of_accredited_with_bteb_condition > option[value='6']`).prop("selected", true);
                          $(`#years_of_accredited_with_bteb_score`).val(6);
                          // console.log('est option = ', opt)
                          return 0;
                        } else {
                          $(`#years_of_accredited_with_bteb_condition > option[value='0']`).removeAttr("disabled");
                          $(`#years_of_accredited_with_bteb_condition > option[value='0']`).prop("selected", true);
                          $(`#years_of_accredited_with_bteb_score`).val(0);
                          // console.log('est option = ', opt)
                          return 0;
                        }
                      }
                    })
                  </script>
                </div>
                <div class="row bordered-p mb-3">
                  <div class="col-md-7">
                    <div class="form-group">
                      <label for="trades_of_short_course_conducted_by_the_institute">Number of trades of short course conducted by the Institute<span
                          class="text-danger">*</span></label>
                      <input type="number" name="trades_of_short_course_conducted_by_the_institute"
                             id="trades_of_short_course_conducted_by_the_institute" required
                             class="form-control @error("trades_of_short_course_conducted_by_the_institute") is-invalid @enderror"
                             placeholder="0"
                             value="{{ old('trades_of_short_course_conducted_by_the_institute', $form ? $form->trades_of_short_course_conducted_by_the_institute : '') }}">
                      @error("trades_of_short_course_conducted_by_the_institute")
                      <strong class="text-danger">{{ $errors->first("trades_of_short_course_conducted_by_the_institute") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="trades_of_short_course_conducted_by_the_institute_condition">Condition</label>
                      <select name="trades_of_short_course_conducted_by_the_institute_condition" disabled
                              id="trades_of_short_course_conducted_by_the_institute_condition"
                              class="form-control @error("trades_of_short_course_conducted_by_the_institute_condition") is-invalid @enderror">
                        <option value="">Condition</option>
                        <optgroup id="trades_of_short_course_conducted_by_the_institute_piht_condition">
                          <option value="10">Number is 5 or above = 10 points</option>
                          <option value="8">Number is 3 or 4 = 8 points</option>
                          <option value="6">Number is 2 = 6 points</option>
                          <option value="0">Number is lower than 2 = 0 points</option>
                        </optgroup>
                      </select>
                      @error("trades_of_short_course_conducted_by_the_institute_condition")
                      <strong
                        class="text-danger">{{ $errors->first("trades_of_short_course_conducted_by_the_institute_condition") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label for="trades_of_short_course_conducted_by_the_institute_score">Score</label>
                    <input type="number" name="trades_of_short_course_conducted_by_the_institute_score" readonly
                           id="trades_of_short_course_conducted_by_the_institute_score"
                           class="form-control @error("trades_of_short_course_conducted_by_the_institute_score") is-invalid @enderror"
                           placeholder="0">
                  </div>
                  <script>
                    $(document).ready(function () {
                      $('#trades_of_short_course_conducted_by_the_institute').change(function () {
                        checkTechnology()
                      })
                      checkTechnology()

                      function checkTechnology() {
                        const value = Number($('#trades_of_short_course_conducted_by_the_institute').val())

                        $("#trades_of_short_course_conducted_by_the_institute_condition").find('option[selected="selected"]').removeAttr('selected');
                        $("#trades_of_short_course_conducted_by_the_institute_condition").find('option').prop("selected", false);
                        $("#trades_of_short_course_conducted_by_the_institute_condition").find('option').attr('disabled', 'true');
                        $("#trades_of_short_course_conducted_by_the_institute_condition").val();
                        if (value >= 5) {
                          $('#trades_of_short_course_conducted_by_the_institute_score').val(10)
                          $("#trades_of_short_course_conducted_by_the_institute_condition > optgroup[id='trades_of_short_course_conducted_by_the_institute_piht_condition']").find('option[value="10"]').removeAttr("disabled");
                          $("#trades_of_short_course_conducted_by_the_institute_condition > optgroup[id='trades_of_short_course_conducted_by_the_institute_piht_condition']").find('option[value="10"]').prop("selected", true);
                          return null;
                        }
                        if (4 >= value && value >= 3) {
                          $('#trades_of_short_course_conducted_by_the_institute_score').val(8)
                          $("#trades_of_short_course_conducted_by_the_institute_condition > optgroup[id='trades_of_short_course_conducted_by_the_institute_piht_condition']").find('option[value="8"]').removeAttr("disabled");
                          $("#trades_of_short_course_conducted_by_the_institute_condition > optgroup[id='trades_of_short_course_conducted_by_the_institute_piht_condition']").find('option[value="8"]').prop("selected", true);
                          return null;
                        }
                        if (2 >= value && value > 1) {
                          $('#trades_of_short_course_conducted_by_the_institute_score').val(6)
                          $("#trades_of_short_course_conducted_by_the_institute_condition > optgroup[id='trades_of_short_course_conducted_by_the_institute_piht_condition']").find('option[value="6"]').removeAttr("disabled");
                          $("#trades_of_short_course_conducted_by_the_institute_condition > optgroup[id='trades_of_short_course_conducted_by_the_institute_piht_condition']").find('option[value="6"]').prop("selected", true);
                          return null;
                        }
                        if (value <= 1) {
                          $('#trades_of_short_course_conducted_by_the_institute_score').val(0)
                          $("#trades_of_short_course_conducted_by_the_institute_condition > optgroup[id='trades_of_short_course_conducted_by_the_institute_piht_condition']").find('option[value="0"]').removeAttr("disabled");
                          $("#trades_of_short_course_conducted_by_the_institute_condition > optgroup[id='trades_of_short_course_conducted_by_the_institute_piht_condition']").find('option[value="0"]').prop("selected", true);
                          return null;
                        }
                      }
                    })
                  </script>
                </div>

                <div class="row bordered-p mb-3">
                  <div class="col-md-7">
                    <div class="form-group">
                      <label for="completion_rate">Completion rate (%)<span class="text-danger">*</span></label>
                      <input type="number" name="completion_rate"
                             id="completion_rate" required value="{{ old('completion_rate', $form ? $form->completion_rate : '') }}"
                             class="form-control @error("completion_rate") is-invalid @enderror"
                             placeholder="0">
                      @error("completion_rate")
                      <strong class="text-danger">{{ $errors->first("completion_rate") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="completion_rate_condition">Condition</label>
                      <select name="completion_rate_condition" disabled
                              id="completion_rate_condition"
                              class="form-control @error("completion_rate_condition") is-invalid @enderror">
                        <option value="">Choose a type</option>
                        <optgroup id="completion_rate_piht_condition">
                          <option value="10">Percentage 90% or more = 10 points</option>
                          <option value="8">Percentage between 80%-89% = 8 points</option>
                          <option value="6">Percentage between 70%-79% = 6 points</option>
                          <option value="0">Percentage below 70% = 0 points</option>
                        </optgroup>
                      </select>
                      @error("completion_rate_condition")
                      <strong
                        class="text-danger">{{ $errors->first("completion_rate_condition") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label for="completion_rate_score">Score</label>
                    <input type="number" name="completion_rate_score" readonly
                           id="completion_rate_score"
                           class="form-control @error("completion_rate_score") is-invalid @enderror"
                           placeholder="0">
                  </div>
                  <script>
                    $(document).ready(function () {
                      $('#completion_rate').change(function () {
                        checkTechnology()
                      })
                      checkTechnology()

                      function checkTechnology() {
                        const value = Number($('#completion_rate').val())

                        $("#completion_rate_condition").find('option[selected="selected"]').removeAttr('selected');
                        $("#completion_rate_condition").find('option').prop("selected", false);
                        $("#completion_rate_condition").find('option').attr('disabled', 'true');
                        $("#completion_rate_condition").val();
                        if (value >= 90) {
                          $('#completion_rate_score').val(10)
                          $("#completion_rate_condition > optgroup[id='completion_rate_piht_condition']").find('option[value="10"]').removeAttr("disabled");
                          $("#completion_rate_condition > optgroup[id='completion_rate_piht_condition']").find('option[value="10"]').prop("selected", true);
                          return null;
                        }
                        if (89 >= value && value >= 80) {
                          $('#completion_rate_score').val(8)
                          $("#completion_rate_condition > optgroup[id='completion_rate_piht_condition']").find('option[value="8"]').removeAttr("disabled");
                          $("#completion_rate_condition > optgroup[id='completion_rate_piht_condition']").find('option[value="8"]').prop("selected", true);
                          return null;
                        }
                        if (79 >= value && value >= 70) {
                          $('#completion_rate_score').val(6)
                          $("#completion_rate_condition > optgroup[id='completion_rate_piht_condition']").find('option[value="6"]').removeAttr("disabled");
                          $("#completion_rate_condition > optgroup[id='completion_rate_piht_condition']").find('option[value="6"]').prop("selected", true);
                          return null;
                        }
                        if (value < 70) {
                          $('#completion_rate_score').val(0)
                          $("#completion_rate_condition > optgroup[id='completion_rate_piht_condition']").find('option[value="0"]').removeAttr("disabled");
                          $("#completion_rate_condition > optgroup[id='completion_rate_piht_condition']").find('option[value="0"]').prop("selected", true);
                          return null;
                        }
                      }
                    })
                  </script>
                </div>

                <div class="row bordered-p mb-3">
                  <div class="col-md-7">
                    <div class="form-group">
                      <label for="trade_wise_no_of_trainer_instructor">Trade wise no. of trainer/instructor for short course facilitation<span class="text-danger">*</span></label>
                      <input type="number" name="trade_wise_no_of_trainer_instructor"
                             id="trade_wise_no_of_trainer_instructor" required
                             value="{{ old('trade_wise_no_of_trainer_instructor', $form ? $form->trade_wise_no_of_trainer_instructor : '') }}"
                             class="form-control @error("trade_wise_no_of_trainer_instructor") is-invalid @enderror"
                             placeholder="0">
                      @error("trade_wise_no_of_trainer_instructor")
                      <strong class="text-danger">{{ $errors->first("trade_wise_no_of_trainer_instructor") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="trade_wise_no_of_trainer_instructor_condition">Condition
                      </label>
                      <select name="trade_wise_no_of_trainer_instructor_condition" disabled
                              id="trade_wise_no_of_trainer_instructor_condition"
                              class="form-control @error("trade_wise_no_of_trainer_instructor_condition") is-invalid @enderror">
                        <option value="">Choose a type</option>
                        <optgroup id="trade_wise_no_of_trainer_instructor_condition">
                          <option value="10">Number is 3 or above = 10 points</option>
                          <option value="8">Number is 2 = 8 points</option>
                          <option value="6">Number is 1 = 6 points</option>
                          <option value="0">Number below 1 = 0 points</option>
                        </optgroup>
                      </select>
                      @error("trade_wise_no_of_trainer_instructor_condition")
                      <strong
                        class="text-danger">{{ $errors->first("trade_wise_no_of_trainer_instructor_condition") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label for="trade_wise_no_of_trainer_instructor_score">Score</label>
                    <input type="number" name="trade_wise_no_of_trainer_instructor_score"
                           id="trade_wise_no_of_trainer_instructor_score" readonly
                           class="form-control"
                           placeholder="0">
                  </div>
                </div>
                <script>
                  $(document).ready(function () {
                    $('#trade_wise_no_of_trainer_instructor').change(function () {
                      trade_wise_no_of_trainer_instructor()
                    })
                    trade_wise_no_of_trainer_instructor()

                    function trade_wise_no_of_trainer_instructor() {
                      $("#trade_wise_no_of_trainer_instructor_condition").find('option[selected="selected"]').removeAttr('selected');
                      $("#trade_wise_no_of_trainer_instructor_condition").find('option').prop("selected", false);
                      $("#trade_wise_no_of_trainer_instructor_condition").find('option').attr('disabled', 'true');
                      $("#trade_wise_no_of_trainer_instructor_condition").val();
                      const value = $('#trade_wise_no_of_trainer_instructor').val();
                      if (value >= 3) {
                        $('#trade_wise_no_of_trainer_instructor_score').val(10)
                        $("#trade_wise_no_of_trainer_instructor_condition").find('option[value="10"]').removeAttr("disabled");
                        $("#trade_wise_no_of_trainer_instructor_condition").find('option[value="10"]').prop("selected", true);
                        return null;
                      }
                      if (value == 2) {
                        $('#trade_wise_no_of_trainer_instructor_score').val(8)
                        $("#trade_wise_no_of_trainer_instructor_condition").find('option[value="8"]').removeAttr("disabled");
                        $("#trade_wise_no_of_trainer_instructor_condition").find('option[value="8"]').prop("selected", true);
                        return null;
                      }
                      if (value == 1) {
                        $('#trade_wise_no_of_trainer_instructor_score').val(6)
                        $("#trade_wise_no_of_trainer_instructor_condition").find('option[value="6"]').removeAttr("disabled");
                        $("#trade_wise_no_of_trainer_instructor_condition").find('option[value="6"]').prop("selected", true);
                        return null;
                      }
                      if (value < 1) {
                        $('#trade_wise_no_of_trainer_instructor_score').val(0)
                        $("#trade_wise_no_of_trainer_instructor_condition").find('option[value="0"]').removeAttr("disabled");
                        $("#trade_wise_no_of_trainer_instructor_condition").find('option[value="0"]').prop("selected", true);
                        return null;
                      }
                    }
                  })
                </script>

                <div class="row bordered-p mb-3">
                  <div class="col-md-7">
                    <div class="form-group">
                      <label for="workshop_with_training_equipment_as_per_cs">Workshops equipped with training equipment as per CS are available<span
                          class="text-danger">*</span></label>
                      <select name="workshop_with_training_equipment_as_per_cs" id="workshop_with_training_equipment_as_per_cs" required
                              class="form-control @error("workshop_with_training_equipment_as_per_cs") is-invalid @enderror">
                        <option value="">Choose an option</option>
                        <option value="yes" @selected(old('workshop_with_training_equipment_as_per_cs', $form ? $form->workshop_with_training_equipment_as_per_cs : '') == 'yes')>
                          Yes
                        </option>
                        <option value="no" @selected(old('workshop_with_training_equipment_as_per_cs', $form ? $form->workshop_with_training_equipment_as_per_cs : '') == 'no')>No
                        </option>
                      </select>
                      @error("workshop_with_training_equipment_as_per_cs")
                      <strong class="text-danger">{{ $errors->first("workshop_with_training_equipment_as_per_cs") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="workshop_with_training_equipment_as_per_cs_condition">Condition
                      </label>
                      <select name="workshop_with_training_equipment_as_per_cs_condition" disabled
                              id="workshop_with_training_equipment_as_per_cs_condition"
                              class="form-control @error("workshop_with_training_equipment_as_per_cs_condition") is-invalid @enderror">
                        <option value="">Choose an option</option>
                        <option value="10">Yes = 10 points</option>
                        <option value="0">No = 0 points</option>
                      </select>
                      @error("workshop_with_training_equipment_as_per_cs_condition")
                      <strong
                        class="text-danger">{{ $errors->first("workshop_with_training_equipment_as_per_cs_condition") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label for="workshop_with_training_equipment_as_per_cs_score">Score</label>
                    <input type="number" name="workshop_with_training_equipment_as_per_cs_score"
                           id="workshop_with_training_equipment_as_per_cs_score" readonly
                           class="form-control"
                           placeholder="0">
                  </div>
                </div>
                <script>
                  $(document).ready(function () {
                    $('#workshop_with_training_equipment_as_per_cs').change(function () {
                      workshop_with_training_equipment_as_per_cs()
                    })
                    workshop_with_training_equipment_as_per_cs()

                    function workshop_with_training_equipment_as_per_cs() {
                      let value = $('#workshop_with_training_equipment_as_per_cs').val()
                      $("#workshop_with_training_equipment_as_per_cs_condition").find('option[selected="selected"]').removeAttr('selected');
                      $("#workshop_with_training_equipment_as_per_cs_condition").find('option').prop("selected", false);
                      $("#workshop_with_training_equipment_as_per_cs_condition").find('option').attr('disabled', 'true');
                      $("#workshop_with_training_equipment_as_per_cs_condition").val();
                      if (value === 'yes') {
                        $('#workshop_with_training_equipment_as_per_cs_score').val(10)
                        $("#workshop_with_training_equipment_as_per_cs_condition").find('option[value="10"]').removeAttr("disabled");
                        $("#workshop_with_training_equipment_as_per_cs_condition").find('option[value="10"]').prop("selected", true);
                        return null;
                      } else {
                        $('#workshop_with_training_equipment_as_per_cs_score').val(0)
                        $("#workshop_with_training_equipment_as_per_cs_condition").find('option[value="0"]').removeAttr("disabled");
                        $("#workshop_with_training_equipment_as_per_cs_condition").find('option[value="0"]').prop("selected", true);
                        return null;
                      }
                    }
                  })
                </script>
                <div class="row bordered-p mb-3">
                  <div class="col-md-7">
                    <div class="form-group">
                      <label for="existence_of_job_placement_cell">Existence of job placement cell<span class="text-danger">*</span></label>
                      <select name="existence_of_job_placement_cell" id="existence_of_job_placement_cell" required
                              class="form-control @error("existence_of_job_placement_cell") is-invalid @enderror">
                        <option value="">Choose an option</option>
                        <option value="yes" @selected(old('existence_of_job_placement_cell', $form ? $form->existence_of_job_placement_cell : '') == 'yes')>Yes</option>
                        <option value="no" @selected(old('existence_of_job_placement_cell', $form ? $form->existence_of_job_placement_cell : '') == 'no')>No</option>
                      </select>
                      @error("existence_of_job_placement_cell")
                      <strong class="text-danger">{{ $errors->first("existence_of_job_placement_cell") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="existence_of_job_placement_cell_condition">Condition
                      </label>
                      <select name="existence_of_job_placement_cell_condition" disabled
                              id="existence_of_job_placement_cell_condition"
                              class="form-control @error("existence_of_job_placement_cell_condition") is-invalid @enderror">
                        <option value="">Choose a type</option>
                        <option value="10">Yes = 10 points</option>
                        <option value="0">No = 0 points</option>
                      </select>
                      @error("existence_of_job_placement_cell_condition")
                      <strong
                        class="text-danger">{{ $errors->first("existence_of_job_placement_cell_condition") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label for="existence_of_job_placement_cell_score">Score</label>
                    <input type="number" name="existence_of_job_placement_cell_score" id="existence_of_job_placement_cell_score" readonly
                           class="form-control"
                           placeholder="0">
                  </div>
                </div>
                <script>
                  $(document).ready(function () {
                    $('#existence_of_job_placement_cell').change(function () {
                      existence_of_job_placement_cell()
                    })
                    existence_of_job_placement_cell()

                    function existence_of_job_placement_cell() {
                      $("#existence_of_job_placement_cell_condition").find('option[selected="selected"]').removeAttr('selected');
                      $("#existence_of_job_placement_cell_condition").find('option').prop("selected", false);
                      $("#existence_of_job_placement_cell_condition").find('option').attr('disabled', 'true');
                      $("#existence_of_job_placement_cell_condition").val();
                      if ($('#existence_of_job_placement_cell').val() == 'yes') {
                        $('#existence_of_job_placement_cell_score').val(10)
                        $("#existence_of_job_placement_cell_condition").find('option[value="10"]').removeAttr("disabled");
                        $("#existence_of_job_placement_cell_condition").find('option[value="10"]').prop("selected", true);
                        return null;
                      } else {
                        $('#existence_of_job_placement_cell_score').val(0)
                        $("#existence_of_job_placement_cell_condition").find('option[value="0"]').removeAttr("disabled");
                        $("#existence_of_job_placement_cell_condition").find('option[value="0"]').prop("selected", true);
                        return null;
                      }
                    }
                  })
                </script>
                <div class="row bordered-p mb-3">
                  <div class="col-md-7">
                    <div class="form-group">
                      <label for="provision_of_occupational_health_safety">Provision of Occupational Health & Safety(OHS)<span class="text-danger">*</span></label>
                      <select name="provision_of_occupational_health_safety" id="provision_of_occupational_health_safety" required
                              class="form-control @error("provision_of_occupational_health_safety") is-invalid @enderror">
                        <option value="">Choose an option</option>
                        <option value="yes" @selected(old('provision_of_occupational_health_safety', $form ? $form->provision_of_occupational_health_safety : '') == 'yes')>Yes
                        </option>
                        <option value="no" @selected(old('provision_of_occupational_health_safety', $form ? $form->provision_of_occupational_health_safety : '') == 'no')>No
                        </option>
                      </select>
                      @error("provision_of_occupational_health_safety")
                      <strong class="text-danger">{{ $errors->first("provision_of_occupational_health_safety") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="provision_of_occupational_health_safety_condition">Condition
                      </label>
                      <select name="provision_of_occupational_health_safety_condition" disabled
                              id="provision_of_occupational_health_safety_condition"
                              class="form-control @error("provision_of_occupational_health_safety_condition") is-invalid @enderror">
                        <option value="">Choose a type</option>
                        <option value="10">Yes = 10 points</option>
                        <option value="0">No = 0 points</option>
                      </select>
                      @error("provision_of_occupational_health_safety_condition")
                      <strong
                        class="text-danger">{{ $errors->first("provision_of_occupational_health_safety_condition") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label for="provision_of_occupational_health_safety_score">Score</label>
                    <input type="number" name="provision_of_occupational_health_safety_score" id="provision_of_occupational_health_safety_score" readonly
                           class="form-control"
                           placeholder="0">
                  </div>
                </div>
                <script>
                  $(document).ready(function () {
                    $('#provision_of_occupational_health_safety').change(function () {
                      provision_of_occupational_health_safety()
                    })
                    provision_of_occupational_health_safety()

                    function provision_of_occupational_health_safety() {
                      $("#provision_of_occupational_health_safety_condition").find('option[selected="selected"]').removeAttr('selected');
                      $("#provision_of_occupational_health_safety_condition").find('option').prop("selected", false);
                      $("#provision_of_occupational_health_safety_condition").find('option').attr('disabled', 'true');
                      $("#provision_of_occupational_health_safety_condition").val();
                      if ($('#provision_of_occupational_health_safety').val() == 'yes') {
                        $('#provision_of_occupational_health_safety_score').val(10)
                        $("#provision_of_occupational_health_safety_condition").find('option[value="10"]').removeAttr("disabled");
                        $("#provision_of_occupational_health_safety_condition").find('option[value="10"]').prop("selected", true);
                        return null;
                      } else {
                        $('#provision_of_occupational_health_safety_score').val(0)
                        $("#provision_of_occupational_health_safety_condition").find('option[value="0"]').removeAttr("disabled");
                        $("#provision_of_occupational_health_safety_condition").find('option[value="0"]').prop("selected", true);
                        return null;
                      }
                    }
                  })
                </script>

                <div class="row bordered-p mb-3">
                  <div class="col-md-7">
                    <div class="form-group">
                      <label for="existence_of_employment_track_record">Existence of employment track record (No of Year)<span class="text-danger">*</span></label>
                      <input type="number" name="existence_of_employment_track_record"
                             id="existence_of_employment_track_record" required
                             value="{{ old('existence_of_employment_track_record', $form ? $form->existence_of_employment_track_record : '') }}"
                             class="form-control @error("existence_of_employment_track_record") is-invalid @enderror"
                             placeholder="0">
                      @error("existence_of_employment_track_record")
                      <strong class="text-danger">{{ $errors->first("existence_of_employment_track_record") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="existence_of_employment_track_record_condition">Condition</label>
                      <select name="existence_of_employment_track_record_condition" disabled
                              id="existence_of_employment_track_record_condition"
                              class="form-control @error("existence_of_employment_track_record_condition") is-invalid @enderror">
                        <option value="">Choose a type</option>
                        <option value="10">Record is 5 or more = 10 points</option>
                        <option value="8">Record is 4 = 8 points</option>
                        <option value="6">Record is 3 = 6 points</option>
                        <option value="4">Record is 2 = 4 points</option>
                        <option value="2">Record is 1 = 2 points</option>
                      </select>
                      @error("existence_of_employment_track_record_condition")
                      <strong
                        class="text-danger">{{ $errors->first("existence_of_employment_track_record_condition") }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label for="existence_of_employment_track_record_score">Score</label>
                    <input type="number" name="existence_of_employment_track_record_score" readonly
                           id="existence_of_employment_track_record_score"
                           class="form-control @error("existence_of_employment_track_record_score") is-invalid @enderror"
                           placeholder="0">
                  </div>
                  <script>
                    $(document).ready(function () {
                      $('#existence_of_employment_track_record').change(function () {
                        checkTechnology()
                      })
                      checkTechnology()

                      function checkTechnology() {
                        const cate = $('#institute_category').val()
                        const value = Number($('#existence_of_employment_track_record').val())

                        $("#existence_of_employment_track_record_condition").find('option[selected="selected"]').removeAttr('selected');
                        $("#existence_of_employment_track_record_condition").find('option').prop("selected", false);
                        $("#existence_of_employment_track_record_condition").find('option').attr('disabled', 'true');
                        $("#existence_of_employment_track_record_condition").val();
                        if (value >= 5) {
                          $('#existence_of_employment_track_record_score').val(10)
                          $("#existence_of_employment_track_record_condition").find('option[value="10"]').removeAttr("disabled");
                          $("#existence_of_employment_track_record_condition").find('option[value="10"]').prop("selected", true);
                          return null;
                        } else {
                          var points = value * 2;
                          $('#existence_of_employment_track_record_score').val(points)
                          $("#existence_of_employment_track_record_condition").find(`option[value="${points}"]`).removeAttr("disabled");
                          $("#existence_of_employment_track_record_condition").find(`option[value="${points}"]`).prop("selected", true);
                          return null;
                        }
                      }
                    })
                  </script>
                </div>


                <div class="row parent-area parent-area1">
                  @if(count(old('coi_course_title', [])) > 0)
                    @foreach(old('coi_course_title', []) as $j => $oldOoi)
                      <div class="col-md-12 single-area single-area1">
                        <h5>COURSE OFFERING INFORMATION</h5>
                        <i class="fa fa-minus minus-btn minus-btn1 action-btn" title="remove"></i>
                        <i class="fa fa-plus add-btn add-btn1 action-btn" title="add"></i>
                        <input type="hidden" name="coi_course_id[]" value="">
                        <div class="row child">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="">Course title</label>
                              <input type="text" alt=""
                                     name="coi_course_title[]"
                                     value="{{ old('coi_course_title')[$j] }}"
                                     class="form-control"
                                     required>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="" class="imageType">Year of the Course was
                                initiated <span class="text-danger">*</span></label>
                              <input type="text" name="coi_year_of_initiated[]"
                                     value="{{ old('coi_year_of_initiated')[$j] }}"
                                     class="form-control yearPicker type ">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="">Course Duration</label>
                              <input type="text" name="coi_course_duration[]"
                                     value="{{ old('coi_course_duration')[$j] }}"
                                     class="form-control filename ">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="">Intake capacity per cycle</label>
                              <input type="text" name="coi_intake_capacity_per_cycle[]"
                                     value="{{ old('coi_intake_capacity_per_cycle')[$j] }}"
                                     class="form-control filename ">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="">No. of trainees trained in 2021</label>
                              <input type="number" name="coi_trained_trainee_in2021[]"
                                     value="{{ old('coi_trained_trainee_in2021')[$j] }}"
                                     class="form-control filename ">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="">No. of teachers</label>
                              <input type="number" name="coi_number_of_teacher[]"
                                     value="{{ old('coi_number_of_teacher')[$j] }}"
                                     class="form-control filename ">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="">Is the Course competency-based<span
                                  class="text-danger">*</span>
                              </label>
                              <select
                                name="coi_course_competency_based[]"

                                class="form-control">
                                <option value="">Choose a type</option>
                                <option @selected(old('coi_course_competency_based')[$j] == 0 ) value="0">Yes</option>
                                <option @selected(old('coi_course_competency_based')[$j] == 1 ) value="1">No</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="">NTVQF /other equivalent framework adopted by the government Level<span class="text-danger">*</span></label>
                              <select
                                name="coi_adopted_framework[]"

                                class="form-control ">
                                <option value="">Choose a type</option>
                                <option @selected(strtoupper(old('coi_adopted_framework')[$j]) == 'NTVQF') value="NTVQF">NTVQF</option>
                                <option @selected(strtoupper(old('coi_adopted_framework')[$j]) == 'BNQF') value="BNQF">BNQF</option>
                                <option @selected(strtoupper(old('coi_adopted_framework')[$j]) == 'OTHERS') value="OTHERS">Others</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label for="">Accredited by?<span
                                  class="text-danger">*</span></label>
                              <select
                                name="coi_accredited_by[]"
                                class="form-control">
                                <option value="">Choose a type</option>
                                <option @selected(strtoupper(old('coi_accredited_by')[$j]) == "BTEB") value="BTEB">BTEB</option>
                                <option @selected(strtoupper(old('coi_accredited_by')[$j]) == "NSDA") value="NSDA">NSDA</option>
                                <option @selected(strtoupper(old('coi_accredited_by')[$j]) == "BTEB & NSDA") value="BTEB & NSDA">BTEB & NSDA</option>
                                <option @selected(strtoupper(old('coi_accredited_by')[$j]) == "MINISTRY") value="MINISTRY">Ministry</option>
                                <option @selected(strtoupper(old('coi_accredited_by')[$j]) == "OTHERS") value="OTHERS">Others</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  @endif
                  @foreach($form ? $form->cois : [] as $ooi)
                    <div class="col-md-12 single-area single-area1">
                      <h5>COURSE OFFERING INFORMATION</h5>
                      <i class="fa fa-minus minus-btn minus-btn1 action-btn" data-id="{{ $ooi->id }}"  title="remove"></i>
                      <i class="fa fa-plus add-btn add-btn1 action-btn" title="add"></i>
                      <input type="hidden" name="coi_course_id[]" value="{{ $ooi->id }}">
                      <div class="row child">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Course title</label>
                            <input type="text" alt=""
                                   name="coi_course_title[]"
                                   value="{{ $ooi->coi_course_title }}"
                                   class="form-control"
                                   required>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="" class="imageType">Year of the Course was
                              initiated <span class="text-danger">*</span></label>
                            <input type="text" name="coi_year_of_initiated[]"
                                   value="{{ $ooi->coi_year_of_initiated }}"
                                   class="form-control yearPicker type ">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Course Duration</label>
                            <input type="text" name="coi_course_duration[]"
                                   value="{{ $ooi->coi_course_duration }}"
                                   class="form-control filename ">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Intake capacity per cycle</label>
                            <input type="text" name="coi_intake_capacity_per_cycle[]"
                                   value="{{ $ooi->coi_intake_capacity_per_cycle }}"
                                   class="form-control filename ">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">No. of trainees trained in 2021</label>
                            <input type="number" name="coi_trained_trainee_in2021[]"
                                   value="{{ $ooi->coi_trained_trainee_in2021 }}"
                                   class="form-control filename ">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">No. of teachers</label>
                            <input type="number" name="coi_number_of_teacher[]"
                                   value="{{ $ooi->coi_number_of_teacher }}"
                                   class="form-control filename ">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Is the Course competency-based<span
                                class="text-danger">*</span>
                            </label>
                            <select
                              name="coi_course_competency_based[]"

                              class="form-control">
                              <option value="">Choose a type</option>
                              <option @selected($ooi->coi_course_competency_based == 0 ) value="0">Yes</option>
                              <option @selected($ooi->coi_course_competency_based == 1 ) value="1">No</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">NTVQF /other equivalent framework adopted by the government Level<span class="text-danger">*</span></label>
                            <select
                              name="coi_adopted_framework[]"

                              class="form-control ">
                              <option value="">Choose a type</option>
                              <option @selected(strtoupper($ooi->coi_adopted_framework) == 'NTVQF') value="NTVQF">NTVQF</option>
                              <option @selected(strtoupper($ooi->coi_adopted_framework) == 'BNQF') value="BNQF">BNQF</option>
                              <option @selected(strtoupper($ooi->coi_adopted_framework) == 'OTHERS') value="OTHERS">Others</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="">Accredited by?<span
                                class="text-danger">*</span></label>
                            <select
                              name="coi_accredited_by[]"
                              class="form-control">
                              <option value="">Choose a type</option>
                              <option @selected(strtoupper($ooi->coi_accredited_by) == "BTEB") value="BTEB">BTEB</option>
                              <option @selected(strtoupper($ooi->coi_accredited_by) == "NSDA") value="NSDA">NSDA</option>
                              <option @selected(strtoupper($ooi->coi_accredited_by) == "BTEB & NSDA") value="BTEB & NSDA">BTEB & NSDA</option>
                              <option @selected(strtoupper($ooi->coi_accredited_by) == "MINISTRY") value="MINISTRY">Ministry</option>
                              <option @selected(strtoupper($ooi->coi_accredited_by) == "OTHERS") value="OTHERS">Others</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                  @if(!$form && count(old('coi_course_title', [])) < 1)
                    <div class="col-md-12 single-area single-area1">
                      <h5>COURSE OFFERING INFORMATION</h5>
                      <i class="fa fa-plus add-btn add-btn1 action-btn" title="add"></i>
                      <input type="hidden" name="coi_course_id[]" value="">
                      <div class="row child">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Course title</label>
                            <input type="text" alt=""
                                   name="coi_course_title[]"
                                   class="form-control @error('coi_course_title') is-invalid @enderror"
                                   required>
                            @error('coi_course_title')
                            <strong
                              class="text-danger">{{ $errors->first('coi_course_title') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="" class="imageType">Year of the Course was
                              initiated <span class="text-danger">*</span></label>
                            <input type="text" name="coi_year_of_initiated[]"
                                   class="form-control yearPicker type @error('coi_year_of_initiated') is-invalid @enderror">
                            @error('coi_year_of_initiated')
                            <strong
                              class="text-danger">{{ $errors->first('coi_year_of_initiated') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Course Duration</label>
                            <input type="text" name="coi_course_duration[]"
                                   class="form-control filename @error('coi_course_duration') is-invalid @enderror">
                            @error('coi_course_duration')
                            <strong
                              class="text-danger">{{ $errors->first('coi_course_duration') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Intake capacity per cycle</label>
                            <input type="text" name="coi_intake_capacity_per_cycle[]"
                                   class="form-control filename @error('coi_intake_capacity_per_cycle') is-invalid @enderror">
                            @error('coi_intake_capacity_per_cycle')
                            <strong
                              class="text-danger">{{ $errors->first('coi_intake_capacity_per_cycle') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">No. of trainees trained in 2021</label>
                            <input type="number" name="coi_trained_trainee_in2021[]"
                                   class="form-control filename @error('coi_trained_trainee_in2021') is-invalid @enderror">
                            @error('coi_trained_trainee_in2021')
                            <strong
                              class="text-danger">{{ $errors->first('coi_trained_trainee_in2021') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">No. of teachers</label>
                            <input type="number" name="coi_number_of_teacher[]"
                                   class="form-control filename @error('coi_number_of_teacher') is-invalid @enderror">
                            @error('coi_number_of_teacher')
                            <strong
                              class="text-danger">{{ $errors->first('coi_number_of_teacher') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Is the Course competency-based<span
                                class="text-danger">*</span>
                            </label>
                            <select
                              name="coi_course_competency_based[]"

                              class="form-control @error('coi_course_competency_based') is-invalid @enderror">
                              <option value="">Choose a type</option>
                              <option value="0">Yes</option>
                              <option value="1">No</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">NTVQF /other equivalent framework adopted by the government Level<span class="text-danger">*</span></label>
                            <select
                              name="coi_adopted_framework[]"

                              class="form-control @error('coi_adopted_framework') is-invalid @enderror">
                              <option value="">Choose a type</option>
                              <option value="NTVQF">NTVQF</option>
                              <option value="BNQF">BNQF</option>
                              <option value="OTHERS">Others</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="">Accredited by?<span
                                class="text-danger">*</span></label>
                            <select
                              name="coi_accredited_by[]"

                              class="form-control @error('coi_accredited_by') is-invalid @enderror">
                              <option value="">Choose a type</option>
                              <option value="BTEB">BTEB</option>
                              <option value="NSDA">NSDA</option>
                              <option value="BTEB & NSDA">BTEB & NSDA</option>
                              <option value="MINISTRY">Ministry</option>
                              <option value="OTHERS">Others</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
                  @if($form && count($form->cois) < 1)
                    <div class="col-md-12 single-area single-area1">
                      <h5>COURSE OFFERING INFORMATION</h5>
                      <i class="fa fa-plus add-btn add-btn1 action-btn" title="add"></i>
                      <input type="hidden" name="coi_course_id[]" value="">
                      <div class="row child">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Course title</label>
                            <input type="text" alt=""
                                   name="coi_course_title[]"
                                   class="form-control @error('coi_course_title') is-invalid @enderror"
                                   required>
                            @error('coi_course_title')
                            <strong
                              class="text-danger">{{ $errors->first('coi_course_title') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="" class="imageType">Year of the Course was
                              initiated <span class="text-danger">*</span></label>
                            <input type="text" name="coi_year_of_initiated[]"
                                   class="form-control yearPicker type @error('coi_year_of_initiated') is-invalid @enderror">
                            @error('coi_year_of_initiated')
                            <strong
                              class="text-danger">{{ $errors->first('coi_year_of_initiated') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Course Duration</label>
                            <input type="text" name="coi_course_duration[]"
                                   class="form-control filename @error('coi_course_duration') is-invalid @enderror">
                            @error('coi_course_duration')
                            <strong
                              class="text-danger">{{ $errors->first('coi_course_duration') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Intake capacity per cycle</label>
                            <input type="text" name="coi_intake_capacity_per_cycle[]"
                                   class="form-control filename @error('coi_intake_capacity_per_cycle') is-invalid @enderror">
                            @error('coi_intake_capacity_per_cycle')
                            <strong
                              class="text-danger">{{ $errors->first('coi_intake_capacity_per_cycle') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">No. of trainees trained in 2021</label>
                            <input type="number" name="coi_trained_trainee_in2021[]"
                                   class="form-control filename @error('coi_trained_trainee_in2021') is-invalid @enderror">
                            @error('coi_trained_trainee_in2021')
                            <strong
                              class="text-danger">{{ $errors->first('coi_trained_trainee_in2021') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">No. of teachers</label>
                            <input type="number" name="coi_number_of_teacher[]"
                                   class="form-control filename @error('coi_number_of_teacher') is-invalid @enderror">
                            @error('coi_number_of_teacher')
                            <strong
                              class="text-danger">{{ $errors->first('coi_number_of_teacher') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Is the Course competency-based<span
                                class="text-danger">*</span>
                            </label>
                            <select
                              name="coi_course_competency_based[]"

                              class="form-control @error('coi_course_competency_based') is-invalid @enderror">
                              <option value="">Choose a type</option>
                              <option value="0">Yes</option>
                              <option value="1">No</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">NTVQF /other equivalent framework adopted by the government Level<span class="text-danger">*</span></label>
                            <select
                              name="coi_adopted_framework[]"

                              class="form-control @error('coi_adopted_framework') is-invalid @enderror">
                              <option value="">Choose a type</option>
                              <option value="NTVQF">NTVQF</option>
                              <option value="BNQF">BNQF</option>
                              <option value="OTHERS">Others</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="">Accredited by?<span
                                class="text-danger">*</span></label>
                            <select
                              name="coi_accredited_by[]"

                              class="form-control @error('coi_accredited_by') is-invalid @enderror">
                              <option value="">Choose a type</option>
                              <option value="BTEB">BTEB</option>
                              <option value="NSDA">NSDA</option>
                              <option value="BTEB & NSDA">BTEB & NSDA</option>
                              <option value="MINISTRY">Ministry</option>
                              <option value="OTHERS">Others</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
                </div>


                <h5 class="admin-form-sub-header mt-3">OTHER INFORMATION</h5>
                <div class="row bordered-p mb-4">
                  <div class="col-md-12">
                    <h2 class="group-title">2019</h2>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Total Number of Enrolled Trainees <span
                          class="text-danger">*</span></label>
                      <input type="number" name="oi_enrolled_trainees_2019"
                             id="oi_enrolled_trainees_2019"
                             value="{{ old('oi_enrolled_trainees_2019', $form ? $form->oi_enrolled_trainees_2019 : '') }}" placeholder=""
                             class="form-control @error('oi_enrolled_trainees_2019') is-invalid @enderror">
                      @error('oi_enrolled_trainees_2019')
                      <strong
                        class="text-danger">{{ $errors->first('oi_enrolled_trainees_2019') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Out of the above, the number of female trainees<span
                          class="text-danger">*</span></label>
                      <input type="number" name="oi_female_trainee_2019"
                             id="oi_female_trainee_2019"
                             value="{{ old('oi_female_trainee_2019', $form ? $form->oi_female_trainee_2019 : '') }}" placeholder=""
                             class="form-control @error('oi_female_trainee_2019') is-invalid @enderror">
                      @error('oi_female_trainee_2019')
                      <strong
                        class="text-danger">{{ $errors->first('oi_female_trainee_2019') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Total number of Trainees completed the course<span class="text-danger">*</span></label>
                      <input type="number" name="oi_completed_trainee_2019"
                             id="oi_completed_trainee_2019"
                             value="{{ old('oi_completed_trainee_2019', $form ? $form->oi_completed_trainee_2019 : '') }}" placeholder=""
                             class="form-control @error('oi_completed_trainee_2019') is-invalid @enderror">
                      @error('oi_completed_trainee_2019')
                      <strong
                        class="text-danger">{{ $errors->first('oi_completed_trainee_2019') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Percentage of Course Completed Trainees<span
                          class="text-danger">*</span></label>
                      <input type="number" name="oi_completed_percentage_2019"
                             id="oi_completed_percentage_2019"
                             value="{{ old('oi_completed_percentage_2019', $form ? $form->oi_completed_percentage_2019 : '') }}" placeholder=""
                             class="form-control @error('oi_completed_percentage_2019') is-invalid @enderror">
                      @error('oi_completed_percentage_2019')
                      <strong
                        class="text-danger">{{ $errors->first('oi_completed_percentage_2019') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row bordered-p mb-4">
                  <div class="col-md-12">
                    <h2 class="group-title">2018</h2>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Total Number of Enrolled Trainees <span
                          class="text-danger">*</span></label>
                      <input type="number" name="oi_enrolled_trainees_2018"
                             id="oi_enrolled_trainees_2018"
                             value="{{ old('oi_enrolled_trainees_2018', $form ? $form->oi_enrolled_trainees_2018 : '') }}" placeholder=""
                             class="form-control @error('oi_enrolled_trainees_2018') is-invalid @enderror">
                      @error('oi_enrolled_trainees_2018')
                      <strong
                        class="text-danger">{{ $errors->first('oi_enrolled_trainees_2018') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Out of the above, the number of female trainees<span
                          class="text-danger">*</span></label>
                      <input type="number" name="oi_female_trainee_2018"
                             id="oi_female_trainee_2018"
                             value="{{ old('oi_female_trainee_2018', $form ? $form->oi_female_trainee_2018 : '') }}" placeholder=""
                             class="form-control @error('oi_female_trainee_2018') is-invalid @enderror">
                      @error('oi_female_trainee_2018')
                      <strong
                        class="text-danger">{{ $errors->first('oi_female_trainee_2018') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Total number of Trainees completed the course<span class="text-danger">*</span></label>
                      <input type="number" name="oi_completed_trainee_2018"
                             id="oi_completed_trainee_2018"
                             value="{{ old('oi_completed_trainee_2018', $form ? $form->oi_completed_trainee_2018 : '') }}" placeholder=""
                             class="form-control @error('oi_completed_trainee_2018') is-invalid @enderror">
                      @error('oi_completed_trainee_2018')
                      <strong
                        class="text-danger">{{ $errors->first('oi_completed_trainee_2018') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Percentage of Course Completed Trainees<span
                          class="text-danger">*</span></label>
                      <input type="number" name="oi_completed_percentage_2018"
                             id="oi_completed_percentage_2018"
                             value="{{ old('oi_completed_percentage_2018', $form ? $form->oi_completed_percentage_2018 : '') }}" placeholder=""
                             class="form-control @error('oi_completed_percentage_2018') is-invalid @enderror">
                      @error('oi_completed_percentage_2018')
                      <strong
                        class="text-danger">{{ $errors->first('oi_completed_percentage_2018') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>


                <div class="row bordered-p mb-4">
                  <div class="col-sm-12 col-lg-4">
                    <div class="form-group">
                      <label for="">Total Number of occupations /courses offered <span
                          class="text-danger">*</span></label>
                      <input type="number" name="occupation_or_course_offered"
                             id="occupation_or_course_offered"
                             value="{{ old('occupation_or_course_offered', $form ? $form->occupation_or_course_offered : '') }}" placeholder=""
                             class="form-control @error('occupation_or_course_offered') is-invalid @enderror">
                      @error('occupation_or_course_offered')
                      <strong
                        class="text-danger">{{ $errors->first('occupation_or_course_offered') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-lg-4">
                    <div class="form-group">
                      <label for="">Total Number of Teachers <span
                          class="text-danger">*</span></label>
                      <input type="number" name="total_number_of_teacher"
                             id="total_number_of_teacher"
                             value="{{ old('total_number_of_teacher', $form ? $form->total_number_of_teacher : '') }}" placeholder=""
                             class="form-control @error('total_number_of_teacher') is-invalid @enderror">
                      @error('total_number_of_teacher')
                      <strong
                        class="text-danger">{{ $errors->first('total_number_of_teacher') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-lg-4">
                    <div class="form-group">
                      <label for="">Total Number of Non-teaching staff <span
                          class="text-danger">*</span></label>
                      <input type="number" name="total_number_of_non_tech_staff"
                             id="total_number_of_non_tech_staff"
                             value="{{ old('total_number_of_non_tech_staff', $form ? $form->total_number_of_non_tech_staff : '') }}" placeholder=""
                             class="form-control @error('total_number_of_non_tech_staff') is-invalid @enderror">
                      @error('total_number_of_non_tech_staff')
                      <strong
                        class="text-danger">{{ $errors->first('total_number_of_non_tech_staff') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-lg-12" id="accreditation_area">
                    <div class="form-group">
                      <label for="">Accreditation<span
                          class="text-danger">*</span></label>
                      <select name="accreditation"
                              id="accreditation"
                              class="form-control @error("accreditation") is-invalid @enderror">
                        <option value="">Choose one</option>
                        <option value="yes" @selected(old('accreditation', $form?$form->accreditation : '') == 'yes')>Yes</option>
                        <option value="no" @selected(old('accreditation', $form?$form->accreditation : '') == 'no')>No</option>
                      </select>
                      @error('accreditation')
                      <strong
                        class="text-danger">{{ $errors->first('accreditation') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-lg-6 d-none" id="agancy_area">
                    <div class="form-group">
                      <label for="">Accrediting Agency<span
                          class="text-danger">*</span></label>
                      <select
                        name="accreditation_agency"
                        class="form-control">
                        <option value="">Choose a type</option>
                        <option @selected(strtoupper(old('accreditation_agency',$form ? $form->accreditation_agency : '')) == "BTEB") value="BTEB">BTEB</option>
                        <option @selected(strtoupper(old('accreditation_agency',$form ? $form->accreditation_agency : '')) == "NSDA") value="NSDA">NSDA</option>
                        <option @selected(strtoupper(old('accreditation_agency',$form ? $form->accreditation_agency : '')) == "BTEB & NSDA") value="BTEB & NSDA">BTEB & NSDA
                        </option>
                        <option @selected(strtoupper(old('accreditation_agency',$form ? $form->accreditation_agency : '')) == "MINISTRY") value="MINISTRY">Ministry</option>
                        <option @selected(strtoupper(old('accreditation_agency',$form ? $form->accreditation_agency : '')) == "OTHERS") value="OTHERS">Others</option>
                      </select>
                      @error('accreditation_agency')
                      <strong
                        class="text-danger">{{ $errors->first('accreditation_agency') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-lg-12">
                    <div class="form-group">
                      <label for="">[Only for private training providers] Committed, if selected, to share at least 15% of cost(in kind) for our proposal as co-financing from our
                        institution.<span
                          class="text-danger">*</span></label>
                      <select required
                              name="share_cash_kind"
                              class="form-control">
                        <option value="">Choose a type</option>
                        <option @selected(strtoupper(old('share_cash_kind',$form ? $form->share_cash_kind : '')) == "YES") value="YES">YES</option>
                        <option @selected(strtoupper(old('share_cash_kind',$form ? $form->share_cash_kind : '')) == "NO") value="NO">NO</option>
                        <option @selected(strtoupper(old('share_cash_kind',$form ? $form->share_cash_kind : '')) == "N/A") value="N/A">N/A</option>
                      </select>
                      @error('share_cash_kind')
                      <strong
                        class="text-danger">{{ $errors->first('share_cash_kind') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>


                <h5 class="admin-form-sub-header mt-3">STUDENT BACKGROUND INFORMATION</h5>


                <div class="row bordered-p mb-4">
                  <div class="col-md-12">
                    <h2 class="group-title">2019</h2>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Trainees from rural areas <span
                          class="text-danger">*</span></label>
                      <input type="number" name="sbi_trainee_from_rural_area_2019"
                             id="sbi_trainee_from_rural_area_2019"
                             value="{{ old('sbi_trainee_from_rural_area_2019', $form ? $form->sbi_trainee_from_rural_area_2019 : '') }}" placeholder=""
                             class="form-control @error('sbi_trainee_from_rural_area_2019') is-invalid @enderror">
                      @error('sbi_trainee_from_rural_area_2019')
                      <strong
                        class="text-danger">{{ $errors->first('sbi_trainee_from_rural_area_2019') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Female Trainees<span
                          class="text-danger">*</span></label>
                      <input type="number" name="sbi_female_trainee_2019"
                             id="sbi_female_trainee_2019"
                             value="{{ old('sbi_female_trainee_2019', $form ? $form->sbi_female_trainee_2019 : '') }}" placeholder=""
                             class="form-control @error('sbi_female_trainee_2019') is-invalid @enderror">
                      @error('sbi_female_trainee_2019')
                      <strong
                        class="text-danger">{{ $errors->first('sbi_female_trainee_2019') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Trainees with disabilities<span class="text-danger">*</span></label>
                      <input type="number" name="sbi_trainee_with_disabilities_2019"
                             id="sbi_trainee_with_disabilities_2019"
                             value="{{ old('sbi_trainee_with_disabilities_2019', $form ? $form->sbi_trainee_with_disabilities_2019 : '') }}" placeholder=""
                             class="form-control @error('sbi_trainee_with_disabilities_2019') is-invalid @enderror">
                      @error('sbi_trainee_with_disabilities_2019')
                      <strong
                        class="text-danger">{{ $errors->first('sbi_trainee_with_disabilities_2019') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Trainees of ethnic minority background <span
                          class="text-danger">*</span></label>
                      <input type="number" name="sbi_trainee_of_ethnic_minority_2019"
                             id="sbi_trainee_of_ethnic_minority_2019"
                             value="{{ old('sbi_trainee_of_ethnic_minority_2019', $form ? $form->sbi_trainee_of_ethnic_minority_2019 : '') }}" placeholder=""
                             class="form-control @error('sbi_trainee_of_ethnic_minority_2019') is-invalid @enderror">
                      @error('sbi_trainee_of_ethnic_minority_2019')
                      <strong
                        class="text-danger">{{ $errors->first('sbi_trainee_of_ethnic_minority_2019') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row bordered-p mb-4">
                  <div class="col-md-12">
                    <h2 class="group-title">2018</h2>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Trainees from rural areas <span
                          class="text-danger">*</span></label>
                      <input type="number" name="sbi_trainee_from_rural_area_2018"
                             id="sbi_trainee_from_rural_area_2018"
                             value="{{ old('sbi_trainee_from_rural_area_2018', $form ? $form->sbi_trainee_from_rural_area_2018 : '') }}" placeholder=""
                             class="form-control @error('sbi_trainee_from_rural_area_2018') is-invalid @enderror">
                      @error('sbi_trainee_from_rural_area_2018')
                      <strong
                        class="text-danger">{{ $errors->first('sbi_trainee_from_rural_area_2018') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Female Trainees<span
                          class="text-danger">*</span></label>
                      <input type="number" name="sbi_female_trainee_2018"
                             id="sbi_female_trainee_2018"
                             value="{{ old('sbi_female_trainee_2018', $form ? $form->sbi_female_trainee_2018 : '') }}" placeholder=""
                             class="form-control @error('sbi_female_trainee_2018') is-invalid @enderror">
                      @error('sbi_female_trainee_2018')
                      <strong
                        class="text-danger">{{ $errors->first('sbi_female_trainee_2018') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Trainees with disabilities<span class="text-danger">*</span></label>
                      <input type="number" name="sbi_trainee_with_disabilities_2018"
                             id="sbi_trainee_with_disabilities_2018"
                             value="{{ old('sbi_trainee_with_disabilities_2018', $form ? $form->sbi_trainee_with_disabilities_2018 : '') }}" placeholder=""
                             class="form-control @error('sbi_trainee_with_disabilities_2018') is-invalid @enderror">
                      @error('sbi_trainee_with_disabilities_2018')
                      <strong
                        class="text-danger">{{ $errors->first('sbi_trainee_with_disabilities_2018') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Trainees of ethnic minority background <span
                          class="text-danger">*</span></label>
                      <input type="number" name="sbi_trainee_of_ethnic_minority_2018"
                             id="sbi_trainee_of_ethnic_minority_2018"
                             value="{{ old('sbi_trainee_of_ethnic_minority_2018', $form ? $form->sbi_trainee_of_ethnic_minority_2018 : '') }}" placeholder=""
                             class="form-control @error('sbi_trainee_of_ethnic_minority_2018') is-invalid @enderror">
                      @error('sbi_trainee_of_ethnic_minority_2018')
                      <strong
                        class="text-danger">{{ $errors->first('sbi_trainee_of_ethnic_minority_2018') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>


                <div class="row parent-area parent-area2">
                  @if(count(old('ayc_course_title', [])) > 0)
                    @foreach(old('ayc_course_title') as $k => $oldAyo)
                      <div class="col-md-12 single-area single-area2">
                        <h5>AFFORDABILITY OF YOUR COURSE</h5>
                        <i class="fa fa-minus minus-btn minus-btn2 action-btn" title="Remove"></i>
                        <i class="fa fa-plus add-btn add-btn2 action-btn" title="add"></i>
                        <input type="hidden" name="ayc_course_id[]" value="">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Course title</label>
                              <input type="text" alt=""
                                     name="ayc_course_title[]" value="{{ old('ayc_course_title')[$k] }}"
                                     class="form-control"
                                     required>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="imageType">Course duration (days)<span class="text-danger">*</span></label>
                              <input type="text" name="ayc_course_duration[]" value="{{ old('ayc_course_duration')[$k] }}"
                                     class="form-control">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Course fees in 2019 (BDT)</label>
                              <input type="number" name="ayc_course_fee_2019[]" value="{{ old('ayc_course_fee_2019')[$k] }}"
                                     class="form-control">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Course fees in 2018 (BDT)</label>
                              <input type="number" name="ayc_course_fee_2018[]" value="{{ old('ayc_course_fee_2018')[$k] }}"
                                     class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  @endif
                  @foreach($form ? $form->aycs : [] as $ayc)
                    <div class="col-md-12 single-area single-area2">
                      <h5>AFFORDABILITY OF YOUR COURSE</h5>
                      <i class="fa fa-minus minus-btn minus-btn2 action-btn" data-id="{{ $ayc->id }}"  title="Remove"></i>
                      <i class="fa fa-plus add-btn add-btn2 action-btn" title="add"></i>
                      <input type="hidden" name="ayc_course_id[]" value="{{ $ayc->id }}">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Course title</label>
                            <input type="text" alt=""
                                   name="ayc_course_title[]" value="{{ $ayc->ayc_course_title }}"
                                   class="form-control"
                                   required>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="imageType">Course duration (days)<span class="text-danger">*</span></label>
                            <input type="text" name="ayc_course_duration[]" value="{{ $ayc->ayc_course_duration }}"
                                   class="form-control">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Course fees in 2019 (BDT)</label>
                            <input type="number" name="ayc_course_fee_2019[]" value="{{ $ayc->ayc_course_fee_2019 }}"
                                   class="form-control">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Course fees in 2018 (BDT)</label>
                            <input type="number" name="ayc_course_fee_2018[]" value="{{ $ayc->ayc_course_fee_2018 }}"
                                   class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                  @if(!$form && count(old('ayc_course_title', [])) < 1)
                    <div class="col-md-12 single-area single-area2">
                      <h5>AFFORDABILITY OF YOUR COURSE</h5>
                      <i class="fa fa-plus add-btn add-btn2 action-btn" title="add"></i>
                      <input type="hidden" name="ayc_course_id[]" value="">
                      <div class="row child">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="ayc_course_title">Course title</label>
                            <input type="text" alt=""
                                   name="ayc_course_title[]" id="ayc_course_title"
                                   class="form-control @error('ayc_course_title') is-invalid @enderror"
                                   required>
                            @error('ayc_course_title')
                            <strong
                              class="text-danger">{{ $errors->first('ayc_course_title') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="ayc_course_duration" class="imageType">Course duration (days)<span class="text-danger">*</span></label>
                            <input type="text" name="ayc_course_duration[]" id="ayc_course_duration"
                                   class="form-control @error('ayc_course_duration') is-invalid @enderror">
                            @error('ayc_course_duration')
                            <strong
                              class="text-danger">{{ $errors->first('ayc_course_duration') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="ayc_course_fee_2019">Course fees in 2019 (BDT)</label>
                            <input type="number" name="ayc_course_fee_2019[]" id="ayc_course_fee_2019"
                                   class="form-control filename @error('ayc_course_fee_2019') is-invalid @enderror">
                            @error('ayc_course_fee_2019')
                            <strong
                              class="text-danger">{{ $errors->first('ayc_course_fee_2019') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="ayc_course_fee_2018">Course fees in 2018 (BDT)</label>
                            <input type="number" name="ayc_course_fee_2018[]" id="ayc_course_fee_2018"
                                   class="form-control filename @error('ayc_course_fee_2018') is-invalid @enderror">
                            @error('ayc_course_fee_2018')
                            <strong
                              class="text-danger">{{ $errors->first('ayc_course_fee_2018') }}</strong>
                            @enderror
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
                  @if($form && count($form->aycs) < 1)
                    <div class="col-md-12 single-area single-area2">
                      <h5>AFFORDABILITY OF YOUR COURSE</h5>
                      <i class="fa fa-plus add-btn add-btn2 action-btn" title="add"></i>
                      <input type="hidden" name="ayc_course_id[]" value="">
                      <div class="row child">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="ayc_course_title">Course title</label>
                            <input type="text" alt=""
                                   name="ayc_course_title[]" id="ayc_course_title"
                                   class="form-control @error('ayc_course_title') is-invalid @enderror"
                                   required>
                            @error('ayc_course_title')
                            <strong
                              class="text-danger">{{ $errors->first('ayc_course_title') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="ayc_course_duration" class="imageType">Course duration (days)<span class="text-danger">*</span></label>
                            <input type="text" name="ayc_course_duration[]" id="ayc_course_duration"
                                   class="form-control @error('ayc_course_duration') is-invalid @enderror">
                            @error('ayc_course_duration')
                            <strong
                              class="text-danger">{{ $errors->first('ayc_course_duration') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="ayc_course_fee_2019">Course fees in 2019 (BDT)</label>
                            <input type="number" name="ayc_course_fee_2019[]" id="ayc_course_fee_2019"
                                   class="form-control filename @error('ayc_course_fee_2019') is-invalid @enderror">
                            @error('ayc_course_fee_2019')
                            <strong
                              class="text-danger">{{ $errors->first('ayc_course_fee_2019') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="ayc_course_fee_2018">Course fees in 2018 (BDT)</label>
                            <input type="number" name="ayc_course_fee_2018[]" id="ayc_course_fee_2018"
                                   class="form-control filename @error('ayc_course_fee_2018') is-invalid @enderror">
                            @error('ayc_course_fee_2018')
                            <strong
                              class="text-danger">{{ $errors->first('ayc_course_fee_2018') }}</strong>
                            @enderror
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
                </div>

                <div class="row">
                  <div class="col-md-12 single-area single-area2">
                    <h5>List of Documents to be uploaded</h5>
                    <p>1. Affiliation order from BTEB/NSDA</p>
                    <p>2. Result Sheet of 2018 and 2019</p>
                    <p>3. List of Enrolled students signed institute head</p>
                    <p>4. Approval of institute establishment</p>
                    <p>5. Trainer/Instructor (trade wise) list signed by institute head</p>
                    <p>6. Photo of workshop/lab</p>
                    <p>7. Downloaded Signed EAF</p>
                  </div>
                </div>

                @if($form && count($form->files) > 0)
                  <div class="row">
                    <div class="col-md-12 single-area single-area2">
                      <h5>Uploaded File</h5>
                      <div class="row">
                        @foreach($form->files as $file)
                          <div class="col-md-12 mb-2">
                            <a href="{{ route('eligibility.course.file.delete', ['formId'=>$form->id, 'id'=>$file->id]) }}" class="btn btn-danger">
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
                        <label for="image_upload">File Upload</label>
                        <input type="file" alt="" name="image_upload[]" id="image_upload" @if($form && count($form->files) > 0) required @endif
                               class="form-control @error("image_upload") is-invalid @enderror">
                        @error("image_upload")
                        <strong class="text-danger">{{ $errors->first("image_upload") }}</strong>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md 3">
                      <div class="form-group">
                        <label for="image_type" class="imageType">File type</label>
                        <input type="text" name="image_type[]" id="image_type"
                               class="form-control type @error("image_type") is-invalid @enderror">
                        @error("image_type")
                        <strong class="text-danger">{{ $errors->first("image_type") }}</strong>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md 3">
                      <div class="form-group">
                        <label for="image_filename">File Description</label>
                        <input type="text" name="image_filename[]" id="image_filename"
                               class="form-control filename @error("image_filename") is-invalid @enderror">
                        @error("image_filename")
                        <strong class="text-danger">{{ $errors->first("image_filename") }}</strong>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md 2">
                      <div class="form-group">
                        <label for="image_size">Size</label>
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
                      <span type="button" class="btn btn-primary btn-sm btn-block" id="submitBtn" style="background-color: #67a8e4;">Submit</span>
                      {{--                      <span type="button" class="btn btn-primary btn-sm btn-block" style="    background-color: #67a8e4;">Submit</span>--}}
                      <small class="text-danger blink">Only once can be submitted</small>
                    </div>
                  @endif
                  @if($form)
                    <div class="col-md-12 mt-1 text-center">
                      <a href="{{ route('eligibility.course.pdf',$form->id) }}" target="_blank" class="btn btn-info btn-sm btn-block">Download</a>
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
  <script src="{{ asset('assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script>
    $(document).ready(function () {
      $(".yearPicker").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        startDate: '-200y',
        endDate: '+30y',
        autoclose: true
      });

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

      //    multiple row crate


      $('.clear-file').click(function () {
        $('#image_upload').val('').change()
        $('#image_filename').val('')
        $('#image_type').val('')
        $('#image_size').val('')
        $('#clear-file').addClass('hidden')
      })

      $(".add").on('click', function () {
        let content = `<div class="row child" >
            <div class="col-md 3">
                <div class="form-group">
                    <label for="image_upload">File Upload <span class="text-danger">*</span></label>
                    <input type="file" alt="" name="image_upload[]"
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


      $(document).on('click', '.add-btn1', function () {
        $('.parent-area1').append(`<div class="col-md-12 single-area1 single-area">
                    <h5>COURSE OFFERING INFORMATION</h5>
                    <i class="fa fa-minus minus-btn minus-btn1 action-btn" title="Remove"></i>
                    <i class="fa fa-plus add-btn1 add-btn action-btn" title="Add"></i>
                    <input type="hidden" name="coi_course_id[]" value="">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">Course title</label>
                          <input type="text"  alt=""
                                 name="coi_course_title[]"
                                 class="form-control"
                                 required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="" class="imageType">Year of the Course was
                            initiated <span class="text-danger">*</span></label>
                          <input type="text" name="coi_year_of_initiated[]"
                                 class="form-control yearPicker type">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">Course Duration</label>
                          <input type="text" name="coi_course_duration[]"
                                 class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">Intake capacity per cycle</label>
                          <input type="text" name="coi_intake_capacity_per_cycle[]"
                                 class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">No. of trainees trained in 2021</label>
                          <input type="number" name="coi_trained_trainee_in2021[]"
                                 class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">No. of teachers</label>
                          <input type="number" name="coi_number_of_teacher[]"
                                 class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">Is the Course competency-based<span
                              class="text-danger">*</span>
                          </label>
                          <select
                            name="coi_course_competency_based[]"
                            class="form-control">
                            <option value="">Choose a type</option>
                            <option value="0">Yes</option>
                            <option value="1">No</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">NTVQF /other equivalent framework adopted by the government Level<span class="text-danger">*</span></label>
                          <select
                            name="coi_adopted_framework[]"

                            class="form-control">
                            <option value="">Choose a type</option>
                              <option value="NTVQF">NTVQF</option>
                              <option value="BNQF">BNQF</option>
                              <option value="OTHERS">Others</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="">Accredited by?<span
                              class="text-danger">*</span></label>
                          <select
                            name="coi_accredited_by[]"

                            class="form-control">
                            <option value="">Choose a type</option>
                            <option value="BTEB">BTEB</option>
                            <option value="NSDA">NSDA</option>
                            <option value="BTEB & NSDA">BTEB & NSDA</option>
                            <option value="MINISTRY">Ministry</option>
                            <option value="OTHERS">Others</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>`)
      })
      $(document).on('click', '.minus-btn1', function () {
        const id = $(this).data('id')
        const $this = $(this)
        if (id > 0){
          const formId = "{{ $form?->id }}";
          $.ajax({
            url: "{{ route('eligibility.short.course.delete.coi') }}",
            method: "delete",
            dataType: "html",
            data: {formId: formId, id: id},
            success: function (data) {
              if (data === "success") {
                $this.closest('.single-area1').css('background-color', 'red').fadeOut();
              }
            }
          });
        }else{
          $(this).closest('.single-area1').css('background-color', 'red').fadeOut();
        }

      })


      $(document).on('click', '.add-btn2', function () {
        $('.parent-area2').append(` <div class="col-md-12 single-area single-area2">
                    <h5>AFFORDABILITY OF YOUR COURSE</h5>
                    <i class="fa fa-minus minus-btn minus-btn2 action-btn" title="Remove"></i>
                    <i class="fa fa-plus add-btn2 add-btn action-btn" title="Add"></i>
                    <input type="hidden" name="ayc_course_id[]" value="">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Course title</label>
                          <input type="text"  alt=""
                                 name="ayc_course_title[]"
                                 class="form-control"
                                 required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="imageType">Course duration (days)<span class="text-danger">*</span></label>
                          <input type="text" name="ayc_course_duration[]"
                                 class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Course fees in 2019 (BDT)</label>
                          <input type="number" name="ayc_course_fee_2019[]"
                                 class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Course fees in 2018 (BDT)</label>
                          <input type="number" name="ayc_course_fee_2018[]"
                                 class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>`)
      })
      $(document).on('click', '.minus-btn2', function () {
        // $(this).closest('.single-area2').remove()
        const id = $(this).data('id')
        const $this = $(this)
        if (id > 0){
          const formId = "{{ $form?->id }}";
          $.ajax({
            url: "{{ route('eligibility.short.course.delete.aco') }}",
            method: "delete",
            dataType: "html",
            data: {formId: formId, id: id},
            success: function (data) {
              if (data === "success") {
                $this.closest('.single-area2').css('background-color', 'red').fadeOut();
              }
            }
          });
        }else{
          $(this).closest('.single-area2').css('background-color', 'red').fadeOut();
        }
      })


      $('select[name="accreditation"]').change(function () {
        chackAccreditation()
      })
      chackAccreditation()

      function chackAccreditation() {
        if ($('select[name="accreditation"]').val() == 'yes') {
          $('#accreditation_area').removeClass('col-lg-12')
          $('#accreditation_area').addClass('col-lg-6')
          $('#agancy_area').removeClass('d-none')
        } else {
          $('#accreditation_area').removeClass('col-lg-6')
          $('#accreditation_area').addClass('col-lg-12')
          $('#agancy_area').addClass('d-none')
        }
      }

    })
  </script>

@endsection
