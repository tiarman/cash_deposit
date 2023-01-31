@extends('layout.admin')

@section('stylesheet')
  <!-- DataTables -->
  <link href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>
  <link href="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>

  <link href="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>

@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Eligibility Forms-IDG</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              <div class="row">
                <div class="col-md-12 text-right">
                  <a href="{{ route('admin.eaf.form.list.idg', ['type' => 'download']) }}" class="btn btn-info btn-sm">Download As XLSX</a>
                </div>
              </div>
              <div class="table-responsive">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                       cellspacing="0" width="100%" style="font-size: 14px">

                  <thead>
                  <tr>
                    <th width="50">#</th>
                    <th>Applicant</th>
                    <th>Institute Name [en]</th>
                    <th>Institute Name [bn]</th>
                    <th>Email</th>
                    <th>Institute Code</th>
                    <th>Phone</th>
                    <th>Website</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Division</th>
                    <th>District</th>
                    <th>Upazila</th>
                    <th>Principal Name</th>
                    <th>Principal Phone</th>
                    <th>Principal Email</th>
                    <th>Establishment Year</th>
                    <th>Score of Establishment</th>
                    <th class="p-0 m-0">
                      <table style="width: 100%">
                        <tr class="gradeX">
                          <td colspan="4" class="text-center">Student Intake Capacity</td>
                        </tr>
                        <tr>
                          <td width="100">2022</td>
                          <td width="100">2021</td>
                          <td width="100">2020</td>
                          <td width="100">2019</td>
                        </tr>
                      </table>
                    </th>
{{--                    <th>student_intake_capacity_2022</th>--}}
{{--                    <th>student_intake_capacity_2021</th>--}}
{{--                    <th>student_intake_capacity_2020</th>--}}
{{--                    <th>student_intake_capacity_2019</th>--}}

                    <th class="p-0 m-0">
                      <table style="width: 100%">
                        <tr class="gradeX">
                          <td colspan="4" class="text-center">No of Actual Student</td>
                        </tr>
                        <tr>
                          <td width="100">2022</td>
                          <td width="100">2021</td>
                          <td width="100">2020</td>
                          <td width="100">2019</td>
                        </tr>
                      </table>
                    </th>
{{--                    <th>no_of_actual_student_2022</th>--}}
{{--                    <th>no_of_actual_student_2021</th>--}}
{{--                    <th>no_of_actual_student_2020</th>--}}
{{--                    <th>no_of_actual_student_2019</th>--}}
                    <th>Score of Intake Criterion</th>
                    <th class="p-0 m-0">
                      <table style="width: 100%">
                        <tr class="gradeX">
                          <td colspan="4" class="text-center">No of Student Form Fill Up</td>
                        </tr>
                        <tr>
                          <td width="100">2022</td>
                          <td width="100">2021</td>
                          <td width="100">2020</td>
                          <td width="100">2019</td>
                        </tr>
                      </table>
                    </th>
{{--                    <th>no_students_form_fill_up_2022</th>--}}
{{--                    <th>no_students_form_fill_up_2021</th>--}}
{{--                    <th>no_students_form_fill_up_2020</th>--}}
{{--                    <th>no_students_form_fill_up_2019</th>--}}

                    <th class="p-0 m-0">
                      <table style="width: 100%">
                        <tr class="gradeX">
                          <td colspan="4" class="text-center">No of Student Passed</td>
                        </tr>
                        <tr>
                          <td width="100">2022</td>
                          <td width="100">2021</td>
                          <td width="100">2020</td>
                          <td width="100">2019</td>
                        </tr>
                      </table>
                    </th>
{{--                    <th>no_students_passed_2022</th>--}}
{{--                    <th>no_students_passed_2021</th>--}}
{{--                    <th>no_students_passed_2020</th>--}}
{{--                    <th>no_students_passed_2019</th>--}}
                    <th>AVG Passed Student</th>
                    <th>AVG Passed Rate</th>
                    <th>Score of Student Passed Rates</th>

                    <th class="p-0 m-0">
                      <table style="width: 100%">
                        <tr class="gradeX">
                          <td colspan="4" class="text-center">Total Student</td>
                        </tr>
                        <tr>
                          <td width="100">2022</td>
                          <td width="100">2021</td>
                          <td width="100">2020</td>
                          <td width="100">2019</td>
                        </tr>
                      </table>
                    </th>
{{--                    <th>total_students_2022</th>--}}
{{--                    <th>total_students_2021</th>--}}
{{--                    <th>total_students_2020</th>--}}
{{--                    <th>total_students_2019</th>--}}

                    <th class="p-0 m-0">
                      <table style="width: 100%">
                        <tr class="gradeX">
                          <td colspan="4" class="text-center">Total Female Student</td>
                        </tr>
                        <tr>
                          <td width="100">2022</td>
                          <td width="100">2021</td>
                          <td width="100">2020</td>
                          <td width="100">2019</td>
                        </tr>
                      </table>
                    </th>
{{--                    <th>total_female_students_2022</th>--}}
{{--                    <th>total_female_students_2021</th>--}}
{{--                    <th>total_female_students_2020</th>--}}
{{--                    <th>total_female_students_2019</th>--}}
                    <th>AVG Student</th>
                    <th>AVG Female Student</th>
                    <th>Score of Student Population</th>
                    <th>No of Technology</th>
                    <th>Score No of Technology</th>
                    <th>Total Approved Teachers</th>
                    <th>Total Regular Teachers</th>
                    <th>Total Contractual Teachers</th>
                    <th>Teacher Vacancy Ratio</th>
                    <th>Score of Teacher Vacancy Ratio</th>
                    <th>Score of Student Teacher Ratio</th>
                    <th>Premise Type</th>
                    <th>Score of Infrastructure</th>


                    <th class="p-0 m-0">
                      <table style="width: 100%">
                        <tr class="gradeX">
                          <td colspan="4" class="text-center">External Audit Performed</td>
                        </tr>
                        <tr>
                          <td width="100">2022</td>
                          <td width="100">2021</td>
                          <td width="100">2020</td>
                          <td width="100">2019</td>
                        </tr>
                      </table>
                    </th>
{{--                    <th>external_audit_performed_2022</th>--}}
{{--                    <th>external_audit_performed_2021</th>--}}
{{--                    <th>external_audit_performed_2020</th>--}}
{{--                    <th>external_audit_performed_2019</th>--}}

                    <th class="p-0 m-0">
                      <table style="width: 100%">
                        <tr class="gradeX">
                          <td colspan="4" class="text-center">Opinions of External Audit</td>
                        </tr>
                        <tr>
                          <td width="100">2022</td>
                          <td width="100">2021</td>
                          <td width="100">2020</td>
                          <td width="100">2019</td>
                        </tr>
                      </table>
                    </th>

