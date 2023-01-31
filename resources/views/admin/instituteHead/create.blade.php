@extends('layout.admin')

@section('stylesheet')
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
              <h2 class="panel-title">Create Member</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List Of Institute', 'Super Admin'))
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.institute.head.list') }}" class="brn btn-success btn-sm">List of institute Members</a>
                  </div>
                </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.institute.head.store') }}" method="post">
                @csrf
{{--                <h4 class="panel-sub-title">New Member Creation Form</h4>--}}
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Full name [Eng]<span class="text-danger">*</span></label>
                      <input type="text" name="name_en" placeholder="Full name in english" required value="{{ old('name_en') }}"
                             class="form-control @error('name_en') is-invalid @enderror">
                      @error('name_en')
                      <strong class="text-danger">{{ $errors->first('name_en') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Full name [Ban]<span class="text-danger">*</span></label>
                      <input type="text" name="name_bn" placeholder="Full name in Bangla" required value="{{ old('name_bn') }}"
                             class="form-control @error('name_bn') is-invalid @enderror">
                      @error('name_bn')
                      <strong class="text-danger">{{ $errors->first('name_bn') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Username<span class="text-danger">*</span></label>
                      <input type="text" name="username" placeholder="Username" required value="{{ old('username') }}"
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
                      <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                             class="form-control @error('email') is-invalid @enderror" required>
                      @error('email')
                      <strong class="text-danger">{{ $errors->first('email') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Phone No <span class="text-danger">*</span></label>
                      <input type="number" name="phone" placeholder="Phone No" value="{{ old('phone') }}"
                             class="form-control @error('phone') is-invalid @enderror" required>
                      @error('phone')
                      <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Password<span class="text-danger">*</span></label>
                      <input type="password" name="password" placeholder="Password" required
                             value="{{ old('password') }}"
                             class="form-control @error('password') is-invalid @enderror">
                      @error('password')
                      <strong class="text-danger">{{ $errors->first('password') }}</strong>
                      @enderror
                    </div>
                  </div>
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
  <script>
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
