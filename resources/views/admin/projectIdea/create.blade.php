@extends('layout.admin')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/admin/css/jquery-ui.min.css') }}">
@endsection

@section('content')
    <div class="row">
        {{--        <div class="float-right">--}}
        {{--            @if ($errors->any())--}}
        {{--                <div class="alert alert-danger">--}}
        {{--                    <ul>--}}
        {{--                        @foreach ($errors->all() as $error)--}}
        {{--                            <li>{{ $error }}</li>--}}
        {{--                        @endforeach--}}
        {{--                    </ul>--}}
        {{--                </div><br />--}}
        {{--            @endif--}}
        {{--        </div>--}}
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="panel-title">Project Idea Submission</h2>
                        </header>
                        <div class="panel-body">
                            @if(\App\Helper\CustomHelper::canView('List Of Project Idea', 'Super Admin'))
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                                        <a href="{{ route('admin.projectIdea.list') }}" class="brn btn-success btn-sm">List
                                            of Project Ideas</a>
                                    </div>
                                </div>
                            @endif
                            @if(session()->has('status'))
                                {!! session()->get('status') !!}
                            @endif

                            <form action="{{ route('admin.projectIdea.store') }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                {{--                <h4 class="panel-sub-title">New Member Creation Form</h4>--}}
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="title" class="control-label">Title [EN]<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="title" placeholder="Full Title in English" required
                                                   value="{{ old('title') }}"
                                                   class="form-control @error('title') is-invalid @enderror">
                                            @error('title')
                                            <strong class="text-danger">{{ $errors->first('title') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="title_bn" class="control-label">Title [BN]</label>
                                            <input type="text" name="title_bn" placeholder="Full Title in Bangla"
                                                   required
                                                   value="{{ old('title_bn') }}"
                                                   class="form-control @error('title_bn') is-invalid @enderror">
                                            @error('title_bn')
                                            <strong class="text-danger">{{ $errors->first('title_bn') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="keyword" class="control-label">Keyword's<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="keyword" placeholder="Keyword" required
                                                   value="{{ old('keyword') }}"
                                                   class="form-control @error('keyword') is-invalid @enderror">
                                            @error('keyword')
                                            <strong class="text-danger">{{ $errors->first('keyword') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="implementation_location" class="control-label">Implementation
                                                Location</label>
                                            <input type="text" name="implementation_location"
                                                   placeholder="Implementation Location"
                                                   value="{{ old('implementation_location') }}"
                                                   class="form-control @error('implementation_location') is-invalid @enderror"
                                            >
                                            @error('implementation_location')
                                            <strong
                                                class="text-danger">{{ $errors->first('implementation_location') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="expenses" class="control-label">Appx Expenses (BDT)</label>
                                            <input type="number" name="expenses" placeholder="Expenses"
                                                   value="{{ old('expenses') }}"
                                                   class="form-control @error('expenses') is-invalid @enderror">
                                            @error('expenses')
                                            <strong class="text-danger">{{ $errors->first('expenses') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">Benefits <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="benefits" placeholder="Benefits" rows="4"
                                                      class="form-control @error('benefits') is-invalid @enderror">{{ old('benefits') }}</textarea>
                                            @error('benefits')
                                            <strong class="text-danger">{{ $errors->first('benefits') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="instrument_details" class="control-label">Instrument
                                                Details</label>
                                            <textarea name="instrument_details" placeholder="Instrument Details"
                                                      rows="4"
                                                      class="form-control @error('instrument_details') is-invalid @enderror">{{ old('instrument_details') }}</textarea>
                                            @error('instrument_details')
                                            <strong
                                                class="text-danger">{{ $errors->first('instrument_details') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="short_description" class="control-label">Short Description
                                                [EN]<span
                                                    class="text-danger">*</span></label>
                                            <textarea name="short_description" placeholder="Short Description" rows="4"
                                                      class="form-control @error('short_description') is-invalid @enderror">{{ old('short_description') }}</textarea>
                                            @error('short_description')
                                            <strong
                                                class="text-danger">{{ $errors->first('short_description') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="short_description_bn" class="control-label">Short Description
                                                [BN] <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="short_description_bn" placeholder="Short Description"
                                                      rows="4"
                                                      class="form-control @error('short_description_bn') is-invalid @enderror">{{ old('short_description_bn') }}</textarea>
                                            @error('short_description_bn')
                                            <strong
                                                class="text-danger">{{ $errors->first('short_description_bn') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="description" class="control-label">Description [EN]<span
                                                    class="text-danger">*</span></label>
                                            <textarea name="description" placeholder="Description" rows="5"
                                                      class="form-control summernote @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                            @error('description')
                                            <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="description_bn" class="control-label">Description [BN] <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="description_bn" placeholder="Description" rows="5"
                                                      class="form-control summernote @error('description_bn') is-invalid @enderror">{{ old('description_bn') }}</textarea>
                                            @error('description_bn')
                                            <strong class="text-danger">{{ $errors->first('description_bn') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="board_roll" class="control-label">Board roll </label>
                                            <input type="text" id="board_roll_leader"
                                                   class="form-control  @error("board_roll") is-invalid @enderror"
                                                   name="board_roll[]" readonly
                                                   value="{{ old('board_roll',auth()->user()->board_roll) }}"
                                                   data-url="{{ route('admin.ajax.search.idea.student.name') }}">
                                            @error('board_roll')
                                            <strong class="text-danger">{{ $errors->first('board_roll') }}</strong>
                                            @enderror
                                            <input type="hidden" name="student_id[]" value="{{ auth()->id() }}" id="student_name_leader_id">

                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label">Team Leader<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" readonly name="student_name_leader"
                                                   placeholder="Name of item"
                                                   required
                                                   value="{{ old('student_name_leader',auth()->user()->name_en) }}"
                                                   class="form-control @error('student_name_leader') is-invalid @enderror"
                                            >
                                            @error('student_name_leader')
                                            <strong
                                                class="text-danger">{{ $errors->first('student_name_leader') }}</strong>
                                            @enderror
                                            <strong class="text-danger" id="student_name_leader_error"></strong>
                                            <input type="hidden" name="user_id[]" id="student_name_leader_id" value="{{ auth()->id() }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="technology" class="control-label">Technology </label>
                                            <input type="text" readonly
                                                   class="form-control @error("technology") is-invalid @enderror"
                                                   name="technology[]" id="technology"
                                                   value="{{ old('technology',auth()->user()->trade_technology) }}">
                                            @error('technology')
                                            <strong class="text-danger">{{ $errors->first('technology') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="semester" class="control-label">Semester </label>
                                            <input type="text" readonly
                                                   class="form-control @error("semester") is-invalid @enderror"
                                                   name="semester[]" id="semester"
                                                   value="{{ old('semester',auth()->user()->semester) }}">
                                            @error('semester')
                                            <strong class="text-danger">{{ $errors->first('semester') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="board_roll" class="control-label">Board roll </label>
                                            <input type="text" id="board_roll_one"
                                                   class="form-control  @error("board_roll") is-invalid @enderror"
                                                   name="board_roll[]"
                                                   value="{{ old('board_roll') }}"
                                                   data-url="{{ route('admin.ajax.search.idea.student.name') }}">
                                            @error('board_roll')
                                            <strong class="text-danger">{{ $errors->first('board_roll') }}</strong>
                                            @enderror
{{--                                            <input type="hidden" name="user_id[]" id="student_name_one_id">--}}

                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label">Member 1 <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" readonly name="student_name_one"
                                                   placeholder="Name of item"
                                                   required value="{{ old('student_name_one') }}"
                                                   class="form-control @error('student_name_one') is-invalid @enderror">
                                            @error('student_name_one')
                                            <strong
                                                class="text-danger">{{ $errors->first('student_name_one') }}</strong>
                                            @enderror
                                            <strong class="text-danger" id="student_name_one_error"></strong>
                                            <input type="hidden" name="user_id[]" id="student_name_one_id">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="technology" class="control-label">Technology </label>
                                            <input type="text" readonly
                                                   class="form-control @error("technology") is-invalid @enderror"
                                                   name="technology[]" id="technology_one"
                                                   value="{{ old('technology') }}">
                                            @error('technology')
                                            <strong class="text-danger">{{ $errors->first('technology') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group" >
                                            <label for="semester" class="control-label">Semester </label>
                                            <input type="text" readonly
                                                   class="form-control @error("semester") is-invalid @enderror"
                                                   name="semester[]" id="semester_one" value="{{ old('semester') }}">
                                            @error('semester')
                                            <strong class="text-danger">{{ $errors->first('semester') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    {{--                  <div class="col-sm-3">--}}
                                    {{--                    <div class="form-group">--}}
                                    {{--                      <label for="user_id" class="control-label">Member 2 </label>--}}
                                    {{--                      <select name="user_id"--}}
                                    {{--                              class="form-control @error('user_id') is-invalid @enderror">--}}
                                    {{--                        @foreach(\App\Models\User::get() as $item)--}}
                                    {{--                          <option value="{{ $item->id }}">{{ $item->name_en }}</option>--}}
                                    {{--                        @endforeach--}}
                                    {{--                      </select>--}}
                                    {{--                      @error('user_id')--}}
                                    {{--                      <strong class="text-danger">{{ $errors->first('user_id') }}</strong>--}}
                                    {{--                      @enderror--}}
                                    {{--                    </div>--}}
                                    {{--                  </div>--}}
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="board_roll" class="control-label">Board roll </label>
                                            <input type="text" id="board_roll_two"
                                                   class="form-control @error("board_roll") is-invalid @enderror"
                                                   name="board_roll[]" value="{{ old('board_roll') }}"
                                                   data-url="{{ route('admin.ajax.search.idea.student.name') }}">
                                            @error('board_roll')
                                            <strong class="text-danger">{{ $errors->first('board_roll') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Member 2 <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" readonly name="student_name_two"
                                                   placeholder="Name of item"
                                                   required value="{{ old('student_name_two') }}"
                                                   class="form-control @error('student_name_two') is-invalid @enderror"
                                            >
                                            @error('student_name_two')
                                            <strong
                                                class="text-danger">{{ $errors->first('student_name_two') }}</strong>
                                            @enderror
                                            <strong class="text-danger" id="student_name_two_error"></strong>
                                            <input type="hidden" name="user_id[]" id="student_name_two_id">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="technology" class="control-label">Technology </label>
                                            <input type="text" readonly
                                                   class="form-control @error("technology") is-invalid @enderror"
                                                   name="technology[]" id="technology_two"
                                                   value="{{ old('technology') }}">
                                            @error('technology')
                                            <strong class="text-danger">{{ $errors->first('technology') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="semester" class="control-label">Semester </label>
                                            <input type="text" readonly id="semester_two"
                                                   class="form-control @error("semester") is-invalid @enderror"
                                                   name="semester[]" value="{{ old('semester') }}">
                                            @error('semester')
                                            <strong class="text-danger">{{ $errors->first('semester') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div id="attributes">
                                    <div class="row child">
                                        <div class="col-md 3">
                                            <div class="form-group">
                                                <label for="image_upload">File Upload <span class="text-danger">*</span></label>
                                                <input type="file" name="image_upload[]" id="image_upload"
                                                       class="form-control @error("image_upload") is-invalid @enderror">
                                                @error("image_upload")
                                                <strong
                                                    class="text-danger">{{ $errors->first("image_upload") }}</strong>
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
                                                <label for="image_filename">File Description<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="image_filename[]" id="image_filename"
                                                       class="form-control filename @error("image_filename") is-invalid @enderror">
                                                @error("image_filename")
                                                <strong
                                                    class="text-danger">{{ $errors->first("image_filename") }}</strong>
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
                                                <a class="btn btn-danger text-light hidden clear-file" id="clear-file"
                                                   style="padding: 4px 2px; margin-right: 2px">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
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
    <script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/admin/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/custom.js') }}"></script>
    <script>
        $('.summernote').summernote({
            minHeight: '300px'
        })
        $('.select2').select2({
            maximumSelectionLength: 2,
        })
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


    </script>
@endsection
