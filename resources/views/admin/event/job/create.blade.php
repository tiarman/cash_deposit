@extends('layout.admin')

@section('stylesheet')
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.css') }}">
  {{--  <style>--}}
  {{--      .select2-selection__rendered {--}}
  {{--          line-height: 31px !important;--}}
  {{--      }--}}
  {{--      .select2-container .select2-selection--single {--}}
  {{--          height: 35px !important;--}}
  {{--      }--}}
  {{--      .select2-selection__arrow {--}}
  {{--          height: 100px !important;--}}
  {{--      }--}}
  {{--      .select2-container .select2-selection--multiple {--}}
  {{--          box-sizing: border-box;--}}
  {{--          cursor: pointer;--}}
  {{--          display: block;--}}
  {{--          min-height: 122px;--}}
  {{--          user-select: none;--}}
  {{--          -webkit-user-select: none;--}}
  {{--      }--}}
  {{--  </style>--}}
  <style>
      span.email-ids {
          float: left;
          /* padding: 4px; */
          border: 1px solid #ccc;
          margin-right: 5px;
          padding-left: 10px;
          padding-right: 10px;
          margin-bottom: 5px;
          background: #f5f5f5;
          padding-top: 3px;
          padding-bottom: 3px;
          border-radius: 5px;
      }
      span.cancel-email {
          border: 1px solid #ccc;
          width: 18px;
          display: block;
          float: right;
          text-align: center;
          margin-left: 20px;
          border-radius: 49%;
          height: 18px;
          line-height: 15px;
          margin-top: 1px;    cursor: pointer;
      }
      .col-sm-12.email-id-row {
          border: 1px solid #ccc;
      }
      .col-sm-12.email-id-row input {
          border: 0px; outline:0px;
      }
      span.to-input {
          display: block;
          float: left;
          padding-right: 11px;
      }
      .col-sm-12.email-id-row {
          padding-top: 6px;
          padding-bottom: 7px;
          margin-top: 23px;
      }
  </style>
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Create Job Event</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List Of Job Event', 'Institute Head'))
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.event.job.list') }}" class="brn btn-success btn-sm">List of job events</a>
                  </div>
                </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              <form action="{{ route('admin.event.job.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label">Title</label>
                      <input type="text" name="title" placeholder="Title" autocomplete="off"
                             value="{{ old('title') }}"
                             class="form-control @error('title') is-invalid @enderror">
                      @error('title')
                      <strong class="text-danger">{{ $errors->first('title') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Place</label>
                      <input type="text" name="place" placeholder="Place" autocomplete="off"
                             value="{{ old('place') }}"
                             class="form-control @error('place') is-invalid @enderror">
                      @error('place')
                      <strong class="text-danger">{{ $errors->first('place') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Start Date</label>
                      <input type="date" name="start_date" placeholder="Start Date" autocomplete="off"
                             value="{{ old('start_date') }}"
                             class="form-control @error('start_date') is-invalid @enderror">
                      @error('start_date')
                      <strong class="text-danger">{{ $errors->first('start_date') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">End Date</label>
                      <input type="date" name="end_date" placeholder="Date" autocomplete="off"
                             value="{{ old('end_date') }}"
                             class="form-control @error('end_date') is-invalid @enderror">
                      @error('end_date')
                      <strong class="text-danger">{{ $errors->first('end_date') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div id="organizaion_attributes">
                      <div class="row child">
                        <div class="col-md-10">
                          <div class="form-group">
                            <label for="organizaion">Organizer<span class="text-danger">*</span></label>
                            <input type="text" name="organizaion[]" id="organizaion"
                                   class="form-control size @error("organizaion") is-invalid @enderror">
                            @error("organizaion")
                            <strong class="text-danger">{{ $errors->first("organizaion") }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group" style="margin-top:28px!important;display: flex">
                            <a class="btn btn-danger text-light hidden clear-file" id="clear-file" style="padding: 4px 2px; margin-right: 2px">
                              <i class="fa fa-trash-o"></i>
                            </a>
                            <a class="btn btn-secondary text-light add-organizers"><i class="fa fa-plus"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div id="sponsors_attributes">
                      <div class="row child">
                        <div class="col-md-10">
                          <div class="form-group">
                            <label for="sponsors">Sponsor<span class="text-danger">*</span></label>
                            <input type="text" name="sponsors[]" id="sponsors"
                                   class="form-control size @error("sponsors") is-invalid @enderror">
                            @error("sponsors")
                            <strong class="text-danger">{{ $errors->first("sponsors") }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group" style="margin-top:28px!important;display: flex">
                            <a class="btn btn-danger text-light hidden clear-file" id="clear-file" style="padding: 4px 2px; margin-right: 2px">
                              <i class="fa fa-trash-o"></i>
                            </a>
                            <a class="btn btn-secondary text-light add-sponsors"><i class="fa fa-plus"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div id="partner_attributes">
                      <div class="row child">
                        <div class="col-md-10">
                          <div class="form-group">
                            <label for="partners">Co-Organizer/Partner<span class="text-danger">*</span></label>
                            <input type="text" name="partners[]" id="partners"
                                   class="form-control size @error("partners") is-invalid @enderror">
                            @error("partners")
                            <strong class="text-danger">{{ $errors->first("partners") }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group" style="margin-top:28px!important;display: flex">
                            <a class="btn btn-danger text-light hidden clear-file" id="clear-file" style="padding: 4px 2px; margin-right: 2px">
                              <i class="fa fa-trash-o"></i>
                            </a>
                            {{--                            <a class="btn btn-secondary text-light add-pertners"><i class="fa fa-plus"></i></a>--}}
                            <a class="btn btn-secondary text-light add-pertners"><i class="fa fa-plus"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">List Of Employers</label>
                      <select name="employers[]" class="select2 form-control @error('employers') is-invalid @enderror" multiple>
                        <option value="">Employers 1</option>
                        <option value="">Employers 2</option>
                        <option value="">Employers 3</option>
                      </select>
                      @error('employers')
                      <strong class="text-danger">{{ $errors->first('employers') }}</strong>
                      @enderror
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Job Types</label>
                      <select name="job_type[]" class="select2 form-control @error('job_type') is-invalid @enderror" multiple>
                        <option value="">Type 1</option>
                        <option value="">Type 2</option>
                        <option value="">Type 3</option>
                      </select>
                      @error('job_type')
                      <strong class="text-danger">{{ $errors->first('job_type') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Post Types</label>
                      <select name="post_type[]" class="select2 form-control @error('post_type') is-invalid @enderror" multiple>
                        <option value="">Type 1</option>
                        <option value="">Type 2</option>
                        <option value="">Type 3</option>
                      </select>
                      @error('post_type')
                      <strong class="text-danger">{{ $errors->first('post_type') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Perticipants Criteria</label>
                      <select name="perticipant_criteria[]" class="select2 form-control @error('perticipant_criteria') is-invalid @enderror" multiple>
                        <option value="">Criteria 1</option>
                        <option value="">Criteria 2</option>
                        <option value="">Criteria 3</option>
                      </select>
                      @error('perticipant_criteria')
                      <strong class="text-danger">{{ $errors->first('perticipant_criteria') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">No of Guest</label>
                      <input type="text" name="guest_no" placeholder="No of Guest" autocomplete="off"
                             value="{{ old('guest_no') }}"
                             class="form-control @error('guest_no') is-invalid @enderror">
                      @error('guest_no')
                      <strong class="text-danger">{{ $errors->first('guest_no') }}</strong>
                      @enderror
                    </div>
                  </div>

                  {{--                  <div class="col-sm-6">--}}
                  {{--                    <div class="form-group">--}}
                  {{--                      <label class="control-label">Co-Organizer/Partner</label>--}}
                  {{--                      <select name="pertners[]" class="select2 form-control @error('pertners[]') is-invalid @enderror" multiple>--}}
                  {{--                        <option value="">Partner 1</option>--}}
                  {{--                        <option value="">Partner 2</option>--}}
                  {{--                        <option value="">Partner 3</option>--}}
                  {{--                      </select>--}}
                  {{--                      @error('ertners[]')--}}
                  {{--                      <strong class="text-danger">{{ $errors->first('pertners[]') }}</strong>--}}
                  {{--                      @enderror--}}
                  {{--                    </div>--}}
                  {{--                  </div>--}}
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label">Event Details</label>
                      <textarea type="text" id="event_details" name="event_details" placeholder="Event Details" autocomplete="off"
                                value="{{ old('event_details') }}"
                                class="form-control @error('event_details') is-invalid @enderror"></textarea>
                      @error('event_details')
                      <strong class="text-danger">{{ $errors->first('event_details') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label">Guest Details</label>
                      <textarea type="text" id="guest_details" name="guest_details" placeholder="Guest Details" autocomplete="off"
                                value="{{ old('guest_details') }}"
                                class="form-control @error('guest_details') is-invalid @enderror"></textarea>
                      @error('guest_details')
                      <strong class="text-danger">{{ $errors->first('guest_details') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group" style="">
                      <label class="control-label">image (Upload)</label>
                      <input type="file" name="image"
                             class="form-control @error('image') is-invalid @enderror">
                      @error('image')
                      <strong class="text-danger">{{ $errors->first('image') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>
                {{--                  <div class="row">--}}
                {{--                    <div class="col-md-12">--}}
                {{--                      <h3>Stalls Settings</h3>--}}
                {{--                    </div>--}}
                {{--                  </div>--}}
                {{--                <div id="attributes">--}}
                {{--                  <div class="row child">--}}
                {{--                    <div class="col-md 5">--}}
                {{--                      <div class="form-group">--}}
                {{--                        <label for="no_of_stall">No of Stall<span class="text-danger">*</span></label>--}}
                {{--                        <input type="text" name="no_of_stall[]" id="no_of_stall"--}}
                {{--                               class="form-control filename @error("no_of_stall") is-invalid @enderror">--}}
                {{--                        @error("no_of_stall")--}}
                {{--                        <strong class="text-danger">{{ $errors->first("no_of_stall") }}</strong>--}}
                {{--                        @enderror--}}
                {{--                      </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-md 5">--}}
                {{--                      <div class="form-group">--}}
                {{--                        <label for="size_of_stall">Size of Stall<span class="text-danger">*</span></label>--}}
                {{--                        <input type="text" name="size_of_stall[]" id="size_of_stall"--}}
                {{--                               class="form-control size @error("size_of_stall") is-invalid @enderror">--}}
                {{--                        @error("size_of_stall")--}}
                {{--                        <strong class="text-danger">{{ $errors->first("size_of_stall") }}</strong>--}}
                {{--                        @enderror--}}
                {{--                      </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-md-1">--}}
                {{--                      <div class="form-group" style="margin-top:28px!important;display: flex">--}}
                {{--                        <a class="btn btn-danger text-light hidden clear-file" id="clear-file" style="padding: 4px 2px; margin-right: 2px">--}}
                {{--                          <i class="fa fa-trash-o"></i>--}}
                {{--                        </a>--}}
                {{--                        <a class="btn btn-secondary text-light add"><i class="fa fa-plus"></i></a>--}}
                {{--                      </div>--}}
                {{--                    </div>--}}
                {{--                  </div>--}}
                {{--                </div>--}}
                <div class="row">
                  <div class="col-sm-12 text-right">
                    <button class="btn btn-danger btn-sm" type="submit">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
  <script src="{{ asset('assets/admin/plugins/select2/js/select2.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.js') }}"></script>
  <script>
    $(document).ready(function () {
      $('.select2').select2()
      $(".add-sponsors").on('click', function () {
        let content = `<div class="row child" >
              <div class="col-md 5">
                  <div class="form-group">
                      <label for="sponsors">sponsor<span class="text-danger">*</span></label>
                      <input type="text" name="sponsors[]"
                             class="form-control size">
                  </div>
              </div>
              <div class="col-md-1">
                  <div class="form-group" style="margin-top:8px!important;">
                      <label for="sponsors" ></label>
                      <span class="btn btn-danger child-remove"><i class="fa fa-trash-o"></i></span>
                  </div>
              </div>
          </div>`;
        $('#sponsors_attributes').append(content)
      });

      $(document).on('click', '.child-remove', function () {
        $(this).closest('.child').remove()
      });
      $(".add-organizers").on('click', function () {
        let content = `<div class="row child" >
              <div class="col-md 5">
                  <div class="form-group">
                      <label for="organizaion">Organizer<span class="text-danger">*</span></label>
                      <input type="text" name="organizaion[]"
                             class="form-control size">
                  </div>
              </div>
              <div class="col-md-1">
                  <div class="form-group" style="margin-top:8px!important;">
                      <label for="image_size" ></label>
                      <span class="btn btn-danger child-remove"><i class="fa fa-trash-o"></i></span>
                  </div>
              </div>
          </div>`;
        $('#organizaion_attributes').append(content)
      });

      $(document).on('click', '.child-remove', function () {
        $(this).closest('.child').remove()
      });

      $(".add-pertners").on('click', function () {
        let content = `<div class="row child" >
              <div class="col-md 5">
                  <div class="form-group">
                      <label for="pertners">Co-Organizer/Partner<span class="text-danger">*</span></label>
                      <input type="text" name="pertners[]"
                             class="form-control size">
                  </div>
              </div>
              <div class="col-md-1">
                  <div class="form-group" style="margin-top:8px!important;">
                      <label for="image_size" ></label>
                      <span class="btn btn-danger child-remove"><i class="fa fa-trash-o"></i></span>
                  </div>
              </div>
          </div>`;
        $('#partner_attributes').append(content)
      });

      $(document).on('click', '.child-remove', function () {
        $(this).closest('.child').remove()
      });
      // $(".add").on('click', function () {
      // let content = `<div class="row child" >
      //       <div class="col-md 5">
      //           <div class="form-group">
      //               <label for="no_of_stall">No of Stall<span class="text-danger">*</span></label>
      //               <input type="text" name="no_of_stall[]"
      //                      class="form-control filename">
      //           </div>
      //       </div>
      //       <div class="col-md 5">
      //           <div class="form-group">
      //               <label for="size_of_stall">Size of Stall<span class="text-danger">*</span></label>
      //               <input type="text" name="size_of_stall[]"
      //                      class="form-control size">
      //           </div>
      //       </div>
      //       <div class="col-md-1">
      //           <div class="form-group" style="margin-top:8px!important;">
      //               <label for="image_size" ></label>
      //               <span class="btn btn-danger child-remove"><i class="fa fa-trash-o"></i></span>
      //           </div>
      //       </div>
      //   </div>`;
      //   $('#attributes').append(content)
      // });
      //
      // $(document).on('click', '.child-remove', function () {
      //   $(this).closest('.child').remove()
      // });
      $(document).ready(function() {
        $('#guest_details').summernote({
          'height': 100,
        });
        $('#event_details').summernote({
          'height': 100,
        });
      });
    });
  </script>
  {{--  <script>--}}
  {{--    $(".enter-mail-id").keydown(function (e) {--}}
  {{--      if (e.keyCode == 13 ) {--}}
  {{--        //alert('You Press enter');--}}
  {{--        var getValue = $(this).val();--}}
  {{--        $('.all-mail').append('<span class="email-ids">'+ getValue +' <span class="cancel-email">x</span></span>');--}}
  {{--        $(this).val('');--}}

  {{--      }--}}
  {{--    });--}}


  {{--    /// Cancel--}}

  {{--    $(document).on('click','.cancel-email',function(){--}}

  {{--      $(this).parent().remove();--}}

  {{--    });--}}
  {{--  </script>--}}
@endsection
