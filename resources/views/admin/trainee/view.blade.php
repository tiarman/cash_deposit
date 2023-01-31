@extends('layout.admin')

@section('stylesheet')
@endsection


@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Besic Info</h2>
            </header>
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              <form action="{{ route('admin.trainee.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Username</label>
                      <input type="text" name="username" placeholder="Username" value="{{ $user->username ?? '' }}"
                             class="form-control @error('username') is-invalid @enderror" disabled>
                      @error('username')
                      <strong class="text-danger">{{ $errors->first('username') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Email <span class="text-danger">*</span></label>
                      <input type="email" name="email" placeholder="Email" value="{{ $user->email ?? '' }}"
                             class="form-control @error('email') is-invalid @enderror" disabled required>
                      @error('email')
                      <strong class="text-danger">{{ $errors->first('email') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Phone No <span class="text-danger">*</span></label>
                      <input type="number" name="phone" placeholder="Phone No" value="{{ $user->phone ?? '' }}"
                             class="form-control @error('phone') is-invalid @enderror" disabled required>
                      @error('phone')
                      <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Name(English) <span class="text-danger">*</span></label>
                      <input type="text" name="name_en" placeholder="Name(English)" required value="{{ $user->name_en ?? '' }}"
                             class="form-control @error('name_en') is-invalid @enderror">
                      @error('name_en')
                      <strong class="text-danger">{{ $errors->first('name_en') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Name(Bangla) </label>
                      <input type="text" name="name_bn" placeholder="Name(Bangla)" value="{{ $user->name_bn ?? '' }}"
                             class="form-control @error('name_bn') is-invalid @enderror">
                      @error('name_bn')
                      <strong class="text-danger">{{ $errors->first('name_bn') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Father Name </label>
                      <input type="text" name="father_name" placeholder="Father Name" value="{{ $user->father_name ?? '' }}"
                             class="form-control @error('father_name') is-invalid @enderror">
                      @error('father_name')
                      <strong class="text-danger">{{ $errors->first('father_name') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Mother Name</label>
                      <input type="text" name="mother_name" placeholder="Mother Name" value="{{ $user->mother_name ?? '' }}"
                             class="form-control @error('mother_name') is-invalid @enderror">
                      @error('mother_name')
                      <strong class="text-danger">{{ $errors->first('mother_name') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">NID</label>
                      <input type="text" name="nid" placeholder="NID" value="{{ $user->nid ?? '' }}"
                             class="form-control @error('nid') is-invalid @enderror">
                      @error('nid')
                      <strong class="text-danger">{{ $errors->first('nid') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Date of birth</label>
                      <input type="date" name="dob" placeholder="Date of birth" value="{{ $user->dob ?? '' }}"
                             class="form-control @error('dob') is-invalid @enderror">
                      @error('dob')
                      <strong class="text-danger">{{ $errors->first('dob') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>
                <h4 class="panel-title">Address</h4>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Village</label>
                      <input type="text" name="village" placeholder="Village" value="{{ $user->village ?? '' }}"
                             class="form-control @error('village') is-invalid @enderror">
                      @error('village')
                      <strong class="text-danger">{{ $errors->first('village') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">P.O.</label>
                      <input type="text" name="po" placeholder="P.O" value="{{ $user->po ?? '' }}"
                             class="form-control @error('po') is-invalid @enderror">
                      @error('po')
                      <strong class="text-danger">{{ $errors->first('po') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">P.S.</label>
                      <input type="text" name="ps" placeholder="P.S" value="{{ $user->ps ?? '' }}"
                             class="form-control @error('ps') is-invalid @enderror">
                      @error('ps')
                      <strong class="text-danger">{{ $errors->first('ps') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Division</label>
                      <select name="division_id" class="form-control @error('division_id') is-invalid @enderror">
                        <option value="">Choose a district</option>
                        @foreach($divisions as $division)
                          <option value="{{ $division->id }}"
                                  @selected($division->id == old('division->id', $division->id))>{{ $division->name }}</option>
                        @endforeach
                      </select>
                      @error('division')
                      <strong class="text-danger">{{ $errors->first('division') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">District</label>
                      <select name="district_id" class="form-control @error('district_id') is-invalid @enderror">
                        <option value="">Choose a district</option>
{{--                        @foreach($divisions as $val)--}}
                          @foreach($districts as $district)
                            <option value="{{ $district->id }}"
                              @selected($district->id == old('district->id', $district->id))>{{ $district->name }}</option>
                          @endforeach
{{--                        @endforeach--}}
                      </select>
                      @error('district')
                      <strong class="text-danger">{{ $errors->first('district') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-sm-12 text-right">
                    <button class="btn btn-danger btn-sm" type="submit">Submit</button>
                  </div>
                </div>
              </form>
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