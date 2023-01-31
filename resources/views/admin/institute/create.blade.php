@extends('layout.admin')

@section('stylesheet')
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
  <div class="row">
    <div class="float-right">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div><br/>
      @endif
    </div>
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Create institute</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List Of Institute', 'Super Admin'))
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.institute.list') }}" class="brn btn-success btn-sm">List of institutes</a>
                  </div>
                </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.institute.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <h4 class="panel-sub-title">User Form</h4>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Choose User<span class="text-danger"></span></label>
                      <select name="created_user" class="form-control @error('created_user') is-invalid @enderror">
                        <option value="">Choose a user</option>
                        @foreach($users as $created_user)
                          <option value="{{ $created_user->id }}"
                                  @if(old('created_user->id') == $created_user->id) selected @endif>{{ ucfirst($created_user->name) }}</option>

                        @endforeach
                      </select>
                      @error('created_user')
                      <strong class="text-danger">{{ $errors->first('created_user') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>

                <div id="read">
                  <div class="row" id="reed">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Full name [Eng]<span class="text-danger">*</span></label>
                        <input type="text" id="name_en" name="name_en" placeholder="Full name in english" required value="{{ old('name_en') }}"
                               class="form-control @error('name_en') is-invalid @enderror">
                        @error('name_en')
                        <strong class="text-danger">{{ $errors->first('name_en') }}</strong>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Full name [Ban]<span class="text-danger">*</span></label>
                        <input type="text" id="name_bn" name="name_bn" placeholder="Full name in Bangla" value="{{ old('name_bn') }}"
                               class="form-control @error('name_bn') is-invalid @enderror">
                        @error('name_bn')
                        <strong class="text-danger">{{ $errors->first('name_bn') }}</strong>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Username<span class="text-danger">*</span></label>
                        <input type="text" id="username" name="username" placeholder="Username" required value="{{ old('username') }}"
                               class="form-control @error('username') is-invalid @enderror">
                        @error('username')
                        <strong class="text-danger">{{ $errors->first('username') }}</strong>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Email <span class="text-danger">*</span></label>
                        <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror" required>
                        @error('email')
                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Phone No <span class="text-danger">*</span></label>
                        <input type="number" id="phone" name="phone" placeholder="Phone No" value="{{ old('phone') }}"
                               class="form-control @error('phone') is-invalid @enderror" required>
                        @error('phone')
                        <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Password<span class="text-danger">*</span></label>
                        <input type="password" id="password" name="password" placeholder="Password"
                               value="{{ old('password') }}"
                               class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                        <strong class="text-danger">{{ $errors->first('password') }}</strong>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="user_image" class="control-label">Photo</label>
                        <input type="file" name="user_image"
                               class="form-control @error('user_image') is-invalid @enderror">
                        @error('user_image')
                        <strong class="text-danger">{{ $errors->first('user_image') }}</strong>
                        @enderror
                      </div>
                    </div>

                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Status<span class="text-danger">*</span></label>
                      <select name="status" required class="form-control @error('status') is-invalid @enderror">
                        <option value="">Choose a status</option>
                        @foreach(\App\Models\User::$statusArrays as $status)
                          <option value="{{ $status }}"
                                  @if(old('status') == $status) selected @endif>{{ ucfirst($status) }}</option>
                        @endforeach
                      </select>
                      @error('status')
                      <strong class="text-danger">{{ $errors->first('status') }}</strong>
                      @enderror

                    </div>
                  </div>
                </div>
                <h4 class="panel-sub-title mt-10">Institute Registration Form</h4>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="code" class="control-label">Code<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="code" placeholder="Institute Name" autocomplete="off" required
                             value="{{ old('code') }}"
                             class="form-control @error('code') is-invalid @enderror">
                      @error('code')
                      <strong class="text-danger">{{ $errors->first('code') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Institute Name<span class="text-danger">*</span></label>
                      <input type="text" name="institute_name" placeholder="Institute Name" autocomplete="off" required
                             value="{{ old('institute_name') }}"
                             class="form-control @error('institute_name') is-invalid @enderror">
                      @error('institute_name')
                      <strong class="text-danger">{{ $errors->first('institute_name') }}</strong>
                      @enderror
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="institute_name_bn" class="control-label">Full name [Ban]<span class="text-blue">(Optional)</span></label>
                      <input type="text" id="institute_name_bn" name="institute_name_bn" placeholder="Full name in Bangla" value="{{ old('institute_name_bn') }}"
                             class="form-control @error('institute_name_bn') is-invalid @enderror">
                      @error('institute_name_bn')
                      <strong class="text-danger">{{ $errors->first('institute_name_bn') }}</strong>
                      @enderror
                    </div>

                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Institute Phone</label>
                      <input type="number" min="0" name="institute_phone" placeholder="Institute Phone" autocomplete="off"
                             value="{{ old('institute_phone') }}"
                             class="form-control @error('institute_phone') is-invalid @enderror">
                      @error('institute_phone')
                      <strong class="text-danger">{{ $errors->first('institute_phone') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Institute Email</label>
                      <input type="email" name="institute_email" placeholder="Institute Email" autocomplete="off"
                             value="{{ old('institute_email') }}"
                             class="form-control @error('institute_email') is-invalid @enderror">
                      @error('institute_email')
                      <strong class="text-danger">{{ $errors->first('institute_email') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Division<span class="text-danger">*</span></label>
                      <select name="division_id" class="form-control @error('division_id') is-invalid @enderror" required>
                        <option value="">Choose a Division</option>
                        @foreach($divisions as $division)
                          <option value="{{ $division->id }}" @selected($division->id == old('division_id'))>{{ $division->name }}</option>
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
                        <option value="">Choose a District</option>
                        @foreach($districts as $district)
                          <option value="{{ $district->id }}" @selected($district->id == old('district_id'))>{{ $district->name }}</option>
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
                        <option value="">Choose a Upazila</option>
                        @foreach($upazilas as $upazila)
                          <option value="{{ $upazila->id }}" @selected($upazila->id == old('upazila_id'))>{{ $upazila->name }}</option>
                        @endforeach
                      </select>
                      @error('upazila_id')
                      <strong class="text-danger">{{ $errors->first('upazila_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Photo</label>
                      <input type="file" name="photo"
                             class="form-control @error('photo') is-invalid @enderror">
                      @error('photo')
                      <strong class="text-danger">{{ $errors->first('photo') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label name="address" class="control-label">Address</label>
                      <textarea name="address" placeholder="Enter address" autocomplete="off"
                                class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                      @error('address')
                      <strong class="text-danger">{{ $errors->first('address') }}</strong>
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
                                  @if(old('institute_status') == $institute_status) selected @endif>{{ ucfirst($institute_status) }}</option>
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
                      <select name="type" required class="form-control @error('type') is-invalid @enderror">
                        <option value="">Choose a institute type</option>
                        @foreach($types as $type)
                          <option value="{{ $type->name }}"
                                  @if(old('type') == $type->name) selected @endif>{{ ucfirst($type->name) }}</option>
                        @endforeach
                      </select>
                      @error('type')
                      <strong class="text-danger">{{ $errors->first('type') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="description" class="control-label">Description (Optional)</label>
                      <textarea name="description" placeholder="Name" autocomplete="off" id="summernote"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
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
    const signatureField1 = document.getElementById("name_en");
    const signatureField2 = document.getElementById("name_bn");
    const signatureField3 = document.getElementById("phone");
    const signatureField4 = document.getElementById("email");
    const signatureField5 = document.getElementById("username");
    const signatureField6 = document.getElementById("password");

    function lock_signature_field() {
      signatureField1.setAttribute('readonly', true);
      signatureField2.setAttribute('readonly', true);
      signatureField3.setAttribute('readonly', true);
      signatureField4.setAttribute('readonly', true);
      signatureField5.setAttribute('readonly', true);
      signatureField6.setAttribute('readonly', true);
      // console.log('Element was locked.'); // you can remove this debug-line if you want.
    }

    function unlock_signature_field() {
      signatureField1.removeAttribute("readonly");
      signatureField2.removeAttribute("readonly");
      signatureField3.removeAttribute("readonly");
      signatureField4.removeAttribute("readonly");
      signatureField5.removeAttribute("readonly");
      signatureField6.removeAttribute("readonly");
      // console.log('Element was locked.'); // you can remove this debug-line if you want.
    }


    $(document).ready(function () {
      $('#summernote').summernote({
        placeholder: 'Write here ...',
        tabSize: 2,
        height: 100
      });
      $(document).on('change', 'select[name="created_user"]', function (e) {
        var id = $(this).val();
        var status = 'active';
        $.ajax({
          url: "{{ route('admin.ajax.institute.create') }}",
          method: "GET",
          dataType: "html",
          data: {'id': id, 'status': status},
          // location.reload(),
          success: function (data) {
            console.log(data)
            if (data) {
              data = (JSON.parse(data));
              $("input[name=name_en]").val(data?.name_en)
              $('#name_bn').val(data?.name_bn)
              $('#username').val(data?.username)
              $('#email').val(data?.email)
              $('#phone').val(data?.phone)
              lock_signature_field();
            } else {
              $('#name_en').val('');
              $('#name_bn').val('');
              $('#username').val('');
              $('#email').val('');
              $('#phone').val('');
              unlock_signature_field();
            }
          }
        });


      })

    })


  </script>
@endsection
