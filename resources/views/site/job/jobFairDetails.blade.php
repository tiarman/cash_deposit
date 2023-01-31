@extends('layout.site')

@section('stylesheet')
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
                <h2 class="panel-title">{{ $job_event->title ?? ''}}</h2>
              </header>


              <div class="panel-body">

                <div class="card">
                  <div class="card-header ">
                    <div class="row">
                      <div class="col-md-6">
                          <div class="mo-mb-2 center">
                            <img src="{{ asset($job_event->image ?? 'assets/placeholder.png') }}" alt=""
                                 class="img-fluid mx-auto d-block">
                          </div>
                      </div>
                      <div class="col-md-6">
                        <div >
                          <strong >Organizer : {{ $job_event->institute->name ?? ''}}</strong><br>
                          <strong>Start at :{{ $job_event->start_date ?? ''}} </strong><br>
                          <strong>End at : {{ $job_event->end_date ?? ''}}</strong><br>
                          <strong>Institute Phone : {{ $job_event->institute->phone ?? ''}}</strong><br>
                          <strong>Institute Email : {{ $job_event->institute->email ?? ''}}</strong>
                        </div>
                      </div>
                      <div class="col-md-6"></div>
                    </div>
{{--                    <h4 class="">Job Fair title</h4>--}}

                    {{-- <p>.........................</p> --}}
                  </div>
                  <div class="card-body mx-auto">
                    <p>{{ $job_event->details ?? ''}}</p>
                    <div class="row">
                      <div class="col-md-12 text-center">
                        <a class="btn btn-job-list" href="{{ route('jobs',$job_event->id ) }}">See Job List</a>
                      </div>
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
