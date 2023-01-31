@extends('layout.site')
@section('stylesheet')
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
  <style>
      label {
          margin-top: 10px;
      }

      input[type=radio] {
          margin: 10px;
      }

      .form-sub-section {
          background-color: rgba(25, 135, 84, 0.726) !important;
          /* color: black !important; */
      }

      .image_preview_container {
          width: 100px;
          height: 100px;
          background-color: lightgrey;
          margin-top: 12px;
      }

  </style>
@endsection
@section('content')
    <section id="services" class="services section-bg" style="margin-top:-70px">
      <div class="container institute_head_alignment" data-aos="fade-up">
        <h2 class="text-center" id="title">Employee Registration Form</h2>
        <hr>
        @if(session()->has('status'))
          {!! session()->get('status') !!}
        @endif
        <form class="form-horizontal" action="" method="post">
          @csrf
          {{--        User Informantion--}}
          <h4 class="p-2 text-light form-sub-section">User Information</h4>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="name_en">Name <span class="text-danger">*</span></label>
                <input type="name" name="name" id="name" placeholder="Enter Your Username" autocomplete="off"
                       class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                <span class="spin"></span>
                @error('name')
                <strong class="text-danger">{{ $errors->first('name') }}</strong>
                @enderror
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" placeholder="Enter Your email"
                       class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                <span class="spin"></span>
                @error('email')
                <strong class="text-danger">{{ $errors->first('email') }}</strong>
                @enderror
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="phone">Phone <span class="text-danger">*</span></label>
                <input type="phone" name="phone" id="phone" placeholder="Enter Your Phone Number" autocomplete="off"
                       class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                <span class="spin"></span>
                @error('phone')
                <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="password">Password <span class="text-danger">*</span></label>
                <input type="password" name="password" id="password" placeholder="Enter Your Password"
                       autocomplete="off"
                       class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}"
                       required>
                <span class="spin"></span>
                @error('password')
                <strong class="text-danger">{{ $errors->first('password') }}</strong>
                @enderror
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       placeholder="Confirm Your Password" autocomplete="off"
                       class="form-control @error('password_confirmation') is-invalid @enderror"
                       value="{{ old('password_confirmation') }}" required>
                <span class="spin"></span>
                @error('password_confirmation')
                <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                @enderror
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="po"> P.O.</label>
                <input type="po" name="po" id="po" placeholder="Enter P.O. " autocomplete="off"
                       class="form-control @error('po') is-invalid @enderror" value="{{ old('po') }}" required>
                <span class="spin"></span>
                @error('po')
                <strong class="text-danger">{{ $errors->first('po') }}</strong>
                @enderror
              </div>
            </div>
          </div>
          {{--        Company Details --}}
          <h4 class="p-2 text-light form-sub-section mt-4">Company Details Information</h4>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_name">Company Name <span class="text-danger">*</span></label>
                <input type="text" name="company_name" id="company_name" placeholder="Enter Your company name"
                       autocomplete="off"
                       class="form-control @error('company_name') is-invalid @enderror"
                       value="{{ old('company_name') }}"
                       required>
                <span class="spin"></span>
                @error('company_name')
                <strong class="text-danger">{{ $errors->first('company_name') }}</strong>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_name_bn">কোম্পানির নাম (বাংলায়) <span class="text-danger">*</span></label>
                <input type="text" name="company_name_bn" id="company_name_bn" placeholder="কোম্পানির নাম বাংলায় লিখুন"
                       autocomplete="off"
                       class="form-control @error('company_name_bn') is-invalid @enderror"
                       value="{{ old('company_name_bn') }}" required>
                <span class="spin"></span>
                @error('company_name_bn')
                <strong class="text-danger">{{ $errors->first('company_name_bn') }}</strong>
                @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="entrepreneur">Are you new Entrepreneur? <span class="text-danger">*</span></label>
                <input type="radio" name="entrepreneur" id="entrepreneur" placeholder="Enter Your entrepreneur"
                       class="@error('entrepreneur') is-invalid @enderror" value="{{ old('entrepreneur','no') }}">No
                <input type="radio" name="entrepreneur" id="entrepreneur" placeholder="Enter Your entrepreneur"
                       class="@error('entrepreneur') is-invalid @enderror" value="{{ old('entrepreneur', 'yes') }}">Yes
                <span class="spin"></span>
                @error('entrepreneur')
                <strong class="text-danger">{{ $errors->first('entrepreneur') }}</strong>
                @enderror
              </div>
            </div>
            <div class="col-md-12">
              <p style="display: none; background: #0dcaf0;color: white;padding: 10px; border-radius: 10px; "
                 id="entrepreneur-text">If your company age is maximum 1 year, total employee size is 6 and your
                business
                falls into any of the
                categories like Restaurant, Showroom, Pharmacy, Saloon, Agro Farm, Workshop then enjoy our Uddokta
                Scheme
                for the next one year. (*Condition applied)</p>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="year_of_establishment">Year of Establishment <span class="text-danger">*</span></label>
                <input type="text" name="year_of_establishment" id="year_of_establishment"
                       placeholder="Enter Your Year of Establishment"
                       autocomplete="off"
                       class="form-control @error('year_of_establishment') is-invalid @enderror"
                       value="{{ old('year_of_establishment') }}"
                       required>
                <span class="spin"></span>
                @error('year_of_establishment')
                <strong class="text-danger">{{ $errors->first('year_of_establishment') }}</strong>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_size">Company Size <span class="text-danger">*</span></label>
                <select class="form-control @error('company_size') is-invalid @enderror" name="company_size"
                        id="company_size">
                  <option value="-1">Select Company Size</option>
                  <option value="1-15">1-15 employees</option>
                  <option value="16-30">16-30 employees</option>
                  <option value="31-50">31-50 employees</option>
                  <option value="51-120">51-120 employees</option>
                  <option value="121-300">121-300 employees</option>
                  <option value="301-500">301-500 employees</option>
                  <option value="501-1000">501-1000 employees</option>
                  <option value="1001-5000">1001-5000 employees</option>
                  <option value="5001-10000">5001-10000 employees</option>
                  <option value="10000-0">10000+ employees</option>
                </select>
                <span class="spin"></span>
                @error('company_size')
                <strong class="text-danger">{{ $errors->first('company_size') }}</strong>
                @enderror
              </div>
            </div>
          </div>
          <h4 class="p-2 text-light form-sub-section mt-4 ">Company Address</h4>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">Division<span class="text-danger">*</span></label>
                <select name="division_id" class="form-control @error('division_id') is-invalid @enderror" required>
                  <option value="">Choose a division</option>

                  <option value="" @selected( old('division_id'))>Division names</option>

                </select>
                @error('division_id')
                <strong class="text-danger">{{ $errors->first('division_id') }}</strong>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">District<span class="text-danger">*</span></label>
                <select name="district_id" class="form-control @error('district_id') is-invalid @enderror" required>
                  <option value="">Choose a district</option>
                  <option value="" @selected(old('district_id'))>district</option>
                </select>
                @error('district_id')
                <strong class="text-danger">{{ $errors->first('district_id') }}</strong>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_address">Company Address <span class="text-danger">*</span></label>
                <textarea name="name" id="company_address" placeholder="Enter Your Usercompany_address"
                          class="form-control @error('company_address') is-invalid @enderror"
                          required>{{ old('company_address') }}</textarea>
                <span class="spin"></span>
                @error('company_address')
                <strong class="text-danger">{{ $errors->first('company_address') }}</strong>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_address_bn">কোম্পানির ঠিকানা (বাংলায়) <span class="text-danger">*</span></label>
                <textarea name="company_address_bn" id="company_address_bn" placeholder="কোম্পানির ঠিকানা বাংলায় লিখুন"
                          class="form-control @error('company_address_bn') is-invalid @enderror"></textarea>
                <span class="spin"></span>
                @error('company_address_bn')
                <strong class="text-danger">{{ $errors->first('company_address_bn') }}</strong>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">Industry Type<span class="text-danger">*</span></label>
                <select name="industry_type" class="form-control @error('industry_type') is-invalid @enderror" required>
                  <option value="">Choose a Industry Type</option>

                  <option value="" @selected( old('industry_type'))>Type One</option>
                  <option value="" @selected( old('industry_type'))>Type Two</option>
                  <option value="" @selected( old('industry_type'))>Type Three</option>
                  <option value="" @selected( old('industry_type'))>Type Four</option>

                </select>
                @error('industry_type')
                <strong class="text-danger">{{ $errors->first('industry_type') }}</strong>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">Industry Type Select (Multiple)<span class="text-danger">*</span></label>
                <select name="industry_type_select"
                        class="select2 form-control @error('industry_type_select') is-invalid @enderror"
                        multiple>
                  <option value="">Choose Industry Type</option>
                  <option value="a" @selected( old('industry_type_select'))>Type One</option>
                  <option value="b" @selected( old('industry_type_select'))>Type Two</option>
                  <option value="c" @selected( old('industry_type_select'))>Type Three</option>
                  <option value="d" @selected( old('industry_type_select'))>Type Four</option>
                </select>
                @error('industry_type')
                <strong class="text-danger">{{ $errors->first('industry_type') }}</strong>
                @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="business_description">Business Description </label>
                <textarea type="text" name="business_description" id="business_description"
                          placeholder="Enter Your company Address"
                          class="form-control @error('business_description') is-invalid @enderror"
                          required>{{ old('business_description') }}</textarea>
                <span class="spin"></span>
                @error('business_description')
                <strong class="text-danger">{{ $errors->first('business_description') }}</strong>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="trade_licence">Business/ Trade License No<span class="text-danger">*</span></label>
                <input type="text" name="trade_licence" id="trade_licence" placeholder="Enter Your Usertrade_licence"
                       autocomplete="off"
                       class="form-control @error('trade_licence') is-invalid @enderror"
                       value="{{ old('trade_licence') }}" required>
                <span class="spin"></span>
                @error('trade_licence')
                <strong class="text-danger">{{ $errors->first('trade_licence') }}</strong>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="rl_no">RL No (Only for Recruiting Agency)<span class="text-danger">*</span></label>
                <input type="text" name="rl_no" id="rl_no" placeholder="Enter Your Userrl_no" autocomplete="off"
                       class="form-control @error('rl_no') is-invalid @enderror" value="{{ old('rl_no') }}" required>
                <span class="spin"></span>
                @error('rl_no')
                <strong class="text-danger">{{ $errors->first('rl_no') }}</strong>
                @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="website_url">Website URL<span class="text-danger">*</span></label>
                <input type="url" name="website_url" id="website_url" placeholder="Enter Your Userwebsite_url"
                       autocomplete="off"
                       class="form-control @error('website_url') is-invalid @enderror" value="{{ old('website_url') }}"
                       required>
                <span class="spin"></span>
                @error('website_url')
                <strong class="text-danger">{{ $errors->first('website_url') }}</strong>
                @enderror
              </div>
            </div>
          </div>
          <h4 class="p-2 text-light form-sub-section mt-4">Accessibility Profile for inclusion of Persons with
            Disabilities as Employees</h4>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="checkbox" value="yes" name="facilities">Facilities for
                Person with Disabilities
              </div>
            </div>
          </div>
          <div class="row facilities" style="display: none;">
            <div class="col-md-12">
              <div class="form-group">
                <label for="disability_inclusion_policy">Do you have Disability Inclusion Policy<span
                    class="text-danger">*</span></label>
                <input type="radio" name="disability_inclusion_policy" id="disability_inclusion_policy"
                       placeholder="Enter Your Disability Inclusion Policy"
                       class="@error('disability_inclusion_policy') is-invalid @enderror"
                       value="{{ old('disability_inclusion_policy',0) }}"> No
                <input type="radio" name="disability_inclusion_policy" id="disability_inclusion_policy"
                       placeholder="Enter Your Disability Inclusion Policy"
                       class="@error('disability_inclusion_policy') is-invalid @enderror"
                       value="{{ old('disability_inclusion_policy',1) }}"> Yes
                <span class="spin"></span>
                @error('disability_inclusion_policy')
                <strong class="text-danger">{{ $errors->first('disability_inclusion_policy') }}</strong>
                @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="disability_inclusion_raining_for_your_employee">Do you provide Disability Inclusion Training
                  for your Employees<span class="text-danger">*</span></label>
                <input type="radio" name="disability_inclusion_raining_for_your_employee"
                       id="disability_inclusion_raining_for_your_employee"
                       class="@error('disability_inclusion_raining_for_your_employee') is-invalid @enderror"
                       value="{{ old('disability_inclusion_raining_for_your_employee',0) }}"> No
                <input type="radio" name="disability_inclusion_raining_for_your_employee"
                       id="disability_inclusion_raining_for_your_employee"
                       placeholder="Enter Your Disability Inclusion Policy"
                       class="@error('disability_inclusion_raining_for_your_employee') is-invalid @enderror"
                       value="{{ old('disability_inclusion_raining_for_your_employee',1) }}"> Yes
                <span class="spin"></span>
                @error('disability_inclusion_raining_for_your_employee')
                <strong
                  class="text-danger">{{ $errors->first('disability_inclusion_raining_for_your_employee') }}</strong>
                @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="disability_inclusion_company">As part of Disability Inclusion, what do your company
                  have<span class="text-danger">*</span></label>
                <div style="border: 1px dotted #747373; background: white; padding: 10px;">
                  <div class="row">
                    <div class="col-md-4"><input type="checkbox" name="disability_inclusion_company"
                                                 id="disability_inclusion_company"
                                                 class="@error('disability_inclusion_company') is-invalid @enderror"
                                                 value="{{ old('disability_inclusion_company') }}"> Accessible
                      documentation and alternative
                      formats
                    </div>
                    <div class="col-md-4">
                      <input type="checkbox" name="disability_inclusion_company"
                             id="disability_inclusion_company"
                             placeholder="Enter Your Disability Inclusion Policy"
                             class="@error('disability_inclusion_company') is-invalid @enderror"
                             value="{{ old('disability_inclusion_company') }}"> Accessible Washrooms
                      / Toilets
                    </div>
                    <div class="col-md-4">
                      <input type="checkbox" name="disability_inclusion_company"
                             id="disability_inclusion_company"
                             placeholder="Enter Your Disability Inclusion Policy"
                             class="@error('disability_inclusion_company') is-invalid @enderror"
                             value="{{ old('disability_inclusion_company') }}"> Adapted Transport
                      facility for Distant
                      Travelling
                    </div>
                    <div class="col-md-4">
                      <input type="checkbox" name="disability_inclusion_company"
                             id="disability_inclusion_company"
                             placeholder="Enter Your Disability Inclusion Policy"
                             class="@error('disability_inclusion_company') is-invalid @enderror"
                             value="{{ old('disability_inclusion_company') }}"> Assistive Software,
                      communication and computer
                      devices
                    </div>
                    <div class="col-md-4">
                      <input type="checkbox" name="disability_inclusion_company"
                             id="disability_inclusion_company"
                             placeholder="Enter Your Disability Inclusion Policy"
                             class="@error('disability_inclusion_company') is-invalid @enderror"
                             value="{{ old('disability_inclusion_company') }}"> Available Flexible
                      working shifts
                    </div>

                  </div>


                </div>

                <span class="spin"></span>
                @error('disability_inclusion_company')
                <strong class="text-danger">{{ $errors->first('disability_inclusion_company') }}</strong>
                @enderror
              </div>
            </div>
          </div>
          <div class="form-group row m-3">
            <div class="col-sm-12 text-right">
              <button class="btn btn-success btn-sm w-100 text-center" type="submit">Register</button>
            </div>
          </div>
        </form>
      </div>
    </section>


  <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/select2/js/select2.min.js') }}"></script>


  <script>
    $(document).ready(function () {
      $('.select2').select2()
      $('input[name="entrepreneur"]').change(function () {
        const $this = $('input[name="entrepreneur"]:checked')
        if ($this.val() == "no") {
          $("#entrepreneur-text").show();
        } else {
          $("#entrepreneur-text").hide();

        }
      });
      $('input[name="facilities"]').click(function () {
        const $this = $('input[name="facilities"]:checked')
        if ($this.val() == "yes") {
          $(".facilities").show();
        } else {
          $(".facilities").hide();

        }
      });
    });
  </script>
  </div>
  </div>
@endsection



