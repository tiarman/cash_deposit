@extends('layout.admin')

@section('stylesheet')
@endsection

@section('content')

  <form action="{{ route('admin.training.member.import',request('training_id')) }}" method="POST" enctype="multipart/form-data">
    <div class="row justify-content-md-center">
      @csrf

      

      <div class="col-md-4">
        <div class="form-group">
          <label class="control-label">Choose Excel/CSV File<span class="text-danger mr-3">*</span> <a target="_blank"
                                                                                                       href="{{asset('assets/imp/add_training_member_example.csv')}}"
                                                                                                       download>Demo Training
            </a></label>
          <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
        </div>
      </div>

      <div class="col-md-1">
        <div class="form-group mt-8">
          <label class="control-label"></label>
          <button type="submit" class="btn btn-danger btn-sm">Add</button>
        </div>
      </div>
    </div>
  </form>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Create Training Member</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List Of Training Member', 'Super Admin'))
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.training.member.list',request('training_id')) }}" class="brn btn-success btn-sm">List of Training Members </a>
                  </div>
                </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.training.member.store',request('training_id')) }}" method="post">
                @csrf
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">User<span class="text-danger">(Optional)</span></label>
                      <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                        <option value="">Choose a User</option>
                        @foreach($users as $user)
                          <option value="{{ $user->id }}" @selected($user->id == old('user_id'))>{{ $user->name_en }}</option>
                        @endforeach
                      </select>
                      @error('user_id')
                      <strong class="text-danger">{{ $errors->first('user_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <input type="hidden" name="training_id" value="{{request('trainingId')}}">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Name<span class="text-danger">*</span></label>
                      <input id="name" type="text" name="name" placeholder="Name" autocomplete="off" required
                             value="{{ old('name') }}"
                             class="form-control 
                             
                             @error('name') is-invalid @enderror">
                      @error('name')
                      <strong class="text-danger">{{ $errors->first('name') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Email<span class="text-danger">*</span></label>
                      <input id="email" type="email" name="email" placeholder="Email" autocomplete="off" required
                             value="{{ old('email') }}"
                             class="form-control @error('email') is-invalid @enderror">
                      @error('email')
                      <strong class="text-danger">{{ $errors->first('email') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Phone<span class="text-danger">*</span></label>
                      <input id="phone" type="number" name="phone" placeholder="Phone" autocomplete="off" required
                             value="{{ old('phone') }}"
                             class="form-control @error('phone') is-invalid @enderror">
                      @error('phone')
                      <strong class="text-danger">{{ $errors->first('phone') }}</strong>
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
  <Script>$(document).ready(function () {


      $(document).on('change', 'select[name="user_id"]', function (e) {

//  console.log(e.target.value+' test')

        var status = 'active';
        var id = $(this).val();


        $.ajax({
          url: "{{ route('admin.ajax.training.member.create') }}",
          method: "GET",
          dataType: "html",
          data: {'id': id, 'status': status},
          // location.reload(),
          success: function (data) {
            if (data) {
              data = (JSON.parse(data));
              $('#name').val(data?.name_en)
              $('#email').val(data?.email)
              $('#phone').val(data?.phone)
            } else {
              $('#name').val('');
              $('#email').val('');
              $('#phone').val('');
            }
          }
        });


      })

    })
  </script>

@endsection
