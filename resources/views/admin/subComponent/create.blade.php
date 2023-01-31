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
              <h2 class="panel-title">Create Sub Component</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List Of Component', 'Super Admin'))
              <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                  <a href="{{ route('admin.subComponent.list') }}" class="brn btn-success btn-sm">List of sub components</a>
                </div>
              </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.subComponent.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Component<span class="text-danger">*</span></label>
                            <select name="component_id" class="form-control @error('component_id') is-invalid @enderror" required>
                                <option value="">Choose a component</option>
                                @foreach($components as $component)
                                    <option value="{{ $component->id }}" @selected($component->id == old('component_id'))>{{ $component->name }}</option>
                                @endforeach
                            </select>
                            @error('component_id')
                            <strong class="text-danger">{{ $errors->first('component_id') }}</strong>
                            @enderror
                        </div>
                    </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Name<span class="text-danger">*</span></label>
                      <input type="text" name="name" placeholder="Name" autocomplete="off" required
                             value="{{ old('name') }}"
                             class="form-control @error('name') is-invalid @enderror">
                      @error('name')
                      <strong class="text-danger">{{ $errors->first('name') }}</strong>
                      @enderror
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Code</label>
                      <input type="text" min="0" name="code" placeholder="Code" autocomplete="off"
                             value="{{ old('code') }}"
                             class="form-control @error('code') is-invalid @enderror">
                      @error('code')
                      <strong class="text-danger">{{ $errors->first('code') }}</strong>
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
