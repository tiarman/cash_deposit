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
              <h2 class="panel-title">View User</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <div class="row">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                       cellspacing="0" width="100%" style="font-size: 14px">

                  <thead>
                  <tr>
                    <th>Title</th>
                    <th>Value</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>Name</td>
                    <td>{{ $projectIdea->user_id }}</td>
                  </tr>
                  <tr>
                    <td>Institute</td>
                    <td>{{ $projectIdea->institute->name }}</td>
                  </tr>
                  <tr>
                    <td>Project</td>
                    <td>{{ $projectIdea->project_id }}</td>
                  </tr>
                  <tr>
                    <td>Title</td>
                    <td>{{ $projectIdea->title }}</td>
                  </tr>
                  <tr>
                    <td>Title [BN]</td>
                    <td>{{ $projectIdea->title_bn }}</td>
                  </tr>
                  <tr>
                    <td>Keyword</td>
                    <td>{{ $projectIdea->keyword }}</td>
                  </tr>
                  <tr>
                    <td>Short Description</td>
                    <td>{{ $projectIdea->short_description }}</td>
                  </tr>
                  <tr>
                    <td>Short Description [BN]</td>
                    <td>{{ $projectIdea->short_description_bn }}</td>
                  </tr>
                  <tr>
                    <td> Description</td>
                    <td>{{ $projectIdea->description }}</td>
                  </tr>
                  <tr>
                    <td>Description [BN]</td>
                    <td>{{ $projectIdea->description_bn }}</td>
                  </tr>
                  <tr>
                    <td>Benifits</td>
                    <td>{{ $projectIdea->benefits }}</td>
                  </tr>
                  <tr>
                    <td>Implementation Location</td>
                    <td>{{ $projectIdea->implementation_location }}</td>
                  </tr>
                  <tr>
                    <td>Expenses</td>
                    <td>{{ $projectIdea->expenses }}</td>
                  </tr>
                  <tr>
                    <td>Instrument Details</td>
                    <td>{{ $projectIdea->instrument_details }}</td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td>{{ $projectIdea->status }}</td>
                  </tr>
                  <tr>
                    <td>Hod Approval</td>
                    <td>{{ $projectIdea->hod_approval == 1 ? "Accepted" : "Decline" }}</td>
                  </tr>
                  <tr>
                    <td>VP Approval</td>
                    <td>{{ $projectIdea->vp_approval== 1 ? "Accepted" : "Decline" }}</td>
                  </tr>
                  <tr>
                    <td>P Approval</td>
                    <td>{{ $projectIdea->p_approval== 1 ? "Accepted" : "Decline" }}</td>
                  </tr>
                  <tr>
                    <td>PMU Approval</td>
                    <td>{{ $projectIdea->pmu_approval== 1 ? "Accepted" : "Decline" }}</td>
                  </tr>
                  <tr>
                    <td>Uploaded Files</td>
                    <td>
                      @foreach($projectIdea->files as $val)
                        <a class="btn-danger" href="{{ asset($val->file) }}" download>{{ $val->name }} <i class="fa fa-download"></i></a>
                      @endforeach
                      </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>

@endsection
