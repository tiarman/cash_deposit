@extends('layout.admin')

@section('stylesheet')
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
  <script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Eligibility Confirmation Form</h2>
            </header>
            <div class="panel-body">
              @if (session()->has('status'))
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
              <form role="form" method="post" id="ea-form"
                    {{--                    action="{{ route('eligibility.rpl.createOrStore') }}" enctype="multipart/form-data">--}}
                    action="{{ route('eligibility.rpl.without.score') }}" enctype="multipart/form-data">
                @csrf
                <h5 class="admin-form-sub-header">BASIC INSTITUTIONAL PROFILE</h5>
                {{-- start row --}}

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
                        @foreach(\App\Models\EafRplWithoutScore::$instituteTypes as $type)
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

                <div class="row bordered-p mb-4">
                  <div class="col-md-4">
                    <label for="">Years of Institute Establishment<span
                        class="text-danger">*</span></label>
                  </div>
                  <div class="col-md-8">

                    <input type="text" name="years_of_institute_establishment"
                           id="years_of_institute_establishment"
                           value="{{ old('years_of_institute_establishment', $form ? $form->years_of_institute_establishment : '') }}" placeholder=""
                           class="yearPicker form-control @error('years_of_institute_establishment') is-invalid @enderror">
                    @error('years_of_institute_establishment')
                    <strong
                      class="text-danger">{{ $errors->first('years_of_institute_establishment') }}</strong>
                    @enderror
                  </div>
                </div>
                {{-- end row --}}

                <div class="row bordered-p mb-4">
                  <div class="col-md-12">
                    <h2 class="group-title">2021</h2>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Total Number of Enrolled Trainees<span
                          class="text-danger">*</span></label>
                      <input type="number" name="total_enrolled_trainee_2021"
                             id="total_enrolled_trainee_2021"
                             value="{{ old('total_enrolled_trainee_2021', $form ? $form->total_enrolled_trainee_2021 : '') }}" placeholder=""
                             class="form-control @error('total_enrolled_trainee_2021') is-invalid @enderror">
                      @error('total_enrolled_trainee_2021')
                      <strong
                        class="text-danger">{{ $errors->first('total_enrolled_trainee_2021') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">The No of female trainees<span
                          class="text-danger">*</span></label>
                      <input type="number" name="female_trainee_2021"
                             id="female_trainee_2021"
                             value="{{ old('female_trainee_2021', $form ? $form->female_trainee_2021 : '') }}" placeholder=""
                             class="form-control @error('female_trainee_2021') is-invalid @enderror">
                      @error('female_trainee_2021')
                      <strong
                        class="text-danger">{{ $errors->first('female_trainee_2021') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Total No of Trainees completed the Occupation<span class="text-danger">*</span></label>
                      <input type="number" name="total_trainee_completed_2021"
                             id="total_trainee_completed_2021"
                             value="{{ old('total_trainee_completed_2021', $form ? $form->total_trainee_completed_2021 : '') }}" placeholder=""
                             class="form-control @error('total_trainee_completed_2021') is-invalid @enderror">
                      @error('total_trainee_completed_2021')
                      <strong
                        class="text-danger">{{ $errors->first('total_trainee_completed_2021') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Percentage of Occupation Completed Trainees <span
                          class="text-danger">*</span></label>
                      <input type="number" name="percentage_completed_trainee_2021"
                             id="percentage_completed_trainee_2021"
                             value="{{ old('percentage_completed_trainee_2021', $form ? $form->percentage_completed_trainee_2021 : '') }}" placeholder=""
                             class="form-control @error('percentage_completed_trainee_2021') is-invalid @enderror">
                      @error('percentage_completed_trainee_2021')
                      <strong
                        class="text-danger">{{ $errors->first('percentage_completed_trainee_2021') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>


                <div class="row bordered-p mb-4">
                  <div class="col-md-12">
                    <h2 class="group-title">2020</h2>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Total Number of Enrolled Trainees<span
                          class="text-danger">*</span></label>
                      <input type="number" name="total_enrolled_trainee_2020"
                             id="total_enrolled_trainee_2020"
                             value="{{ old('total_enrolled_trainee_2020', $form ? $form->total_enrolled_trainee_2020 : '') }}" placeholder=""
                             class="form-control @error('total_enrolled_trainee_2020') is-invalid @enderror">
                      @error('total_enrolled_trainee_2020')
                      <strong
                        class="text-danger">{{ $errors->first('total_enrolled_trainee_2020') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">The No of female trainees<span
                          class="text-danger">*</span></label>
                      <input type="number" name="female_trainee_2020"
                             id="female_trainee_2020"
                             value="{{ old('female_trainee_2020', $form ? $form->female_trainee_2020 : '') }}" placeholder=""
                             class="form-control @error('female_trainee_2020') is-invalid @enderror">
                      @error('female_trainee_2020')
                      <strong
                        class="text-danger">{{ $errors->first('female_trainee_2020') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Total No of Trainees completed the Occupation<span class="text-danger">*</span></label>
                      <input type="number" name="total_trainee_completed_2020"
                             id="total_trainee_completed_2020"
                             value="{{ old('total_trainee_completed_2020', $form ? $form->total_trainee_completed_2020 : '') }}" placeholder=""
                             class="form-control @error('total_trainee_completed_2020') is-invalid @enderror">
                      @error('total_trainee_completed_2020')
                      <strong
                        class="text-danger">{{ $errors->first('total_trainee_completed_2020') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Percentage of Occupation Completed Trainees <span
                          class="text-danger">*</span></label>
                      <input type="number" name="percentage_completed_trainee_2020"
                             id="percentage_completed_trainee_2020"
                             value="{{ old('percentage_completed_trainee_2020', $form ? $form->percentage_completed_trainee_2020 : '') }}" placeholder=""
                             class="form-control @error('percentage_completed_trainee_2020') is-invalid @enderror">
                      @error('percentage_completed_trainee_2020')
                      <strong
                        class="text-danger">{{ $errors->first('percentage_completed_trainee_2020') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>


                <div class="row bordered-p mb-4">
                  <div class="col-md-12">
                    <h2 class="group-title">2019</h2>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Total Number of Enrolled Trainees<span
                          class="text-danger">*</span></label>
                      <input type="number" name="total_enrolled_trainee_2019"
                             id="total_enrolled_trainee_2019"
                             value="{{ old('total_enrolled_trainee_2019', $form ? $form->total_enrolled_trainee_2019 : '') }}" placeholder=""
                             class="form-control @error('total_enrolled_trainee_2019') is-invalid @enderror">
                      @error('total_enrolled_trainee_2019')
                      <strong
                        class="text-danger">{{ $errors->first('total_enrolled_trainee_2019') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">The No of female trainees<span
                          class="text-danger">*</span></label>
                      <input type="number" name="female_trainee_2019"
                             id="female_trainee_2019"
                             value="{{ old('female_trainee_2019', $form ? $form->female_trainee_2019 : '') }}" placeholder=""
                             class="form-control @error('female_trainee_2019') is-invalid @enderror">
                      @error('female_trainee_2019')
                      <strong
                        class="text-danger">{{ $errors->first('female_trainee_2019') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Total No of Trainees completed the Occupation<span class="text-danger">*</span></label>
                      <input type="number" name="total_trainee_completed_2019"
                             id="total_trainee_completed_2019"
                             value="{{ old('total_trainee_completed_2019', $form ? $form->total_trainee_completed_2019 : '') }}" placeholder=""
                             class="form-control @error('total_trainee_completed_2019') is-invalid @enderror">
                      @error('total_trainee_completed_2019')
                      <strong
                        class="text-danger">{{ $errors->first('total_trainee_completed_2019') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Percentage of Occupation Completed Trainees <span
                          class="text-danger">*</span></label>
                      <input type="number" name="percentage_completed_trainee_2019"
                             id="percentage_completed_trainee_2019"
                             value="{{ old('percentage_completed_trainee_2019', $form ? $form->percentage_completed_trainee_2019 : '') }}" placeholder=""
                             class="form-control @error('percentage_completed_trainee_2019') is-invalid @enderror">
                      @error('percentage_completed_trainee_2019')
                      <strong
                        class="text-danger">{{ $errors->first('percentage_completed_trainee_2019') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>


                <div class="row  bordered-p mb-4">
                  <div class="col-md-6">
                    <label for="">Total Number of Occupations Offered<span class="text-danger">*</span></label>
                  </div>
                  <div class="col-md-6">
                    <input type="number" name="total_occupation_offered"
                           id="total_occupation_offered"
                           value="{{ old('total_occupation_offered', $form ? $form->total_occupation_offered : '') }}" placeholder=""
                           class="form-control @error('total_occupation_offered') is-invalid @enderror">
                    @error('total_occupation_offered')
                    <strong
                      class="text-danger">{{ $errors->first('total_occupation_offered') }}</strong>
                    @enderror
                  </div>
                </div>


                <div class="row  bordered-p mb-4">
                  <div class="col-md-6">
                    <label for="">Total Number of Teachers <span
                        class="text-danger">*</span></label>
                  </div>
                  <div class="col-md-6">
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


                <div class="row  bordered-p mb-4">
                  <div class="col-md-6">
                    <label for="">Total Number of Non-teaching staff <span
                        class="text-danger">*</span></label>
                  </div>
                  <div class="col-md-6">
                    <input type="number" name="total_no_of_non_tech_staff"
                           id="total_no_of_non_tech_staff"
                           value="{{ old('total_no_of_non_tech_staff', $form ? $form->total_no_of_non_tech_staff : '') }}" placeholder=""
                           class="form-control @error('total_no_of_non_tech_staff') is-invalid @enderror">
                    @error('total_no_of_non_tech_staff')
                    <strong
                      class="text-danger">{{ $errors->first('total_no_of_non_tech_staff') }}</strong>
                    @enderror
                  </div>
                </div>


                <div class="row  bordered-p mb-4">
                  <div class="col-md-6">
                    <label for="">Accreditation - whether accredited with BTEB, NSDA or
                      other Authority <span class="text-danger">*</span></label>
                  </div>
                  <div class="col-md-6">
                    <select
                      name="accreditation"
                      id="accreditation"
                      class="form-control @error('accreditation') is-invalid @enderror">
                      <option value="">Choose an option</option>
                      <option @selected(strtoupper(old('accreditation', $form ? $form->accreditation : '')) == 'BTEB') value="BTEB">BTEB</option>
                      <option @selected(strtoupper(old('accreditation', $form ? $form->accreditation : '')) == 'NSDA') value="NSDA">NSDA</option>
                      <option @selected(strtoupper(old('accreditation', $form ? $form->accreditation : '')) == 'BTEB & NSDA') value="BTEB & NSDA">BTEB & NSDA</option>
                      <option @selected(strtoupper(old('accreditation', $form ? $form->accreditation : '')) == 'MINISTRY') value="MINISTRY">Ministry</option>
                      <option @selected(strtoupper(old('accreditation', $form ? $form->accreditation : '')) == 'OTHERS') value="OTHERS">Others</option>
                    </select>
                  </div>
                </div>


                <div class="row parent-area parent-area1">
                  @if(count(old('ooi_occupation_title', [])) > 0)
                    @foreach(old('ooi_occupation_title', []) as $j => $oldOoi)
                      <div class="col-md-12 single-area single-area1">
                        <h5>OCCUPATION OFFERING INFORMATION</h5>
                        <i class="fa fa-minus minus-btn minus-btn1 action-btn" title="remove"></i>
                        <i class="fa fa-plus add-btn add-btn1 action-btn" title="add"></i>
                        <input type="hidden" name="ooi_occupation_id[]" value="">
                        <div class="row child">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="">Occupation title</label>
                              <input type="text" alt=""
                                     name="ooi_occupation_title[]"
                                     value="{{ old('ooi_occupation_title')[$j] }}"
                                     class="form-control"
                                     required>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="" class="imageType">Year of the Occupation was
                                initiated <span class="text-danger">*</span></label>
                              <input type="text" name="ooi_year_of_initiated[]"
                                     value="{{ old('ooi_year_of_initiated')[$j] }}"
                                     class="form-control yearPicker type ">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="">Occupation Duration</label>
                              <input type="text" name="ooi_occupation_duration[]"
                                     value="{{ old('ooi_occupation_duration')[$j] }}"
                                     class="form-control filename ">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="">Intake capacity per cycle</label>
                              <input type="text" name="ooi_intake_capacity_per_cycle[]"
                                     value="{{ old('ooi_intake_capacity_per_cycle')[$j] }}"
                                     class="form-control filename ">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="">No. of trainees trained in 2021</label>
                              <input type="number" name="ooi_trained_trainee_in2021[]"
                                     value="{{ old('ooi_trained_trainee_in2021')[$j] }}"
                                     class="form-control filename ">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="">No. of teachers</label>
                              <input type="number" name="ooi_number_of_teacher[]"
                                     value="{{ old('ooi_number_of_teacher')[$j] }}"
                                     class="form-control filename ">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="">Is the Occupation competency-based<span
                                  class="text-danger">*</span>
                              </label>
                              <select
                                name="ooi_occupation_competency_based[]"

                                class="form-control">
                                <option value="">Choose a type</option>
                                <option @selected(old('ooi_occupation_competency_based')[$j] == 0 ) value="0">Yes</option>
                                <option @selected(old('ooi_occupation_competency_based')[$j] == 1 ) value="1">No</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="">NTVQF /other equivalent framework adopted by the government Level<span class="text-danger">*</span></label>
                              <select
                                name="ooi_adopted_framework[]"

                                class="form-control ">
                                <option value="">Choose a type</option>
                                <option @selected(strtoupper(old('ooi_adopted_framework')[$j]) == 'NTVQF') value="NTVQF">NTVQF</option>
                                <option @selected(strtoupper(old('ooi_adopted_framework')[$j]) == 'BNQF') value="BNQF">BNQF</option>
                                <option @selected(strtoupper(old('ooi_adopted_framework')[$j]) == 'OTHERS') value="OTHERS">Others</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label for="">Accredited by?<span
                                  class="text-danger">*</span></label>
                              <select
                                name="ooi_accredited_by[]"
                                class="form-control">
                                <option value="">Choose a type</option>
                                <option @selected(strtoupper(old('ooi_accredited_by')[$j]) == "BTEB") value="BTEB">BTEB</option>
                                <option @selected(strtoupper(old('ooi_accredited_by')[$j]) == "NSDA") value="NSDA">NSDA</option>
                                <option @selected(strtoupper(old('ooi_accredited_by')[$j]) == "BTEB & NSDA") value="BTEB & NSDA">BTEB & NSDA</option>
                                <option @selected(strtoupper(old('ooi_accredited_by')[$j]) == "MINISTRY") value="MINISTRY">Ministry</option>
                                <option @selected(strtoupper(old('ooi_accredited_by')[$j]) == "OTHERS") value="OTHERS">Others</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  @endif
                  @foreach($form ? $form->oois : [] as $ooi)
                    <div class="col-md-12 single-area single-area1">
                      <h5>OCCUPATION OFFERING INFORMATION</h5>
                      <i class="fa fa-minus minus-btn minus-btn1 action-btn" data-id="{{ $ooi->id }}"  title="remove"></i>
                      <i class="fa fa-plus add-btn add-btn1 action-btn" title="add"></i>
                      <input type="hidden" name="ooi_occupation_id[]" value="{{ $ooi->id }}">
                      <div class="row child">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Occupation title</label>
                            <input type="text" alt=""
                                   name="ooi_occupation_title[]"
                                   value="{{ $ooi->ooi_occupation_title }}"
                                   class="form-control"
                                   required>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="" class="imageType">Year of the Occupation was
                              initiated <span class="text-danger">*</span></label>
                            <input type="text" name="ooi_year_of_initiated[]"
                                   value="{{ $ooi->ooi_year_of_initiated }}"
                                   class="form-control yearPicker type ">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Occupation Duration</label>
                            <input type="text" name="ooi_occupation_duration[]"
                                   value="{{ $ooi->ooi_occupation_duration }}"
                                   class="form-control filename ">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Intake capacity per cycle</label>
                            <input type="text" name="ooi_intake_capacity_per_cycle[]"
                                   value="{{ $ooi->ooi_intake_capacity_per_cycle }}"
                                   class="form-control filename ">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">No. of trainees trained in 2021</label>
                            <input type="number" name="ooi_trained_trainee_in2021[]"
                                   value="{{ $ooi->ooi_trained_trainee_in2021 }}"
                                   class="form-control filename ">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">No. of teachers</label>
                            <input type="number" name="ooi_number_of_teacher[]"
                                   value="{{ $ooi->ooi_number_of_teacher }}"
                                   class="form-control filename ">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Is the Occupation competency-based<span
                                class="text-danger">*</span>
                            </label>
                            <select
                              name="ooi_occupation_competency_based[]"

                              class="form-control">
                              <option value="">Choose a type</option>
                              <option @selected($ooi->ooi_occupation_competency_based == 0 ) value="0">Yes</option>
                              <option @selected($ooi->ooi_occupation_competency_based == 1 ) value="1">No</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">NTVQF /other equivalent framework adopted by the government Level<span class="text-danger">*</span></label>
                            <select
                              name="ooi_adopted_framework[]"

                              class="form-control ">
                              <option value="">Choose a type</option>
                              <option @selected(strtoupper($ooi->ooi_adopted_framework) == 'NTVQF') value="NTVQF">NTVQF</option>
                              <option @selected(strtoupper($ooi->ooi_adopted_framework) == 'BNQF') value="BNQF">BNQF</option>
                              <option @selected(strtoupper($ooi->ooi_adopted_framework) == 'OTHERS') value="OTHERS">Others</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="">Accredited by?<span
                                class="text-danger">*</span></label>
                            <select
                              name="ooi_accredited_by[]"
                              class="form-control">
                              <option value="">Choose a type</option>
                              <option @selected(strtoupper($ooi->ooi_accredited_by) == "BTEB") value="BTEB">BTEB</option>
                              <option @selected(strtoupper($ooi->ooi_accredited_by) == "NSDA") value="NSDA">NSDA</option>
                              <option @selected(strtoupper($ooi->ooi_accredited_by) == "BTEB & NSDA") value="BTEB & NSDA">BTEB & NSDA</option>
                              <option @selected(strtoupper($ooi->ooi_accredited_by) == "MINISTRY") value="MINISTRY">Ministry</option>
                              <option @selected(strtoupper($ooi->ooi_accredited_by) == "OTHERS") value="OTHERS">Others</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                  @if(!$form && count(old('ooi_occupation_title', [])) < 1)
                    <div class="col-md-12 single-area single-area1">
                      <h5>OCCUPATION OFFERING INFORMATION</h5>
                      <i class="fa fa-plus add-btn add-btn1 action-btn" title="add"></i>
                      <input type="hidden" name="ooi_occupation_id[]" value="">
                      <div class="row child">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Occupation title</label>
                            <input type="text" alt=""
                                   name="ooi_occupation_title[]"
                                   class="form-control @error('ooi_occupation_title') is-invalid @enderror"
                                   required>
                            @error('ooi_occupation_title')
                            <strong
                              class="text-danger">{{ $errors->first('ooi_occupation_title') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="" class="imageType">Year of the Occupation was
                              initiated <span class="text-danger">*</span></label>
                            <input type="text" name="ooi_year_of_initiated[]"
                                   class="form-control yearPicker type @error('ooi_year_of_initiated') is-invalid @enderror">
                            @error('ooi_year_of_initiated')
                            <strong
                              class="text-danger">{{ $errors->first('ooi_year_of_initiated') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Occupation Duration</label>
                            <input type="text" name="ooi_occupation_duration[]"
                                   class="form-control filename @error('ooi_occupation_duration') is-invalid @enderror">
                            @error('ooi_occupation_duration')
                            <strong
                              class="text-danger">{{ $errors->first('ooi_occupation_duration') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Intake capacity per cycle</label>
                            <input type="text" name="ooi_intake_capacity_per_cycle[]"
                                   class="form-control filename @error('ooi_intake_capacity_per_cycle') is-invalid @enderror">
                            @error('ooi_intake_capacity_per_cycle')
                            <strong
                              class="text-danger">{{ $errors->first('ooi_intake_capacity_per_cycle') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">No. of trainees trained in 2021</label>
                            <input type="number" name="ooi_trained_trainee_in2021[]"
                                   class="form-control filename @error('ooi_trained_trainee_in2021') is-invalid @enderror">
                            @error('ooi_trained_trainee_in2021')
                            <strong
                              class="text-danger">{{ $errors->first('ooi_trained_trainee_in2021') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">No. of teachers</label>
                            <input type="number" name="ooi_number_of_teacher[]"
                                   class="form-control filename @error('ooi_number_of_teacher') is-invalid @enderror">
                            @error('ooi_number_of_teacher')
                            <strong
                              class="text-danger">{{ $errors->first('ooi_number_of_teacher') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Is the Occupation competency-based<span
                                class="text-danger">*</span>
                            </label>
                            <select
                              name="ooi_occupation_competency_based[]"

                              class="form-control @error('ooi_occupation_competency_based') is-invalid @enderror">
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
                              name="ooi_adopted_framework[]"

                              class="form-control @error('ooi_adopted_framework') is-invalid @enderror">
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
                              name="ooi_accredited_by[]"

                              class="form-control @error('ooi_accredited_by') is-invalid @enderror">
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
                  @if($form && count($form->oois) < 1)
                    <div class="col-md-12 single-area single-area1">
                      <h5>OCCUPATION OFFERING INFORMATION</h5>
                      <i class="fa fa-plus add-btn add-btn1 action-btn" title="add"></i>
                      <input type="hidden" name="ooi_occupation_id[]" value="">
                      <div class="row child">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Occupation title</label>
                            <input type="text" alt=""
                                   name="ooi_occupation_title[]"
                                   class="form-control @error('ooi_occupation_title') is-invalid @enderror"
                                   required>
                            @error('ooi_occupation_title')
                            <strong
                              class="text-danger">{{ $errors->first('ooi_occupation_title') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="" class="imageType">Year of the Occupation was
                              initiated <span class="text-danger">*</span></label>
                            <input type="text" name="ooi_year_of_initiated[]"
                                   class="form-control yearPicker type @error('ooi_year_of_initiated') is-invalid @enderror">
                            @error('ooi_year_of_initiated')
                            <strong
                              class="text-danger">{{ $errors->first('ooi_year_of_initiated') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Occupation Duration</label>
                            <input type="text" name="ooi_occupation_duration[]"
                                   class="form-control filename @error('ooi_occupation_duration') is-invalid @enderror">
                            @error('ooi_occupation_duration')
                            <strong
                              class="text-danger">{{ $errors->first('ooi_occupation_duration') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Intake capacity per cycle</label>
                            <input type="text" name="ooi_intake_capacity_per_cycle[]"
                                   class="form-control filename @error('ooi_intake_capacity_per_cycle') is-invalid @enderror">
                            @error('ooi_intake_capacity_per_cycle')
                            <strong
                              class="text-danger">{{ $errors->first('ooi_intake_capacity_per_cycle') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">No. of trainees trained in 2021</label>
                            <input type="number" name="ooi_trained_trainee_in2021[]"
                                   class="form-control filename @error('ooi_trained_trainee_in2021') is-invalid @enderror">
                            @error('ooi_trained_trainee_in2021')
                            <strong
                              class="text-danger">{{ $errors->first('ooi_trained_trainee_in2021') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">No. of teachers</label>
                            <input type="number" name="ooi_number_of_teacher[]"
                                   class="form-control filename @error('ooi_number_of_teacher') is-invalid @enderror">
                            @error('ooi_number_of_teacher')
                            <strong
                              class="text-danger">{{ $errors->first('ooi_number_of_teacher') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Is the Occupation competency-based<span
                                class="text-danger">*</span>
                            </label>
                            <select
                              name="ooi_occupation_competency_based[]"

                              class="form-control @error('ooi_occupation_competency_based') is-invalid @enderror">
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
                              name="ooi_adopted_framework[]"

                              class="form-control @error('ooi_adopted_framework') is-invalid @enderror">
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
                              name="ooi_accredited_by[]"

                              class="form-control @error('ooi_accredited_by') is-invalid @enderror">
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

                <div class="div d-none" id="test01">
                  {{--                  <div class="col-md-12 single-area1 single-area">--}}
                  {{--                    <h5>OCCUPATION OFFERING INFORMATION</h5>--}}
                  {{--                    <i class="fa fa-minus minus-btn minus-btn1 action-btn" title="Remove"></i>--}}
                  {{--                    <i class="fa fa-plus add-btn1 add-btn action-btn" title="Add"></i>--}}
                  {{--                    <div class="row">--}}
                  {{--                      <div class="col-md-4">--}}
                  {{--                        <div class="form-group">--}}
                  {{--                          <label for="">Occupation title</label>--}}
                  {{--                          <input type="text"  alt=""--}}
                  {{--                                 name="ooi_occupation_title[]"--}}
                  {{--                                 class="form-control"--}}
                  {{--                                 required>--}}
                  {{--                        </div>--}}
                  {{--                      </div>--}}
                  {{--                      <div class="col-md-4">--}}
                  {{--                        <div class="form-group">--}}
                  {{--                          <label for="" class="imageType">Year of the Occupation was--}}
                  {{--                            initiated <span class="text-danger">*</span></label>--}}
                  {{--                          <input type="text" name="ooi_year_of_initiated[]"--}}
                  {{--                                 class="form-control yearPicker type">--}}
                  {{--                        </div>--}}
                  {{--                      </div>--}}
                  {{--                      <div class="col-md-4">--}}
                  {{--                        <div class="form-group">--}}
                  {{--                          <label for="">Occupation Duration</label>--}}
                  {{--                          <input type="text" name="ooi_occupation_duration[]"--}}
                  {{--                                 class="form-control filename">--}}
                  {{--                        </div>--}}
                  {{--                      </div>--}}
                  {{--                      <div class="col-md-4">--}}
                  {{--                        <div class="form-group">--}}
                  {{--                          <label for="">Intake capacity per cycle</label>--}}
                  {{--                          <input type="text" name="ooi_intake_capacity_per_cycle[]"--}}
                  {{--                                 class="form-control filename">--}}
                  {{--                        </div>--}}
                  {{--                      </div>--}}
                  {{--                      <div class="col-md-4">--}}
                  {{--                        <div class="form-group">--}}
                  {{--                          <label for="">No. of trainees trained in 2021</label>--}}
                  {{--                          <input type="number" name="ooi_trained_trainee_in2021[]"--}}
                  {{--                                 class="form-control filename">--}}
                  {{--                        </div>--}}
                  {{--                      </div>--}}
                  {{--                      <div class="col-md-4">--}}
                  {{--                        <div class="form-group">--}}
                  {{--                          <label for="">No. of teachers</label>--}}
                  {{--                          <input type="number" name="ooi_number_of_teacher[]"--}}
                  {{--                                 class="form-control filename">--}}
                  {{--                        </div>--}}
                  {{--                      </div>--}}
                  {{--                      <div class="col-md-4">--}}
                  {{--                        <div class="form-group">--}}
                  {{--                          <label for="">Is the Occupation competency-based<span--}}
                  {{--                              class="text-danger">*</span>--}}
                  {{--                          </label>--}}
                  {{--                          <select--}}
                  {{--                            name="ooi_occupation_competency_based"--}}

                  {{--                            class="form-control">--}}
                  {{--                            <option value="">Choose a type</option>--}}
                  {{--                            <option value="0">Yes</option>--}}
                  {{--                            <option value="1">No</option>--}}
                  {{--                          </select>--}}
                  {{--                        </div>--}}
                  {{--                      </div>--}}
                  {{--                      <div class="col-md-6">--}}
                  {{--                        <div class="form-group">--}}
                  {{--                          <label for="">NTVQF /other equivalent framework adopted by the government Level<span class="text-danger">*</span></label>--}}
                  {{--                          <select--}}
                  {{--                            name="ooi_adopted_framwork"--}}

                  {{--                            class="form-control @error('ooi_adopted_framwork') is-invalid @enderror">--}}
                  {{--                            <option value="">Choose a type</option>--}}
                  {{--                              <option value="1">1</option>--}}
                  {{--                              <option value="2">2</option>--}}
                  {{--                              <option value="3">3</option>--}}
                  {{--                              <option value="4">4</option>--}}
                  {{--                              <option value="5">5</option>--}}
                  {{--                              <option value="6">6</option>--}}
                  {{--                              <option value="7">7</option>--}}
                  {{--                              <option value="8">8</option>--}}
                  {{--                              <option value="9">9</option>--}}
                  {{--                              <option value="10">10</option>--}}
                  {{--                          </select>--}}
                  {{--                        </div>--}}
                  {{--                      </div>--}}
                  {{--                      <div class="col-md-2">--}}
                  {{--                        <div class="form-group">--}}
                  {{--                          <label for="">Accredited by?<span--}}
                  {{--                              class="text-danger">*</span></label>--}}
                  {{--                          <select--}}
                  {{--                            name="ooi_accredited_by"--}}

                  {{--                            class="form-control">--}}
                  {{--                            <option value="">Choose a type</option>--}}
                  {{--                            <option value="bteb">BTEB</option>--}}
                  {{--                            <option value="nsda">NSDA</option>--}}
                  {{--                          </select>--}}
                  {{--                        </div>--}}
                  {{--                      </div>--}}
                  {{--                    </div>--}}
                  {{--                  </div>--}}
                </div>


                <h5 class="admin-form-sub-header mt-3">STUDENT BACKGROUND INFORMATION</h5>

                <div class="row bordered-p mb-4">
                  <div class="col-md-12">
                    <h2 class="group-title">2021</h2>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Trainees from rural areas <span
                          class="text-danger">*</span></label>
                      <input type="number" name="sbi_trainee_from_rural_area_2021"
                             id="sbi_trainee_from_rural_area_2021"
                             value="{{ old('sbi_trainee_from_rural_area_2021', $form ? $form->sbi_trainee_from_rural_area_2021 : '') }}" placeholder=""
                             class="form-control @error('sbi_trainee_from_rural_area_2021') is-invalid @enderror">
                      @error('sbi_trainee_from_rural_area_2021')
                      <strong
                        class="text-danger">{{ $errors->first('sbi_trainee_from_rural_area_2021') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Female Trainees<span
                          class="text-danger">*</span></label>
                      <input type="number" name="sbi_female_trainee_2021"
                             id="sbi_female_trainee_2021"
                             value="{{ old('sbi_female_trainee_2021', $form ? $form->sbi_female_trainee_2021 : '') }}" placeholder=""
                             class="form-control @error('sbi_female_trainee_2021') is-invalid @enderror">
                      @error('sbi_female_trainee_2021')
                      <strong
                        class="text-danger">{{ $errors->first('sbi_female_trainee_2021') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Trainees with disabilities<span class="text-danger">*</span></label>
                      <input type="number" name="sbi_trainee_with_disabilities_2021"
                             id="sbi_trainee_with_disabilities_2021"
                             value="{{ old('sbi_trainee_with_disabilities_2021', $form ? $form->sbi_trainee_with_disabilities_2021 : '') }}" placeholder=""
                             class="form-control @error('sbi_trainee_with_disabilities_2021') is-invalid @enderror">
                      @error('sbi_trainee_with_disabilities_2021')
                      <strong
                        class="text-danger">{{ $errors->first('sbi_trainee_with_disabilities_2021') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Trainees of ethnic minority background <span
                          class="text-danger">*</span></label>
                      <input type="number" name="sbi_trainee_of_ethnic_minority_2021"
                             id="sbi_trainee_of_ethnic_minority_2021"
                             value="{{ old('sbi_trainee_of_ethnic_minority_2021', $form ? $form->sbi_trainee_of_ethnic_minority_2021 : '') }}" placeholder=""
                             class="form-control @error('sbi_trainee_of_ethnic_minority_2021') is-invalid @enderror">
                      @error('sbi_trainee_of_ethnic_minority_2021')
                      <strong
                        class="text-danger">{{ $errors->first('sbi_trainee_of_ethnic_minority_2021') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row bordered-p mb-4">
                  <div class="col-md-12">
                    <h2 class="group-title">2020</h2>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Trainees from rural areas <span
                          class="text-danger">*</span></label>
                      <input type="number" name="sbi_trainee_from_rural_area_2020"
                             id="sbi_trainee_from_rural_area_2020"
                             value="{{ old('sbi_trainee_from_rural_area_2020', $form ? $form->sbi_trainee_from_rural_area_2020 : '') }}" placeholder=""
                             class="form-control @error('sbi_trainee_from_rural_area_2020') is-invalid @enderror">
                      @error('sbi_trainee_from_rural_area_2020')
                      <strong
                        class="text-danger">{{ $errors->first('sbi_trainee_from_rural_area_2020') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Female Trainees<span
                          class="text-danger">*</span></label>
                      <input type="number" name="sbi_female_trainee_2020"
                             id="sbi_female_trainee_2020"
                             value="{{ old('sbi_female_trainee_2020', $form ? $form->sbi_female_trainee_2020 : '') }}" placeholder=""
                             class="form-control @error('sbi_female_trainee_2020') is-invalid @enderror">
                      @error('sbi_female_trainee_2020')
                      <strong
                        class="text-danger">{{ $errors->first('sbi_female_trainee_2020') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Trainees with disabilities<span class="text-danger">*</span></label>
                      <input type="number" name="sbi_trainee_with_disabilities_2020"
                             id="sbi_trainee_with_disabilities_2020"
                             value="{{ old('sbi_trainee_with_disabilities_2020', $form ? $form->sbi_trainee_with_disabilities_2020 : '') }}" placeholder=""
                             class="form-control @error('sbi_trainee_with_disabilities_2020') is-invalid @enderror">
                      @error('sbi_trainee_with_disabilities_2020')
                      <strong
                        class="text-danger">{{ $errors->first('sbi_trainee_with_disabilities_2020') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Trainees of ethnic minority background <span
                          class="text-danger">*</span></label>
                      <input type="number" name="sbi_trainee_of_ethnic_minority_2020"
                             id="sbi_trainee_of_ethnic_minority_2020"
                             value="{{ old('sbi_trainee_of_ethnic_minority_2020', $form ? $form->sbi_trainee_of_ethnic_minority_2020 : '') }}" placeholder=""
                             class="form-control @error('sbi_trainee_of_ethnic_minority_2020') is-invalid @enderror">
                      @error('sbi_trainee_of_ethnic_minority_2020')
                      <strong
                        class="text-danger">{{ $errors->first('sbi_trainee_of_ethnic_minority_2020') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>

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


                <div class="row parent-area parent-area2">
                  @if(count(old('ayo_occupation_title', [])) > 0)
                    @foreach(old('ayo_occupation_title') as $k => $oldAyo)
                      <div class="col-md-12 single-area single-area2">
                        <h5>AFFORDABILITY OF YOUR OCCUPATIONS</h5>
                        <i class="fa fa-minus minus-btn minus-btn2 action-btn" title="Remove"></i>
                        <i class="fa fa-plus add-btn add-btn2 action-btn" title="add"></i>
                        <input type="hidden" name="ayo_occupation_id[]" value="">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Occupation title</label>
                              <input type="text" alt=""
                                     name="ayo_occupation_title[]" value="{{ old('ayo_occupation_title')[$k] }}"
                                     class="form-control"
                                     required>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="imageType">Occupation duration (days)<span class="text-danger">*</span></label>
                              <input type="text" name="ayo_occupation_duration[]" value="{{ old('ayo_occupation_duration')[$k] }}"
                                     class="form-control">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Occupation fees in 2019 (BDT)</label>
                              <input type="number" name="ayo_occupation_fee_2019[]" value="{{ old('ayo_occupation_fee_2019')[$k] }}"
                                     class="form-control">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Occupation fees in 2020 (BDT)</label>
                              <input type="number" name="ayo_occupation_fee_2020[]" value="{{ old('ayo_occupation_fee_2020')[$k] }}"
                                     class="form-control">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Occupation fees in 2021 (BDT)</label>
                              <input type="number" name="ayo_occupation_fee_2021[]" value="{{ old('ayo_occupation_fee_2021')[$k] }}"
                                     class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  @endif
                  @foreach($form ? $form->ayos : [] as $ayo)
                    <div class="col-md-12 single-area single-area2">
                      <h5>AFFORDABILITY OF YOUR OCCUPATIONS</h5>
                      <i class="fa fa-minus minus-btn minus-btn2 action-btn" data-id="{{ $ayo->id }}" title="Remove"></i>
                      <i class="fa fa-plus add-btn add-btn2 action-btn" title="add"></i>
                      <input type="hidden" name="ayo_occupation_id[]" value="{{ $ayo->id }}">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Occupation title</label>
                            <input type="text" alt=""
                                   name="ayo_occupation_title[]" value="{{ $ayo->ayo_occupation_title }}"
                                   class="form-control"
                                   required>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="imageType">Occupation duration (days)<span class="text-danger">*</span></label>
                            <input type="text" name="ayo_occupation_duration[]" value="{{ $ayo->ayo_occupation_duration }}"
                                   class="form-control">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Occupation fees in 2019 (BDT)</label>
                            <input type="number" name="ayo_occupation_fee_2019[]" value="{{ $ayo->ayo_occupation_fee_2019 }}"
                                   class="form-control">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Occupation fees in 2020 (BDT)</label>
                            <input type="number" name="ayo_occupation_fee_2020[]" value="{{ $ayo->ayo_occupation_fee_2020 }}"
                                   class="form-control">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Occupation fees in 2021 (BDT)</label>
                            <input type="number" name="ayo_occupation_fee_2021[]" value="{{ $ayo->ayo_occupation_fee_2021 }}"
                                   class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                  @if(!$form && count(old('ayo_occupation_title', [])) < 1)
                    <div class="col-md-12 single-area single-area2">
                      <h5>AFFORDABILITY OF YOUR OCCUPATIONS</h5>
                      <i class="fa fa-plus add-btn add-btn2 action-btn" title="add"></i>
                      <input type="hidden" name="ayo_occupation_id[]" value="">
                      <div class="row child">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="ayo_occupation_title">Occupation title</label>
                            <input type="text" alt=""
                                   name="ayo_occupation_title[]" id="ayo_occupation_title"
                                   class="form-control @error('ayo_occupation_title') is-invalid @enderror"
                                   required>
                            @error('ayo_occupation_title')
                            <strong
                              class="text-danger">{{ $errors->first('ayo_occupation_title') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="ayo_occupation_duration" class="imageType">Occupation duration (days)<span class="text-danger">*</span></label>
                            <input type="text" name="ayo_occupation_duration[]" id="ayo_occupation_duration"
                                   class="form-control @error('ayo_occupation_duration') is-invalid @enderror">
                            @error('ayo_occupation_duration')
                            <strong
                              class="text-danger">{{ $errors->first('ayo_occupation_duration') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="ayo_occupation_fee_2019">Occupation fees in 2019 (BDT)</label>
                            <input type="number" name="ayo_occupation_fee_2019[]" id="ayo_occupation_fee_2019"
                                   class="form-control filename @error('ayo_occupation_fee_2019') is-invalid @enderror">
                            @error('ayo_occupation_fee_2019')
                            <strong
                              class="text-danger">{{ $errors->first('ayo_occupation_fee_2019') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="ayo_occupation_fee_2020">Occupation fees in 2020 (BDT)</label>
                            <input type="number" name="ayo_occupation_fee_2020[]" id="ayo_occupation_fee_2020"
                                   class="form-control filename @error('ayo_occupation_fee_2020') is-invalid @enderror">
                            @error('ayo_occupation_fee_2020')
                            <strong
                              class="text-danger">{{ $errors->first('ayo_occupation_fee_2020') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="ayo_occupation_fee_2021">Occupation fees in 2021 (BDT)</label>
                            <input type="number" name="ayo_occupation_fee_2021[]" id="ayo_occupation_fee_2021"
                                   class="form-control filename @error('ayo_occupation_fee_2021') is-invalid @enderror">
                            @error('ayo_occupation_fee_2021')
                            <strong
                              class="text-danger">{{ $errors->first('ayo_occupation_fee_2021') }}</strong>
                            @enderror
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
                  @if($form && count($form->ayos) < 1)
                    <div class="col-md-12 single-area single-area2">
                      <h5>AFFORDABILITY OF YOUR OCCUPATIONS</h5>
                      <i class="fa fa-plus add-btn add-btn2 action-btn" title="add"></i>
                      <input type="hidden" name="ayo_occupation_id[]" value="">
                      <div class="row child">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="ayo_occupation_title">Occupation title</label>
                            <input type="text" alt=""
                                   name="ayo_occupation_title[]" id="ayo_occupation_title"
                                   class="form-control @error('ayo_occupation_title') is-invalid @enderror"
                                   required>
                            @error('ayo_occupation_title')
                            <strong
                              class="text-danger">{{ $errors->first('ayo_occupation_title') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="ayo_occupation_duration" class="imageType">Occupation duration (days)<span class="text-danger">*</span></label>
                            <input type="text" name="ayo_occupation_duration[]" id="ayo_occupation_duration"
                                   class="form-control @error('ayo_occupation_duration') is-invalid @enderror">
                            @error('ayo_occupation_duration')
                            <strong
                              class="text-danger">{{ $errors->first('ayo_occupation_duration') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="ayo_occupation_fee_2019">Occupation fees in 2019 (BDT)</label>
                            <input type="number" name="ayo_occupation_fee_2019[]" id="ayo_occupation_fee_2019"
                                   class="form-control filename @error('ayo_occupation_fee_2019') is-invalid @enderror">
                            @error('ayo_occupation_fee_2019')
                            <strong
                              class="text-danger">{{ $errors->first('ayo_occupation_fee_2019') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="ayo_occupation_fee_2020">Occupation fees in 2020 (BDT)</label>
                            <input type="number" name="ayo_occupation_fee_2020[]" id="ayo_occupation_fee_2020"
                                   class="form-control filename @error('ayo_occupation_fee_2020') is-invalid @enderror">
                            @error('ayo_occupation_fee_2020')
                            <strong
                              class="text-danger">{{ $errors->first('ayo_occupation_fee_2020') }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="ayo_occupation_fee_2021">Occupation fees in 2021 (BDT)</label>
                            <input type="number" name="ayo_occupation_fee_2021[]" id="ayo_occupation_fee_2021"
                                   class="form-control filename @error('ayo_occupation_fee_2021') is-invalid @enderror">
                            @error('ayo_occupation_fee_2021')
                            <strong
                              class="text-danger">{{ $errors->first('ayo_occupation_fee_2021') }}</strong>
                            @enderror
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
                </div>

                <div class="div d-none" id="test02">
                  {{--                  <div class="col-md-12 single-area single-area2">--}}
                  {{--                    <h5>AFFORDABILITY OF YOUR OCCUPATIONS</h5>--}}
                  {{--                    <i class="fa fa-plus add-btn add-btn2 action-btn" title="add"></i>--}}
                  {{--                    <div class="row">--}}
                  {{--                      <div class="col-md-12">--}}
                  {{--                        <div class="form-group">--}}
                  {{--                          <label>Occupation title</label>--}}
                  {{--                          <input type="text"  alt=""--}}
                  {{--                                 name="ayo_occupation_title[]"--}}
                  {{--                                 class="form-control"--}}
                  {{--                                 required>--}}
                  {{--                        </div>--}}
                  {{--                      </div>--}}
                  {{--                      <div class="col-md-3">--}}
                  {{--                        <div class="form-group">--}}
                  {{--                          <label class="imageType">Occupation duration (days)<span class="text-danger">*</span></label>--}}
                  {{--                          <input type="text" name="ayo_occupation_duration[]"--}}
                  {{--                                 class="form-control">--}}
                  {{--                        </div>--}}
                  {{--                      </div>--}}
                  {{--                      <div class="col-md-3">--}}
                  {{--                        <div class="form-group">--}}
                  {{--                          <label>Occupation fees in 2019 (BDT)</label>--}}
                  {{--                          <input type="number" name="ayo_occupation_fee_2019[]"--}}
                  {{--                                 class="form-control filename">--}}
                  {{--                        </div>--}}
                  {{--                      </div>--}}
                  {{--                      <div class="col-md-3">--}}
                  {{--                        <div class="form-group">--}}
                  {{--                          <label>Occupation fees in 2020 (BDT)</label>--}}
                  {{--                          <input type="number" name="ayo_occupation_fee_2020[]"--}}
                  {{--                                 class="form-control filename">--}}
                  {{--                        </div>--}}
                  {{--                      </div>--}}
                  {{--                      <div class="col-md-3">--}}
                  {{--                        <div class="form-group">--}}
                  {{--                          <label>Occupation fees in 2021 (BDT)</label>--}}
                  {{--                          <input type="number" name="ayo_occupation_fee_2021[]"--}}
                  {{--                                 class="form-control filename">--}}
                  {{--                        </div>--}}
                  {{--                      </div>--}}
                  {{--                    </div>--}}
                  {{--                  </div>--}}
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
                            <a href="{{ route('eligibility.rpl.without.score.file.delete', ['formId'=>$form->id, 'id'=>$file->id]) }}" class="btn btn-danger">
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
                        <input type="file" alt="" name="image_upload[]" id="image_upload" @if($form && count($form->files) > 0) required @endif
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
{{--                      <span type="button" class="btn btn-primary btn-sm btn-block" style="background-color: #67a8e4;">Submit (Under Maintenance)</span>--}}
                      <small class="text-danger blink">Only once can be submitted</small>
                    </div>
                  @endif
                  @if($form)
                    <div class="col-md-12 mt-1 text-center">
                      {{--                      <a href="{{ route('eligibility.rpl.without.score.pdf', $form->id) }}" target="_blank" class="btn btn-info btn-sm btn-block">Download</a>--}}
                      <a href="{{ route('eligibility.rpl.without.score.pdf', $form->id) }}" target="_blank" class="btn btn-info btn-sm btn-block">Download</a>
                      {{--                      <a href="#" target="_blank" class="btn btn-info btn-sm btn-block">Download (Under Maintenance)</a>--}}
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
@endsection

@section('script')
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
                    <h5>OCCUPATION OFFERING INFORMATION</h5>
                    <i class="fa fa-minus minus-btn minus-btn1 action-btn" title="Remove"></i>
                    <i class="fa fa-plus add-btn1 add-btn action-btn" title="Add"></i>
                    <input type="hidden" name="ooi_occupation_id[]" value="">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">Occupation title</label>
                          <input type="text"  alt=""
                                 name="ooi_occupation_title[]"
                                 class="form-control"
                                 required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="" class="imageType">Year of the Occupation was
                            initiated <span class="text-danger">*</span></label>
                          <input type="text" name="ooi_year_of_initiated[]"
                                 class="form-control yearPicker type">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">Occupation Duration</label>
                          <input type="text" name="ooi_occupation_duration[]"
                                 class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">Intake capacity per cycle</label>
                          <input type="text" name="ooi_intake_capacity_per_cycle[]"
                                 class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">No. of trainees trained in 2021</label>
                          <input type="number" name="ooi_trained_trainee_in2021[]"
                                 class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">No. of teachers</label>
                          <input type="number" name="ooi_number_of_teacher[]"
                                 class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">Is the Occupation competency-based<span
                              class="text-danger">*</span>
                          </label>
                          <select
                            name="ooi_occupation_competency_based[]"
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
                            name="ooi_adopted_framework[]"

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
                            name="ooi_accredited_by[]"

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
          const formId = "{{ $form?->id }}"
          $.ajax({
            url: "{{ route('eligibility.rpl.without.score.delete.ooi') }}",
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
                    <h5>AFFORDABILITY OF YOUR OCCUPATIONS</h5>
                    <i class="fa fa-minus minus-btn minus-btn2 action-btn" title="Remove"></i>
                    <i class="fa fa-plus add-btn2 add-btn action-btn" title="Add"></i>
                    <input type="hidden" name="ayo_occupation_id[]" value="">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Occupation title</label>
                          <input type="text"  alt=""
                                 name="ayo_occupation_title[]"
                                 class="form-control"
                                 required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="imageType">Occupation duration (days)<span class="text-danger">*</span></label>
                          <input type="text" name="ayo_occupation_duration[]"
                                 class="form-control">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Occupation fees in 2019 (BDT)</label>
                          <input type="number" name="ayo_occupation_fee_2019[]"
                                 class="form-control">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Occupation fees in 2020 (BDT)</label>
                          <input type="number" name="ayo_occupation_fee_2020[]"
                                 class="form-control">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Occupation fees in 2021 (BDT)</label>
                          <input type="number" name="ayo_occupation_fee_2021[]"
                                 class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>`)
      })
      $(document).on('click', '.minus-btn2', function () {
        const id = $(this).data('id')
        const $this = $(this)
        if (id > 0){
        const formId = "{{ $form?->id }}";
          $.ajax({
            url: "{{ route('eligibility.rpl.without.score.delete.ayo') }}",
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
    })
  </script>
@endsection
