<?php

namespace App\Exports;

use App\Models\EligibilityApplicationFormIdg;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EligibilityApplicationFormIDGExport implements FromCollection, WithHeadings {
  /**
   * @return \Illuminate\Support\Collection
   */
  public function collection() {
    return EligibilityApplicationFormIdg::with('applicant:id,name_en', 'division:id,name', 'district:id,name', 'upazila:id,name')->where('status', 'submit')
      ->get()->map(function ($item, $key) {
        $newItem = new \stdClass();
        $newItem->serial = ($key+1);
        $newItem->name_en = $item->applicant?->name_en;
        $newItem->institute_name_en = $item->institute_name_en;
        $newItem->institute_name_bn = $item->institute_name_bn;
        $newItem->email = $item->email;
        $newItem->institute_code = $item->institute_code;
        $newItem->telephone = $item->telephone;
        $newItem->institute_website = $item->institute_website;
        $newItem->institute_type = $item->institute_type;
        $newItem->institute_category = $item->institute_category;
        $newItem->division = $item->division?->name;
        $newItem->district = $item->district?->name;
        $newItem->upazila = $item->upazila?->name;
        $newItem->principal_name = $item->principal_name;
        $newItem->principal_phone = $item->principal_phone;
        $newItem->principal_email = $item->principal_email;
        $newItem->establishment_year = $item->establishment_year;
        $newItem->score_for_establishment_year = $item->score_for_establishment_year;
        $newItem->student_intake_capacity_2022 = $item->student_intake_capacity_2022;
        $newItem->student_intake_capacity_2021 = $item->student_intake_capacity_2021;
        $newItem->student_intake_capacity_2020 = $item->student_intake_capacity_2020;
        $newItem->student_intake_capacity_2019 = $item->student_intake_capacity_2019;


        $newItem->no_of_actual_student_2022 = $item->no_of_actual_student_2022;
        $newItem->no_of_actual_student_2021 = $item->no_of_actual_student_2021;
        $newItem->no_of_actual_student_2020 = $item->no_of_actual_student_2020;
        $newItem->no_of_actual_student_2019 = $item->no_of_actual_student_2019;
        $newItem->score_for_intake_criterion = $item->score_for_intake_criterion;


        $newItem->no_students_form_fill_up_2022 = $item->no_students_form_fill_up_2022;
        $newItem->no_students_form_fill_up_2021 = $item->no_students_form_fill_up_2021;
        $newItem->no_students_form_fill_up_2020 = $item->no_students_form_fill_up_2020;
        $newItem->no_students_form_fill_up_2019 = $item->no_students_form_fill_up_2019;


        $newItem->no_students_passed_2022 = $item->no_students_passed_2022;
        $newItem->no_students_passed_2021 = $item->no_students_passed_2021;
        $newItem->no_students_passed_2020 = $item->no_students_passed_2020;
        $newItem->no_students_passed_2019 = $item->no_students_passed_2019;

        $newItem->average_passed_students_last_3_year = $item->average_passed_students_last_3_year;
        $newItem->average_passed_rate_last_3_year = $item->average_passed_rate_last_3_year;
        $newItem->score_of_students_passed_rates = $item->score_of_students_passed_rates;


        $newItem->total_students_2022 = $item->total_students_2022;
        $newItem->total_students_2021 = $item->total_students_2021;
        $newItem->total_students_2020 = $item->total_students_2020;
        $newItem->total_students_2019 = $item->total_students_2019;

        $newItem->total_female_students_2022 = $item->total_female_students_2022;
        $newItem->total_female_students_2021 = $item->total_female_students_2021;
        $newItem->total_female_students_2020 = $item->total_female_students_2020;
        $newItem->total_female_students_2019 = $item->total_female_students_2019;

        $newItem->avg_student_of_last_3_year = $item->avg_student_of_last_3_year;
        $newItem->avg_female_student_of_last_3_year = $item->avg_female_student_of_last_3_year;
        $newItem->score_of_student_population = $item->score_of_student_population;
        $newItem->no_of_technology_or_trade_courses = $item->no_of_technology_or_trade_courses;
        $newItem->score_no_of_technology_or_trade_courses = $item->score_no_of_technology_or_trade_courses;
        $newItem->total_number_of_approved_teachers = $item->total_number_of_approved_teachers;
        $newItem->total_number_of_reguler_teachers = $item->total_number_of_reguler_teachers;
        $newItem->total_number_of_contractual_teachers = $item->total_number_of_contractual_teachers;
        $newItem->teacher_vacancy_ratio = $item->teacher_vacancy_ratio;
        $newItem->score_of_teacher_vacancy_ratio = $item->score_of_teacher_vacancy_ratio;
        $newItem->score_for_student_teacher_ratio = $item->score_for_student_teacher_ratio;
        $newItem->premise_type = $item->premise_type;
        $newItem->score_for_infrastructure = $item->score_for_infrastructure;


        $newItem->external_audit_performed_2022 = EligibilityApplicationFormIdg::$boolTypesName[$item->external_audit_performed_2022 ?? 0];
        $newItem->external_audit_performed_2021 = EligibilityApplicationFormIdg::$boolTypesName[$item->external_audit_performed_2021 ?? 0];
        $newItem->external_audit_performed_2020 = EligibilityApplicationFormIdg::$boolTypesName[$item->external_audit_performed_2020 ?? 0];
        $newItem->external_audit_performed_2019 = EligibilityApplicationFormIdg::$boolTypesName[$item->external_audit_performed_2019 ?? 0];


        $newItem->opinions_of_external_audit_2022 = EligibilityApplicationFormIdg::$externalAuditTypesName[$item->opinions_of_external_audit_2022 ?? 0];
        $newItem->opinions_of_external_audit_2021 = EligibilityApplicationFormIdg::$externalAuditTypesName[$item->opinions_of_external_audit_2021 ?? 0];
        $newItem->opinions_of_external_audit_2020 = EligibilityApplicationFormIdg::$externalAuditTypesName[$item->opinions_of_external_audit_2020 ?? 0];
        $newItem->opinions_of_external_audit_2019 = EligibilityApplicationFormIdg::$externalAuditTypesName[$item->opinions_of_external_audit_2019 ?? 0];
        $newItem->institute_have_own_land = $item->institute_have_own_land;
        $newItem->amount_of_total_land = $item->amount_of_total_land;
        $newItem->price_of_land = $item->price_of_land;
        $newItem->date_of_purchase_or_ownership = $item->date_of_purchase_or_ownership;
        $newItem->location_of_land = $item->location_of_land;
        $newItem->institute_accreditation_from_competent_authority = $item->institute_accreditation_from_competent_authority;
        $newItem->have_you_receive_idg_from_step = $item->have_you_receive_idg_from_step;
        $newItem->idg_amount_awarded_from_step = $item->idg_amount_awarded_from_step;
        $newItem->idg_amount_utilized_under_step = $item->idg_amount_utilized_under_step;
        $newItem->idg_received_from_any_other_gob_project_or_budget = $item->idg_received_from_any_other_gob_project_or_budget;
        $newItem->name_of_the_project = $item->name_of_the_project;
        $newItem->year_of_financing = $item->year_of_financing;
        $newItem->duration_of_financing = $item->duration_of_financing;
        $newItem->amount_received = $item->amount_received;
        $newItem->outcomes = $item->outcomes;
        $newItem->institute_have_rto = $item->institute_have_rto;
        $newItem->self_finance_at_least_15_of_the_cash = $item->self_finance_at_least_15_of_the_cash;
        $newItem->mark = $item->mark;
        $newItem->status = $item->status;
        return $newItem;
      });
  }

  /**
   * Write code on Method
   *
   * @return string[]
   */
  public function headings(): array {
    return [
      '#',
      'Applicant',
      'Institute Name [en]',
      'Institute Name [bn]',
      'Email',
      'Institute Code',
      'Phone',
      'Website',
      'Type',
      'Category',
      'Division',
      'District',
      'Upazila',
      'Principal Name',
      'Principal Phone',
      'Principal Email',
      'Establishment Year',
      'Score of Establishment',
      'Student Intake Capacity 2022',
      'Student Intake Capacity 2021',
      'Student Intake Capacity 2020',
      'Student Intake Capacity 2019',
      'No of Actual Student 2022',
      'No of Actual Student 2021',
      'No of Actual Student 2020',
      'No of Actual Student 2019',
      'Score of Intake Criterion',
      'No Students Form Fill UP 2022',
      'No Students Form Fill UP 2021',
      'No Students Form Fill UP 2020',
      'No Students Form Fill UP 2019',
      'No Students Passed 2022',
      'No Students Passed 2021',
      'No Students Passed 2020',
      'No Students Passed 2019',
      'AVG Passed Student',
      'AVG Passed Rate',
      'Score of Student Passed Rates',
      'Total Students 2022',
      'Total Students 2021',
      'Total Students 2020',
      'Total Students 2019',
      'Total Female Students 2022',
      'Total Female Students 2021',
      'Total Female Students 2020',
      'Total Female Students 2019',
      'AVG Student',
      'AVG Female Student',
      'Score of Student Population',
      'No of Technology',
      'Score No of Technology',
      'Total Approved Teachers',
      'Total Regular Teachers',
      'Total Contractual Teachers',
      'Teacher Vacancy Ratio',
      'Score of Teacher Vacancy Ratio',
      'Score of Student Teacher Ratio',
      'Premise Type',
      'Score of Infrastructure',
      'External Audit Performed 2022',
      'External Audit Performed 2021',
      'External Audit Performed 2020',
      'External Audit Performed 2019',
      'Opinions of External Audit 2022',
      'Opinions of External Audit 2021',
      'Opinions of External Audit 2020',
      'Opinions of External Audit 2019',
      'Institute Have Own Land',
      'Amount of Total Land',
      'Price of Land',
      'Date of Purchase/Ownership',
      'Location of Land',
      'Institute Accreditation from Competent Authority',
      'Have You Receive IDG',
      'IDG Amount Awarded',
      'IDG Amount Utilized',
      'IDG Received',
      'Name of The Project',
      'Year of Financing',
      'Duration of Financing',
      'Amount Received',
      'Outcomes',
      'Institute Have RTO',
      'Self Finance at Least',
      'mark',
      'Status',
    ];
  }
}
