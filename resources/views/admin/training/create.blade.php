@extends('layout.admin')

@section('stylesheet')
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
  <style>
    .select2-container--default
    .select2-selection--single {
      height: 40px!important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
      line-height: 32px!important;
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
              <h2 class="panel-title">Create training</h2>
            </header>
            <div class="panel-body">
              {{--              @if(\App\Helper\CustomHelper::canView('List Of Training', 'Super Admin'))--}}
              <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                  <a href="{{ route('admin.training.list') }}" class="brn btn-success btn-sm">List of trainings</a>
                </div>
              </div>
              {{--              @endif--}}
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.training.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  @if(!(\App\Helper\CustomHelper::isInstituteTrainingProvider()))
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label class="control-label">Institute Name<span class="text-danger">*</span></label>
                        <select name="institute_id" class="form-control @error('institute_id') is-invalid @enderror">
                          @foreach($institutes as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  @else
                    <input type="hidden" name="institute_id" value="{{ $institute->id }}">
                  @endif
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Training Title<span class="text-danger">*</span></label>
                      <input type="text" name="title" placeholder="Training Title" autocomplete="off" required
                             value="{{ old('title') }}"
                             class="form-control @error('title') is-invalid @enderror">
                      @error('title')
                      <strong class="text-danger">{{ $errors->first('title') }}</strong>
                      @enderror
                    </div>
                  </div>


                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Technology/trade<span class="text-danger">*</span></label>
                      <input type="text" name="technology" placeholder="Technology / trade" autocomplete="off" required
                             value="{{ old('technology') }}"
                             class="form-control @error('technology') is-invalid @enderror">
                      @error('technology')
                      <strong class="text-danger">{{ $errors->first('technology') }}</strong>
                      @enderror
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Type<span class="text-danger">*</span></label>
                      <select name="type_id" required class="form-control @error('type_id') is-invalid @enderror">
                        <option value="">Choose a type</option>
                        @foreach($trainingtype as $type)
                          <option value="{{ $type->id }}"
                                  @if(old('type_id') == $type->id) selected @endif>{{ ucfirst($type->name) }}</option>
                        @endforeach
                      </select>
                      @error('type_id')
                      <strong class="text-danger">{{ $errors->first('type_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label class="control-label">Participant Type</label>
                      <select name="participants[]" multiple class="form-control select2 @error('participants') is-invalid @enderror" required>
                        <option value="">Choose participant types</option>
                        @foreach($instituteTypes as $insType)
                          <option value="{{ $insType->id }}" @selected(in_array($insType->id,old('participants')?? []))>{{ $insType->name }}</option>
                        @endforeach
                      </select>
                      @error('participants')
                      <strong class="text-danger">{{ $errors->first('participants') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label class="control-label">Participant Limit</label>
                      <input type="number" name="participate_limit" placeholder="Participant Limit" autocomplete="off"
                             value="{{ old('participate_limit') }}"
                             class="form-control @error('participate_limit') is-invalid @enderror">
                      @error('participate_limit')
                      <strong class="text-danger">{{ $errors->first('participate_limit') }}</strong>
                      @enderror
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <label class="control-label">Start Date<span class="text-danger">*</span></label>
                      <input type="date" name="start_date" placeholder="Title" autocomplete="off" required
                             value="{{ old('start_date') }}"
                             class="form-control @error('start_date') is-invalid @enderror">
                      @error('start_date')
                      <strong class="text-danger">{{ $errors->first('start_date') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label class="control-label">End Date<span class="text-danger">*</span></label>
                      <input type="date" name="end_date" placeholder="Title" autocomplete="off" required
                             value="{{ old('end_date') }}"
                             class="form-control @error('end_date') is-invalid @enderror">
                      @error('end_date')
                      <strong class="text-danger">{{ $errors->first('end_date') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label class="control-label">Country<span class="text-danger">*</span></label>
                      <select name="country_id" class="form-control @error('country_id') is-invalid @enderror" required>
                        <option value="">Choose a country</option>
                        @foreach($countries as $country)
                          <option value="{{ $country->id }}" @selected($country->id == old('country_id', 19))>{{ $country->name }}</option>
                        @endforeach
                      </select>
                      @error('country_id')
                      <strong class="text-danger">{{ $errors->first('country_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label class="control-label">Division<span class="text-danger">*</span></label>
                      <select name="division_id" class="form-control @error('division_id') is-invalid @enderror" required>
                        <option value="">Choose a Division</option>
                        @foreach($divisions as $division)
                          <option value="{{ $division->id }}" @selected($division->id == old('division_id', $institute->division_id))>{{ $division->name }}</option>
                        @endforeach
                      </select>
                      @error('division_id')
                      <strong class="text-danger">{{ $errors->first('division_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label class="control-label">District<span class="text-danger">*</span></label>
                      <select name="district_id" class="form-control @error('district_id') is-invalid @enderror" required>
                        <option value="">Choose a District</option>
                        @foreach($districts as $district)
                          <option value="{{ $district->id }}" @selected($district->id == old('district_id', $institute->district_id))>{{ $district->name }}</option>
                        @endforeach
                      </select>
                      @error('district_id')
                      <strong class="text-danger">{{ $errors->first('district_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label class="control-label">Upazila<span class="text-danger">*</span></label>
                      <select name="upazila_id" class="form-control @error('upazila_id') is-invalid @enderror" required>
                        <option value="">Choose a upazila</option>
                        @foreach($upazilas as $upazila)
                          <option value="{{ $upazila->id }}" @selected($upazila->id == old('upazila_id', $institute->upazila_id))>{{ $upazila->name }}</option>
                        @endforeach
                      </select>
                      @error('upazila_id')
                      <strong class="text-danger">{{ $errors->first('upazila_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Participation Mode<span class="text-danger">*</span></label>
                      <select name="participation" class="form-control @error('participation') is-invalid @enderror" required>
                        <option value="single">Single</option>
                        @hasrole('Super Admin')
                        <option value="multiple">Multiple</option>
                        @else
                        <option disabled value="multiple">Multiple</option>
                        @endhasrole
                      </select>
                      @error('participation')
                      <strong class="text-danger">{{ $errors->first('participation') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Batch Creator<span class="text-danger">*</span></label>
                      <select name="batch_creator_id" class="form-control @error('batch_creator_id') is-invalid @enderror" required>
                        <option value="">Choose a Batch Creator</option>
                        @foreach($batchcreators as $user)
                          <option value="{{ $user->id }}" @selected($user->id == old('batch_creator_id'))>{{ $user->name_en }}</option>
                        @endforeach
                      </select>
                      @error('batch_creator_id')
                      <strong class="text-danger">{{ $errors->first('batch_creator_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Batch Approver<span class="text-danger">*</span></label>
                      <select name="batch_approver_id" class="form-control @error('batch_approver_id') is-invalid @enderror" required>
                        <option value="">Choose a Batch Approver</option>
                        @foreach($batchapprovers as $user)
                          <option value="{{ $user->id }}" @selected($user->id == old('batch_approver_id'))>{{ $user->name_en }}</option>
                        @endforeach
                      </select>
                      @error('batch_approver_id')
                      <strong class="text-danger">{{ $errors->first('batch_approver_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="description" class="control-label">Description</label>
                      <textarea name="description" placeholder="Write description" autocomplete="off"
                                class="form-control summernote @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                      @error('description')
                      <strong class="text-danger">{{ $errors->first('description') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>


                <div id="attributes">
                  <div class="row child">
                    <div class="col-md 3">
                      <div class="form-group">
                        <label for="image_upload">File Upload <span class="text-danger">*</span></label>
                        <input type="file"  alt="" name="image_upload[]" id="image_upload"
                               class="form-control @error("image_upload") is-invalid @enderror">
                        @error("image_upload")
                        <strong class="text-danger">{{ $errors->first("image_upload") }}</strong>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md 3">
                      <div class="form-group">
                        <label for="image_type" class="imageType">File type <span
                            class="text-danger">*</span></label>
                        <input type="text" name="image_type[]" id="image_type"
                               class="form-control type @error("image_type") is-invalid @enderror">
                        @error("image_type")
                        <strong class="text-danger">{{ $errors->first("image_type") }}</strong>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md 3">
                      <div class="form-group">
                        <label for="image_filename">File Description<span class="text-danger">*</span></label>
                        <input type="text" name="image_filename[]" id="image_filename"
                               class="form-control filename @error("image_filename") is-invalid @enderror">
                        @error("image_filename")
                        <strong class="text-danger">{{ $errors->first("image_filename") }}</strong>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md 2">
                      <div class="form-group">
                        <label for="image_size">Size <span class="text-danger">*</span></label>
                        <input type="text" name="image_size[]" id="image_size"
                               class="form-control size @error("image_size") is-invalid @enderror">
                        @error("image_size")
                        <strong class="text-danger">{{ $errors->first("image_size") }}</strong>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-1">
                      <div class="form-group" style="margin-top:25px!important;display: flex">
                        <a class="btn btn-danger text-light hidden clear-file" id="clear-file" style="padding: 4px 2px; margin-right: 2px">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path
                              d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                            <path fill-rule="evenodd"
                                  d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                          </svg>
                        </a>
                        <a class="btn btn-secondary text-light add"><strong>+</strong> Add</a>
                      </div>
                    </div>
                  </div>
                </div>


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
  <script>
    $(document).ready(function () {
      $('.select2').select2()

      $('.clear-file').click(function () {
        $('#image_upload').val('').change()
        $('#image_filename').val('')
        $('#image_type').val('')
        $('#image_size').val('')
        $('#clear-file').addClass('hidden')
      })

      //    multiple row crate

      /* Variables */
      var row = $(".attr");

      function addRow() {
        row.clone(true, true).appendTo("#attributes");
      }

      function removeRow(button) {
        button.closest("div.attr").remove();
      }

      $('#attributes .attr:first-child').find('.remove').hide();

      /* Doc ready */
      $(".add").on('click', function () {
        let content = `<div class="row child" >
            <div class="col-md 3">
                <div class="form-group">
                    <label for="image_upload">File Upload <span class="text-danger">*</span></label>
                    <input type="file"  alt="" name="image_upload[]"
                         class="form-control">
                  </div>
              </div>
              <div class="col-md 3">
                  <div class="form-group">
                      <label for="image_type">File type <span class="text-danger">*</span></label>
                      <input type="text" name="image_type[]"
                             class="form-control type">
                  </div>
              </div>
              <div class="col-md 3">
                  <div class="form-group">
                      <label for="image_filename">File Description<span class="text-danger">*</span></label>
                      <input type="text" name="image_filename[]"
                             class="form-control filename">
                  </div>
              </div>
              <div class="col-md 2">
                  <div class="form-group">
                      <label for="image_size">Size <span class="text-danger">*</span></label>
                      <input type="text" name="image_size[]"
                             class="form-control size">
                  </div>
              </div>
              <div class="col-md-1">
                  <div class="form-group" style="margin-top:30px!important;">
                      <label for="image_size" ></label>
                  <span  class="btn btn-danger child-remove"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                          <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                      </svg></span>
                  </div>
              </div>
          </div>`;
        $('#attributes').append(content)
      });


      $(document).on('click', '.child-remove', function () {
        $(this).closest('.child').remove()
      });

      $(document).on('change', 'input[type="file"]', function (e) {
        if (e.target.id === 'image_upload') {
          $('#clear-file').removeClass('hidden')
        }
        const filename = $(this)[0].files.length ? $(this)[0].files[0].name : "";
        var file_name_array = filename.split(".");
        var ext = file_name_array[file_name_array.length - 1];
        const size = Math.round($(this)[0].files.length ? ($(this)[0].files[0].size / 1024) : 0);
        $(this).closest('.child').find('.type').val('.' + ext)
        $(this).closest('.child').find('.type').attr('readonly', 'true')
        $(this).closest('.child').find('.filename').val(filename.split('.').slice(0, -1).join('.'))
        $(this).closest('.child').find('.size').val(size + ' KB')
        $(this).closest('.child').find('.size').attr('readonly', 'true')
      })
    });
  </script>


@endsection
