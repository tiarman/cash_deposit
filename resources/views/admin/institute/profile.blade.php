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
              <h2 class="panel-title">Institute Profile Update</h2>
            </header>
            @if(session()->has('status'))
              {!! session()->get('status') !!}
            @endif
            <div class="panel-body">
              <form action="{{ route('admin.instituteProfile') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="dt form-control" name="id" value="{{ $institute->id }}">

                <div class="row mb-3">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Name [English]<span class="text-danger">*</span></label>
                      <input type="text" name="name" placeholder="Institute Name in English" autocomplete="off" required
                             value="{{ old('name', $institute->name) }}"
                             class="form-control @error('name') is-invalid @enderror">
                      @error('name')
                      <strong class="text-danger">{{ $errors->first('name') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="name_bn" class="control-label">নাম [বাংলায়]</label>
                      <input type="text" id="name_bn" name="name_bn" placeholder="ইনস্টিটিউটের নাম বাংলায়" value="{{ old('name_bn', $institute->name_bn) }}"
                             class="form-control @error('name_bn') is-invalid @enderror">
                      @error('name_bn')
                      <strong class="text-danger">{{ $errors->first('name_bn') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="code" class="control-label">Code<span class="text-danger">*</span></label>
                      <input type="number" min="0" name="code" placeholder="Institute Code" autocomplete="off" required
                             value="{{ old('code', $institute->code) }}"
                             class="form-control @error('code') is-invalid @enderror">
                      <small id="realtime-code-error" class="text-danger d-none">The Code must be at least 7 characters </small>
                      @error('code')
                      <strong class="text-danger">{{ $errors->first('code') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Phone</label>
                      <input type="number" min="0" name="phone" placeholder="Institute Phone" autocomplete="off"
                             value="{{ old('phone', $institute->phone) }}"
                             class="form-control @error('phone') is-invalid @enderror">
                      @error('phone')
                      <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Email</label>
                      <input type="email" name="email" placeholder="Institute Email" autocomplete="off"
                             value="{{ old('email', $institute->email) }}"
                             class="form-control @error('email') is-invalid @enderror">
                      @error('email')
                      <strong class="text-danger">{{ $errors->first('email') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Website</label>
                      <input type="text" name="website" placeholder="Institute website" autocomplete="off"
                             value="{{ old('website', $institute->website ?? 'https://') }}"
                             class="form-control @error('website') is-invalid @enderror">
                      @error('website')
                      <strong class="text-danger">{{ $errors->first('website') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Division<span class="text-danger">*</span></label>
                      <select name="division_id" class="form-control @error('division_id') is-invalid @enderror" required>
                        <option value="">Choose a division</option>
                        @foreach($divisions as $division)
                          <option value="{{ $division->id }}" @selected($division->id == old('division_id', $institute->division_id))>{{ $division->name }}</option>
                        @endforeach
                      </select>
                      @error('division_id')
                      <strong class="text-danger">{{ $errors->first('division_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="district_id" class="control-label">District<span class="text-danger">*</span></label>
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
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="upazila_id" class="control-label">Upazila<span class="text-danger">*</span></label>
                      <select name="upazila_id" class="form-control @error('upazila_id') is-invalid @enderror" required>
                        <option value="">Choose a Upazila</option>
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

                <div class="row mb-3">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="control-label">Address</label>
                      <input type="text" name="address" placeholder="Full Address" value="{{ old('address', $institute->address) }}"
                             class="form-control @error('address') is-invalid @enderror">
                      @error('address')
                      <strong class="text-danger">{{ $errors->first('address') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Image (Optional)</label>
                      <input type="file" name="photo"
                             class="form-control @error('photo') is-invalid @enderror">
                      @error('photo')
                      <strong class="text-danger">{{ $errors->first('photo') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-12 text-center">
                    <button class="btn btn-success w-full text-center" type="submit">Submit</button>
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
    $(document).ready(function () {
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
