@extends('layout.admin')

@section('stylesheet')
  <style>
      .panel{
          padding: 0px 0px !important;
      }
      .panel-heading{
          /* padding: 10px 0px; */
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
          width: 30%;
      }
      img {
          max-width: 100%;
          height: auto;
      }

      .graduate-img {
          width: 120px;
          min-height: 120px;
          /*max-height: auto;*/
          float: left;
          margin: 3px;
          padding: 3px;
      }
  </style>
@endsection

@section('content')

  <div class="container">
    <div class="row " style="margin-top:50px; ">
      <div class="col-12">
        <div class="card" style="border: none">
          <div class="card-body mt-0">
            <section class="panel">
              <header class="panel-heading border-bottom text-center">
                <h2 class="panel-title">Profile of {{ $profile->name_en ?? '' ?? ''}}</h2>
              </header>
              <div class="panel-body">
                <div class="card">
                  <div class="card-header ">
                    <div class="row mb-4" >
                      <div class="col-md-6">
                        <div class="mo-mb-2 center">
                          <img src="{{ asset($profile->image ?? 'assets/placeholder.png') }}" alt=""
                               class="img-fluid mx-auto d-block">
                        </div>
                      </div>
                      <div class="col-md-6" style="align-content: center">
                        <strong style="font-size: x-large;">Name English : {{ $profile->name_en ?? ''}}</strong><br>
                        <strong style="font-size: medium;">Name Bangla : {{ $profile->name_bn ?? ''}} </strong><br>
                        <strong><span style="color: #013f7c">Email :</span> <Span>{{ $profile->email ?? ''}}</Span></strong>&nbsp;<br>
                        @if(auth()->user())
                          <strong>Phone No : {{ $profile->phone ?? ''}}</strong><br>
                        @else
                          <strong>Phone No : 01*********</strong><br>
                        @endif
{{--                        <strong>Phone No : {{ $profile->phone ?? ''}}</strong><br>--}}
                        <strong style="font-size: medium;">Address : {{ $profile->address ?? ''}}</strong><br>
                      </div>
                    </div>

                    <div class="row" >
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-6" style="border: #002752;">
                            <h5 style="background-color: #46b2e554"> Personal Info</h5>
                            <strong>Father Name : {{ $profile->father_name ?? ''}}</strong><br>
                            <strong>Mother Name : {{ $profile->mother_name ?? ''}}</strong><br>
                            <strong>Gender : {{ $profile->gender ?? ''}}</strong><br>
                            <strong>Blood Group : {{ $profile->blood_group ?? ''}}</strong><br>
                            <strong>Marital Status : {{ $profile->marital_status ?? ''}}</strong><br>
                            <strong>Religion : {{ $profile->religion ?? ''}}</strong><br>
                          </div>
                          <div class="col-md-6" style="border: #002752;">
                            <h5 style="background-color: #46b2e554"> Educational/Professional Info</h5>

                            <strong>Institute : {{ $profile->institute?->name ?? ''}}</strong><br>
                            <strong>Trade/Technology/Department : {{ $profile->trade_technology ?? ''}}</strong><br>
                            <strong>Board Roll : {{ $profile->board_roll ?? ''}}</strong><br>
                            <strong>Employment Company : {{ $profile->employing_company ?? ''}}</strong><br>
                            <strong>Employment Status : {{ $profile->employment_status ?? ''}}</strong><br>
                            <strong>Admission Year : {{ $profile->admission_year ?? ''}}</strong><br>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{--                    <h4 class="">Job Fair title</h4>--}}

                    {{-- <p>.........................</p> --}}
                  </div>
                  <div class="card-body mx-auto">
                    <p>{{ $profile->details ?? ''}}</p>
                    <div class="row">
                    </div>
                  </div>
                </div>

              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
