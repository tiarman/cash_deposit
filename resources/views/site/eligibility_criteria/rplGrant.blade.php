@extends('layout.admin')

@section('stylesheet')

@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
          <div class="card-body">
            <section class="panel">
              <header class="panel-heading">
                <h2 class="panel-title text-center mb-5">Eligibility Criteria for RPL Grant </h2>
              </header>
              <div class="panel-body">
                @if(session()->has('status'))
                  {!! session()->get('status') !!}
                @endif
                <form role="form" method="post" id="ea-form" action="{{route('eligibility.rpl.createOrStore')}}" enctype="multipart/form-data">
                  @csrf
                {{-- start row --}}
                  <div class="row border-bottom">
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Years of Institute Establishment<span class="text-danger">*</span></label>
                            <input type="text" name="years_of_institute_establishment" id="years_of_institute_establishment"
                            value="{{old("years_of_institute_establishment")}}"
                            placeholder=""
                            class="form-control yearPicker @error('years_of_institute_establishment') is-invalid @enderror"
                            >
                            @error("years_of_institute_establishment")
                            <strong class="text-danger">{{ $errors->first("years_of_institute_establishment") }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Condition<span class="text-danger">*</span></label>
                            <select name="condition_for_years_of_institute_establishment" id="condition_for_years_of_institute_establishment" readonly
                              class="form-control @error("condition_for_years_of_institute_establishment") is-invalid @enderror">
                                <option value="">Choose a type</option>
                                <option value="5">Established 10 years ago or more = 5 points</option>
                                <option value="3">Established 9 to 7 years  = 3 points</option>
                                <option value="2">Established 6 to 4 years  = 2 points</option>
                                <option value="0">Established 3 or less years  = 0 point</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Score<span class="text-danger">*</span></label>
                            <input type="text" 
                            readonly
                            name="years_of_institute_establishment_score" id="years_of_institute_establishment_score"
                            value="0"
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
                            checkEstablishAndRtoYear(e.target)
                          })
                          $('#years_of_rto_registration').change(function (e) {
                            checkEstablishAndRtoYear(e.target)
                          })
                        //   checkEstablishAndRtoYear()
      
      
                          function checkEstablishAndRtoYear(e) {
                            const targetId = e?.id;
                            console.log('es = ',targetId)
                            const currentDate = new Date();
                            const currentYear = parseInt(currentDate.getFullYear());
                            let year = 0;

                            if(targetId){
                                const getYear = ($(`#${targetId}`)?.val()).split('-');
                                year = getYear[0];
                            }
                            if (year === 0) {
                              return 0;
                            }
                            console.log(year);
                            $(`#condition_for_${targetId}`).find('option[selected="selected"]').removeAttr('selected');
                            // $("#condition_for_years_of_institute_establishment").find('option').attr('disabled', 'true');
                            if (targetId ) {
                              if ((currentYear - year) >= 10) {
                                $(`#condition_for_${targetId} > option[value='5']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='5']`).prop("selected", true);
                                $(`#${targetId}_score`).val(5);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              else if ((currentYear - year) >= 7) {
                                $(`#condition_for_${targetId} > option[value='3']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='3']`).prop("selected", true);
                                $(`#${targetId}_score`).val(3);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              else if ((currentYear - year) > 3) {
                                $(`#condition_for_${targetId} > option[value='2']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='2']`).prop("selected", true);
                                $(`#${targetId}_score`).val(2);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              else{
                                $(`#condition_for_${targetId} > option[value='0']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='0']`).prop("selected", true);
                                $(`#${targetId}_score`).val(0);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                            }
                          }
                        })
                    </script>

                    {{-- year end --}}
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Years of RTO registration <span class="text-danger">*</span></label>
                            <input type="text" name="years_of_rto_registration" id="years_of_rto_registration"
                            value="{{old("years_of_rto_registration")}}"
                            placeholder=""
                            class="form-control yearPicker @error('years_of_rto_registration') is-invalid @enderror"
                            >
                            @error("years_of_rto_registration")
                            <strong class="text-danger">{{ $errors->first("years_of_rto_registration") }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Condition<span class="text-danger">*</span></label>
                            <select name="condition_for_years_of_rto_registration" id="condition_for_years_of_rto_registration" readonly
                              class="form-control @error("condition_for_years_of_rto_registration") is-invalid @enderror">
                                <option value="">Choose a type</option>
                                <option value="5">Reg. >= 10 years = 5 points</option>
                                <option value="3">Reg. >= 7 years  = 3 points</option>
                                <option value="3">Reg. >= 4 years  = 2 points</option>
                                <option value="0">Reg. < 3 years  = 0 point</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4"> 
                        <div class="form-group">
                            <label for="">Score<span class="text-danger">*</span></label>
                            <input type="text" 
                            readonly
                            name="years_of_rto_registration_score" id="years_of_rto_registration_score"
                            value="0"
                            placeholder="0"
                            class="form-control @error('years_of_rto_registration_score') is-invalid @enderror"
                            >
                            @error("years_of_rto_registration_score")
                            <strong class="text-danger">{{ $errors->first("years_of_rto_registration_score") }}</strong>
                            @enderror
                        </div>
                    </div>
                    {{-- end rto --}}

                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">No. of Batch Conducted RPL by the Institute <span class="text-danger">*</span></label>
                            <input type="number" name="number_of_batch_conducted_rpl_by_the_institute" id="number_of_batch_conducted_rpl_by_the_institute"
                            value="{{old("number_of_batch_conducted_rpl_by_the_institute")}}"
                            placeholder=""
                            class="form-control @error('number_of_batch_conducted_rpl_by_the_institute') is-invalid @enderror"
                            >
                            @error("number_of_batch_conducted_rpl_by_the_institute")
                            <strong class="text-danger">{{ $errors->first("number_of_batch_conducted_rpl_by_the_institute") }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Condition<span class="text-danger">*</span></label>
                            <select name="condition_for_number_of_batch_conducted_rpl_by_the_institute" id="condition_for_number_of_batch_conducted_rpl_by_the_institute" readonly
                              class="form-control @error("condition_for_number_of_batch_conducted_rpl_by_the_institute") is-invalid @enderror">
                                <option value="">Choose a type</option>
                                <option value="5">No. of Batch Conducted > 10 years = 5 points</option>
                                <option value="3">No. of Batch Conducted > 8 years  = 3 points</option>
                                <option value="2">No. of Batch Conducted >= 5 years  = 2 points</option>
                                <option value="0">No. of Batch Conducted < 5 years  = 0 point</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Score<span class="text-danger">*</span></label>
                            <input type="text" 
                            readonly
                            name="number_of_batch_conducted_rpl_by_the_institute_score" id="number_of_batch_conducted_rpl_by_the_institute_score"
                            value="0"
                            placeholder="0"
                            class="form-control @error('number_of_batch_conducted_rpl_by_the_institute_score') is-invalid @enderror"
                            >
                            @error("number_of_batch_conducted_rpl_by_the_institute_score")
                            <strong class="text-danger">{{ $errors->first("number_of_batch_conducted_rpl_by_the_institute_score") }}</strong>
                            @enderror
                        </div>
                    </div>
                    <script>
                        $(document).ready(function () {
                            // function create for- wordsheet serial number: 3
                          $('#number_of_batch_conducted_rpl_by_the_institute').change(function (e) {
                            numberOfBatchConducted(e.target)
                          })
                        //   numberOfBatchConducted()
      
      
                          function numberOfBatchConducted(e) {
                            const targetId = e?.id;
                            const value = e?.value;
                            console.log('es = ',targetId)
                            // const currentDate = new Date();
                            // const currentYear = parseInt(currentDate.getFullYear());
                            // let year = 0;

                            // if(targetId){
                            //     const getYear = ($(`#${targetId}`)?.val()).split('-');
                            //     year = getYear[0];
                            // }
                            // if (year === 0) {
                            //   return 0;
                            // }
                            // console.log(year);
                            $(`#condition_for_${targetId}`).find('option[selected="selected"]').removeAttr('selected');
                            // $("#condition_for_years_of_institute_establishment").find('option').attr('disabled', 'true');
                            if (targetId ) {
                              if (value > 10) {
                                $(`#condition_for_${targetId} > option[value='5']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='5']`).prop("selected", true);
                                $(`#${targetId}_score`).val(5);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              else if (value > 8) {
                                $(`#condition_for_${targetId} > option[value='3']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='3']`).prop("selected", true);
                                $(`#${targetId}_score`).val(3);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              else if (value >= 5) {
                                $(`#condition_for_${targetId} > option[value='2']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='2']`).prop("selected", true);
                                $(`#${targetId}_score`).val(2);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              else{
                                $(`#condition_for_${targetId} > option[value='0']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='0']`).prop("selected", true);
                                $(`#${targetId}_score`).val(0);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                            }
                          }
                        })
                    </script>
                    {{-- end batch --}}
                  </div>
                  {{-- end row --}}

                  {{-- start row --}}
                  <div class="row mt-4 border-bottom ">
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Trade wise no. of trainer for RPL facilitation  <span class="text-danger">*</span></label>
                            <input type="number" name="trade_wise_no_of_trainer_instructor_for_rpl_facilitation" id="trade_wise_no_of_trainer_instructor_for_rpl_facilitation"
                            value="{{old("trade_wise_no_of_trainer_instructor_for_rpl_facilitation")}}"
                            placeholder=""
                            class="form-control @error('trade_wise_no_of_trainer_instructor_for_rpl_facilitation') is-invalid @enderror"
                            >
                            @error("trade_wise_no_of_trainer_instructor_for_rpl_facilitation")
                            <strong class="text-danger">{{ $errors->first("trade_wise_no_of_trainer_instructor_for_rpl_facilitation") }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Condition<span class="text-danger">*</span></label>
                            <select name="condition_for_trade_wise_no_of_trainer_instructor_for_rpl_facilitation" id="condition_for_trade_wise_no_of_trainer_instructor_for_rpl_facilitation" readonly
                              class="form-control @error("condition_for_trade_wise_no_of_trainer_instructor_for_rpl_facilitation") is-invalid @enderror">
                                <option value="">Choose a type</option>
                                <option value="5">No. of Trainer > 5 = 5 points</option>
                                <option value="3">Trainer > 3  = 3 points</option>
                                <option value="2">Trainer >= 1  = 2 points</option>
                                <option value="0">Trainer < 1  = 0 point</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Score<span class="text-danger">*</span></label>
                            <input type="text" 
                            readonly
                            name="trade_wise_no_of_trainer_instructor_for_rpl_facilitation_score" id="trade_wise_no_of_trainer_instructor_for_rpl_facilitation_score"
                            value="0"
                            placeholder="0"
                            class="form-control @error('trade_wise_no_of_trainer_instructor_for_rpl_facilitation_score') is-invalid @enderror"
                            >
                            @error("trade_wise_no_of_trainer_instructor_for_rpl_facilitation_score")
                            <strong class="text-danger">{{ $errors->first("trade_wise_no_of_trainer_instructor_for_rpl_facilitation_score") }}</strong>
                            @enderror
                        </div>
                    </div>
                    <script>
                        $(document).ready(function () {
                            // function create for- wordsheet serial number: 4, 9
                          $('#trade_wise_no_of_trainer_instructor_for_rpl_facilitation').change(function (e) {
                            tradeAndOccupationWise(e.target)
                          })
                          $('#occupation_wise_number_of_rpl_assessor').change(function (e) {
                            tradeAndOccupationWise(e.target)
                          })
                        //   tradeAndOccupationWise()
      
      
                          function tradeAndOccupationWise(e) {
                            const targetId = e?.id;
                            const value = e?.value;
                            console.log('es = ',targetId)

                            $(`#condition_for_${targetId}`).find('option[selected="selected"]').removeAttr('selected');

                            if (targetId ) {
                              if (value > 5) {
                                $(`#condition_for_${targetId} > option[value='5']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='5']`).prop("selected", true);
                                $(`#${targetId}_score`).val(5);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              else if (value > 3) {
                                $(`#condition_for_${targetId} > option[value='3']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='3']`).prop("selected", true);
                                $(`#${targetId}_score`).val(3);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              else if (value >= 1) {
                                $(`#condition_for_${targetId} > option[value='2']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='2']`).prop("selected", true);
                                $(`#${targetId}_score`).val(2);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              else{
                                $(`#condition_for_${targetId} > option[value='0']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='0']`).prop("selected", true);
                                $(`#${targetId}_score`).val(0);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                            }
                          }
                        })
                    </script>
                    {{-- end trade --}}

                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Number of occupations of RPL<span class="text-danger">*</span></label>
                            <input type="number" name="number_of_occupations_of_rpl" id="number_of_occupations_of_rpl"
                            value="{{old("number_of_occupations_of_rpl")}}"
                            placeholder=""
                            class="form-control @error('number_of_occupations_of_rpl') is-invalid @enderror"
                            >
                            @error("number_of_occupations_of_rpl")
                            <strong class="text-danger">{{ $errors->first("number_of_occupations_of_rpl") }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Condition<span class="text-danger">*</span></label>
                            <select name="condition_for_number_of_occupations_of_rpl" id="condition_for_number_of_occupations_of_rpl" readonly
                              class="form-control @error("condition_for_number_of_occupations_of_rpl") is-invalid @enderror">
                                <option value="">Choose a type</option>
                                <option value="5">No. of Occupation >= 5 = 5 points</option>
                                <option value="1">No. of Occupation > 0  = 1 points (for each)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Score<span class="text-danger">*</span></label>
                            <input type="text" 
                            readonly
                            name="number_of_occupations_of_rpl_score" id="number_of_occupations_of_rpl_score"
                            value="0"
                            placeholder="0"
                            class="form-control @error('number_of_occupations_of_rpl_score') is-invalid @enderror"
                            >
                            @error("number_of_occupations_of_rpl_score")
                            <strong class="text-danger">{{ $errors->first("number_of_occupations_of_rpl_score") }}</strong>
                            @enderror
                        </div>
                    </div>
                    <script>
                        // function create for- wordsheet serial number: 5, 15, 16
                        $(document).ready(function () {
                          $('#number_of_occupations_of_rpl').change(function (e) {
                            occupationAndExistenceAndLinkage(e.target)
                          })
                          $('#existence_of_employment_track_record').change(function (e) {
                            occupationAndExistenceAndLinkage(e.target)
                          })
                          $('#linkage_with_industry').change(function (e) {
                            occupationAndExistenceAndLinkage(e.target)
                          })
                        //   occupationAndExistenceAndLinkage()
      
      
                          function occupationAndExistenceAndLinkage(e) {
                            const targetId = e?.id;
                            const value = e?.value;
                            console.log('es = ',targetId)

                            $(`#condition_for_${targetId}`).find('option[selected="selected"]').removeAttr('selected');
                            
                            if (targetId ) {
                              if (value >= 5) {
                                $(`#condition_for_${targetId} > option[value='5']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='5']`).prop("selected", true);
                                $(`#${targetId}_score`).val(5);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              else{
                                $(`#condition_for_${targetId} > option[value='0']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='0']`).prop("selected", true);
                                $(`#${targetId}_score`).val(value);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                            }
                          }
                        })
                    </script>
                    {{-- end occupation --}}

                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Level (NTVQF) of RPL assessment<span class="text-danger">*</span></label>
                            <select name="level_ntvqf_of_rpl_assessment" id="level_ntvqf_of_rpl_assessment" 
                              class="form-control @error("level_ntvqf_of_rpl_assessment") is-invalid @enderror">
                        <option value="">Choose a type</option>
                          <option value="4">Level 4</option>
                          <option value="3">Level 3</option>
                          <option value="2">Level 2</option>
                          <option value="1">Level 1</option>
                      </select>
                      @error("level_ntvqf_of_rpl_assessment")
                      <strong class="text-danger">{{ $errors->first("level_ntvqf_of_rpl_assessment") }}</strong>
                      @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Condition<span class="text-danger">*</span></label>
                            <select name="condition_for_level_ntvqf_of_rpl_assessment" id="condition_for_level_ntvqf_of_rpl_assessment" readonly
                              class="form-control @error("condition_for_level_ntvqf_of_rpl_assessment") is-invalid @enderror">
                                <option value="">Choose a type</option>
                                <option value="4">Level 4 = 5 points</option>
                                <option value="3">Level 3 = 4 points</option>
                                <option value="2">Level 2 = 3 points</option>
                                <option value="1">Level 1 = 2 points</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Score<span class="text-danger">*</span></label>
                            <input type="text" 
                            readonly
                            name="level_ntvqf_of_rpl_assessment_score" id="level_ntvqf_of_rpl_assessment_score"
                            value="0"
                            placeholder="0"
                            class="form-control @error('level_ntvqf_of_rpl_assessment_score') is-invalid @enderror"
                            >
                            @error("level_ntvqf_of_rpl_assessment_score")
                            <strong class="text-danger">{{ $errors->first("level_ntvqf_of_rpl_assessment_score") }}</strong>
                            @enderror
                        </div>
                    </div>
                    <script>
                        // function create for- wordsheet serial number: 6
                        $(document).ready(function () {
                          $('#level_ntvqf_of_rpl_assessment').change(function (e) {
                            levelNtvqf(e.target)
                          })
                        //   levelNtvqf()
      
      
                          function levelNtvqf(e) {
                            const targetId = e?.id;
                            const value = e?.value;
                            console.log('es = ',targetId)

                            $(`#condition_for_${targetId}`).find('option[selected="selected"]').removeAttr('selected');
                            
                            if (targetId ) {
                              if (value == 4) {
                                $(`#condition_for_${targetId} > option[value='4']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='4']`).prop("selected", true);
                                $(`#${targetId}_score`).val(5);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              if (value == 3) {
                                $(`#condition_for_${targetId} > option[value='3']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='3']`).prop("selected", true);
                                $(`#${targetId}_score`).val(4);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              if (value == 2) {
                                $(`#condition_for_${targetId} > option[value='2']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='2']`).prop("selected", true);
                                $(`#${targetId}_score`).val(3);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              else{
                                $(`#condition_for_${targetId} > option[value='1']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='1']`).prop("selected", true);
                                $(`#${targetId}_score`).val(2);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                            }
                          }
                        })
                    </script>
                    {{-- end level --}}
                  </div>
                  {{-- end row --}}
                  {{-- start row --}}
                  <div class="row mt-4 border-bottom ">
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Total number of RPL assessment <span class="text-danger">*</span></label>
                            <input type="number" name="total_number_of_rpl_assessment" id="total_number_of_rpl_assessment"
                            value="{{old("total_number_of_rpl_assessment")}}"
                            placeholder=""
                            class="form-control @error('total_number_of_rpl_assessment') is-invalid @enderror"
                            >
                            @error("total_number_of_rpl_assessment")
                            <strong class="text-danger">{{ $errors->first("total_number_of_rpl_assessment") }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Condition<span class="text-danger">*</span></label>
                            <select name="condition_for_total_number_of_rpl_assessment" id="condition_for_total_number_of_rpl_assessment" readonly
                              class="form-control @error("condition_for_total_number_of_rpl_assessment") is-invalid @enderror">
                                <option value="">Choose a type</option>
                                <option value="5">No. of Assessment >= 250 = 5 points</option>
                                <option value="3">No. of Assessment >= 200 = 3 points</option>
                                <option value="2">No. of Assessment >= 150 = 2 points</option>
                                <option value="1">No. of Assessment >= 100 = 1 points</option>
                                <option value="0">No. of Assessment < 100  = 0 points</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Score<span class="text-danger">*</span></label>
                            <input type="text" 
                            readonly
                            name="total_number_of_rpl_assessment_score" id="total_number_of_rpl_assessment_score"
                            value="0"
                            placeholder="0"
                            class="form-control @error('total_number_of_rpl_assessment_score') is-invalid @enderror"
                            >
                            @error("total_number_of_rpl_assessment_score")
                            <strong class="text-danger">{{ $errors->first("total_number_of_rpl_assessment_score") }}</strong>
                            @enderror
                        </div>
                    </div>
                    <script>
                        // function create for- wordsheet serial number: 7
                        $(document).ready(function () {
                          $('#total_number_of_rpl_assessment').change(function (e) {
                            numberOfAssessment(e.target)
                          })
                        //   numberOfAssessment()
      
      
                          function numberOfAssessment(e) {
                            const targetId = e?.id;
                            const value = e?.value;
                            console.log('es = ',targetId)

                            $(`#condition_for_${targetId}`).find('option[selected="selected"]').removeAttr('selected');
                            
                            if (targetId ) {
                              if (value >= 250) {
                                $(`#condition_for_${targetId} > option[value='5']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='5']`).prop("selected", true);
                                $(`#${targetId}_score`).val(5);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              if (value >= 200) {
                                $(`#condition_for_${targetId} > option[value='3']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='3']`).prop("selected", true);
                                $(`#${targetId}_score`).val(4);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              if (value >= 150) {
                                $(`#condition_for_${targetId} > option[value='2']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='2']`).prop("selected", true);
                                $(`#${targetId}_score`).val(3);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              if (value >= 100) {
                                $(`#condition_for_${targetId} > option[value='1']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='1']`).prop("selected", true);
                                $(`#${targetId}_score`).val(3);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              else{
                                $(`#condition_for_${targetId} > option[value='0']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='0']`).prop("selected", true);
                                $(`#${targetId}_score`).val(2);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                            }
                          }
                        })
                    </script>
                    {{-- end total rpl assess --}}

                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Total number of RPL certification<span class="text-danger">*</span></label>
                            <input type="number" name="total_number_of_rpl_certification" id="total_number_of_rpl_certification"
                            value="{{old("total_number_of_rpl_certification")}}"
                            placeholder=""
                            class="form-control @error('total_number_of_rpl_certification') is-invalid @enderror"
                            >
                            @error("total_number_of_rpl_certification")
                            <strong class="text-danger">{{ $errors->first("total_number_of_rpl_certification") }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Condition<span class="text-danger">*</span></label>
                            <select name="condition_for_total_number_of_rpl_certification" id="condition_for_total_number_of_rpl_certification" readonly
                              class="form-control @error("condition_for_total_number_of_rpl_certification") is-invalid @enderror">
                                <option value="">Choose a type</option>
                                <option value="5">No. of Certification >= 250 = 5 points</option>
                                <option value="3">No. of Certification >= 150 = 3 points</option>
                                <option value="2">No. of Certification >= 100 = 2 points</option>
                                <option value="1">No. of Certification >= 50 = 1 points</option>
                                <option value="0">No. of Certification < 50  = 0 points</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Score<span class="text-danger">*</span></label>
                            <input type="text" 
                            readonly
                            name="total_number_of_rpl_certification_score" id="total_number_of_rpl_certification_score"
                            value="0"
                            placeholder="0"
                            class="form-control @error('total_number_of_rpl_certification_score') is-invalid @enderror"
                            >
                            @error("total_number_of_rpl_certification_score")
                            <strong class="text-danger">{{ $errors->first("total_number_of_rpl_certification_score") }}</strong>
                            @enderror
                        </div>
                    </div>
                    <script>
                        // function create for- wordsheet serial number: 8
                        $(document).ready(function () {
                          $('#total_number_of_rpl_certification').change(function (e) {
                            numberOfCertification(e.target)
                          })
                        //   numberOfCertification()
      
      
                          function numberOfCertification(e) {
                            const targetId = e?.id;
                            const value = e?.value;
                            console.log('es = ',targetId)

                            $(`#condition_for_${targetId}`).find('option[selected="selected"]').removeAttr('selected');
                            
                            if (targetId ) {
                              if (value >= 250) {
                                $(`#condition_for_${targetId} > option[value='5']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='5']`).prop("selected", true);
                                $(`#${targetId}_score`).val(5);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              if (value >= 150) {
                                $(`#condition_for_${targetId} > option[value='3']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='3']`).prop("selected", true);
                                $(`#${targetId}_score`).val(4);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              if (value >= 100) {
                                $(`#condition_for_${targetId} > option[value='2']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='2']`).prop("selected", true);
                                $(`#${targetId}_score`).val(3);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              if (value >= 50) {
                                $(`#condition_for_${targetId} > option[value='1']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='1']`).prop("selected", true);
                                $(`#${targetId}_score`).val(3);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              else{
                                $(`#condition_for_${targetId} > option[value='0']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='0']`).prop("selected", true);
                                $(`#${targetId}_score`).val(2);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                            }
                          }
                        })
                    </script>
                    {{-- end certification --}}

                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Occupation wise number of RPL assessor (if any)<span class="text-danger">*</span></label>
                            <input type="number" name="occupation_wise_number_of_rpl_assessor" id="occupation_wise_number_of_rpl_assessor"
                            value="{{old("occupation_wise_number_of_rpl_assessor")}}"
                            placeholder=""
                            class="form-control @error('occupation_wise_number_of_rpl_assessor') is-invalid @enderror"
                            >
                            @error("occupation_wise_number_of_rpl_assessor")
                            <strong class="text-danger">{{ $errors->first("occupation_wise_number_of_rpl_assessor") }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Condition<span class="text-danger">*</span></label>
                            <select name="condition_for_occupation_wise_number_of_rpl_assessor" id="condition_for_occupation_wise_number_of_rpl_assessor" readonly
                              class="form-control @error("condition_for_occupation_wise_number_of_rpl_assessor") is-invalid @enderror">
                                <option value="">Choose a type</option>
                                <option value="5">No. of RPL Assessor > 5 = 5 points</option>
                                <option value="3">No. of RPL Assessor > 3 = 3 points</option>
                                <option value="2">No. of RPL Assessor >= 1 = 2 points</option>
                                <option value="0">No. of RPL Assessor < 1 = 0 point</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Score<span class="text-danger">*</span></label>
                            <input type="text" 
                            readonly
                            name="occupation_wise_number_of_rpl_assessor_score" id="occupation_wise_number_of_rpl_assessor_score"
                            value="0"
                            placeholder="0"
                            class="form-control @error('occupation_wise_number_of_rpl_assessor_score') is-invalid @enderror"
                            >
                            @error("occupation_wise_number_of_rpl_assessor_score")
                            <strong class="text-danger">{{ $errors->first("occupation_wise_number_of_rpl_assessor_score") }}</strong>
                            @enderror
                        </div>
                    </div>
                    {{-- end rpl assessor --}}
                  </div>
                  {{-- end row --}}
                  {{-- start row --}}
                  <div class="row mt-4 border-bottom ">
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Number of RPL workshop with list of equipments<span class="text-danger">*</span></label>
                            <select name="number_of_rpl_workshop_with_list_of_equipments" id="number_of_rpl_workshop_with_list_of_equipments" 
                              class="form-control @error("number_of_rpl_workshop_with_list_of_equipments") is-invalid @enderror">
                                <option value="">Choose a type</option>
                                <option value="5">Yes</option>
                                <option value="0">No</option>
                                
                            </select>
                            @error("number_of_rpl_workshop_with_list_of_equipments")
                            <strong class="text-danger">{{ $errors->first("number_of_rpl_workshop_with_list_of_equipments") }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Condition<span class="text-danger">*</span></label>
                            <select name="condition_for_number_of_rpl_workshop_with_list_of_equipments" id="condition_for_number_of_rpl_workshop_with_list_of_equipments" readonly
                              class="form-control @error("condition_for_number_of_rpl_workshop_with_list_of_equipments") is-invalid @enderror">
                                <option value="">Choose a type</option>
                                <option value="5">Yes = 5</option>
                                <option value="0">No = 0</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Score<span class="text-danger">*</span></label>
                            <input type="text" 
                            readonly
                            name="number_of_rpl_workshop_with_list_of_equipments_score" id="number_of_rpl_workshop_with_list_of_equipments_score"
                            value="0"
                            placeholder="0"
                            class="form-control @error('number_of_rpl_workshop_with_list_of_equipments_score') is-invalid @enderror"
                            >
                            @error("number_of_rpl_workshop_with_list_of_equipments_score")
                            <strong class="text-danger">{{ $errors->first("number_of_rpl_workshop_with_list_of_equipments_score") }}</strong>
                            @enderror
                        </div>
                    </div>
                    <script>
                        // function create for- wordsheet serial number: 10, 11, 12, 13, 14,17, 18, 19, 20
                        $(document).ready(function () {
                            // yesno
                          $('#number_of_rpl_workshop_with_list_of_equipments').change(function (e) {
                            wordSheetSerial_10_11_12_13_14_17_18_19_20(e.target)
                          })
                          $('#boarding_and_lodging_facilities').change(function (e) {
                            wordSheetSerial_10_11_12_13_14_17_18_19_20(e.target)
                          })
                          $('#rpl_awareness_activities').change(function (e) {
                            wordSheetSerial_10_11_12_13_14_17_18_19_20(e.target)
                          })
                          $('#existence_of_job_placement_centre').change(function (e) {
                            wordSheetSerial_10_11_12_13_14_17_18_19_20(e.target)
                          })
                          $('#existence_of_occupation_counselling').change(function (e) {
                            wordSheetSerial_10_11_12_13_14_17_18_19_20(e.target)
                          })
                          $('#implementation_plan').change(function (e) {
                            wordSheetSerial_10_11_12_13_14_17_18_19_20(e.target)
                          })
                          $('#investment_plan').change(function (e) {
                            wordSheetSerial_10_11_12_13_14_17_18_19_20(e.target)
                          })
                          $('#environmental_and_social_management_plan').change(function (e) {
                            wordSheetSerial_10_11_12_13_14_17_18_19_20(e.target)
                          })
                          $('#presence_of_occupational_health_and_safety').change(function (e) {
                            wordSheetSerial_10_11_12_13_14_17_18_19_20(e.target)
                          })
                        //   wordSheetSerial_10_11_12_13_14_17_18_19_20()
      
      
                          function wordSheetSerial_10_11_12_13_14_17_18_19_20(e) {
                            const targetId = e?.id;
                            const value = e?.value;
                            console.log('es = ',targetId)

                            $(`#condition_for_${targetId}`).find('option[selected="selected"]').removeAttr('selected');
                            
                            if (targetId ) {
                              if (value == 5) {
                                $(`#condition_for_${targetId} > option[value='5']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='5']`).prop("selected", true);
                                $(`#${targetId}_score`).val(5);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                              else{
                                $(`#condition_for_${targetId} > option[value='0']`).removeAttr("disabled");
                                $(`#condition_for_${targetId} > option[value='0']`).prop("selected", true);
                                $(`#${targetId}_score`).val(0);
                                // console.log('est option = ', opt)
                                return 0;
                              }
                            }
                          }
                        })
                    </script>
                    {{-- end workshop --}}

                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Boarding and Lodging facilities<span class="text-danger">*</span></label>
                            <select name="boarding_and_lodging_facilities" id="boarding_and_lodging_facilities"
                            class="form-control @error("boarding_and_lodging_facilities") is-invalid @enderror">
                            <option value="">Choose a type</option>
                            <option value="5" @selected(old("boarding_and_lodging_facilities"))>Yes</option>
                            <option value="0" @selected(old("boarding_and_lodging_facilities"))>No</option>
                            </select>
                            @error("boarding_and_lodging_facilities")
                            <strong class="text-danger">{{ $errors->first("boarding_and_lodging_facilities") }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Condition<span class="text-danger">*</span></label>
                            <select name="condition_for_boarding_and_lodging_facilities" id="condition_for_boarding_and_lodging_facilities" readonly
                              class="form-control @error("condition_for_boarding_and_lodging_facilities") is-invalid @enderror">
                                <option value="">Choose a type</option>
                                <option value="5">Yes = 5</option>
                                <option value="0">No = 0</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Score<span class="text-danger">*</span></label>
                            <input type="text" 
                            readonly
                            name="boarding_and_lodging_facilities_score" id="boarding_and_lodging_facilities_score"
                            value="0"
                            placeholder="0"
                            class="form-control @error('boarding_and_lodging_facilities_score') is-invalid @enderror"
                            >
                            @error("boarding_and_lodging_facilities_score")
                            <strong class="text-danger">{{ $errors->first("boarding_and_lodging_facilities_score") }}</strong>
                            @enderror
                        </div>
                    </div>
                    {{-- end boarding --}}

                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">RPL Awareness activities<span class="text-danger">*</span></label>
                            <select name="rpl_awareness_activities" id="rpl_awareness_activities"
                            class="form-control @error("rpl_awareness_activities") is-invalid @enderror">
                            <option value="">Choose a type</option>
                            <option value="5" @selected(old("rpl_awareness_activities"))>Yes</option>
                            <option value="0" @selected(old("rpl_awareness_activities"))>No</option>
                            </select>
                            @error("rpl_awareness_activities")
                            <strong class="text-danger">{{ $errors->first("rpl_awareness_activities") }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Condition<span class="text-danger">*</span></label>
                            <select name="condition_for_rpl_awareness_activities" id="condition_for_rpl_awareness_activities" readonly
                              class="form-control @error("condition_for_rpl_awareness_activities") is-invalid @enderror">
                                <option value="">Choose a type</option>
                                <option value="5">Yes = 5</option>
                                <option value="0">No = 0</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Score<span class="text-danger">*</span></label>
                            <input type="text" 
                            readonly
                            name="rpl_awareness_activities_score" id="rpl_awareness_activities_score"
                            value="0"
                            placeholder="0"
                            class="form-control @error('rpl_awareness_activities_score') is-invalid @enderror"
                            >
                            @error("rpl_awareness_activities_score")
                            <strong class="text-danger">{{ $errors->first("rpl_awareness_activities_score") }}</strong>
                            @enderror
                        </div>
                    </div>
                    {{-- end awarness --}}
                  </div>
                  {{-- end row --}}
                  {{-- start row --}}
                   <div class="row mt-4 border-bottom ">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Existence of job placement centre <span class="text-danger">*</span></label>
                                <select name="existence_of_job_placement_centre" id="existence_of_job_placement_centre"
                                class="form-control @error("existence_of_job_placement_centre") is-invalid @enderror">
                                <option value="">Choose a type</option>
                                <option value="5" @selected(old("existence_of_job_placement_centre"))>Yes</option>
                                <option value="0" @selected(old("existence_of_job_placement_centre"))>No</option>
                                </select>
                                @error("existence_of_job_placement_centre")
                                <strong class="text-danger">{{ $errors->first("existence_of_job_placement_centre") }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Condition<span class="text-danger">*</span></label>
                                <select name="condition_for_existence_of_job_placement_centre" id="condition_for_existence_of_job_placement_centre" readonly
                                  class="form-control @error("condition_for_existence_of_job_placement_centre") is-invalid @enderror">
                                    <option value="">Choose a type</option>
                                    <option value="5">Yes = 5</option>
                                    <option value="0">No = 0</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Score<span class="text-danger">*</span></label>
                                <input type="text" 
                                readonly
                                name="existence_of_job_placement_centre_score" id="existence_of_job_placement_centre_score"
                                value="0"
                                placeholder="0"
                                class="form-control @error('existence_of_job_placement_centre_score') is-invalid @enderror"
                                >
                                @error("existence_of_job_placement_centre_score")
                                <strong class="text-danger">{{ $errors->first("existence_of_job_placement_centre_score") }}</strong>
                                @enderror
                            </div>
                        </div>
                        {{-- end job placement --}}

                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Existence of occupation counselling<span class="text-danger">*</span></label>
                                <select name="existence_of_occupation_counselling" id="existence_of_occupation_counselling"
                                class="form-control @error("existence_of_occupation_counselling") is-invalid @enderror">
                                <option value="">Choose a type</option>
                                <option value="5" @selected(old("existence_of_occupation_counselling"))>Yes</option>
                                <option value="0" @selected(old("existence_of_occupation_counselling"))>No</option>
                                </select>
                                @error("existence_of_occupation_counselling")
                                <strong class="text-danger">{{ $errors->first("existence_of_occupation_counselling") }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Condition<span class="text-danger">*</span></label>
                                <select name="condition_for_existence_of_occupation_counselling" id="condition_for_existence_of_occupation_counselling" readonly
                                  class="form-control @error("condition_for_existence_of_occupation_counselling") is-invalid @enderror">
                                    <option value="">Choose a type</option>
                                    <option value="5">Yes = 5</option>
                                    <option value="0">No = 0</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Score<span class="text-danger">*</span></label>
                                <input type="text" 
                                readonly
                                name="existence_of_occupation_counselling_score" id="existence_of_occupation_counselling_score"
                                value="0"
                                placeholder="0"
                                class="form-control @error('existence_of_occupation_counselling_score') is-invalid @enderror"
                                >
                                @error("existence_of_occupation_counselling_score")
                                <strong class="text-danger">{{ $errors->first("existence_of_occupation_counselling_score") }}</strong>
                                @enderror
                            </div>
                        </div>
                        {{-- end counselling --}}

                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Existence of employment track record<span class="text-danger">*</span></label>
                                <input type="number"
                                name="existence_of_employment_track_record" id="existence_of_employment_track_record"
                                placeholder="0"
                                class="form-control @error('existence_of_employment_track_record') is-invalid @enderror"
                                >
                                @error("existence_of_employment_track_record")
                                <strong class="text-danger">{{ $errors->first("existence_of_employment_track_record") }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Condition<span class="text-danger">*</span></label>
                                <select name="condition_for_existence_of_employment_track_record" id="condition_for_existence_of_employment_track_record" readonly
                                  class="form-control @error("condition_for_existence_of_employment_track_record") is-invalid @enderror">
                                    <option value="">Choose a type</option>
                                    <option value="5">Existence of employment track record >= 5</option>
                                    <option value="0">Existence of employment track record < 5
                                        = 1 (for each industry) </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Score<span class="text-danger">*</span></label>
                                <input type="text" 
                                readonly
                                name="existence_of_employment_track_record_score" id="existence_of_employment_track_record_score"
                                value="0"
                                placeholder="0"
                                class="form-control @error('existence_of_employment_track_record_score') is-invalid @enderror"
                                >
                                @error("existence_of_employment_track_record_score")
                                <strong class="text-danger">{{ $errors->first("existence_of_employment_track_record_score") }}</strong>
                                @enderror
                            </div>
                        </div>
                        {{-- end track record --}}
                    </div>
                    {{-- end row --}}
                    {{-- start row --}}
                    <div class="row mt-4 border-bottom ">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Linkage with industry with name of industry <span class="text-danger">*</span></label>
                                <input type="number"
                                name="linkage_with_industry" id="linkage_with_industry"
                                placeholder="0"
                                class="form-control @error('linkage_with_industry') is-invalid @enderror"
                                >
                                @error("linkage_with_industry")
                                <strong class="text-danger">{{ $errors->first("linkage_with_industry") }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Condition<span class="text-danger">*</span></label>
                                <select name="condition_for_linkage_with_industry" id="condition_for_linkage_with_industry" readonly
                                  class="form-control @error("condition_for_linkage_with_industry") is-invalid @enderror">
                                    <option value="">Choose a type</option>
                                    <option value="5">Linkage with industry >= 5</option>
                                    <option value="0">Linkage with industry < 5
                                        = 1 (for each industry) </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Score<span class="text-danger">*</span></label>
                                <input type="text" 
                                readonly
                                name="linkage_with_industry_score" id="linkage_with_industry_score"
                                value="0"
                                placeholder="0"
                                class="form-control @error('linkage_with_industry_score') is-invalid @enderror"
                                >
                                @error("linkage_with_industry_score")
                                <strong class="text-danger">{{ $errors->first("linkage_with_industry_score") }}</strong>
                                @enderror
                            </div>
                        </div>
                        {{-- end linkage --}}

                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Implementation Plan<span class="text-danger">*</span></label>
                                <select name="implementation_plan" id="implementation_plan"
                                class="form-control @error("implementation_plan") is-invalid @enderror">
                                <option value="">Choose a type</option>
                                <option value="5" @selected(old("implementation_plan"))>Yes</option>
                                <option value="0" @selected(old("implementation_plan"))>No</option>
                                </select>
                                @error("implementation_plan")
                                <strong class="text-danger">{{ $errors->first("implementation_plan") }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Condition<span class="text-danger">*</span></label>
                                <select name="condition_for_implementation_plan" id="condition_for_implementation_plan" readonly
                                  class="form-control @error("condition_for_implementation_plan") is-invalid @enderror">
                                    <option value="">Choose a type</option>
                                    <option value="5">Yes = 5</option>
                                    <option value="0">No = 0</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Score<span class="text-danger">*</span></label>
                                <input type="text" 
                                readonly
                                name="implementation_plan_score" id="implementation_plan_score"
                                value="0"
                                placeholder="0"
                                class="form-control @error('implementation_plan_score') is-invalid @enderror"
                                >
                                @error("implementation_plan_score")
                                <strong class="text-danger">{{ $errors->first("implementation_plan_score") }}</strong>
                                @enderror
                            </div>
                        </div>
                        {{-- end implementation --}}

                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Investment Plan<span class="text-danger">*</span></label>
                                <select name="investment_plan" id="investment_plan"
                                class="form-control @error("investment_plan") is-invalid @enderror">
                                <option value="">Choose a type</option>
                                <option value="5" @selected(old("investment_plan"))>Yes</option>
                                <option value="0" @selected(old("investment_plan"))>No</option>
                                </select>
                                @error("investment_plan")
                                <strong class="text-danger">{{ $errors->first("investment_plan") }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Condition<span class="text-danger">*</span></label>
                                <select name="condition_for_investment_plan" id="condition_for_investment_plan" readonly
                                  class="form-control @error("condition_for_investment_plan") is-invalid @enderror">
                                    <option value="">Choose a type</option>
                                    <option value="5">Yes = 5</option>
                                    <option value="0">No = 0</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Score<span class="text-danger">*</span></label>
                                <input type="text" 
                                readonly
                                name="investment_plan_score" id="investment_plan_score"
                                value="0"
                                placeholder="0"
                                class="form-control @error('investment_plan_score') is-invalid @enderror"
                                >
                                @error("investment_plan_score")
                                <strong class="text-danger">{{ $errors->first("investment_plan_score") }}</strong>
                                @enderror
                            </div>
                        </div>
                        {{-- end investment --}}
                    </div>
                    {{-- end row --}}
                    {{-- start row --}}
                    <div class="row mt-4 border-bottom ">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Environmental and social management plan<span class="text-danger">*</span></label>
                                <select name="environmental_and_social_management_plan" id="environmental_and_social_management_plan"
                                class="form-control @error("environmental_and_social_management_plan") is-invalid @enderror">
                                <option value="">Choose a type</option>
                                <option value="5" @selected(old("environmental_and_social_management_plan"))>Yes</option>
                                <option value="0" @selected(old("environmental_and_social_management_plan"))>No</option>
                                </select>
                                @error("environmental_and_social_management_plan")
                                <strong class="text-danger">{{ $errors->first("environmental_and_social_management_plan") }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Condition<span class="text-danger">*</span></label>
                                <select name="condition_for_environmental_and_social_management_plan" id="condition_for_environmental_and_social_management_plan" readonly
                                  class="form-control @error("condition_for_environmental_and_social_management_plan") is-invalid @enderror">
                                    <option value="">Choose a type</option>
                                    <option value="5">Yes = 5</option>
                                    <option value="0">No = 0</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Score<span class="text-danger">*</span></label>
                                <input type="text" 
                                readonly
                                name="environmental_and_social_management_plan_score" id="environmental_and_social_management_plan_score"
                                value="0"
                                placeholder="0"
                                class="form-control @error('environmental_and_social_management_plan_score') is-invalid @enderror"
                                >
                                @error("environmental_and_social_management_plan_score")
                                <strong class="text-danger">{{ $errors->first("environmental_and_social_management_plan_score") }}</strong>
                                @enderror
                            </div>
                        </div>
                        {{-- end environmental --}}

                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Presence of occupational health and safety<span class="text-danger">*</span></label>
                                <select name="presence_of_occupational_health_and_safety" id="presence_of_occupational_health_and_safety"
                                class="form-control @error("presence_of_occupational_health_and_safety") is-invalid @enderror">
                                <option value="">Choose a type</option>
                                <option value="5" @selected(old("presence_of_occupational_health_and_safety"))>Yes</option>
                                <option value="0" @selected(old("presence_of_occupational_health_and_safety"))>No</option>
                                </select>
                                @error("presence_of_occupational_health_and_safety")
                                <strong class="text-danger">{{ $errors->first("presence_of_occupational_health_and_safety") }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Condition<span class="text-danger">*</span></label>
                                <select name="condition_for_presence_of_occupational_health_and_safety" id="condition_for_presence_of_occupational_health_and_safety" readonly
                                  class="form-control @error("condition_for_presence_of_occupational_health_and_safety") is-invalid @enderror">
                                    <option value="">Choose a type</option>
                                    <option value="5">Yes = 5</option>
                                    <option value="0">No = 0</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Score<span class="text-danger">*</span></label>
                                <input type="text" 
                                readonly
                                name="presence_of_occupational_health_and_safety_score" id="presence_of_occupational_health_and_safety_score"
                                value="0"
                                placeholder="0"
                                class="form-control @error('presence_of_occupational_health_and_safety_score') is-invalid @enderror"
                                >
                                @error("presence_of_occupational_health_and_safety_score")
                                <strong class="text-danger">{{ $errors->first("presence_of_occupational_health_and_safety_score") }}</strong>
                                @enderror
                            </div>
                        </div>
                        {{-- end presence --}}
                        {{-- file start --}}
                        <div class="col-sm-12 col-md-12 col-lg-3">
                          <div class="form-group">
                            <label for="file">File Upload (optional)</label>
                            <input type="file" name="file" id="file"
                            class="form-control @error('file') is-invalid @enderror"
                            >
                          </div>
                          @error('file')
                          <strong class="text-danger">{{$error->first('file')}}</strong>                              
                          @enderror
                        </div>
                        {{-- file script--}}
                        <script>
                          $(document).ready(function(){
                            $("#file").change(function(){
                              const fileInfo = $("#file")[0].files[0];
                              const nameAndType = fileInfo.name.split('.');
                              const name = nameAndType[0];
                              const type = nameAndType[1];
                              const size = Math.round(fileInfo.size/1024);
                              // console.log("file output = ", nameAndType);

                              $('#file_type').val(type);
                              $('#file_type').attr('readonly',true);
                              $('#file_description').val(name);
                              $('#file_description').attr('readonly',true);
                              $('#file_size').val(size+' KB');
                              $('#file_size').attr('readonly',true);
                            });
                          })
                        </script>
                        <div class="col-sm-12 col-md-12 col-lg-3">
                          <div class="form-group">
                            <label for="file_type">File Type</label>
                            <input type="text" name="file_type" id="file_type"
                            class="form-control @error('file_type') is-invalid @enderror"
                            >
                          </div>
                          @error('file_type')
                          <strong class="text-danger">{{$error->first('file_type')}}</strong>                              
                          @enderror
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3">
                          <div class="form-group">
                            <label for="file_description">File Description</label>
                            <input type="text" name="file_description" id="file_description"
                            class="form-control @error('file_description') is-invalid @enderror"
                            >
                          </div>
                          @error('file_description')
                          <strong class="text-danger">{{$error->first('file_description')}}</strong>                              
                          @enderror
                        </div>
                        <div class="col-sm-12 col-lg-3">
                          <div class="form-group">
                            <label for="file_size">File Size</label>
                            <input type="text" name="file_size" id="file_size"
                            class="form-control @error('file_size') is-invalid @enderror">
                          </div>
                          @error('file_size')
                              <strong class="text-center">{{$error->first('file_size')}}</strong>
                          @enderror
                        </div>

                    </div>
                    {{-- end row --}}
                    <div class="row mt-5 ">
                        <div class="col-sm-6 ">
                          <button class="btn w-100 btn-success " type="submit">Save as Draft</button>
                        </div>
                        <div class="col-sm-6 ">
                          <button class="btn w-100 btn-primary " type="submit">Submit</button>
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
      $(".yearPicker").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        startDate: '-50y',
        endDate: '+30y',
        autoclose: true
      });
    </script>
@endsection
