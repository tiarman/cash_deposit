@extends('layout.site')

@section('stylesheet')
  <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <style>
      .panel{
          padding: 0px 0px !important;
      }
      .panel-heading{
          padding: 10px 0px;
          background-color: rgb(16,38,74);
          color: white;
          border-radius: 5px;
      }
      .btn-job-list{
          background-color: rgb(16,38,74);
          color: white;
      }
      .btn-job-list:hover{
          background-color: #0D6EFD;
          color: white;
      }
      .center {
          display: block;
          margin-left: auto;
          margin-right: auto;
          width: 50%;
      }
      img {
          max-width: 100%;
          height: auto;
      }

      .product-list-img {
          width: 100px;
          min-height: 100px;
          max-height: auto;
          float: left;
          margin: 3px;
          padding: 3px;
      }
  </style>
@endsection

@section('content')

  <div class="container">
    <div class="row " style="margin-top:50px">
      <div class="col-12">
        <div class="card" style="border: none">
          <div class="card-body mt-0">

            <section class="panel">
              <header class="panel-heading border-bottom mb-4 text-center">
                                <h2 class="panel-title">List of All graduates</h2>
              </header>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                    <table id="datatable" class="table dt-responsive nowrap table-vertical" width="100%" cellspacing="0">
                      <thead>
                      <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Employment Status</th>
                        <th>Address</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($graduates as $val)
                        <tr>
                          <td class="product-list-img">
                            <img src="{{ asset($val->image ?? 'assets/placeholder.png') }}" class="img-fluid" alt="tbl" style="">
                          </td>
                          <td>
                            <h6 class="mt-0 m-b-5">{{ $val->name_en }}</h6>
                          </td>
                          <td>{{ Ucfirst($val->gender)  }}</td>
                          <td>{{ Ucfirst($val->employment_status) }}</td>
                          <td>{{ $val->address }}</td>
                          <td>
                            <a href="{{ route('graduate.Info',$val->id) }}" class="btn btn-info btn-sm">Profile</a>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="warningModal"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 25%">
      <div class="modal-content">
        <div style="justify-content: right;">
          <div class="modal-header" style="justify-content: right;">
            {{--          <h4>Delete User</h4>--}}
            <button type="button" class="btn btn-secondary btn-sm"  data-bs-dismiss="modal" >Close</button>
          </div>
          {{--        <button type="button" class="btn btn-secondary btn-sm"  data-bs-dismiss="modal" >close</button>--}}
          <div class="modal-body" style="text-align: center;">
            <strong>Sorry!!! Only Students Can Apply.</strong>
          </div>

          <div class="modal-footer mb-4">
            {{--          <button type="button" class="btn btn-secondary btn-sm"  data-bs-dismiss="modal" >close</button>--}}
            {{--          <button type="button" class="btn btn-success btn-sm yes-btn">Yes</button>--}}
          </div>
        </div>
      </div>
    </div>
    @endsection

    @section('script')
      <!-- Datatable js -->
{{--      <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>--}}
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
{{--      <script src="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>--}}
{{--      <script src="{{ asset('assets/admin/plugins/datatables/dataTables.responsive.min.js') }}"></script>--}}
{{--      <script src="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>--}}
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"></script>
      <script type="text/javascript">
        $(document).ready(function () {
          $('#datatable').DataTable();
        });
      </script>
@endsection