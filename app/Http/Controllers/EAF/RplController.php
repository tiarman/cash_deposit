<?php

namespace App\Http\Controllers\EAF;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Http\Controllers\Controller;
use App\Mail\EAFRplWithoutScoreMail;
use App\Models\Eaf_Rpl;
use App\Models\EafRplAffordabilityOccupation;
use App\Models\EafRplOccupationOfferInfo;
use App\Models\EafRplWithoutScore;
use App\Models\EafRplWithoutScoreFile;
use App\Models\EafShortCourseFile;
use App\Models\Institute;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RplController extends Controller {
  public function createOrStore(Request $request) {
    if (request()->isMethod('post')) {
      $rules = [
        'years_of_institute_establishment' => 'string|nullable',
        'condition_for_years_of_institute_establishment' => 'string|nullable',
        'years_of_institute_establishment_score' => 'string|nullable',
        'years_of_rto_registration' => 'string|nullable',
        'condition_for_years_of_rto_registration' => 'string|nullable',
        'years_of_rto_registration_score' => 'string|nullable',
        'number_of_batch_conducted_rpl_by_the_institute' => 'string|nullable',
        'condition_for_number_of_batch_conducted_rpl_by_the_institute' => 'string|nullable',
        'number_of_batch_conducted_rpl_by_the_institute_score' => 'string|nullable',
        'trade_wise_no_of_trainer_instructor_for_rpl_facilitation' => 'string|nullable',
        'condition_for_trade_wise_no_of_trainer_instructor' => 'string|nullable',
        'trade_wise_no_of_trainer_instructor_for_rpl_facilitation_score' => 'string|nullable',
        'number_of_occupations_of_rpl' => 'string|nullable',
        'condition_for_number_of_occupations_of_rpl' => 'string|nullable',
        'number_of_occupations_of_rpl_score' => 'string|nullable',
        'level_ntvqf_of_rpl_assessment' => 'string|nullable',
        'condition_for_level_ntvqf_of_rpl_assessment' => 'string|nullable',
        'level_ntvqf_of_rpl_assessment_score' => 'string|nullable',
        'total_number_of_rpl_assessment' => 'string|nullable',
        'condition_for_total_number_of_rpl_assessment' => 'string|nullable',
        'total_number_of_rpl_assessment_score' => 'string|nullable',
        'total_number_of_rpl_certification' => 'string|nullable',
        'condition_for_total_number_of_rpl_certification' => 'string|nullable',
        'total_number_of_rpl_certification_score' => 'string|nullable',
        'occupation_wise_number_of_rpl_assessor' => 'string|nullable',
        'condition_for_occupation_wise_number_of_rpl_assessor' => 'string|nullable',
        'occupation_wise_number_of_rpl_assessor_score' => 'string|nullable',
        'number_of_rpl_workshop_with_list_of_equipments' => 'string|nullable',
        'condition_for_number_of_rpl_workshop_with_list_of_equipments' => 'string|nullable',
        'number_of_rpl_workshop_with_list_of_equipments_score' => 'string|nullable',
        'boarding_and_lodging_facilities' => 'string|nullable',
        'condition_for_boarding_and_lodging_facilities' => 'string|nullable',
        'boarding_and_lodging_facilities_score' => 'string|nullable',
        'rpl_awareness_activities' => 'string|nullable',
        'condition_for_rpl_awareness_activities' => 'string|nullable',
        'rpl_awareness_activities_score' => 'string|nullable',
        'existence_of_job_placement_centre' => 'string|nullable',
        'condition_for_existence_of_job_placement_centre' => 'string|nullable',
        'existence_of_job_placement_centre_score' => 'string|nullable',
        'existence_of_occupation_counselling' => 'string|nullable',
        'condition_for_existence_of_occupation_counselling' => 'string|nullable',
        'existence_of_occupation_counselling_score' => 'string|nullable',
        'existence_of_employment_track_record' => 'string|nullable',
        'condition_for_existence_of_employment_track_record' => 'string|nullable',
        'existence_of_employment_track_record_score' => 'string|nullable',
        'linkage_with_industry' => 'string|nullable',
        'condition_for_linkage_with_industry' => 'string|nullable',
        'linkage_with_industry_score' => 'string|nullable',
        'implementation_plan' => 'string|nullable',
        'condition_for_implementation_plan' => 'string|nullable',
        'implementation_plan_score' => 'string|nullable',
        'investment_plan' => 'string|nullable',
        'condition_for_investment_plan' => 'string|nullable',
        'investment_plan_score' => 'string|nullable',
        'environmental_and_social_management_plan' => 'string|nullable',
        'condition_for_environmental_and_social_management_plan' => 'string|nullable',
        'environmental_and_social_management_plan_score' => 'string|nullable',
        'presence_of_occupational_health_and_safety' => 'string|nullable',
        'condition_for_presence_of_occupational_health_and_safety' => 'string|nullable',
        'presence_of_occupational_health_and_safety_score' => 'string|nullable',
        'file_type' => 'string|nullable',
        'file_description' => 'string|nullable',
        'file_size' => 'string|nullable',
      ];

      $request->validate($rules);
      // return $request;
      try {
        $rpl = new Eaf_Rpl();
        $message = '<strong>Congratulations!!!</strong>successfully created.';
        $rpl->years_of_institute_establishment = $request->years_of_institute_establishment;

        $rpl->condition_for_years_of_institute_establishment = $request->condition_for_years_of_institute_establishment;

        $rpl->years_of_institute_establishment_score = $request->years_of_institute_establishment_score;

        $rpl->years_of_rto_registration = $request->years_of_rto_registration;

        $rpl->condition_for_years_of_rto_registration = $request->condition_for_years_of_rto_registration;

        $rpl->years_of_rto_registration_score = $request->years_of_rto_registration_score;

        $rpl->number_of_batch_conducted_rpl_by_the_institute = $request->number_of_batch_conducted_rpl_by_the_institute;

        $rpl->condition_for_number_of_batch_conducted_rpl_by_the_institute = $request->condition_for_number_of_batch_conducted_rpl_by_the_institute;

        $rpl->number_of_batch_conducted_rpl_by_the_institute_score = $request->number_of_batch_conducted_rpl_by_the_institute_score;

        $rpl->trade_wise_no_of_trainer_instructor_for_rpl_facilitation = $request->trade_wise_no_of_trainer_instructor_for_rpl_facilitation;

        $rpl->condition_for_trade_wise_no_of_trainer_instructor = $request->condition_for_trade_wise_no_of_trainer_instructor;

        $rpl->trade_wise_no_of_trainer_instructor_for_rpl_facilitation_score = $request->trade_wise_no_of_trainer_instructor_for_rpl_facilitation_score;

        $rpl->number_of_occupations_of_rpl = $request->number_of_occupations_of_rpl;
        $rpl->condition_for_number_of_occupations_of_rpl = $request->condition_for_number_of_occupations_of_rpl;
        $rpl->number_of_occupations_of_rpl_score = $request->number_of_occupations_of_rpl_score;


        $rpl->level_ntvqf_of_rpl_assessment = $request->level_ntvqf_of_rpl_assessment;
        $rpl->condition_for_level_ntvqf_of_rpl_assessment = $request->condition_for_level_ntvqf_of_rpl_assessment;
        $rpl->level_ntvqf_of_rpl_assessment_score = $request->level_ntvqf_of_rpl_assessment_score;

        $rpl->total_number_of_rpl_assessment = $request->total_number_of_rpl_assessment;
        $rpl->condition_for_total_number_of_rpl_assessment = $request->condition_for_total_number_of_rpl_assessment;
        $rpl->total_number_of_rpl_assessment_score = $request->total_number_of_rpl_assessment_score;

        $rpl->total_number_of_rpl_certification = $request->total_number_of_rpl_certification;
        $rpl->condition_for_total_number_of_rpl_certification = $request->condition_for_total_number_of_rpl_certification;
        $rpl->total_number_of_rpl_certification_score = $request->total_number_of_rpl_certification_score;

        $rpl->occupation_wise_number_of_rpl_assessor = $request->occupation_wise_number_of_rpl_assessor;
        $rpl->condition_for_occupation_wise_number_of_rpl_assessor = $request->condition_for_occupation_wise_number_of_rpl_assessor;
        $rpl->occupation_wise_number_of_rpl_assessor_score = $request->occupation_wise_number_of_rpl_assessor_score;

        $rpl->number_of_rpl_workshop_with_list_of_equipments = $request->number_of_rpl_workshop_with_list_of_equipments;
        $rpl->condition_for_number_of_rpl_workshop_with_list_of_equipments = $request->condition_for_number_of_rpl_workshop_with_list_of_equipments;
        $rpl->number_of_rpl_workshop_with_list_of_equipments_score = $request->number_of_rpl_workshop_with_list_of_equipments_score;

        $rpl->boarding_and_lodging_facilities = $request->boarding_and_lodging_facilities;
        $rpl->condition_for_boarding_and_lodging_facilities = $request->condition_for_boarding_and_lodging_facilities;
        $rpl->boarding_and_lodging_facilities_score = $request->boarding_and_lodging_facilities_score;

        $rpl->rpl_awareness_activities = $request->rpl_awareness_activities;
        $rpl->condition_for_rpl_awareness_activities = $request->condition_for_rpl_awareness_activities;
        $rpl->rpl_awareness_activities_score = $request->rpl_awareness_activities_score;

        $rpl->existence_of_job_placement_centre = $request->existence_of_job_placement_centre;
        $rpl->condition_for_existence_of_job_placement_centre = $request->condition_for_existence_of_job_placement_centre;
        $rpl->existence_of_job_placement_centre_score = $request->existence_of_job_placement_centre_score;

        $rpl->existence_of_occupation_counselling = $request->existence_of_occupation_counselling;
        $rpl->condition_for_existence_of_occupation_counselling = $request->condition_for_existence_of_occupation_counselling;
        $rpl->existence_of_occupation_counselling_score = $request->existence_of_occupation_counselling_score;

        $rpl->existence_of_employment_track_record = $request->existence_of_employment_track_record;
        $rpl->condition_for_existence_of_employment_track_record = $request->condition_for_existence_of_employment_track_record;
        $rpl->existence_of_employment_track_record_score = $request->existence_of_employment_track_record_score;

        $rpl->linkage_with_industry = $request->linkage_with_industry;
        $rpl->condition_for_linkage_with_industry = $request->condition_for_linkage_with_industry;
        $rpl->linkage_with_industry_score = $request->linkage_with_industry_score;

        $rpl->implementation_plan = $request->implementation_plan;
        $rpl->condition_for_implementation_plan = $request->condition_for_implementation_plan;
        $rpl->implementation_plan_score = $request->implementation_plan_score;

        $rpl->investment_plan = $request->investment_plan;
        $rpl->condition_for_investment_plan = $request->condition_for_investment_plan;
        $rpl->investment_plan_score = $request->investment_plan_score;

        $rpl->environmental_and_social_management_plan = $request->environmental_and_social_management_plan;
        $rpl->condition_for_environmental_and_social_management_plan = $request->condition_for_environmental_and_social_management_plan;
        $rpl->environmental_and_social_management_plan_score = $request->environmental_and_social_management_plan_score;

        $rpl->presence_of_occupational_health_and_safety = $request->presence_of_occupational_health_and_safety;
        $rpl->condition_for_presence_of_occupational_health_and_safety = $request->condition_for_presence_of_occupational_health_and_safety;
        $rpl->presence_of_occupational_health_and_safety_score = $request->presence_of_occupational_health_and_safety_score;
        if ($request->has('file')) {

          $rpl->file = CustomHelper::storeImage($request->file, '/eaf-rpl-form/');
        }
        // $rpl->file_type = $request->file_type;
        // $rpl->file_description = $request->file_description;
        // $rpl->file_size = $request->file_size;

        if ($rpl->save()) {
          return RedirectHelper::routeSuccess('eligibility.rpl.createOrStore', $message);
        }
        return RedirectHelper::backWithInput();
      } catch (Exception $e) {
        return RedirectHelper::backWithInputFromException();
      }

    }
    return view('site.eligibility_criteria.rplGrant');
  }


  public function withoutScore(Request $request) {
    if ($request->isMethod('POST')) {
      $request->validate([
        'email' => 'required|email',
        'institute_name_en' => 'required',
        'institute_name_bn' => 'required',
        'institute_code' => 'required',
        'telephone' => 'required',
        'institute_website' => 'nullable|regex:' . CustomHelper::URLRegex,
        'institute_type' => 'required',
        'institute_category' => 'required',
        'division_id' => 'required',
        'district_id' => 'required',
        'upazila_id' => 'required',
        'principal_name' => 'required',
        'principal_phone' => "required|regex:" . CustomHelper::PhoneNoRegex,
        'principal_email' => 'required',
        'years_of_institute_establishment' => 'required',

        "total_enrolled_trainee_2021" => 'required|numeric',
        "female_trainee_2021" => 'required|numeric',
        "total_trainee_completed_2021" => 'required|numeric',
        "percentage_completed_trainee_2021" => 'required|numeric',
        "total_enrolled_trainee_2020" => 'required|numeric',
        "female_trainee_2020" => 'required|numeric',
        "total_trainee_completed_2020" => 'required|numeric',
        "percentage_completed_trainee_2020" => 'required|numeric',
        "total_enrolled_trainee_2019" => 'required|numeric',
        "female_trainee_2019" => 'required|numeric',
        "total_trainee_completed_2019" => 'required|numeric',
        "percentage_completed_trainee_2019" => 'required|numeric',
        "total_occupation_offered" => 'required|numeric',
        "total_number_of_teacher" => 'required|numeric',
        "total_no_of_non_tech_staff" => 'required|numeric',
        "accreditation" => 'required|string',

        "ooi_occupation_title.*" => 'required|string',
        "ooi_year_of_initiated.*" => 'required',
        "ooi_occupation_duration.*" => 'required',
        "ooi_intake_capacity_per_cycle.*" => 'required',
        "ooi_trained_trainee_in2021.*" => 'required',
        "ooi_number_of_teacher.*" => 'required',
        "ooi_occupation_competency_based.*" => 'required',
        "ooi_adopted_framework.*" => 'required',
        "ooi_accredited_by.*" => 'required',

        "sbi_trainee_from_rural_area_2021" => 'required|numeric',
        "sbi_female_trainee_2021" => 'required|numeric',
        "sbi_trainee_with_disabilities_2021" => 'required|numeric',
        "sbi_trainee_of_ethnic_minority_2021" => 'required|numeric',
        "sbi_trainee_from_rural_area_2020" => 'required|numeric',
        "sbi_female_trainee_2020" => 'required|numeric',
        "sbi_trainee_with_disabilities_2020" => 'required|numeric',
        "sbi_trainee_of_ethnic_minority_2020" => 'required|numeric',
        "sbi_trainee_from_rural_area_2019" => 'required|numeric',
        "sbi_female_trainee_2019" => 'required|numeric',
        "sbi_trainee_with_disabilities_2019" => 'required|numeric',
        "sbi_trainee_of_ethnic_minority_2019" => 'required|numeric',

        "ayo_occupation_title.*" => 'required|string',
        "ayo_occupation_duration.*" => 'required|string',
        "ayo_occupation_fee_2019.*" => 'required|numeric',
        "ayo_occupation_fee_2020.*" => 'required|numeric',
        "ayo_occupation_fee_2021.*" => 'required|numeric',

      ]);

      DB::beginTransaction();
      try {

        if ($request->filled('id')) {
          $form = EafRplWithoutScore::find($request->id);
        } else {
          $form = new EafRplWithoutScore();
          $form->applicant_id = auth()->id();
          $form->institute_id = auth()->user()->institute_id;
        }
        $form->email = $request->email;
        $form->institute_name_en = $request->institute_name_en;
        $form->institute_name_bn = $request->institute_name_bn;
        $form->institute_code = $request->institute_code;
        $form->telephone = $request->telephone;
        $form->institute_website = $request->institute_website;
        $form->institute_type = $request->institute_type;
        $form->institute_category = $request->institute_category;
        $form->division_id = $request->division_id;
        $form->district_id = $request->district_id;
        $form->upazila_id = $request->upazila_id;
        $form->principal_name = $request->principal_name;
        $form->principal_phone = $request->principal_phone;
        $form->principal_email = $request->principal_email;
        $form->years_of_institute_establishment = $request->years_of_institute_establishment;

        $form->total_enrolled_trainee_2021 = $request->total_enrolled_trainee_2021;
        $form->female_trainee_2021 = $request->female_trainee_2021;
        $form->total_trainee_completed_2021 = $request->total_trainee_completed_2021;
        $form->percentage_completed_trainee_2021 = $request->percentage_completed_trainee_2021;
        $form->total_enrolled_trainee_2020 = $request->total_enrolled_trainee_2020;
        $form->female_trainee_2020 = $request->female_trainee_2020;
        $form->total_trainee_completed_2020 = $request->total_trainee_completed_2020;
        $form->percentage_completed_trainee_2020 = $request->percentage_completed_trainee_2020;
        $form->total_enrolled_trainee_2019 = $request->total_enrolled_trainee_2019;
        $form->female_trainee_2019 = $request->female_trainee_2019;
        $form->total_trainee_completed_2019 = $request->total_trainee_completed_2019;
        $form->percentage_completed_trainee_2019 = $request->percentage_completed_trainee_2019;
        $form->total_occupation_offered = $request->total_occupation_offered;
        $form->total_number_of_teacher = $request->total_number_of_teacher;
        $form->total_no_of_non_tech_staff = $request->total_no_of_non_tech_staff;
        $form->accreditation = $request->accreditation;


        $form->sbi_trainee_from_rural_area_2021 = $request->sbi_trainee_from_rural_area_2021;
        $form->sbi_female_trainee_2021 = $request->sbi_female_trainee_2021;
        $form->sbi_trainee_with_disabilities_2021 = $request->sbi_trainee_with_disabilities_2021;
        $form->sbi_trainee_of_ethnic_minority_2021 = $request->sbi_trainee_of_ethnic_minority_2021;
        $form->sbi_trainee_from_rural_area_2020 = $request->sbi_trainee_from_rural_area_2020;
        $form->sbi_female_trainee_2020 = $request->sbi_female_trainee_2020;
        $form->sbi_trainee_with_disabilities_2020 = $request->sbi_trainee_with_disabilities_2020;
        $form->sbi_trainee_of_ethnic_minority_2020 = $request->sbi_trainee_of_ethnic_minority_2020;
        $form->sbi_trainee_from_rural_area_2019 = $request->sbi_trainee_from_rural_area_2019;
        $form->sbi_female_trainee_2019 = $request->sbi_female_trainee_2019;
        $form->sbi_trainee_with_disabilities_2019 = $request->sbi_trainee_with_disabilities_2019;
        $form->sbi_trainee_of_ethnic_minority_2019 = $request->sbi_trainee_of_ethnic_minority_2019;


        $form->status = $request->saveSubmit;


        if ($form->save()) {

          if ($request->hasFile('image_upload')) {
            foreach ($request->file('image_upload') as $k => $file) {
              $file = CustomHelper::storeImage($file, '/EAF/RPL/WithoutScore/' . $form->id . '/');
              if ($file) {
                $fileUpload = new EafRplWithoutScoreFile();
                $fileUpload->description = $request->image_filename[$k];
                $fileUpload->type = $request->image_type[$k];
                $fileUpload->size = $request->image_size[$k];
                $fileUpload->file = $file;
                $fileUpload->form_id = $form->id;
                $fileUpload->save();
              }
            }
          }


          foreach ($request->ooi_occupation_title as $k => $ooi_occupation_title) {
            if ($request->ooi_occupation_id[$k]) {
              $ooiOccupation = EafRplOccupationOfferInfo::find($request->ooi_occupation_id[$k]);
            } else {
              $ooiOccupation = new EafRplOccupationOfferInfo();
              $ooiOccupation->form_id = $form->id;
            }

            $ooiOccupation->ooi_occupation_title = $ooi_occupation_title;
            $ooiOccupation->ooi_year_of_initiated = $request->ooi_year_of_initiated[$k];
            $ooiOccupation->ooi_occupation_duration = $request->ooi_occupation_duration[$k];
            $ooiOccupation->ooi_intake_capacity_per_cycle = $request->ooi_intake_capacity_per_cycle[$k];
            $ooiOccupation->ooi_trained_trainee_in2021 = $request->ooi_trained_trainee_in2021[$k];
            $ooiOccupation->ooi_number_of_teacher = $request->ooi_number_of_teacher[$k];
            $ooiOccupation->ooi_occupation_competency_based = $request->ooi_occupation_competency_based[$k];
            $ooiOccupation->ooi_adopted_framework = $request->ooi_adopted_framework[$k];
            $ooiOccupation->ooi_accredited_by = $request->ooi_accredited_by[$k];

            $ooiOccupation->save();
          }

          foreach ($request->ayo_occupation_title as $j => $ayo_occupation_title) {
            if ($request->ayo_occupation_id[$j]) {
              $ayoOccupation = EafRplAffordabilityOccupation::find($request->ayo_occupation_id[$j]);
            } else {
              $ayoOccupation = new EafRplAffordabilityOccupation();
              $ayoOccupation->form_id = $form->id;
            }

            $ayoOccupation->ayo_occupation_title = $ayo_occupation_title;
            $ayoOccupation->ayo_occupation_duration = $request->ayo_occupation_duration[$j];
            $ayoOccupation->ayo_occupation_fee_2019 = $request->ayo_occupation_fee_2019[$j];
            $ayoOccupation->ayo_occupation_fee_2020 = $request->ayo_occupation_fee_2020[$j];
            $ayoOccupation->ayo_occupation_fee_2021 = $request->ayo_occupation_fee_2021[$j];

            $ayoOccupation->save();
          }

          $message = ' drafted';
          if ($form->status == 'submited') {
            $message = ' submitted';
            try {
              ini_set('max_execution_time', 300);
              \Illuminate\Support\Facades\Mail::to($form->email)->cc([
                $form->principal_email,
                'pd@asset-dte.gov.bd',
                'apd@asset-dte.gov.bd',
                'dpd2@asset-dte.gov.bd',
                'po2@asset-dte.gov.bd',
                'programmer@asset-dte.gov.bd',
                'info@asset-dte.gov.bd',
              ])->send(new EAFRplWithoutScoreMail(\route('eligibility.rpl.without.score.pdf', $form->id), $form->institute_name_en, $form->principal_name));
            } catch (\Exception $e) {
            }
          }

          DB::commit();
          $status = '<div class="alert alert-success alert-dismissible show" role="alert">
                  <strong>Congratulation!!! </strong> Application ' . $message . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
              </div>';
          return back()->with('status', $status)->with('url', route('eligibility.rpl.without.score.pdf', $form->id));
        }
        DB::rollBack();
        return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Action not completed.');
      } catch (\Exception $e) {
        DB::rollBack();
        return RedirectHelper::backWithInputFromException();
      }
    }
    $data['institute'] = Institute::find(auth()->user()->institute_id);
    $data['form'] = EafRplWithoutScore::with('oois', 'ayos')->where('applicant_id', auth()->id())->where('institute_id', auth()->user()->institute_id)->first();
    return view('site.eligibility_criteria.eaf_confirmation', $data);
  }


  public function withoutScorePdf($id = 0) {

    ini_set('max_execution_time', 300);
    if ($form = EafRplWithoutScore::with('oois', 'ayos')->where('id', $id)->first()) {
      try {
        return Pdf::loadView('pdf.EafRplWithoutScore', compact('form'))->download('RPL Eligibility Application Form - ' . $form->id . '.pdf');
      } catch (\Exception $e) {
      }
    }
    $status = '<div class="alert alert-warning alert-dismissible show" role="alert">
                  <strong>Sorry!!! </strong> Application not found.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
              </div>';
    return redirect()->route('eligibility.rpl.without.score')->with('status', $status);
  }


  /**
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function formFileDelete($formId = null, $id = null): \Illuminate\Http\RedirectResponse {
    if ($file = EafRplWithoutScoreFile::where('id', $id)->where('form_id', $formId)->first()) {
      $filePath = $file->file;
      if ($file->delete()) {
        CustomHelper::deleteFile($filePath);
        return RedirectHelper::back('<strong>Congratulation!!! </strong> File Successfully Deleted.');
      }
    }
    return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Action not completed.');
  }

  /**
   * @param Request $request
   * @return string|void
   */
  public function withoutScoreDeleteAyo(Request $request) {
    $id = $request->post('id');
    $formId = $request->post('formId');
    if (EafRplWithoutScore::where('id', $formId)->where('status', 'save')->first()) {
      if ($file = EafRplAffordabilityOccupation::where('id', $id)->where('form_id', $formId)->first()) {
        if ($file->delete()) {
          return 'success';
        }
      }
    }
  }


  /**
   * @param Request $request
   * @return string|void
   */
  public function withoutScoreDeleteOoi(Request $request) {
    $id = $request->post('id');
    $formId = $request->post('formId');
    if (EafRplWithoutScore::where('id', $formId)->where('status', 'save')->first()) {
      if ($file = EafRplOccupationOfferInfo::where('id', $id)->where('form_id', $formId)->first()) {
        if ($file->delete()) {
          return 'success';
        }
      }
    }
  }



  public function indexWithoutScore() {
//    if (\request('type') == 'download') {
//      return Excel::download(new EligibilityApplicationFormIDGExport, 'Eligibility Application Form IDG Export ' . now()->format('h:i A F d,Y') . '.xlsx');
//    }
    $data['forms'] = EafRplWithoutScore::with('institute:id,name,phone,email', 'applicant:id,name_en,phone,email')
      ->select('id', 'institute_id', 'applicant_id', 'institute_type as type', 'institute_category as category', 'status')
      ->get();
//    return $data;
    return view('admin.forms.eaf.rplWithoutScore', $data);
  }


  /**
   * @param Request $request
   * @return \Illuminate\Http\RedirectResponse|void
   */
  public function updateStatus(Request $request) {
    if ($request->isMethod("POST")) {
      $id = $request->post('id');
      $postStatus = $request->post('status');
      $status = strtolower($postStatus);
      $form = EafRplWithoutScore::find($id);
      if ($form->update(['status' => $status])) {
        return RedirectHelper::back('<strong>Congratulation!!! </strong> Status updated.');
      }
      return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Action not completed.');
    }
  }
}
