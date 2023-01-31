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
              <h2 class="panel-title">Manage Training Member</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List of Sub Component', 'Super Admin'))
              <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                  <a href="{{ route('admin.training.member.list',request('training_id')) }}" class="brn btn-success btn-sm">List of Training Member</a>
                </div>
              </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.training.member.store',[request('training_id'),$training_memeber->id]) }}" method="post">
                @csrf
                <input type="hidden" class="dt form-control" name="id" value="{{ $training_memeber->id }}">


                  <div class="row">
                  <div class="col-sm-4">
                      <div class="form-group">
                          <label class="control-label">Training<span class="text-danger">*</span></label>
                          <select name="training_id" class="form-control @error('training_id') is-invalid @enderror" required>
                              <option value="">Choose a component</option>
                              @foreach($trainings as $training)
                                  <option value="{{ $training->id }}" @selected($training->id == old('training_id',$training_memeber->training_id))>{{ $training->title }}</option>
                              @endforeach
                          </select>
                          @error('training_id')
                          <strong class="text-danger">{{ $errors->first('training_id') }}</strong>
                          @enderror
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                          <label class="control-label">Name<span class="text-danger">*</span></label>
                          <input type="text" name="name" placeholder="Name" autocomplete="off" required
                                 value="{{ old('name',$training_memeber->name) }}"
                                 class="form-control @error('name') is-invalid @enderror">
                          @error('name')
                          <strong class="text-danger">{{ $errors->first('name') }}</strong>
                          @enderror
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                          <label class="control-label">Email<span class="text-danger">*</span></label>
                          <input type="email" name="email" placeholder="Email" autocomplete="off" required
                                 value="{{ old('email',$training_memeber->email) }}"
                                 class="form-control @error('email') is-invalid @enderror">
                          @error('email')
                          <strong class="text-danger">{{ $errors->first('email') }}</strong>
                          @enderror
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                          <label class="control-label">Phone<span class="text-danger">*</span></label>
                          <input type="number" name="phone" placeholder="Phone" autocomplete="off" required
                                 value="{{ old('phone',$training_memeber->phone) }}"
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
@endsection
