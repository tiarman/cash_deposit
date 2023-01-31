<?php

namespace App\Http\Controllers\EAF;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Http\Controllers\Controller;
use App\Mail\EAFShortCourseMail;
use App\Models\EafRplWithoutScore;
use App\Models\EafShortCourse;
use App\Models\EafShortCourseAffordabilityCourse;
use App\Models\EafShortCourseFile;
use App\Models\EafShortCourseOfferingInfo;
use App\Models\Institute;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShortCourseController extends Controller {
  public function createOrStore(Request $request) {
    if ($request->isMethod('post')) {
//      return $request;
      $rules = [
        'applicant_id' => "nullable",
        'institute_id' => "nullable",
        'email' => "required",
        'institute_name_en' => "required",
        'institute_name_bn' => "required",
        'institute_code' => "required",
        'telephone' => "required",
        'institute_website' => 'nullable|regex:' . CustomHelper::URLRegex,
        'institute_type' => "required",
        'institute_category' => "required",
        'division_id' => "required",
        'district_id' => "required",
        'upazila_id' => "required",
        'principal_name' => "required",
        'principal_phone' => "required|regex:" . CustomHelper::PhoneNoRegex,
        'principal_email' => "required",
        "years_of_institute_establishment" => "required",
        "years_of_institute_establishment_score" => "required",
        "annual_intake" => "required",
        "annual_intake_score" => "required",
        "years_of_accredited_with_bteb" => "required",
        "years_of_accredited_with_bteb_score" => "required",
        "trades_of_short_course_conducted_by_the_institute" => "required",
        "trades_of_short_course_conducted_by_the_institute_score" => "required",
        "completion_rate" => "required",
        "completion_rate_score" => "required",
        "trade_wise_no_of_trainer_instructor" => "required",
        "trade_wise_no_of_trainer_instructor_score" => "required",
        "workshop_with_training_equipment_as_per_cs" => "required",
        "workshop_with_training_equipment_as_per_cs_score" => "required",
        "existence_of_job_placement_cell" => "required",
        "existence_of_job_placement_cell_score" => "required",
        "provision_of_occupational_health_safety" => "required",
        "provision_of_occupational_health_safety_score" => "required",
        "existence_of_employment_track_record" => "required",
        "existence_of_employment_track_record_score" => "required",

//        "coi_occupation_id" => "required",
        "coi_course_title.*" => "required",
        "coi_year_of_initiated.*" => "required",
        "coi_course_duration.*" => "required",
        "coi_intake_capacity_per_cycle.*" => "required",
        "coi_trained_trainee_in2021.*" => "required",
        "coi_number_of_teacher.*" => "required",
        "coi_course_competency_based.*" => "required",
        "coi_adopted_framework.*" => "required",
        "coi_accredited_by.*" => "required",


        "oi_enrolled_trainees_2019" => "required",
        "oi_female_trainee_2019" => "required",
        "oi_completed_trainee_2019" => "required",
        "oi_completed_percentage_2019" => "required",
        "oi_enrolled_trainees_2018" => "required",
        "oi_female_trainee_2018" => "required",
        "oi_completed_trainee_2018" => "required",
        "oi_completed_percentage_2018" => "required",
        "occupation_or_course_offered" => "required",
        "total_number_of_teacher" => "required",
        "total_number_of_non_tech_staff" => "required",
        "accreditation" => "required",
        "accreditation_agency" => "nullable",
        "share_cash_kind" => "required",


        "sbi_trainee_from_rural_area_2019" => "required",
        "sbi_female_trainee_2019" => "required",
        "sbi_trainee_with_disabilities_2019" => "required",
        "sbi_trainee_of_ethnic_minority_2019" => "required",
        "sbi_trainee_from_rural_area_2018" => "required",
        "sbi_female_trainee_2018" => "required",
        "sbi_trainee_with_disabilities_2018" => "required",
        "sbi_trainee_of_ethnic_minority_2018" => "required",


//        "ayc_course_id.*" => 'required',
        "ayc_course_title.*" => 'required',
        "ayc_course_duration.*" => 'required',
        "ayc_course_fee_2019.*" => 'required',
        "ayc_course_fee_2018.*" => 'required',

      ];
      $request->validate($rules);
//return $request;
      $message = '<strong>Congratulations!!!</strong>Application Successfully submitted.';
      DB::beginTransaction();
      try {
        if ($request->filled('id')) {
          $form = EafShortCourse::find($request->id);
        } else {
          $form = new EafShortCourse();
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
        $form->years_of_institute_establishment_score = $request->years_of_institute_establishment_score;
        $form->annual_intake = $request->annual_intake;
        $form->annual_intake_score = $request->annual_intake_score;
        $form->years_of_accredited_with_bteb = $request->years_of_accredited_with_bteb;
        $form->years_of_accredited_with_bteb_score = $request->years_of_accredited_with_bteb_score;
        $form->trades_of_short_course_conducted_by_the_institute = $request->trades_of_short_course_conducted_by_the_institute;
        $form->trades_of_short_course_conducted_by_the_institute_score = $request->trades_of_short_course_conducted_by_the_institute_score;
        $form->completion_rate = $request->completion_rate;
        $form->completion_rate_score = $request->completion_rate_score;
        $form->trade_wise_no_of_trainer_instructor = $request->trade_wise_no_of_trainer_instructor;
        $form->trade_wise_no_of_trainer_instructor_score = $request->trade_wise_no_of_trainer_instructor_score;
        $form->workshop_with_training_equipment_as_per_cs = $request->workshop_with_training_equipment_as_per_cs;
        $form->workshop_with_training_equipment_as_per_cs_score = $request->workshop_with_training_equipment_as_per_cs_score;
        $form->existence_of_job_placement_cell = $request->existence_of_job_placement_cell;
        $form->existence_of_job_placement_cell_score = $request->existence_of_job_placement_cell_score;
        $form->provision_of_occupational_health_safety = $request->provision_of_occupational_health_safety;
        $form->provision_of_occupational_health_safety_score = $request->provision_of_occupational_health_safety_score;
        $form->existence_of_employment_track_record = $request->existence_of_employment_track_record;
        $form->existence_of_employment_track_record_score = $request->existence_of_employment_track_record_score;


        $form->oi_enrolled_trainees_2019 = $request->oi_enrolled_trainees_2019;
        $form->oi_female_trainee_2019 = $request->oi_female_trainee_2019;
        $form->oi_completed_trainee_2019 = $request->oi_completed_trainee_2019;
        $form->oi_completed_percentage_2019 = $request->oi_completed_percentage_2019;
        $form->oi_enrolled_trainees_2018 = $request->oi_enrolled_trainees_2018;
        $form->oi_female_trainee_2018 = $request->oi_female_trainee_2018;
        $form->oi_completed_trainee_2018 = $request->oi_completed_trainee_2018;
        $form->oi_completed_percentage_2018 = $request->oi_completed_percentage_2018;
        $form->occupation_or_course_offered = $request->occupation_or_course_offered;
        $form->total_number_of_teacher = $request->total_number_of_teacher;
        $form->total_number_of_non_tech_staff = $request->total_number_of_non_tech_staff;
        $form->accreditation = $request->accreditation;
        $form->accreditation_agency = $request->accreditation_agency;
        $form->share_cash_kind = $request->share_cash_kind;
        $form->sbi_trainee_from_rural_area_2019 = $request->sbi_trainee_from_rural_area_2019;
        $form->sbi_female_trainee_2019 = $request->sbi_female_trainee_2019;
        $form->sbi_trainee_with_disabilities_2019 = $request->sbi_trainee_with_disabilities_2019;
        $form->sbi_trainee_of_ethnic_minority_2019 = $request->sbi_trainee_of_ethnic_minority_2019;
        $form->sbi_trainee_from_rural_area_2018 = $request->sbi_trainee_from_rural_area_2018;
        $form->sbi_female_trainee_2018 = $request->sbi_female_trainee_2018;
        $form->sbi_trainee_with_disabilities_2018 = $request->sbi_trainee_with_disabilities_2018;
        $form->sbi_trainee_of_ethnic_minority_2018 = $request->sbi_trainee_of_ethnic_minority_2018;


        $form->status = $request->saveSubmit;

        $form->mark = (
          $form->years_of_institute_establishment_score +
          $form->annual_intake_score +
          $form->years_of_accredited_with_bteb_score +
          $form->trades_of_short_course_conducted_by_the_institute_score +
          $form->completion_rate_score +
          $form->trade_wise_no_of_trainer_instructor_score +
          $form->workshop_with_training_equipment_as_per_cs_score +
          $form->existence_of_job_placement_cell_score +
          $form->provision_of_occupational_health_safety_score +
          $form->existence_of_employment_track_record_score
        );
//        return $request;
        if ($form->save()) {

          if ($request->hasFile('image_upload')) {
            foreach ($request->file('image_upload') as $k => $file) {
              $file = CustomHelper::storeImage($file, '/EligibilityShortCourse/' . $form->id . '/');
              if ($file) {
                $fileUpload = new EafShortCourseFile();
                $fileUpload->description = $request->image_filename[$k];
                $fileUpload->type = $request->image_type[$k];
                $fileUpload->size = $request->image_size[$k];
                $fileUpload->file = $file;
                $fileUpload->form_id = $form->id;
                $fileUpload->save();
              }
            }
          }


          foreach ($request->coi_course_title as $k => $coi_course_title) {
            if ($request->coi_course_id[$k]) {
              $coiCourse = EafShortCourseOfferingInfo::find($request->coi_course_id[$k]);
            } else {
              $coiCourse = new EafShortCourseOfferingInfo();
              $coiCourse->form_id = $form->id;
            }

            $coiCourse->coi_course_title = $coi_course_title;
            $coiCourse->coi_year_of_initiated = $request->coi_year_of_initiated[$k];
            $coiCourse->coi_course_duration = $request->coi_course_duration[$k];
            $coiCourse->coi_intake_capacity_per_cycle = $request->coi_intake_capacity_per_cycle[$k];
            $coiCourse->coi_trained_trainee_in2021 = $request->coi_trained_trainee_in2021[$k];
            $coiCourse->coi_number_of_teacher = $request->coi_number_of_teacher[$k];
            $coiCourse->coi_course_competency_based = $request->coi_course_competency_based[$k];
            $coiCourse->coi_adopted_framework = $request->coi_adopted_framework[$k];
            $coiCourse->coi_accredited_by = $request->coi_accredited_by[$k];

            $coiCourse->save();
          }

          foreach ($request->ayc_course_title as $j => $ayc_course_title) {
            if ($request->ayc_course_id[$j]) {
              $ayoCourse = EafShortCourseAffordabilityCourse::find($request->ayc_course_id[$j]);
            } else {
              $ayoCourse = new EafShortCourseAffordabilityCourse();
              $ayoCourse->form_id = $form->id;
            }

            $ayoCourse->ayc_course_title = $ayc_course_title;
            $ayoCourse->ayc_course_duration = $request->ayc_course_duration[$j];
            $ayoCourse->ayc_course_fee_2019 = $request->ayc_course_fee_2019[$j];
            $ayoCourse->ayc_course_fee_2018 = $request->ayc_course_fee_2018[$j];

            $ayoCourse->save();
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
              'dpd1@asset-dte.gov.bd',
              'po1@asset-dte.gov.bd',
              'programmer@asset-dte.gov.bd',
              'info@asset-dte.gov.bd',
            ])->send(new EAFShortCourseMail(\route('eligibility.course.pdf', $form->id), $form->institute_name_en, $form->principal_name));
            } catch (\Exception $e) {
            }
          }

          DB::commit();
          $status = '<div class="alert alert-success alert-dismissible show" role="alert">
                  <strong>Congratulation!!! </strong> Application ' . $message . '.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
              </div>';
          return back()->with('status', $status)->with('url', route('form.pdf', $form->id));
        }
        DB::rollBack();
        return RedirectHelper::backWithInput();
      } catch (Exception $e) {
        DB::rollBack();
        return RedirectHelper::backWithInputFromException();
      }
    }
    $data['institute'] = Institute::find(auth()->user()->institute_id);
    $data['form'] = EafShortCourse::with('cois', 'aycs')->where('applicant_id', auth()->id())->where('institute_id', auth()->user()->institute_id)->first();
