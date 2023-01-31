@extends('layout.site')

@section('stylesheet')
  <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <style>
        .row .event-main-design-align:hover {
            transform: scale(1.001);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
        }
        i{ color: white;}
    </style>
@endsection

@section('content')

  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div id="hero" class="d-flex align-items-center">
          <div class="container">
            <div class="row">
              <div
                class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                data-aos="fade-up" data-aos-delay="200">
                <h3 class="text-white">Better Solutions For Your Event 2</h3>
                <h1 class="text-white">Name 2</h1>
                <h2 class="text-white">Designation 2</h2>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                <img width="70%" src="{{asset('assets/frontend/img/error/e400g1.gif')}}" class="img-fluid animated"
                     alt="">
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="carousel-item">


        <div id="hero" class="d-flex align-items-center">
          <div class="container">
            <div class="row">
              <div
                class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                data-aos="fade-up" data-aos-delay="200">
                <h3 class="text-white">Better Solutions For Your Event</h3>
                <h1 class="text-white">Name</h1>
                <h2 class="text-white">Designation</h2>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                <img src="{{asset('assets/frontend/img/hero-img.png')}}" class="img-fluid animated"
                     alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <!-- ======= Hero Section ======= -->
  {{--    <div id="hero" class="d-flex align-items-center">--}}


  {{--        <div class="container">--}}
  {{--            <div class="row">--}}
  {{--                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"--}}
  {{--                     data-aos="fade-up" data-aos-delay="200">--}}
  {{--                    <h1>Better Solutions For Your Event</h1>--}}
  {{--                    <h2>বাংলায় লিখা</h2>--}}

  {{--                </div>--}}
  {{--                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">--}}
  {{--                    <img src="{{asset('assets/frontend/img/hero-img.png')}}" class="img-fluid animated" alt="">--}}
  {{--                </div>--}}
  {{--            </div>--}}
  {{--        </div>--}}

  {{--    </div>--}}

  <div class="container" data-aos="fade-up">

    <div class="section-title mt-5">
      <h2 style="text-align: center">Event List</h2>
    </div>

    <div class="row">

      <div class="col-md-6">
        <label class=" me-3" for="order_by_training"><input class="me-1" type="radio" checked name="order_by"
                                                            id="order_by_training" value="order_by_training">Upcoming
          Event</label>
        <label class=" me-3" for="order_by_training"><input class="me-1" type="radio" checked name="order_by"
                                                            id="order_by_training" value="order_by_training">Running
          Events</label>
        <label class=" me-3" for="order_by_training"><input class="me-1" type="radio" checked name="order_by"
                                                            id="order_by_training" value="order_by_training">Past
          Events</label>
      </div>
      <div class="text-end col-md-6">
        <div class="row">
          <div class="col-md-6">
            <label for="">From</label>
            <input type="date" class="form-control">
          </div>
          <div class="col-md-6">
            <label for="">To</label>
            <input type="date" class="form-control">
          </div>
        </div>

      </div>

      <div class="mt-5">
        <h2>Events</h2>
        <hr>
      </div>


      <section class="container event-banner-design1">
        <div class="row event-main-design-align">
          <div class="col-md-2 date-align">
            <a href="">11 NOV</a>
          </div>
          <div class="col-md-7 event-midle-align">
            <div class="member-info">
              <span class="work-shop-title">Work Shop</span>
              <h4>Work Shop on RPL Operation Manual</h4>
              <p>work shop</p>

              <div class="g-3">
                                <span class="time-align"><i
                                    class="bx bx-time icon-help"></i> <a>10:00 AM</a></span>
                <span class="time-align"><i class="bx bx-current-location icon-help"></i> <a>The pan pasifig hotel sonargoan</a></span>
              </div>
            </div>
          </div>
          <div class="col-md-3 text-center register-button-align">
            <button class="btn btn-danger">Register</button>
            <p class="mt-2">Invitation</p>
            <a class="event-button-design" href="">More Details</a>
          </div>
        </div>

      </section>

      <div style="margin-top: -45px">
        <hr>
      </div>

      <section class="container event-banner-design1">
        <div class="row event-main-design-align">
          <div class="col-md-2 date-align">
            <a href="">12 DEC</a>
          </div>
          <div class="col-md-7 event-midle-align">
            <div class="member-info">
              <span class="work-shop-title">Work Shop</span>
              <h4>Work Shop on RPL Operation Manual</h4>
              <p>work shop</p>

              <div class="g-3">
                                <span class="time-align"><i
                                    class="bx bx-time icon-help"></i> <a>10:00 AM</a></span>
                <span class="time-align"><i class="bx bx-current-location icon-help"></i> <a>The pan pasifig hotel sonargoan</a></span>
              </div>
            </div>
          </div>
          <div class="col-md-3 text-center register-button-align">
            <button class="btn btn-danger">Register</button>
            <p class="mt-2">Invitation</p>
            <a class="event-button-design" href="">More Details</a>
          </div>
        </div>

      </section>

      <div style="margin-top: -40px">
        <hr>
      </div>

      <section class="container event-banner-design1">
        <div class="row event-main-design-align">
          <div class="col-md-2 date-align">
            <a href="">14 DEC</a>
          </div>
          <div class="col-md-7 event-midle-align">
            <div class="member-info">
              <span class="work-shop-title">Work Shop</span>
              <h4>Work Shop on RPL Operation Manual</h4>
              <p>work shop</p>

              <div class="g-3">
                                <span class="time-align"><i
                                    class="bx bx-time icon-help"></i> <a>10:00 AM</a></span>
                <span class="time-align"><i class="bx bx-current-location icon-help"></i> <a>The pan pasifig hotel sonargoan</a></span>
              </div>
            </div>
          </div>
          <div class="col-md-3 text-center register-button-align">
            <button class="btn btn-danger">Register</button>
            <p class="mt-2">Invitation</p>
            <a class="event-button-design" href="">More Details</a>
          </div>
        </div>

      </section>

    </div>

  </div>
@endsection


<script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/bootstrap.bundle.min.js') }}"></script>



@section('script')
  <script>
    $(document).ready(function () {
      $('#carouselExampleIndicators').carousel({
        interval: 2000
      })
        .carousel('next')
    })
  </script>
@endsection
