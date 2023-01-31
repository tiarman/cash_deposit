@extends('layout.admin')

@section('stylesheet')
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Manage institute</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List Of Institute', 'Super Admin'))
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.institute.list') }}" class="brn btn-success btn-sm">List of Institutes</a>
                  </div>
                </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.institute.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="dt form-control" name="id" value="{{ $institute->id }}">


                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Change Institute Head<span class="text-danger"></span></label>
                      <select name="created_user" class="form-control @error('created_user') is-invalid @enderror">
                        <option value="{{ $institute->instituteHead?->id }}">{{ $institute->instituteHead?->name_en }}</option>
                        @foreach($users as $created_user)
                          <option value="{{ $created_user->id }}"
                                  @if(old('created_user->id') == $created_user->id) selected @endif>{{ ucfirst($created_user->name) }}</option>
                        @endforeach
                      </select>
                      @error('created_user')
                      {{--                              <strong class="text-danger">{{ $errors->first('created_user') }}</strong>--}}
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Current Institute Head<span class="text-danger">*</span></label>
                      <input type="text" readonly name="head" autocomplete="off" required
                             value="{{ $institute->instituteHead?->name_en }}"
                             class="form-control @error('institute_name') is-invalid @enderror">
                      @error('institute_name')
                      <strong class="text-danger">{{ $errors->first('institute_name') }}</strong>
                      @enderror
                    </div>
                  </div>

                </div>


                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="code" class="control-label">Code<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="code" placeholder="Institute Name" autocomplete="off" required
                             value="{{ old('code',$institute->code) }}"
                             class="form-control @error('code') is-invalid @enderror">
                      @error('code')
                      <strong class="text-danger">{{ $errors->first('code') }}</strong>
                      @enderror
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="institute_name" class="control-label">Institute Name<span class="text-danger">*</span></label>
                      <input type="text" name="institute_name" placeholder="Name" autocomplete="off" required
                             value="{{ old('institute_name', $institute->name) }}"
                             class="form-control @error('institute_name') is-invalid @enderror">
                      @error('institute_name')
                      <strong class="text-danger">{{ $errors->first('institute_name') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="institute_name_bn" class="control-label">Institute Name [Ban]<span class="text-blue">(Optional)</span></label>
                      <input type="text" name="institute_name_bn" placeholder="Name in Bangla" autocomplete="off" required
                             value="{{ old('institute_name_bn', $institute->name_bn) }}"
                             class="form-control @error('institute_name_bn') is-invalid @enderror">
                      @error('institute_name_bn')
                      <strong class="text-danger">{{ $errors->first('institute_name_bn') }}</strong>
                      @enderror
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Institute Phone<span class="text-danger">*</span></label>
                      <input type="number" name="institute_phone" placeholder="institute_phone" autocomplete="off" required
                             value="{{ old('institute_phone', $institute->phone) }}"
                             class="form-control @error('institute_phone') is-invalid @enderror">
                      @error('institute_phone')
                      <strong class="text-danger">{{ $errors->first('institute_phone') }}</strong>
                      @enderror
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="photo" value="{{ old('photo', $institute->photo) }}" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Institute Email<span class="text-danger">*</span></label>
                      <input type="email" name="institute_email" placeholder="Name" autocomplete="off" required
                             value="{{ old('institute_email', $institute->email) }}"
                             class="form-control @error('institute_email') is-invalid @enderror">
                      @error('institute_email')
                      <strong class="text-danger">{{ $errors->first('institute_email') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Address<span class="text-danger">*</span></label>
                      <textarea name="address" autocomplete="off" required
                                class="form-control @error('address') is-invalid @enderror">{{ old('name', $institute->address) }}</textarea>
                      @error('address')
                      <strong class="text-danger">{{ $errors->first('address') }}</strong>
                      @enderror
                    </div>
                  </div>


                  {{--                    division--}}

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Division<span class="text-danger">*</span></label>
                      <select name="division_id" class="form-control @error('division_id') is-invalid @enderror">
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
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">District<span class="text-danger">*</span></label>
                      <select name="district_id" class="form-control @error('district_id') is-invalid @enderror" required>
                        <option value="">Choose a district</option>
                        @foreach($districts as $district)
                          <option value="{{ $district->id }}" @selected($district->id == old('district_id', $institute->district_id))>{{ $district->name }}</option>
                        @endforeach
                      </select>
                      @error('district_id')
                      <strong class="text-danger">{{ $errors->first('district_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
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
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Institute Status<span class="text-danger">*</span></label>
                      <select name="institute_status" required class="form-control @error('institute_status') is-invalid @enderror">
                        <option value="">Choose a institute Status</option>
                        @foreach(\App\Models\Institute::$statusArrays as $institute_status)
                          <option value="{{ $institute_status }}"
                                  @if(old('institute_status',$institute->status) == $institute_status) selected @endif>{{ ucfirst($institute_status) }}</option>
                        @endforeach
                      </select>
                      @error('institute_status')
                      <strong class="text-danger">{{ $errors->first('institute_status') }}</strong>
                      @enderror
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Institute Type<span class="text-danger">*</span></label>
                      <select name="institute_type_id" required class="form-control @error('institute_type_id') is-invalid @enderror">
                        <option value="">Choose a institute type</option>
                        @foreach($types as $type)
                          <option value="{{ $type->id }}"
                                  @if(old('institute_type_id',$institute->institute_type_id) == $type->id) selected @endif>{{ ucfirst($type->name) }}</option>
                        @endforeach
                      </select>
                      @error('institute_type_id')
                      <strong class="text-danger">{{ $errors->first('institute_type_id') }}</strong>
                      @enderror
                    </div>
                  </div>


                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Photo <label class="text-danger">*</label></label>
                      <input type="file" name="photo" placeholder="Institute photo" value="{{ old('photo', $institute->photo) }}"
                             class="form-control @error('photo') is-invalid @enderror">
                      @error('photo')
                      <strong class="text-danger">{{ $errors->first('photo',$institute->photo ) }}</strong>
                      @enderror
                    </div>
                    <div>
                      <img style="width: 100px" src="{{asset(old('photo', $institute->photo))}}" alt="">
                      <input type="hidden" name="old_photo" value="{{(old('photo', $institute->photo))}}" alt="">

                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="description" class="control-label">Description (Optional)</label>
                      <textarea name="description" placeholder="Name" autocomplete="off" id="summernote"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description',$institute->description) }}</textarea>
                      @error('description')
                      <strong class="text-danger">{{ $errors->first('description') }}</strong>
                      @enderror
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
  <script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.js') }}"></script>
  <script>
    $(document).ready(function () {
      $('#summernote').summernote({
        placeholder: 'Write here ...',
        tabSize: 2,
        height: 100
      });
    });
    $('select[name="division_id"]').change(function () {
      const $this = $('select[name="district_id"]')
      var idDivision = this.value;
      $this.html('');
      $.ajax({
        url: "{{url('api/fetch-districts')}}/" + idDivision,
        type: "GET",
        dataType: 'json',
        success: function (result) {
          $this.html('<option value="">-- Select District --</option>');
          $.each(result.districts, function (key, value) {
            $this.append('<option value="' + value
              .id + '">' + value.name + '</option>');
          });

        }
      });
    });


  </script>
@endsection