//return $data;
    return view('site.eligibility_criteria.shortCourse', $data);
  }


  public function pdf($id = null) {

//    return redirect()->back();
    ini_set('max_execution_time', 300);
    if ($form = EafShortCourse::where('id', $id)->first()) {
//        return view('pdf.eligibilityAffplicationForm', compact('form'));
      try {
//        return view('pdf.eligibilityShortCourse', compact('form'));
        return Pdf::loadView('pdf.eligibilityShortCourse', compact('form'))->download('Short Course Eligibility Application Form - ' . $form->id . '.pdf');
      } catch (\Exception $e) {
      }
    }
    $status = '<div class="alert alert-warning alert-dismissible show" role="alert">
                  <strong>Sorry!!! </strong> Application not found.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
              </div>';
    return redirect()->route('eligibility.course.createOrStore')->with('status', $status);
  }


  /**
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function formFileDelete($formId = null, $id = null): \Illuminate\Http\RedirectResponse {
    if ($file = EafShortCourseFile::where('id', $id)->where('form_id', $formId)->first()) {
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
  public function shortCourseDeleteAco(Request $request) {
    $id = $request->post('id');
    $formId = $request->post('formId');
    if (EafShortCourse::where('id', $formId)->where('status', 'save')->first()) {
      if ($file = EafShortCourseAffordabilityCourse::where('id', $id)->where('form_id', $formId)->first()) {
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
  public function shortCourseDeleteCoi(Request $request) {
    $id = $request->post('id');
    $formId = $request->post('formId');
    if (EafShortCourse::where('id', $formId)->where('status', 'save')->first()) {
      if ($file = EafShortCourseOfferingInfo::where('id', $id)->where('form_id', $formId)->first()) {
        if ($file->delete()) {
          return 'success';
        }
      }
    }
  }




  public function index() {
//    if (\request('type') == 'download') {
//      return Excel::download(new EligibilityApplicationFormIDGExport, 'Eligibility Application Form IDG Export ' . now()->format('h:i A F d,Y') . '.xlsx');
//    }
    $data['forms'] = EafShortCourse::with('institute:id,name,phone,email', 'applicant:id,name_en,phone,email')
      ->select('id', 'institute_id', 'applicant_id', 'institute_type as type', 'institute_category as category', 'mark', 'status')
      ->get();
//    return $data;
    return view('admin.forms.eaf.shortCourse', $data);
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
      $form = EafShortCourse::find($id);
      if ($form->update(['status' => $status])) {
        return RedirectHelper::back('<strong>Congratulation!!! </strong> Status updated.');
      }
      return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Action not completed.');
    }
  }
}
