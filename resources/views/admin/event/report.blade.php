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
              <h2 class="panel-title">Create Report</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List Of Event', 'Super Admin'))
              <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                  <a href="{{ route('admin.event.create') }}" class="brn btn-success btn-sm">Create Events</a>
                </div>
              </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.district.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="control-label">Participant No.</label>
                          <input type="number" name="participant_no" placeholder="Enter Participant No" autocomplete="off"
                                 value="{{ old('participant_no') }}"
                                 class="form-control @error('participant_no') is-invalid @enderror">
                          @error('participant_no')
                          <strong class="text-danger">{{ $errors->first('participant_no') }}</strong>
                          @enderror
                        </div>
                      </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="control-label">Expense.</label>
                          <input type="number" name="expense" placeholder="Enter Expense Amount" autocomplete="off"
                                 value="{{ old('expense') }}"
                                 class="form-control @error('expense') is-invalid @enderror">
                          @error('expense')
                          <strong class="text-danger">{{ $errors->first('expense') }}</strong>
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
                  {{-- ending --}}
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
    $(".yearPicker").datepicker({
      format: "yyyy",
      viewMode: "years",
      minViewMode: "years",
      startDate: '-50y',
      endDate: '+30y',
      autoclose: true
    });
// summernote
    $(document).ready(function(){
        $('#summernote').summernote({
        placeholder: 'Write here ...',
        tabSize: 2,
        height: 100
      });
    })
    
</script>


@endsection
