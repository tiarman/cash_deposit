@extends('layout.admin')

@section('stylesheet')
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.css') }}">
  <style>
      /*.img-input{*/
      /*    text-align: center;*/
      /*}*/
      #inp {
          text-align: center;
          margin: auto;
      }
      .sub-panel-heading .sub-panel-title {
          font-size: 20px;
          font-weight: 400;
          margin-bottom: 26px;
          text-align: left;
      }

      .select2-selection__rendered {
          line-height: 31px !important;
      }
      .select2-container .select2-selection--single {
          height: 40px !important;
      }
      .select2-selection__arrow {
          height: 34px !important;
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
              <h2 class="panel-title">Update Profile</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List Of Student', 'Super Admin'))
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    {{--                    <a href="{{ route('admin.division.list') }}" class="brn btn-success btn-sm">List of divisions</a>--}}
                  </div>
                </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.resume.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-sm-6">
                    <div class="img-holder mb-4 d-flex justify-content-center">
                      <img src="{{ asset(auth()->user()->image ?? 'assets/placeholder.png') }}"
                           alt="example placeholder" style="width: 131px; margin-top: 26px;" />
                    </div>
                    <div class="form-group" style="text-align-last: center;">
                      <label class="control-label">Photo (Upload)</label>
                      <input type="file" name="photo"
                             class="form-control @error('photo') is-invalid @enderror">
                      @error('photo')
                      <strong class="text-danger">{{ $errors->first('photo') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Full name [English]<span class="text-danger">*</span></label>
                          <input type="text" name="name_en" placeholder="Full name in english" required value="{{ old('name_en', auth()->user()->name_en) }}"
                                 class="form-control @error('name_en') is-invalid @enderror">
                          @error('name_en')
                          <strong class="text-danger">{{ $errors->first('name_en') }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="phone">Phone <span class="text-danger">*</span></label>
                          <input type="number" name="phone" id="phone" placeholder="Enter Your Phone Number" autocomplete="off"
                                 class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', auth()->user()->phone) }}">
                          <span class="spin"></span>
                          @error('phone')
                          <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="email">Email <span class="text-danger">*</span></label>
                          <input type="email" name="email" id="email" placeholder="Enter Your E-mail"
                                 class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->email) }}">
                          <span class="spin"></span>
                          @error('email')
                          <strong class="text-danger">{{ $errors->first('email') }}</strong>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label" for="address">Address</label>
                          <input type="text" name="address" placeholder="address" autocomplete="off"
                                 value="{{ old('address',auth()->user()->address) }}"
                                 class="form-control @error('address') is-invalid @enderror">
                          @error('address')
                          <strong class="text-danger">{{ $errors->first('address') }}</strong>
                          @enderror
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <header class="sub-panel-heading" style="background-color: #e9eff1">
                  <h2 class="sub-panel-title">Registration Information</h2>
                </header>
                <div  class="row pb-3 mt-3 border-bottom">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="trade_technology_id">Trade/Technology/Department</label>
                      <select name="trade_technology_id" id="trade_technology_id" class="form-control @error('trade_technology_id') is-invalid @enderror">
                        <option value="">Choose a Trade/Technology</option>
                        @foreach ($trades as $item)
                          <option value="{{ $item->id }}"
                                  @if(old('trade_technology_id',auth()->user()->trade_technology_id) == $item->id) selected @endif>{{ ucfirst($item->name) }}</option>
                        @endforeach
                      </select>
                      @error('trade_technology_id')
                      <strong class="text-danger">{{$error->first('trade_technology_id')}}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="shift_id">Shift</label>
                      <select name="shift_id" id="shift_id" class="form-control @error('shift_id') is-invalid @enderror">
                        <option value="">Choose a Shift</option>
                        @foreach ($shifts as $item)
                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                          <option value="{{ $item->id }}"
                                  @if(old('shift_id',auth()->user()->shift_id) == $item->id) selected @endif>{{ ucfirst($item->name) }}</option>
                        @endforeach
                      </select>
                      @error('shift_id')
                      <strong class="text-danger">{{$error->first('shift_id')}}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Semester</label>
                      <select id="semester_id" name="semester_id" class="form-control select-or-disable @error('semester_id') is-invalid @enderror">
                        <option value="">Choose a Semester</option>
                        <option value="1">Semester 1</option>
                        @foreach($semesters as $item)
{{--                          <option value="{{ $item->id }}" @selected($item->id == old('semester_id'))>{{ $item->name }}</option>--}}
                          <option value="{{ $item->id }}"
                                  @if(old('semester_id',auth()->user()->semester_id) == $item->id) selected @endif>{{ ucfirst($item->name) }}</option>
                        @endforeach
                      </select>
                      @error('semester_id')
                      <strong class="text-danger">{{ $errors->first('semester_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Year</label>
                      <select id="year"  name="year" class="form-control select-or-disable @error('year') is-invalid @enderror">
                        <option value="">Choose a Year</option>
                        @foreach(\App\Models\User::$yearArrays as $year)
                          <option value="{{ $year }}"
                                  @if(old('year', auth()->user()->year) == $year) selected @endif>{{ ucfirst($year) }}</option>
                        @endforeach
                      </select>
                      @error('year')
                      <strong class="text-danger">{{ $errors->first('year') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="s_session">Session</label>
                      <input type="text" name="s_session" id="s_session" placeholder="2021-2022" autocomplete="off"
                             class="form-control @error('s_session') is-invalid @enderror" value="{{ old('session',auth()->user()->session) }}">
                      <span class="spin"></span>
                      @error('s_session')
                      <strong class="text-danger">{{ $errors->first('s_session') }}</strong>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="board_roll">Board Roll<span class="text-danger">*</span></label>
                      <input type="text" name="board_roll" id="board_roll" placeholder="Enter Your Fath er Name" autocomplete="off"
                             class="form-control select-or-disable @error('board_roll') is-invalid @enderror" value="{{ old('board_roll',auth()->user()->board_roll) }}">
                      <span class="spin"></span>
                      @error('board_roll')
                      <strong class="text-danger">{{ $errors->first('board_roll') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="running_board_roll">Running Board Roll<span class="text-danger">*</span></label>
                      <input type="text" name="running_board_roll" id="running_board_roll" placeholder="Enter Your Fath er Name" autocomplete="off"
                             class="form-control select-or-disable @error('running_board_roll') is-invalid @enderror" value="{{ old('running_board_roll',auth()->user()->running_board_roll)}}">
                      <span class="spin"></span>
                      @error('running_board_roll')
                      <strong class="text-danger">{{ $errors->first('running_board_roll') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="admission_year">Admission Year <span class="text-danger">*</span></label>
                      <input type="text" name="admission_year" id="admission_year" placeholder="Enter Admission Year " autocomplete="off"
                             class="form-control @error('admission_year') is-invalid @enderror" value="{{ old('admission_year',auth()->user()->admission_year) }}">
                      <span class="spin"></span>
                      @error('admission_year')
                      <strong class="text-danger">{{ $errors->first('admission_year') }}</strong>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">NID</label>
                      <input id="nid" type="text" name="nid" placeholder="Your NID NO." value="{{ old('nid', auth()->user()->nid) }}"
                             class="form-control select-or-disable @error('nid') is-invalid @enderror">
                      @error('nid')
                      <strong class="text-danger">{{ $errors->first('nid') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Birth-Certificate<span class="text-danger">*</span></label>
                      <input type="text" id="birth_certificate" name="birth_certificate" placeholder="Your Birth Certificate NO." required value="{{ old('birth_certificate',auth()->user()->birth_certificate) }}"
                             class="form-control select-or-disable @error('birth_certificate') is-invalid @enderror">
                      @error('birth_certificate')
                      <strong class="text-danger">{{ $errors->first('birth_certificate') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Employment Status<span class="text-danger">*</span></label>
                      <select name="employment_status" required class="form-control @error('employment_status') is-invalid @enderror">
                        <option value="">Choose an Option</option>
                        @foreach(\App\Models\User::$employmentArrays as $employment_status)
                          <option value="{{ $employment_status }}"
                                  @if(old('employment_status', auth()->user()->employment_status) == $employment_status) selected @endif>{{ ucfirst($employment_status) }}</option>
                        @endforeach
                      </select>
                      @error('employment_status')
                      <strong class="text-danger">{{ $errors->first('employment_status') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="employing_company">Work For(Optional)</label>
                      <input type="text" name="employing_company" id="employing_company" placeholder="Company Name" autocomplete="off"
                             class="form-control @error('employing_company') is-invalid @enderror" value="{{ old('employing_company',auth()->user()->employing_company) }}">
                      <span class="spin"></span>
                      @error('employing_company')
                      <strong class="text-danger">{{ $errors->first('employing_company') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="cv">CV(Optional)</label>
                      <input type="file" name="cv" id="cv" placeholder="" autocomplete="off"
                             class="form-control @error('cv') is-invalid @enderror" value="{{ old('cv') }}">
                      <span class="spin"></span>
                      @error('cv')
                      <strong class="text-danger">{{ $errors->first('cv') }}</strong>
                      @enderror
                    </div>
                  </div>

                </div>
                <header class="sub-panel-heading" style="background-color: #e9eff1">
                  <h2 class="sub-panel-title">Personal Information</h2>
                </header>
                <div class="row pb-3 mt-3 border-bottom">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="father_name">Father Name<span class="text-danger">*</span></label>
                      <input type="text" name="father_name" id="father_name" placeholder="Enter Your Father Name" autocomplete="off"
                             class="form-control select-or-disable @error('father_name') is-invalid @enderror" value="{{ old('father_name',auth()->user()->father_name) }}">
                      <span class="spin"></span>
                      @error('father_name')
                      <strong class="text-danger">{{ $errors->first('father_name') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="mother_name">Mother Name<span class="text-danger">*</span></label>
                      <input type="text" name="mother_name" id="mother_name" placeholder="Enter Your Mother Name" autocomplete="off"
                             class="form-control select-or-disable @error('mother_name') is-invalid @enderror" value="{{ old('mother_name',auth()->user()->mother_name) }}">
                      <span class="spin"></span>
                      @error('mother_name')
                      <strong class="text-danger">{{ $errors->first('mother_name') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Gender</label>
                      <select id="gender"  name="gender" class="form-control select-or-disable @error('gender') is-invalid @enderror">
                        <option value="">Choose a Gender</option>
                        @foreach(\App\Models\User::$genderArrays as $gender)
                          <option value="{{ $gender }}"
                                  @if(old('gender', auth()->user()->gender) == $gender) selected @endif>{{ ucfirst($gender) }}</option>
                        @endforeach
                      </select>
                      @error('gender')
                      <strong class="text-danger">{{ $errors->first('gender') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="blood_group">Blood Group<span class="text-danger">*</span></label>
                      <input type="text" name="blood_group" id="blood_group" placeholder="Enter Your Fath er Name" autocomplete="off"
                             class="form-control select-or-disable @error('blood_group') is-invalid @enderror" value="{{ old('blood_group',auth()->user()->blood_group)}}">
                      <span class="spin"></span>
                      @error('blood_group')
                      <strong class="text-danger">{{ $errors->first('blood_group') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="marital_status">Marital Status <span class="text-danger">*</span></label>
                      <input type="text" name="marital_status" id="marital_status" placeholder="Enter Marital Status " autocomplete="off"
                             class="form-control @error('marital_status') is-invalid @enderror" value="{{ old('marital_status',auth()->user()->marital_status) }}">
                      <span class="spin"></span>
                      @error('marital_status')
                      <strong class="text-danger">{{ $errors->first('marital_status') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Religion</label>
                      <input id="religion" type="text" name="religion" placeholder="Your Religion" value="{{ old('religion', auth()->user()->religion) }}"
                             class="form-control select-or-disable @error('religion') is-invalid @enderror">
                      @error('religion')
                      <strong class="text-danger">{{ $errors->first('religion') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row mb-4">
                  <div class="col-sm-12 text-right">
                    <button class="btn btn-danger btn-sm" type="submit">Update</button>
                  </div>
                </div>
              </form>
{{--              <header class="sub-panel-heading" style="background-color: #e9eff1">--}}
{{--                <h2 class="sub-panel-title">Training/Short Course Information</h2>--}}
{{--              </header>--}}

{{--                <div class="row">--}}
{{--                  <table id="datatable-buttons" class="table table-striped dt-responsive nowrap"--}}
{{--                         cellspacing="0" width="100%" style="font-size: 14px; margin: 0px 0px 10px 10px;">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                      <th width="50">#</th>--}}
{{--                      <th>Training title</th>--}}
{{--                      <th>Provider</th>--}}
{{--                      <th>Duration</th>--}}
{{--                      <th>Location</th>--}}
{{--                      <th>Option</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    <tr>--}}
{{--                      <td></td>--}}
{{--                      <td></td>--}}
{{--                      <td></td>--}}
{{--                      <td></td>--}}
{{--                      <td></td>--}}
{{--                      <td></td>--}}
{{--                      <td></td>--}}
{{--                    </tr>--}}
{{--                    --}}{{--                @foreach($datas as $key => $val)--}}
{{--                    --}}{{--                  <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">--}}
{{--                    --}}{{--                    <td class="p-1">{{ ($key+1) }}</td>--}}
{{--                    --}}{{--                    <td class="p-1 text-capitalize"><a href="{{ route('institute.trainings.details', $val->training_id) }}">{{ $val->training?->title }}</a></td>--}}
{{--                    --}}{{--                    <td class="p-1 text-capitalize">{{ $val->training?->institute?->name }}</td>--}}
{{--                    --}}{{--                    <td class="p-1">{{ $val->training?->start_date . ' to ' . $val->training?->end_date }}</td>--}}
{{--                    --}}{{--                    <td class="p-1">{{ $val->created_at->format('h:i A F d, Y') }}</td>--}}
{{--                    --}}{{--                    <td class="p-1 text-capitalize">{{ $val->status }}</td>--}}
{{--                    --}}{{--                    <td class="p-0">--}}
{{--                    --}}{{--                      @if($val->created_at == $val->updated_at && $val->status == \App\Models\TrainingMember::$statusArrays[0] )--}}
{{--                    --}}{{--                        <a href="{{ route('admin.my.training.withdraw', $val->id) }}" class="btn btn-sm btn-warning" style="cursor: pointer">Withdraw</a>--}}
{{--                    --}}{{--                      @endif--}}
{{--                    --}}{{--                    </td>--}}
{{--                    --}}{{--                  </tr>--}}
{{--                    --}}{{--                @endforeach--}}
{{--                    </tbody>--}}
{{--                  </table>--}}
{{--                </div>--}}
{{--              <div class="row" style="width: 100%;">--}}
{{--                <div class="col-sm-12" style="text-align: left; margin-bottom: 30px; padding-left: 10px;">--}}
{{--                  <p>--}}
{{--                    <a class="btn btn-success btn-md" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="width: 100%;">--}}
{{--                      <i class="mdi mdi-plus-circle-outline"></i> ADD--}}
{{--                    </a>--}}
{{--                  </p>--}}
{{--                  <div class="collapse" id="collapseExample">--}}
{{--                    <div class="card card-body">--}}
{{--                      <div class="row">--}}

{{--                        <div class="col-sm-12">--}}
{{--                          <div class="form-group">--}}
{{--                            <label class="control-label">Training Provider<span class="text-danger">*</span></label>--}}
{{--                            <select name="provider_id" class="form-control @error('provider_id') is-invalid @enderror">--}}
{{--                              <option value=""></option>--}}
{{--                            </select>--}}
{{--                          </div>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                      <div class="row">--}}
{{--                        <div class="col-sm-4">--}}
{{--                          <div class="form-group">--}}
{{--                            <label class="control-label">Training Title<span class="text-danger">*</span></label>--}}
{{--                            <input type="text" name="title" placeholder="Training Title" autocomplete="off" required--}}
{{--                                   value="{{ old('title') }}"--}}
{{--                                   class="form-control @error('title') is-invalid @enderror">--}}
{{--                            @error('title')--}}
{{--                            <strong class="text-danger">{{ $errors->first('title') }}</strong>--}}
{{--                            @enderror--}}
{{--                          </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-4">--}}
{{--                          <div class="form-group">--}}
{{--                            <label class="control-label">Start Date<span class="text-danger">*</span></label>--}}
{{--                            <input type="date" name="start_date" placeholder="Title" autocomplete="off" required--}}
{{--                                   value="{{ old('start_date') }}"--}}
{{--                                   class="form-control @error('start_date') is-invalid @enderror">--}}
{{--                            @error('start_date')--}}
{{--                            <strong class="text-danger">{{ $errors->first('start_date') }}</strong>--}}
{{--                            @enderror--}}
{{--                          </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-4">--}}
{{--                          <div class="form-group">--}}
{{--                            <label class="control-label">End Date<span class="text-danger">*</span></label>--}}
{{--                            <input type="date" name="end_date" placeholder="Title" autocomplete="off" required--}}
{{--                                   value="{{ old('end_date') }}"--}}
{{--                                   class="form-control @error('end_date') is-invalid @enderror">--}}
{{--                            @error('end_date')--}}
{{--                            <strong class="text-danger">{{ $errors->first('end_date') }}</strong>--}}
{{--                            @enderror--}}
{{--                          </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-4">--}}
{{--                          <div class="form-group">--}}
{{--                            <label class="control-label">Training Location<span class="text-danger">*</span></label>--}}
{{--                            <input type="text" name="training_location" placeholder="Training Location" autocomplete="off" required--}}
{{--                                   value="{{ old('training_location') }}"--}}
{{--                                   class="form-control @error('training_location') is-invalid @enderror">--}}
{{--                            @error('training_location')--}}
{{--                            <strong class="text-danger">{{ $errors->first('training_location') }}</strong>--}}
{{--                            @enderror--}}
{{--                          </div>--}}
{{--                        </div>--}}

{{--                        <div class="col-sm-4">--}}
{{--                          <div class="form-group">--}}
{{--                            <label class="control-label">Country<span class="text-danger">*</span></label>--}}
{{--                            <select name="country_id" class="form-control @error('country_id') is-invalid @enderror" required>--}}
{{--                              <option value="">Choose a country</option>--}}
{{--                            </select>--}}
{{--                            @error('country_id')--}}
{{--                            <strong class="text-danger">{{ $errors->first('country_id') }}</strong>--}}
{{--                            @enderror--}}
{{--                          </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-4">--}}
{{--                          <div class="form-group">--}}
{{--                            <label class="control-label">Duration<span class="text-danger">*</span></label>--}}
{{--                            <div class="row">--}}
{{--                              <div class="col-md-4">--}}
{{--                                <input type="text" name="duration_year" placeholder="Year" autocomplete="off" required--}}
{{--                                       value="{{ old('duration_year') }}"--}}
{{--                                       class="form-control @error('duration_year') is-invalid @enderror"></div>--}}
{{--                              <div class="col-md-4">--}}
{{--                                <input type="text" name="duration" placeholder="Month" autocomplete="off" required--}}
{{--                                       value="{{ old('duration_month') }}"--}}
{{--                                       class="form-control @error('duration_month') is-invalid @enderror"></div>--}}
{{--                              <div class="col-md-4">--}}
{{--                                <input type="text" name="duration" placeholder="Day" autocomplete="off" required--}}
{{--                                       value="{{ old('duration_day') }}"--}}
{{--                                       class="form-control @error('duration_day') is-invalid @enderror"></div>--}}
{{--                            </div>--}}
{{--                            @error('duration')--}}
{{--                            <strong class="text-danger">{{ $errors->first('duration') }}</strong>--}}
{{--                            @enderror--}}
{{--                          </div>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                      <div class="row">--}}
{{--                        <div class="col-sm-12 text-right">--}}
{{--                          <button class="btn btn-danger btn-sm" type="submit">Submit</button>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}

{{--              <header class="sub-panel-heading" style="background-color: #e9eff1">--}}
{{--                <h2 class="sub-panel-title">Educational Information</h2>--}}
{{--              </header>--}}
{{--              <div class="row" style="width: 100%;">--}}

{{--                <div class="col-sm-12">--}}

{{--                  <div class="row">--}}
{{--                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap"--}}
{{--                           cellspacing="0" width="100%" style="font-size: 14px; margin: 0px 0px 10px 10px;">--}}
{{--                      <thead>--}}
{{--                      <tr>--}}
{{--                        <th width="50">#</th>--}}
{{--                        <th>Degree</th>--}}
{{--                        <th>Institution</th>--}}
{{--                        <th>Department</th>--}}
{{--                        <th>Board</th>--}}
{{--                        <th>Result</th>--}}
{{--                        <th>Option</th>--}}
{{--                      </tr>--}}
{{--                      </thead>--}}
{{--                      <tbody>--}}
{{--                      <tr>--}}
{{--                        <td></td>--}}
{{--                        <td></td>--}}
{{--                        <td></td>--}}
{{--                        <td></td>--}}
{{--                        <td></td>--}}
{{--                        <td></td>--}}
{{--                      </tr>--}}
{{--                      </tbody>--}}
{{--                    </table>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-12" style="text-align: center; margin-bottom: 30px;">--}}
{{--                  <p>--}}
{{--                    <a class="btn btn-success btn-md" data-toggle="collapse" href="#education_info" role="button" aria-expanded="false" aria-controls="education_info" style="width: 100%;">--}}
{{--                      <i class="mdi mdi-plus-circle-outline"></i> ADD--}}
{{--                    </a>--}}
{{--                  </p>--}}
{{--                  <div class="collapse" id="education_info">--}}
{{--                    <div class="card card-body">--}}
{{--                      <div class="row">--}}

{{--                        <div class="col-sm-12">--}}
{{--                          <div class="form-group">--}}
{{--                            <label class="control-label">Degree<span class="text-danger">*</span></label>--}}
{{--                            <select name="degree" class="form-control @error('degree') is-invalid @enderror">--}}
{{--                              <option value="">BA (Bachelor of Arts)</option>--}}
{{--                              <option value="">BSc (Bachelor of Science)</option>--}}
{{--                              <option value="">BBS (Bachelor of Business Studies)</option>--}}
{{--                              <option value="">SSC (Secondary School Certificate)</option>--}}
{{--                              <option value="">HSC (Higher Secondary School Certificate)</option>--}}
{{--                            </select>--}}
{{--                            @error('degree')--}}
{{--                            <strong class="text-danger">{{ $errors->first('degree') }}</strong>--}}
{{--                            @enderror--}}
{{--                          </div>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                      <div class="row">--}}
{{--                        <div class="col-sm-4">--}}
{{--                          <div class="form-group">--}}
{{--                            <label class="control-label">Institution<span class="text-danger">*</span></label>--}}
{{--                            <input type="text" name="institution" placeholder="Institution" autocomplete="off" required--}}
{{--                                   value="{{ old('institution') }}"--}}
{{--                                   class="form-control @error('institution') is-invalid @enderror">--}}
{{--                            @error('institution')--}}
{{--                            <strong class="text-danger">{{ $errors->first('institution') }}</strong>--}}
{{--                            @enderror--}}
{{--                          </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-4">--}}
{{--                          <div class="form-group">--}}
{{--                            <label class="control-label">Subject/Department<span class="text-danger">*</span></label>--}}
{{--                            <input type="text" name="subject" placeholder="Subject/Department" autocomplete="off" required--}}
{{--                                   value="{{ old('subject') }}"--}}
{{--                                   class="form-control @error('subject') is-invalid @enderror">--}}
{{--                            @error('subject')--}}
{{--                            <strong class="text-danger">{{ $errors->first('subject') }}</strong>--}}
{{--                            @enderror--}}
{{--                          </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-4">--}}
{{--                          <div class="form-group">--}}
{{--                            <label class="control-label">Year<span class="text-danger">*</span></label>--}}
{{--                            <input type="date" name="year" placeholder="Year" autocomplete="off" required--}}
{{--                                   value="{{ old('year') }}"--}}
{{--                                   class="form-control @error('year') is-invalid @enderror">--}}
{{--                            @error('year')--}}
{{--                            <strong class="text-danger">{{ $errors->first('year') }}</strong>--}}
{{--                            @enderror--}}
{{--                          </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-4">--}}
{{--                          <div class="form-group">--}}
{{--                            <label class="control-label">Board<span class="text-danger">*</span></label>--}}
{{--                            <select name="board" class="form-control @error('board') is-invalid @enderror">--}}
{{--                              <option value="">Dhaka</option>--}}
{{--                              <option value="">Khulna</option>--}}
{{--                            </select>--}}
{{--                            @error('board')--}}
{{--                            <strong class="text-danger">{{ $errors->first('board') }}</strong>--}}
{{--                            @enderror--}}
{{--                          </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-4">--}}
{{--                          <div class="form-group">--}}
{{--                            <label class="control-label">Result<span class="text-danger">*</span></label>--}}
{{--                            <input type="text" name="result" placeholder="Result" autocomplete="off" required--}}
{{--                                   value="{{ old('result') }}"--}}
{{--                                   class="form-control @error('result') is-invalid @enderror">--}}
{{--                            @error('result')--}}
{{--                            <strong class="text-danger">{{ $errors->first('result') }}</strong>--}}
{{--                            @enderror--}}
{{--                          </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-4">--}}
{{--                          <div class="form-group">--}}
{{--                            <label class="control-label">GPA Scale<span class="text-danger">*</span></label>--}}
{{--                            <select name="gpa_scale" class="form-control @error('gpa_scale') is-invalid @enderror">--}}
{{--                              <option value="">GPA 5</option>--}}
{{--                              <option value="">CGPA 4</option>--}}
{{--                            </select>--}}
{{--                            @error('gpa_scale')--}}
{{--                            <strong class="text-danger">{{ $errors->first('gpa_scale') }}</strong>--}}
{{--                            @enderror--}}
{{--                          </div>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                      <div class="row">--}}
{{--                        <div class="col-sm-12 text-right">--}}
{{--                          <button class="btn btn-danger btn-sm" type="submit">Submit</button>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <header class="sub-panel-heading" style="background-color: #e9eff1">--}}
{{--                <h2 class="sub-panel-title">Professional Experience</h2>--}}
{{--              </header>--}}
{{--              <div class="row" style="width: 100%;">--}}

{{--                <div class="col-sm-12">--}}

{{--                  <div class="row">--}}
{{--                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap"--}}
{{--                           cellspacing="0" width="100%" style="font-size: 14px; margin: 0px 0px 10px 10px;">--}}
{{--                      <thead>--}}
{{--                      <tr>--}}
{{--                        <th width="50">#</th>--}}
{{--                        <th>Organization</th>--}}
{{--                        <th>Institution</th>--}}
{{--                        <th>Department</th>--}}
{{--                        <th>Board</th>--}}
{{--                        <th>Result</th>--}}
{{--                        <th>Option</th>--}}
{{--                      </tr>--}}
{{--                      </thead>--}}
{{--                      <tbody>--}}
{{--                      <tr>--}}
{{--                        <td></td>--}}
{{--                        <td></td>--}}
{{--                        <td></td>--}}
{{--                        <td></td>--}}
{{--                        <td></td>--}}
{{--                        <td></td>--}}
{{--                      </tr>--}}
{{--                      </tbody>--}}
{{--                    </table>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-12" style="text-align: center; margin-bottom: 30px;">--}}
{{--                  <p>--}}
{{--                    <a class="btn btn-success btn-md" data-toggle="collapse" href="#experience_info" role="button" aria-expanded="false" aria-controls="experience_info" style="width: 100%;">--}}
{{--                      <i class="mdi mdi-plus-circle-outline"></i> ADD--}}
{{--                    </a>--}}
{{--                  </p>--}}
{{--                  <div class="collapse" id="experience_info">--}}
{{--                    <div class="card card-body">--}}
{{--                      <div class="row">--}}

{{--                        <div class="col-sm-12">--}}
{{--                          <div class="form-group">--}}
{{--                            <label class="control-label">Organization Name<span class="text-danger">*</span></label>--}}
{{--                            <input type="text" name="employer" placeholder="Organization Name" autocomplete="off" required--}}
{{--                                   value="{{ old('employer') }}"--}}
{{--                                   class="form-control @error('employer') is-invalid @enderror">--}}
{{--                            @error('employer')--}}
{{--                            <strong class="text-danger">{{ $errors->first('employer') }}</strong>--}}
{{--                            @enderror--}}
{{--                          </div>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                      <div class="row">--}}
{{--                        <div class="col-sm-4">--}}
{{--                          <div class="form-group">--}}
{{--                            <label class="control-label">Designation<span class="text-danger">*</span></label>--}}
{{--                            <input type="text" name="designation" placeholder="Designation" autocomplete="off" required--}}
{{--                                   value="{{ old('designation') }}"--}}
{{--                                   class="form-control @error('designation') is-invalid @enderror">--}}
{{--                            @error('designation')--}}
{{--                            <strong class="text-danger">{{ $errors->first('designation') }}</strong>--}}
{{--                            @enderror--}}
{{--                          </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-4">--}}
{{--                          <div class="form-group">--}}
{{--                            <label class="control-label">Start Date<span class="text-danger">*</span></label>--}}
{{--                            <input type="date" name="job_start_date" placeholder="Start Date" autocomplete="off" required--}}
{{--                                   value="{{ old('job_start_date') }}"--}}
{{--                                   class="form-control @error('job_start_date') is-invalid @enderror">--}}
{{--                            @error('job_start_date')--}}
{{--                            <strong class="text-danger">{{ $errors->first('job_start_date') }}</strong>--}}
{{--                            @enderror--}}
{{--                          </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-4">--}}
{{--                          <div class="form-group">--}}
{{--                            <label class="control-label">End Date<span class="text-danger">*</span></label>--}}
{{--                            <input type="date" name="job_end_date" placeholder="End Date" autocomplete="off" required--}}
{{--                                   value="{{ old('job_end_date') }}"--}}
{{--                                   class="form-control @error('job_end_date') is-invalid @enderror">--}}
{{--                            @error('job_end_date')--}}
{{--                            <strong class="text-danger">{{ $errors->first('job_end_date') }}</strong>--}}
{{--                            @enderror--}}
{{--                          </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-4">--}}
{{--                          <div class="form-group">--}}
{{--                            <label class="control-label">Job Location<span class="text-danger">*</span></label>--}}
{{--                            <input type="date" name="job_location" placeholder="Job Location" autocomplete="off" required--}}
{{--                                   value="{{ old('job_location') }}"--}}
{{--                                   class="form-control @error('job_location') is-invalid @enderror">--}}
{{--                            @error('job_location')--}}
{{--                            <strong class="text-danger">{{ $errors->first('job_location') }}</strong>--}}
{{--                            @enderror--}}
{{--                          </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-4">--}}
{{--                          <div class="form-group">--}}
{{--                            <label class="control-label">Duration<span class="text-danger">*</span></label>--}}
{{--                            <div class="row">--}}
{{--                              <div class="col-md-4">--}}
{{--                                <input type="text" name="duration_year" placeholder="Year" autocomplete="off" required--}}
{{--                                       value="{{ old('duration_year') }}"--}}
{{--                                       class="form-control @error('duration_year') is-invalid @enderror"></div>--}}
{{--                              <div class="col-md-4">--}}
{{--                                <input type="text" name="duration" placeholder="Month" autocomplete="off" required--}}
{{--                                       value="{{ old('duration_month') }}"--}}
{{--                                       class="form-control @error('duration_month') is-invalid @enderror"></div>--}}
{{--                              <div class="col-md-4">--}}
{{--                                <input type="text" name="duration" placeholder="Day" autocomplete="off" required--}}
{{--                                       value="{{ old('duration_day') }}"--}}
{{--                                       class="form-control @error('duration_day') is-invalid @enderror"></div>--}}
{{--                            </div>--}}
{{--                            @error('duration')--}}
{{--                            <strong class="text-danger">{{ $errors->first('duration') }}</strong>--}}
{{--                            @enderror--}}
{{--                          </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-12">--}}
{{--                          <div class="form-group">--}}
{{--                            <label class="control-label">Job Responsibility</label>--}}
{{--                            <textarea type="text" id="job_responsibility" name="job_responsibility" autocomplete="off"--}}
{{--                                      value="{{ old('job_responsibility') }}"--}}
{{--                                      class="form-control @error('job_responsibility') is-invalid @enderror"></textarea>--}}
{{--                            @error('job_responsibility')--}}
{{--                            <strong class="text-danger">{{ $errors->first('job_responsibility') }}</strong>--}}
{{--                            @enderror--}}
{{--                          </div>--}}
{{--                        </div>--}}

{{--                      </div>--}}
{{--                      <div class="row">--}}
{{--                        <div class="col-sm-12 text-right">--}}
{{--                          <button class="btn btn-danger btn-sm" type="submit">Submit</button>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
              {{--                <header class="sub-panel-heading" style="background-color: #e9eff1">--}}
              {{--                  <h2 class="sub-panel-title">References</h2>--}}
              {{--                </header>--}}
              {{--                <div class="row" style="width: 100%;">--}}
              {{--                  <div class="col-sm-6">--}}
              {{--                    <div class="form-group">--}}
              {{--                      <label class="control-label">Name</label>--}}
              {{--                      <input type="text" name="Name" placeholder="" autocomplete="off" required--}}
              {{--                             value="{{ old('Name') }}"--}}
              {{--                             class="form-control @error('Name') is-invalid @enderror">--}}
              {{--                      @error('Name')--}}
              {{--                      <strong class="text-danger">{{ $errors->first('Name') }}</strong>--}}
              {{--                      @enderror--}}
              {{--                    </div>--}}
              {{--                  </div>--}}
              {{--                  <div class="col-sm-6">--}}
              {{--                    <div class="form-group">--}}
              {{--                      <label class="control-label">Designation</label>--}}
              {{--                      <input type="text" name="designation" placeholder="Designation" autocomplete="off" required--}}
              {{--                             value="{{ old('designation') }}"--}}
              {{--                             class="form-control @error('designation') is-invalid @enderror">--}}
              {{--                      @error('designation')--}}
              {{--                      <strong class="text-danger">{{ $errors->first('designation') }}</strong>--}}
              {{--                      @enderror--}}
              {{--                    </div>--}}
              {{--                  </div>--}}
              {{--                  <div class="col-sm-6">--}}
              {{--                    <div class="form-group">--}}
              {{--                      <label class="control-label">Contact Email</label>--}}
              {{--                      <input type="text" name="contact_email" placeholder="Contact Email" autocomplete="off" required--}}
              {{--                             value="{{ old('contact_email') }}"--}}
              {{--                             class="form-control @error('contact_email') is-invalid @enderror">--}}
              {{--                      @error('contact_email')--}}
              {{--                      <strong class="text-danger">{{ $errors->first('contact_email') }}</strong>--}}
              {{--                      @enderror--}}
              {{--                    </div>--}}
              {{--                  </div>--}}
              {{--                  <div class="col-sm-6">--}}
              {{--                    <div class="form-group">--}}
              {{--                      <label class="control-label">Mobile no</label>--}}
              {{--                      <input type="text" name="mobile_no" placeholder="Mobile No" autocomplete="off" required--}}
              {{--                             value="{{ old('mobile_no') }}"--}}
              {{--                             class="form-control @error('mobile_no') is-invalid @enderror">--}}
              {{--                      @error('mobile_no')--}}
              {{--                      <strong class="text-danger">{{ $errors->first('mobile_no') }}</strong>--}}
              {{--                      @enderror--}}
              {{--                    </div>--}}
              {{--                  </div>--}}
              {{--                </div>--}}
{{--              <header class="sub-panel-heading" style="background-color: #e9eff1">--}}
{{--                <h2 class="sub-panel-title">NFTVQF Informations</h2>--}}
{{--              </header>--}}
{{--              <div class="row" style="width: 100%;">--}}

{{--                <div class="col-sm-6">--}}
{{--                  <div class="form-group">--}}
{{--                    <label class="control-label">Title</label>--}}
{{--                    <input type="text" name="title" placeholder="Title" autocomplete="off" required--}}
{{--                           value="{{ old('title') }}"--}}
{{--                           class="form-control @error('title') is-invalid @enderror">--}}
{{--                    @error('title')--}}
{{--                    <strong class="text-danger">{{ $errors->first('title') }}</strong>--}}
{{--                    @enderror--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-6">--}}
{{--                  <div class="form-group">--}}
{{--                    <label class="control-label">Level</label>--}}
{{--                    <select name="ntvqf_level" class="select2 form-control @error('ntvqf_level') is-invalid @enderror" style="width: 10px !important;">--}}
{{--                      <option value="">Choose an option</option>--}}
{{--                      <option value="">Level 1</option>--}}
{{--                      <option value="">Level 2</option>--}}
{{--                      <option value="">Level 3</option>--}}
{{--                      <option value="">Level 4</option>--}}
{{--                      <option value="">Level 5</option>--}}
{{--                      <option value="">Level 4</option>--}}
{{--                      <option value="">Level 7</option>--}}
{{--                      <option value="">Level 8</option>--}}
{{--                      <option value="">Level 9</option>--}}
{{--                      <option value="">Level 10</option>--}}
{{--                    </select>--}}
{{--                    @error('ntvqf_level')--}}
{{--                    <strong class="text-danger">{{ $errors->first('ntvqf_level') }}</strong>--}}
{{--                    @enderror--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-6">--}}
{{--                  <div class="form-group">--}}
{{--                    <label class="control-label">Certified By</label>--}}
{{--                    <select name="ntvqf_level" class="select2 form-control @error('ntvqf_level') is-invalid @enderror" style="width: 10px !important;">--}}
{{--                      <option value="">Choose an option</option>--}}
{{--                      <option value="">BTEB</option>--}}
{{--                      <option value="">NSDA</option>--}}
{{--                    </select>--}}
{{--                    @error('ntvqf_level')--}}
{{--                    <strong class="text-danger">{{ $errors->first('ntvqf_level') }}</strong>--}}
{{--                    @enderror--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-6">--}}
{{--                  <div class="form-group">--}}
{{--                    <label class="control-label">Date</label>--}}
{{--                    <input type="date" name="date" placeholder="Date" autocomplete="off" required--}}
{{--                           value="{{ old('date') }}"--}}
{{--                           class="form-control @error('date') is-invalid @enderror">--}}
{{--                    @error('date')--}}
{{--                    <strong class="text-danger">{{ $errors->first('date') }}</strong>--}}
{{--                    @enderror--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <header class="sub-panel-heading" style="background-color: #e9eff1">--}}
{{--                <h2 class="sub-panel-title">Other Informations</h2>--}}
{{--              </header>--}}
{{--              <div class="row" style="width: 100%;">--}}

{{--                <div class="col-sm-6">--}}
{{--                  <div class="form-group">--}}
{{--                    <div class="well well-sm text-center">--}}
{{--                      <div class="row">--}}
{{--                        <label class="control-label">Freedom Fighter</label>--}}
{{--                      </div>--}}
{{--                      <div class="btn-group" data-toggle="buttons">--}}

{{--                        <label class="btn btn-success active">--}}
{{--                          <input type="radio" name="freedom_fighter" id="freedom_fighter" value="yes" autocomplete="off" chacked>--}}
{{--                          <span class="glyphicon glyphicon-ok">Yes</span>--}}
{{--                        </label>--}}
{{--                        <label class="btn btn-danger">--}}
{{--                          <input type="radio" name="freedom_fighter" id="freedom_fighter" value="yes" autocomplete="off">--}}
{{--                          <span class="glyphicon glyphicon-ok">No</span>--}}
{{--                        </label>--}}
{{--                      </div>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-6">--}}
{{--                  <div class="form-group">--}}
{{--                    <div class="well well-sm text-center">--}}
{{--                      <div class="row">--}}
{{--                        <label class="control-label">Special able People</label>--}}
{{--                      </div>--}}
{{--                      <div class="btn-group" data-toggle="buttons">--}}

{{--                        <label class="btn btn-success active">--}}
{{--                          <input type="radio" name="freedom_fighter" id="freedom_fighter" value="yes" autocomplete="off" chacked>--}}
{{--                          <span class="glyphicon glyphicon-ok">Yes</span>--}}
{{--                        </label>--}}
{{--                        <label class="btn btn-danger">--}}
{{--                          <input type="radio" name="freedom_fighter" id="freedom_fighter" value="yes" autocomplete="off">--}}
{{--                          <span class="glyphicon glyphicon-ok">No</span>--}}
{{--                        </label>--}}
{{--                      </div>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <div class="row">--}}
{{--                <div class="col-sm-12 text-right">--}}
{{--                  <button class="btn btn-danger btn-sm" type="submit">Submit</button>--}}
{{--                </div>--}}
{{--              </div>--}}
              {{--              </form>--}}
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
      $(document).ready(function() {
        $('#job_responsibility').summernote({
          'height': 100,
        });
        $('#additional_requirements').summernote({
          'height': 100,
        });
        $('#job_context').summernote({
          'height': 100,
        });
        $('#educational_requirement').summernote({
          'height': 100,
        });
      });
    });
  </script>
@endsection
