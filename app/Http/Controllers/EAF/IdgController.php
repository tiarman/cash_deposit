<?php

namespace App\Http\Controllers\EAF;

use App\Exports\EligibilityApplicationFormIDGExport;
use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Http\Controllers\Controller;
use App\Models\EligibilityApplicationFormIdg;
use App\Models\EligibilityApplicationFormIdgFile;
use App\Models\Institute;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class IdgController extends Controller {
  public function createForm(Request $request) {
    if ($request->isMethod('POST')) {
//      return $request;

      $request->validate([
        'email' => 'required|email',
        'institute_name_en' => 'required',
        'institute_name_bn' => 'required',
        'institute_code' => 'required',
        'telephone' => 'required',
        'institute_website' => 'required|regex:' . CustomHelper::URLRegex,
        'institute_type' => 'required',
        'institute_category' => 'required',
        'division_id' => 'required',
        'district_id' => 'required',
        'upazila_id' => 'required',
        'principal_name' => 'required',
        'principal_phone' => 'required',
        'principal_email' => 'required',
        'establishment_year' => 'required',
        'score_for_establishment_year' => 'required',

        'student_intake_capacity_2022' => 'nullable|numeric|gte:no_of_actual_student_2022',
        'student_intake_capacity_2021' => 'required|numeric|gte:no_of_actual_student_2021',
        'student_intake_capacity_2020' => 'required|numeric|gte:no_of_actual_student_2020',
        'student_intake_capacity_2019' => 'nullable|numeric|gte:no_of_actual_student_2019',
        'no_of_actual_student_2022' => 'nullable|numeric|lte:student_intake_capacity_2022',
        'no_of_actual_student_2021' => 'required|numeric|lte:student_intake_capacity_2021',
        'no_of_actual_student_2020' => 'required|numeric|lte:student_intake_capacity_2020',
        'no_of_actual_student_2019' => 'nullable|numeric|lte:student_intake_capacity_2019',
        'score_for_intake_criterion' => 'required',

        'no_students_form_fill_up_2022' => 'nullable|numeric|gte:no_students_passed_2022',
        'no_students_form_fill_up_2021' => 'required|numeric|gte:no_students_passed_2021',
        'no_students_form_fill_up_2020' => 'required|numeric|gte:no_students_passed_2020',
        'no_students_form_fill_up_2019' => 'nullable|numeric|gte:no_students_passed_2019',
        'no_students_passed_2022' => 'nullable|numeric|lte:no_students_form_fill_up_2022',
        'no_students_passed_2021' => 'required|numeric|lte:no_students_form_fill_up_2021',
        'no_students_passed_2020' => 'required|numeric|lte:no_students_form_fill_up_2020',
        'no_students_passed_2019' => 'nullable|numeric|lte:no_students_form_fill_up_2019',
        'average_passed_students_last_3_year' => 'required',
        'average_passed_rate_last_3_year' => 'required',
        'score_of_students_passed_rates' => 'required',

        'total_students_2022' => 'nullable|numeric|gte:total_female_students_2022',
        'total_students_2021' => 'required|numeric|gte:total_female_students_2021',
        'total_students_2020' => 'required|numeric|gte:total_female_students_2020',
        'total_students_2019' => 'nullable|numeric|gte:total_female_students_2019',
        'total_female_students_2022' => 'nullable|numeric|lte:total_students_2022',
        'total_female_students_2021' => 'required|numeric|lte:total_students_2021',
        'total_female_students_2020' => 'required|numeric|lte:total_students_2020',
        'total_female_students_2019' => 'nullable|numeric|lte:total_students_2019',
        'avg_student_of_last_3_year' => 'required',
        'avg_female_student_of_last_3_year' => 'required',
        'score_of_student_population' => 'required',

        'no_of_technology_or_trade_courses' => 'required|numeric',
        'score_no_of_technology_or_trade_courses' => 'required',

        'total_number_of_approved_teachers' => 'required|numeric',
        'total_number_of_reguler_teachers' => 'required|numeric',
        'total_number_of_contractual_teachers' => 'required|numeric',
        'teacher_vacancy_ratio' => 'required',
        'score_of_teacher_vacancy_ratio' => 'required',
        'score_for_student_teacher_ratio' => 'required',
        'premise_type' => 'required',
        'score_for_infrastructure' => 'required',

        'external_audit_performed_2022' => 'nullable|numeric',
        'external_audit_performed_2021' => 'required|numeric',
        'external_audit_performed_2020' => 'required|numeric',
        'external_audit_performed_2019' => 'nullable|numeric',
//        'opinions_of_external_audit_2022' => 'nullable|numeric',
//        'opinions_of_external_audit_2021' => 'nullable|numeric',
//        'opinions_of_external_audit_2020' => 'nullable|numeric',
//        'opinions_of_external_audit_2019' => 'nullable|numeric',
        'score_of_audit' => 'nullable|numeric',

        'institute_have_own_land' => 'required',
        'amount_of_total_land' => 'nullable|numeric',
        'price_of_land' => 'nullable|numeric',
        'date_of_purchase_or_ownership' => 'nullable|date',
        'location_of_land' => 'nullable|string',

        'institute_accreditation_from_competent_authority' => 'required|numeric',
        'have_you_receive_idg_from_step' => 'required|numeric',
        'idg_amount_awarded_from_step' => 'nullable|required_if:have_you_receive_idg_from_step,1|numeric|gte:idg_amount_utilized_under_step',
        'idg_amount_utilized_under_step' => 'nullable|required_if:have_you_receive_idg_from_step,1|numeric|lte:idg_amount_awarded_from_step',
        'idg_received_from_any_other_gob_project_or_budget' => 'required',
        'name_of_the_project' => 'nullable|required_if:idg_received_from_any_other_gob_project_or_budget,1|string',
        'year_of_financing' => 'nullable|required_if:idg_received_from_any_other_gob_project_or_budget,1|numeric',
        'duration_of_financing' => 'nullable|required_if:idg_received_from_any_other_gob_project_or_budget,1|string',
        'amount_received' => 'nullable|required_if:idg_received_from_any_other_gob_project_or_budget,1|numeric',
        'outcomes' => ['nullable', 'required_if:idg_received_from_any_other_gob_project_or_budget,1', 'string'],
        'institute_have_rto' => 'required|numeric',
        'self_finance_at_least_15_of_the_cash' => 'nullable|required_if:institute_type,private|numeric',
      ]);
//      return $request;
//      return redirect()->back()->withInput();
      DB::beginTransaction();
      try {

        if ($request->filled('id')) {
          $form = EligibilityApplicationFormIdg::find($request->id);
        } else {
          $form = new EligibilityApplicationFormIdg();
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
        $form->establishment_year = $request->establishment_year;
        $form->score_for_establishment_year = $request->score_for_establishment_year;
        $form->student_intake_capacity_2022 = $request->student_intake_capacity_2022;
        $form->student_intake_capacity_2021 = $request->student_intake_capacity_2021;
        $form->student_intake_capacity_2020 = $request->student_intake_capacity_2020;
        $form->student_intake_capacity_2019 = $request->student_intake_capacity_2019;
        $form->no_of_actual_student_2022 = $request->no_of_actual_student_2022;
        $form->no_of_actual_student_2021 = $request->no_of_actual_student_2021;
        $form->no_of_actual_student_2020 = $request->no_of_actual_student_2020;
        $form->no_of_actual_student_2019 = $request->no_of_actual_student_2019;
        $form->score_for_intake_criterion = $request->score_for_intake_criterion;
        $form->no_students_form_fill_up_2022 = $request->no_students_form_fill_up_2022;
        $form->no_students_form_fill_up_2021 = $request->no_students_form_fill_up_2021;
        $form->no_students_form_fill_up_2020 = $request->no_students_form_fill_up_2020;
        $form->no_students_form_fill_up_2019 = $request->no_students_form_fill_up_2019;
        $form->no_students_passed_2022 = $request->no_students_passed_2022;
        $form->no_students_passed_2021 = $request->no_students_passed_2021;
        $form->no_students_passed_2020 = $request->no_students_passed_2020;
        $form->no_students_passed_2019 = $request->no_students_passed_2019;
        $form->average_passed_students_last_3_year = $request->average_passed_students_last_3_year;
        $form->average_passed_rate_last_3_year = $request->average_passed_rate_last_3_year;
        $form->score_of_students_passed_rates = $request->score_of_students_passed_rates;
        $form->total_students_2022 = $request->total_students_2022;
        $form->total_students_2021 = $request->total_students_2021;
        $form->total_students_2020 = $request->total_students_2020;
        $form->total_students_2019 = $request->total_students_2019;
        $form->total_female_students_2022 = $request->total_female_students_2022;
        $form->total_female_students_2021 = $request->total_female_students_2021;
        $form->total_female_students_2020 = $request->total_female_students_2020;
        $form->total_female_students_2019 = $request->total_female_students_2019;
        $form->avg_student_of_last_3_year = $request->avg_student_of_last_3_year;
        $form->avg_female_student_of_last_3_year = $request->avg_female_student_of_last_3_year;
        $form->score_of_student_population = $request->score_of_student_population;
        $form->score_of_female_student_population = $request->score_of_female_student_population ?? $request->score_of_female_student_population_val;
        $form->no_of_technology_or_trade_courses = $request->no_of_technology_or_trade_courses;
        $form->score_no_of_technology_or_trade_courses = $request->score_no_of_technology_or_trade_courses;
        $form->total_number_of_approved_teachers = $request->total_number_of_approved_teachers;
        $form->total_number_of_reguler_teachers = $request->total_number_of_reguler_teachers;
        $form->total_number_of_contractual_teachers = $request->total_number_of_contractual_teachers;
        $form->teacher_vacancy_ratio = (double)$request->teacher_vacancy_ratio;
        $form->score_of_teacher_vacancy_ratio = $request->score_of_teacher_vacancy_ratio;
        $form->score_for_student_teacher_ratio = $request->score_for_student_teacher_ratio;
        $form->premise_type = $request->premise_type;
        $form->score_for_infrastructure = $request->score_for_infrastructure;
        $form->external_audit_performed_2022 = ($form->institute_type == 'government') ? 1 : $request->external_audit_performed_2022;
        $form->external_audit_performed_2021 = ($form->institute_type == 'government') ? 1 : $request->external_audit_performed_2021;
        $form->external_audit_performed_2020 = ($form->institute_type == 'government') ? 1 : $request->external_audit_performed_2020;
        $form->external_audit_performed_2019 = ($form->institute_type == 'government') ? 1 : $request->external_audit_performed_2019;
        $form->opinions_of_external_audit_2022 = $request->opinions_of_external_audit_2022 ?? 0;
        $form->opinions_of_external_audit_2021 = $request->opinions_of_external_audit_2021 ?? 0;
        $form->opinions_of_external_audit_2020 = $request->opinions_of_external_audit_2020 ?? 0;
        $form->opinions_of_external_audit_2019 = $request->opinions_of_external_audit_2019 ?? 0;
        $form->score_of_audit = ($form->institute_type == 'government') ? 5 : $request->score_of_audit ?? 0;

        $form->institute_have_own_land = $request->institute_have_own_land ?? false;
        $form->amount_of_total_land = $request->amount_of_total_land;
        $form->price_of_land = $request->price_of_land;
        $form->date_of_purchase_or_ownership = $request->date_of_purchase_or_ownership;
        $form->location_of_land = $request->location_of_land;

        $form->institute_accreditation_from_competent_authority = $request->institute_accreditation_from_competent_authority;
        $form->have_you_receive_idg_from_step = $request->have_you_receive_idg_from_step;
        $form->idg_amount_awarded_from_step = $request->idg_amount_awarded_from_step ?? 0;
        $form->idg_amount_utilized_under_step = $request->idg_amount_utilized_under_step ?? 0;
        $form->has_objections_or_lawsuit = $request->has_objections_or_lawsuit ?? 0;
        $form->idg_received_from_any_other_gob_project_or_budget = $request->idg_received_from_any_other_gob_project_or_budget;
        $form->name_of_the_project = $request->name_of_the_project;
        $form->year_of_financing = $request->year_of_financing;
        $form->duration_of_financing = $request->duration_of_financing;
        $form->amount_received = $request->amount_received;
        $form->outcomes = $request->outcomes;
        $form->institute_have_rto = $request->institute_have_rto;
        $form->self_finance_at_least_15_of_the_cash = $request->self_finance_at_least_15_of_the_cash;
        $form->status = $request->saveSubmit;

        $form->mark = (
          $form->score_for_establishment_year +
          $form->score_for_intake_criterion +
          $form->score_of_students_passed_rates +
          $form->score_of_student_population +
          $form->score_of_female_student_population +
          $form->score_no_of_technology_or_trade_courses +
          $form->score_of_teacher_vacancy_ratio +
          $form->score_for_student_teacher_ratio +
          $form->score_for_infrastructure +
          $form->score_of_audit
        );

        if ($form->save()) {

          if ($request->hasFile('image_upload')) {
            foreach ($request->file('image_upload') as $k => $file) {
              $file = CustomHelper::storeImage($file, '/EligibilityApplicationForm/' . $form->id . '/');
              if ($file) {
                $fileUpload = new EligibilityApplicationFormIdgFile();
                $fileUpload->description = $request->image_filename[$k];
                $fileUpload->type = $request->image_type[$k];
                $fileUpload->size = $request->image_size[$k];
                $fileUpload->file = $file;
                $fileUpload->form_id = $form->id;
                $fileUpload->save();
              }
            }
          }
          $message = ' drafted';
          if ($form->status == 'submited') {
            $message = ' submitted';
            try {
              ini_set('max_execution_time', 300);
              // , 'apd@asset-dte.gov.bd', 'pd@asset-dte.gov.bd'
              \Illuminate\Support\Facades\Mail::to($form->email)->cc([
                $form->principal_email,
                'pd@asset-dte.gov.bd',
                'apd@asset-dte.gov.bd',
                'dpd3@asset-dte.gov.bd',
                'dpd4@asset-dte.gov.bd',
                'programmer@asset-dte.gov.bd',
                'info@asset-dte.gov.bd',
              ])->send(new \App\Mail\EligibilityApplicationFormIdgMail(\route('form.pdf', $form->id), $form->institute_name_en, $form->principal_name));
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
        return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Action not completed.');
      } catch (\Exception $e) {
        DB::rollBack();
        return RedirectHelper::backWithInputFromException();
      }
    }
    $data['institute'] = Institute::find(auth()->user()->institute_id);
    $data['form'] = EligibilityApplicationFormIdg::where('applicant_id', auth()->id())->where('institute_id', auth()->user()->institute_id)->first();
    return view('site.form', $data);
  }


  public function pdf($id = null) {

    ini_set('max_execution_time', 300);
    if ($form = EligibilityApplicationFormIdg::where('id', $id)->first()) {
//        return view('pdf.eligibilityAffplicationForm', compact('form'));
      try {
        return Pdf::loadView('pdf.eligibilityAffplicationForm', compact('form'))->download('IDG Eligibility Application Form - ' . $form->id . '.pdf');
      } catch (\Exception $e) {
      }
    }
    $status = '<div class="alert alert-warning alert-dismissible show" role="alert">
                  <strong>Sorry!!! </strong> Application not found.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
              </div>';
    return redirect()->route('form')->with('status', $status);
  }


  /**
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function formFileDelete($formId = null, $id = null): \Illuminate\Http\RedirectResponse {
    if ($file = EligibilityApplicationFormIdgFile::where('id', $id)->where('form_id', $formId)->first()) {
      $filePath = $file->file;
      if ($file->delete()) {
        CustomHelper::deleteFile($filePath);
        return RedirectHelper::back('<strong>Congratulation!!! </strong> File Successfully Deleted.');
      }
    }
    return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Action not completed.');
  }


  public function index() {
    if (\request('type') == 'download') {
      return Excel::download(new EligibilityApplicationFormIDGExport, 'Eligibility Application Form IDG Export ' . now()->format('h:i A F d,Y') . '.xlsx');
    }
    $data['forms'] = EligibilityApplicationFormIdg::with('institute:id,name,phone,email', 'applicant:id,name_en,phone,email')
      ->select('id', 'institute_id', 'applicant_id', 'institute_type as type', 'institute_category as category', 'mark', 'status')
      ->get();
//    return $data;
    return view('admin.forms.eaf.idg', $data);
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
      $form = EligibilityApplicationFormIdg::find($id);
      if ($form->update(['status' => $status])) {
        return RedirectHelper::back('<strong>Congratulation!!! </strong> Status updated.');
      }
      return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Action not completed.');
    }
  }
}