{{--                    <th>opinions_of_external_audit_2022</th>--}}
{{--                    <th>opinions_of_external_audit_2021</th>--}}
{{--                    <th>opinions_of_external_audit_2020</th>--}}
{{--                    <th>opinions_of_external_audit_2019</th>--}}
                    <th>Institute Have Own Land</th>
                    <th>Amount of Total Land</th>
                    <th>Price of Land</th>
                    <th>Date of Purchase/Ownership</th>
                    <th>Location of Land</th>
                    <th>Institute Accreditation from Competent Authority</th>
                    <th>Have You Receive IDG</th>
                    <th>IDG Amount Awarded</th>
                    <th>IDG Amount Utilized</th>
                    <th>IDG Received</th>
                    <th>Name of The Project</th>
                    <th>Year of Financing</th>
                    <th>Duration of Financing</th>
                    <th>Amount Received</th>
                    <th>Outcomes</th>
                    <th>Institute Have RTO</th>
                    <th>Self Finance at Least</th>
                    <th>Total Point</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($forms as $key => $val)
                    <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                      <td class="p-1">{{ ($key+1) }}</td>
                      <td class="p-1 text-capitalize">{{ $val->applicant->name_en }}</td>
{{--                      <td class="p-1">{{ $val->institute_id }}</td>--}}
                      <td class="p-1">{{ $val->email }}</td>
                      <td class="p-1">{{ $val->institute_name_en }}</td>
                      <td class="p-1">{{ $val->institute_name_bn }}</td>
                      <td class="p-1">{{ $val->institute_code }}</td>
                      <td class="p-1">{{ $val->telephone }}</td>
                      <td class="p-1">{{ $val->institute_website }}</td>
                      <td class="p-1">{{ $val->institute_type }}</td>
                      <td class="p-1">{{ $val->institute_category }}</td>
                      <td class="p-1">{{ $val->division?->name }}</td>
                      <td class="p-1">{{ $val->district?->name }}</td>
                      <td class="p-1">{{ $val->upazila?->name }}</td>
                      <td class="p-1">{{ $val->principal_name }}</td>
                      <td class="p-1">{{ $val->principal_phone }}</td>
                      <td class="p-1">{{ $val->principal_email }}</td>
                      <td class="p-1">{{ $val->establishment_year }}</td>
                      <td class="p-1">{{ $val->score_for_establishment_year }}</td>

                      <td class="p-0 m-0">
                        <table style="width: 100%">
                          <tr>
                            <td width="100" class="p-1 text-center">{{ $val->student_intake_capacity_2022 ?? 'N/A' }}</td>
                            <td width="100" class="p-1 text-center">{{ $val->student_intake_capacity_2021 ?? 'N/A' }}</td>
                            <td width="100" class="p-1 text-center">{{ $val->student_intake_capacity_2020 ?? 'N/A' }}</td>
                            <td width="100" class="p-1 text-center">{{ $val->student_intake_capacity_2019 ?? 'N/A' }}</td>
                          </tr>
                        </table>
                      </td>
{{--                      <td class="p-1">{{ $val->student_intake_capacity_2022 }}</td>--}}
{{--                      <td class="p-1">{{ $val->student_intake_capacity_2021 }}</td>--}}
{{--                      <td class="p-1">{{ $val->student_intake_capacity_2020 }}</td>--}}
{{--                      <td class="p-1">{{ $val->student_intake_capacity_2019 }}</td>--}}

                      <td class="p-0 m-0">
                        <table style="width: 100%" >
                          <tr>
                            <td width="100" class="p-1 text-center">{{ $val->no_of_actual_student_2022 ?? 'N/A' }}</td>
                            <td width="100" class="p-1 text-center">{{ $val->no_of_actual_student_2021 ?? 'N/A' }}</td>
                            <td width="100" class="p-1 text-center">{{ $val->no_of_actual_student_2020 ?? 'N/A' }}</td>
                            <td width="100" class="p-1 text-center">{{ $val->no_of_actual_student_2019 ?? 'N/A' }}</td>
                          </tr>
                        </table>
                      </td>
{{--                      <td class="p-1">{{ $val->no_of_actual_student_2022 }}</td>--}}
{{--                      <td class="p-1">{{ $val->no_of_actual_student_2021 }}</td>--}}
{{--                      <td class="p-1">{{ $val->no_of_actual_student_2020 }}</td>--}}
{{--                      <td class="p-1">{{ $val->no_of_actual_student_2019 }}</td>--}}
                      <td class="p-1">{{ $val->score_for_intake_criterion }}</td>

                      <td class="p-0 m-0">
                        <table style="width: 100%" >
                          <tr>
                            <td width="100" class="p-1 text-center">{{ $val->no_students_form_fill_up_2022 ?? 'N/A' }}</td>
                            <td width="100" class="p-1 text-center">{{ $val->no_students_form_fill_up_2021 ?? 'N/A' }}</td>
                            <td width="100" class="p-1 text-center">{{ $val->no_students_form_fill_up_2020 ?? 'N/A' }}</td>
                            <td width="100" class="p-1 text-center">{{ $val->no_students_form_fill_up_2019 ?? 'N/A' }}</td>
                          </tr>
                        </table>
                      </td>
{{--                      <td class="p-1">{{ $val->no_students_form_fill_up_2022 }}</td>--}}
{{--                      <td class="p-1">{{ $val->no_students_form_fill_up_2021 }}</td>--}}
{{--                      <td class="p-1">{{ $val->no_students_form_fill_up_2020 }}</td>--}}
{{--                      <td class="p-1">{{ $val->no_students_form_fill_up_2019 }}</td>--}}

                      <td class="p-0 m-0">
                        <table style="width: 100%" >
                          <tr>
                            <td width="100" class="p-1 text-center">{{ $val->no_students_passed_2022 ?? 'N/A' }}</td>
                            <td width="100" class="p-1 text-center">{{ $val->no_students_passed_2021 ?? 'N/A' }}</td>
                            <td width="100" class="p-1 text-center">{{ $val->no_students_passed_2020 ?? 'N/A' }}</td>
                            <td width="100" class="p-1 text-center">{{ $val->no_students_passed_2019 ?? 'N/A' }}</td>
                          </tr>
                        </table>
                      </td>
{{--                      <td class="p-1">{{ $val->no_students_passed_2022 }}</td>--}}
{{--                      <td class="p-1">{{ $val->no_students_passed_2021 }}</td>--}}
{{--                      <td class="p-1">{{ $val->no_students_passed_2020 }}</td>--}}
{{--                      <td class="p-1">{{ $val->no_students_passed_2019 }}</td>--}}

                      <td class="p-1">{{ $val->average_passed_students_last_3_year }}</td>
                      <td class="p-1">{{ $val->average_passed_rate_last_3_year }}</td>
                      <td class="p-1">{{ $val->score_of_students_passed_rates }}</td>

                      <td class="p-0 m-0">
                        <table style="width: 100%" >
                          <tr>
                            <td width="100" class="p-1 text-center">{{ $val->total_students_2022 ?? 'N/A' }}</td>
                            <td width="100" class="p-1 text-center">{{ $val->total_students_2021 ?? 'N/A' }}</td>
                            <td width="100" class="p-1 text-center">{{ $val->total_students_2020 ?? 'N/A' }}</td>
                            <td width="100" class="p-1 text-center">{{ $val->total_students_2019 ?? 'N/A' }}</td>
                          </tr>
                        </table>
                      </td>
{{--                      <td class="p-1">{{ $val->total_students_2022 }}</td>--}}
{{--                      <td class="p-1">{{ $val->total_students_2021 }}</td>--}}
{{--                      <td class="p-1">{{ $val->total_students_2020 }}</td>--}}
{{--                      <td class="p-1">{{ $val->total_students_2019 }}</td>--}}
                      <td class="p-0 m-0">
                        <table style="width: 100%" >
                          <tr>
                            <td width="100" class="p-1 text-center">{{ $val->total_female_students_2022 ?? 'N/A' }}</td>
                            <td width="100" class="p-1 text-center">{{ $val->total_female_students_2021 ?? 'N/A' }}</td>
                            <td width="100" class="p-1 text-center">{{ $val->total_female_students_2020 ?? 'N/A' }}</td>
                            <td width="100" class="p-1 text-center">{{ $val->total_female_students_2019 ?? 'N/A' }}</td>
                          </tr>
                        </table>
                      </td>
{{--                      <td class="p-1">{{ $val->total_female_students_2022 }}</td>--}}
{{--                      <td class="p-1">{{ $val->total_female_students_2021 }}</td>--}}
{{--                      <td class="p-1">{{ $val->total_female_students_2020 }}</td>--}}
{{--                      <td class="p-1">{{ $val->total_female_students_2019 }}</td>--}}

                      <td class="p-1">{{ $val->avg_student_of_last_3_year }}</td>
                      <td class="p-1">{{ $val->avg_female_student_of_last_3_year }}</td>
                      <td class="p-1">{{ $val->score_of_student_population }}</td>
                      <td class="p-1">{{ $val->no_of_technology_or_trade_courses }}</td>
                      <td class="p-1">{{ $val->score_no_of_technology_or_trade_courses }}</td>
                      <td class="p-1">{{ $val->total_number_of_approved_teachers }}</td>
                      <td class="p-1">{{ $val->total_number_of_reguler_teachers }}</td>
                      <td class="p-1">{{ $val->total_number_of_contractual_teachers }}</td>
                      <td class="p-1">{{ $val->teacher_vacancy_ratio }}</td>
                      <td class="p-1">{{ $val->score_of_teacher_vacancy_ratio }}</td>
                      <td class="p-1">{{ $val->score_for_student_teacher_ratio }}</td>
                      <td class="p-1">{{ $val->premise_type }}</td>
                      <td class="p-1">{{ $val->score_for_infrastructure }}</td>

                      <td class="p-0 m-0">
                        <table style="width: 100%" >
                          <tr>
                            <td width="100" class="p-1 text-center">{{  \App\Models\EligibilityApplicationFormIdg::$boolTypesName[$val->external_audit_performed_2022 ?? 0] }}</td>
                            <td width="100" class="p-1 text-center">{{  \App\Models\EligibilityApplicationFormIdg::$boolTypesName[$val->external_audit_performed_2021 ?? 0] }}</td>
                            <td width="100" class="p-1 text-center">{{  \App\Models\EligibilityApplicationFormIdg::$boolTypesName[$val->external_audit_performed_2020 ?? 0] }}</td>
                            <td width="100" class="p-1 text-center">{{  \App\Models\EligibilityApplicationFormIdg::$boolTypesName[$val->external_audit_performed_2019 ?? 0] }}</td>
                          </tr>
                        </table>
                      </td>
{{--                      <td class="p-1">{{ $val->external_audit_performed_2022 }}</td>--}}
{{--                      <td class="p-1">{{ $val->external_audit_performed_2021 }}</td>--}}
{{--                      <td class="p-1">{{ $val->external_audit_performed_2020 }}</td>--}}
{{--                      <td class="p-1">{{ $val->external_audit_performed_2019 }}</td>--}}

                      <td class="p-0 m-0">
                        <table style="width: 100%" >
                          <tr>
                            <td width="100" class="p-1 text-center">{{ \App\Models\EligibilityApplicationFormIdg::$externalAuditTypesName[$val->opinions_of_external_audit_2022 ?? 0] }}</td>
                            <td width="100" class="p-1 text-center">{{ \App\Models\EligibilityApplicationFormIdg::$externalAuditTypesName[$val->opinions_of_external_audit_2021 ?? 0] }}</td>
                            <td width="100" class="p-1 text-center">{{ \App\Models\EligibilityApplicationFormIdg::$externalAuditTypesName[$val->opinions_of_external_audit_2020 ?? 0] }}</td>
                            <td width="100" class="p-1 text-center">{{ \App\Models\EligibilityApplicationFormIdg::$externalAuditTypesName[$val->opinions_of_external_audit_2019 ?? 0] }}</td>
                          </tr>
                        </table>
                      </td>
{{--                      <td class="p-1">{{ $val->opinions_of_external_audit_2022 }}</td>--}}
{{--                      <td class="p-1">{{ $val->opinions_of_external_audit_2021 }}</td>--}}
{{--                      <td class="p-1">{{ $val->opinions_of_external_audit_2020 }}</td>--}}
{{--                      <td class="p-1">{{ $val->opinions_of_external_audit_2019 }}</td>--}}
                      <td class="p-1">{{ $val->institute_have_own_land }}</td>
                      <td class="p-1">{{ $val->amount_of_total_land }}</td>
                      <td class="p-1">{{ $val->price_of_land }}</td>
                      <td class="p-1">{{ $val->date_of_purchase_or_ownership }}</td>
                      <td class="p-1">{{ $val->location_of_land }}</td>
                      <td class="p-1">{{ $val->institute_accreditation_from_competent_authority }}</td>
                      <td class="p-1">{{ $val->have_you_receive_idg_from_step }}</td>
                      <td class="p-1">{{ $val->idg_amount_awarded_from_step }}</td>
                      <td class="p-1">{{ $val->idg_amount_utilized_under_step }}</td>
                      <td class="p-1">{{ $val->idg_received_from_any_other_gob_project_or_budget }}</td>
                      <td class="p-1">{{ $val->name_of_the_project }}</td>
                      <td class="p-1">{{ $val->year_of_financing }}</td>
                      <td class="p-1">{{ $val->duration_of_financing }}</td>
                      <td class="p-1">{{ $val->amount_received }}</td>
                      <td class="p-1">{{ \Illuminate\Support\Str::limit($val->outcomes, 25) }}</td>
                      <td class="p-1">{{ $val->institute_have_rto }}</td>
                      <td class="p-1">{{ $val->self_finance_at_least_15_of_the_cash }}</td>
                      <td class="p-1">{{ $val->mark }}</td>
                      <td class="p-1 text-capitalize">{{ $val->status }}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="userDeleteModal" tabindex="-1" role="dialog" aria-labelledby="userDeleteModal"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Delete Upazila</h4>
        </div>
        <div class="modal-body">
          <strong>Are you sure to delete this upazila?</strong>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-success btn-sm yes-btn">Yes</button>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('script')
  <!-- Required datatable js -->
  <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <!-- Buttons examples -->
  <script src="{{ asset('assets/admin/plugins/datatables/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/jszip.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/pdfmake.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/vfs_fonts.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/buttons.print.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/buttons.colVis.min.js') }}"></script>
  <!-- Responsive examples -->
  <script src="{{ asset('assets/admin/plugins/datatables/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>


  <script>
    $(document).ready(function () {
      // $('#datatable-buttons').DataTable();

      // var table = $('#datatable-buttons').DataTable({
      //   lengthChange: false,
      //   buttons: ['copy', 'excel', 'pdf', 'colvis']
      // });
      //
      // table.buttons().container()
      //   .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');


      {{--$(document).on('change', 'input[name="onoffswitch"]', function () {--}}
      {{--  var status = 'inactive';--}}
      {{--  var id = $(this).data('id')--}}
      {{--  var isChecked = $(this).is(":checked");--}}
      {{--  if (isChecked) {--}}
      {{--    status = 'active';--}}
      {{--  }--}}
      {{--  $.ajax({--}}
      {{--    url: "{{ route('admin.ajax.update.user.status') }}",--}}
      {{--    method: "post",--}}
      {{--    dataType: "html",--}}
      {{--    data: {'id': id, 'status': status},--}}
      {{--    success: function (data) {--}}
      {{--      if (data === "success") {--}}
      {{--      }--}}
      {{--    }--}}
      {{--  });--}}
      {{--})--}}
    })
  </script>
@endsection
