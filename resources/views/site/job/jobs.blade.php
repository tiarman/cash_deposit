@extends('layout.site')

@section('stylesheet')
  <!-- DataTables -->
  <link href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>
  <link href="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>

  <link href="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>

        <style>
          .job-list-box{
            background-color: white;
          }
        </style>

@endsection

@section('content')

  <section id="services" class="services section-bg">
    <div class="container" data-aos="fade-up">

      {{-- new --}}
         <!-- JOB LIST START -->
    <section class="section pt-0">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-12">
                  <div class="section-title text-center mb-4 pb-2">
                      <h4 class="title title-line pb-5">Available job for you</h4>
                      <p class="text-muted para-desc mx-auto mb-1">Post a job to tell us about your project. We'll quickly match you with the right freelancers.</p>
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="col-lg-3">
                  <div class="left-sidebar">
                      <div class="accordion" id="accordionExample">
                          <div class="card rounded mt-4">
                              <a data-toggle="collapse" href="#collapseOne" class="job-list" aria-expanded="true" aria-controls="collapseOne">
                                  <div class="card-header d-flex justify-content-between" id="headingOne">
                                      <h6 class="mb-0 text-dark f-18">Date Posted</h6><i class='bx bxs-minus-circle'></i>
                                  </div>
                              </a>
                              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
                                  <div class="card-body p-0">
                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                          <label class="custom-control-label ml-1 text-muted" for="customRadio1">Last Hour</label>
                                      </div>

                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                          <label class="custom-control-label ml-1 text-muted" for="customRadio2">Last 24 hours</label>
                                      </div>

                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                          <label class="custom-control-label ml-1 text-muted" for="customRadio3">Last 7 days</label>
                                      </div>

                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
                                          <label class="custom-control-label ml-1 text-muted" for="customRadio4">Last 14 days</label>
                                      </div>

                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
                                          <label class="custom-control-label ml-1 text-muted" for="customRadio5">Last 30 days</label>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- collapse one end -->
                          <div class="card rounded mt-4">
                              <a data-toggle="collapse" href="#collapsetwo" class="job-list" aria-expanded="true" aria-controls="collapsetwo">
                                  <div class="card-header d-flex justify-content-between" id="headingtwo">
                                      <h6 class="mb-0 text-dark f-18">Categories</h6><i class='bx bxs-minus-circle'></i>
                                  </div>
                              </a>
                              <div id="collapsetwo" class="collapse show" aria-labelledby="headingtwo">
                                  <div class="card-body p-0">
                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio7" name="customRadio1" class="custom-control-input">
                                          <label class="custom-control-label ml-1 text-muted f-15" for="customRadio7">Digital & Creative</label>
                                      </div>

                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio8" name="customRadio1" class="custom-control-input">
                                          <label class="custom-control-label ml-1 text-muted f-15" for="customRadio8">Accountancy</label>
                                      </div>

                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio9" name="customRadio1" class="custom-control-input">
                                          <label class="custom-control-label ml-1 text-muted f-15" for="customRadio9">Banking</label>
                                      </div>

                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio10" name="customRadio1" class="custom-control-input">
                                          <label class="custom-control-label ml-1 text-muted f-15" for="customRadio10">IT Contractor</label>
                                      </div>

                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio11" name="customRadio1" class="custom-control-input">
                                          <label class="custom-control-label ml-1 text-muted f-15" for="customRadio11">Graduate</label>
                                      </div>

                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio12" name="customRadio1" class="custom-control-input">
                                          <label class="custom-control-label ml-1 text-muted f-15" for="customRadio12">Estate Agency</label>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- collapse one end -->
                          <div class="card rounded mt-4">
                              <a data-toggle="collapse" href="#collapsethree" class="job-list" aria-expanded="true" aria-controls="collapsethree">
                                  <div class="card-header d-flex justify-content-between" id="headingthree">
                                      <h6 class="mb-0 text-dark f-18">Experince</h6>
                                      <i class='bx bxs-minus-circle'></i>
                                  </div>
                              </a>
                              <div id="collapsethree" class="collapse show" aria-labelledby="headingthree">
                                  <div class="card-body p-0">
                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio13" name="customRadio2" class="custom-control-input">
                                          <label class="custom-control-label ml-1 text-muted f-15" for="customRadio13">1Year to 2Year</label>
                                      </div>

                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio14" name="customRadio2" class="custom-control-input">
                                          <label class="custom-control-label ml-1 text-muted f-15" for="customRadio14">2Year to 3Year</label>
                                      </div>

                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio15" name="customRadio2" class="custom-control-input">
                                          <label class="custom-control-label ml-1 text-muted f-15" for="customRadio15">3Year to 4Year</label>
                                      </div>

                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio16" name="customRadio2" class="custom-control-input">
                                          <label class="custom-control-label ml-1 text-muted f-15" for="customRadio16">IT Contractor</label>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- collapse one end -->
                          <div class="card rounded mt-4">
                              <a data-toggle="collapse" href="#collapsefour" class="job-list" aria-expanded="true" aria-controls="collapsefour">
                                  <div class="card-header d-flex justify-content-between" id="headingfour">
                                      <h6 class="mb-0 text-dark f-18">Gender</h6>
                                      <i class='bx bxs-minus-circle'></i>
                                  </div>
                              </a>
                              <div id="collapsefour" class="collapse show" aria-labelledby="headingfour">
                                  <div class="card-body p-0">
                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio17" name="customRadio3" class="custom-control-input">
                                          <label class="custom-control-label ml-1 text-muted f-15" for="customRadio17">Male</label>
                                      </div>

                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio18" name="customRadio3" class="custom-control-input">
                                          <label class="custom-control-label ml-1 text-muted f-15" for="customRadio18">Female</label>
                                      </div>

                                      <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio19" name="customRadio3" class="custom-control-input">
                                          <label class="custom-control-label ml-1 text-muted f-15" for="customRadio19">Others</label>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- collapse one end -->
                      </div>
                  </div>
              </div>

              <div class="col-lg-9 mt-4 pt-2">
                  <div class="row align-items-center">
                      <div class="col-lg-12">
                          <div class="show-results">
                              <div class="float-left">
{{--                                  <h5 class="text-dark mb-0 pt-2 f-18">Showing results 0-20</h5>--}}
                              </div>
                              <div class="sort-button float-right">
                                  <select class="form-control">
                                      <option data-display="Select">Nothing</option>
                                      <option value="1">Web Developer</option>
                                      <option value="2">PHP Developer</option>
                                      <option value="3">Web Designer</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      @foreach($industry_posts as $val)
                              <div class="col-lg-12 mt-4 pt-2">
                                  <div class="job-list-box border rounded">
                                      <div class="p-3">
                                          <div class="row align-items-center">
                                              <div class="col-lg-2">
                                                  <div class="company-logo-img">
                                                      <img src="{{asset($val->user->image ?? 'assets/placeholder.png')}}" alt="" class="img-fluid mx-auto d-block">
                                                  </div>
                                              </div>
                                              <div class="col-lg-7 col-md-9">
                                                  <div class="job-list-desc">
                                                      <h6 class="mb-2"><a href="#" class="text-dark">{{ $val->job_title }}</a></h6>
                                                      <p class="text-muted mb-0"><i class='bx bxs-building-house mr-3'></i>{{ $val->user->name_en }}</p>
                                                      <ul class="list-inline mb-0">
                                                          <li class="list-inline-item mr-3">
                                                              <p class="text-muted mb-0"><i class='bx bx-location-plus mr-3'></i>{{ $val->location }}</p>
                                                              <p class="text-muted mb-0"><i class='bx bxs-user-account mr-3'></i>Vacancies : {{ $val->vacancy }}</p>
                                                          </li>
                                                          {{--                                                      <li class="list-inline-item">--}}
                                                          {{--                                                          <p class="text-muted mb-0"><i class="mdi mdi-clock-outline mr-2"></i>1 Minute ago</p>--}}
                                                          {{--                                                      </li>--}}
                                                      </ul>
                                                  </div>
                                              </div>
                                              <div class="col-lg-3 col-md-3">
                                                  <div class="job-list-button-sm text-right">
                                                      <span class="badge badge-success">Full-Time</span>

                                                      <div class="mt-3">
{{--                                                          <a href="{{ route('post.details'),$val->id }}" class="btn btn-sm btn-primary">Apply</a>--}}
                                                          <a href="{{ route('post.details',$val->id) }}" class="btn btn-sm btn-primary">Apply</a>
{{--                                                          <a href="#" class="btn btn-sm btn-primary">Apply</a>--}}
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                      @endforeach
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- JOB LIST START -->
      {{-- end new --}}

        {{-- <div style="margin-bottom: 20px;" class="row">

          <div class="col-md-12">
            <nav aria-label="Page navigation example" style="float: right !important; margin-right: 30px;">
              <ul class="pagination ">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
              </ul>
            </nav>
          </div>
        </div> --}}

      <style>
          .job-card {
              padding-top: 12px;
              padding-left: 30px;
              padding-right: 30px;
          }

          .job-list {
              margin-top: 25px;
              margin-bottom: 50px;
          }

          .job-overview {
              /*margin: -14px 0px -14px 38px !important;*/
          }

          .short-overview {
              line-height: 3px;
              margin-top: 30px;
          }

          .short-overview i {
              margin-right: 5px;
          }

          .company_logo {
              margin: 14px -75px 0px 0px !important;
              text-align: right;
              float: right !important;
          }

          .company_logo img {
              width: 100px !important;
          }

          .jobs {
              border-radius: 4px;
              background: #f5f5f5;
              box-shadow: 0 6px 10px rgba(0, 0, 0, .08), 0 0 6px rgba(0, 0, 0, .05);
              transition: .5s transform cubic-bezier(.155, 1.105, .295, 1.12), .3s box-shadow, .5s -webkit-transform cubic-bezier(.155, 1.105, .295, 1.12);
              padding: 14px 80px 18px 36px;
              cursor: pointer;
          }

          .jobs:hover {
              transform: scale(1.01);
              box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
          }

      </style>
    </div>
  </section><!-- End Services Section -->
@endsection



