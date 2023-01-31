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
                <h2 class="panel-title">{{ $job_post_details->title ?? ''}}</h2>
              </header>


              <div class="panel-body">

                <div class="card">
                  <div class="card-header ">
                    <div class="row">
                      <div class="col-md-6">
                          <div class="mo-mb-2 center">
                            <img src="{{ asset($job_post_details->image ?? 'assets/placeholder.png') }}" alt=""
                                 class="img-fluid mx-auto d-block">
                          </div>
                      </div>
                      <div class="col-md-6">
                        <div >
                          <strong >Job Title : {{ $job_post_details->job_title ?? ''}}</strong><br>
                          <strong>Position :{{ $job_post_details->position ?? ''}} </strong><br>
                          <strong>Vacancy : {{ $job_post_details->vacancy ?? ''}}</strong><br>
                          <strong>Location : {{ $job_post_details->location ?? ''}}</strong><br>
                          <strong>Salary : {{ $job_post_details->salary ?? ''}}</strong><br>
                          <strong>Experience : {{ $job_post_details->experience_requirement ?? ''}}</strong><br>
                          <strong>Application Deadline : {{ $job_post_details->application_deadline ?? ''}}</strong><br>
                          <strong>Job Type : {{ $job_post_details->employment_status ?? ''}}</strong><br>
                        </div>
                      </div>
                      <div class="col-md-6"></div>
                    </div>
{{--                    <h4 class="">Job Fair title</h4>--}}

                    {{-- <p>.........................</p> --}}
                  </div>
                  <div class="card-body mx-auto">
                    <p>{{ $job_post_details->details ?? ''}}</p>
                    <div class="row">
                      <div class="col-md-12 text-center">
                        @if(auth()->user())
                          @if(\App\Helper\CustomHelper::canView('', 'Student'))
                            @if($IsApplied == 1)
                              <button class="btn btn-success btn-job-list" disabled>You have applied</button>
                            @else
                              <button type="submit" class="btn btn-job-list btn-apply">Apply Now</button>
                            @endif
                            {{--                        @endif--}}
                            {{--                        @if(auth()->user()->role('Student'))--}}
                          @else
                            <button type="submit" class="btn btn-job-list btn-apply-warning">Apply Now</button>
                          @endif
                        @else
                          <a class="btn btn-job-list" href="{{ route('login') }}">Apply Now</a>
                        @endif

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
  <script>
    $(document).on('click', '.btn-apply-warning', function () {
      $('#warningModal').modal('show')
    });
    // $(document).on('click', '.btn-apply-warning', function () {
    //   $('#warningModal').modal('show')
    // });
    $(document).on('click', '.btn-apply', function () {
      {{--var id = {{ request('id') }};--}}
      const pid = {{ request('id') }};
        $('.btn-apply').text("You have applied");
        $(this).addClass("btn-success");
        $(this).attr("disabled", true);
        $.ajax({
          type: "post",
          {{--url: "{{ url('tablet-data') }}/" + id,--}}
          url: "{{ route('ajax.post.apply') }}",
          dataType: "json",
          data: {'id': pid},
          success: function (data) {
            console.log(data);
            // if (data === "success") {
            //   $('.btn-apply').text("You have applied");
            //   $(this).addClass("btn-success");
            //   $(this).attr("disabled", true);
            // }
          }
        })
      // }
    })

    $(document).on('click', '.btn-delete', function () {
      var pid = $(this).data('id');
      $('.yes-btn').data('id', pid);
      $('#DeleteModal').modal('show')
    });
  </script>
@endsection
