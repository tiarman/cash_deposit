@extends('layout.site')

@section('stylesheet')

@endsection

@section('content')
  <div class="container" data-aos="fade-up">

    <div class="section-title mt-5">
      <h2 style="text-align: center">Training List</h2>
    </div>

    <div class="row">

      <div class="col-md-6 mb-3">
        <label class=" me-3" for="order_by_training"><input class="me-1" type="radio" checked name="order_by" id="order_by_training" value="order_by_training">By Name</label>
        <label class=" me-3" for="order_by_institute"><input class="me-1" type="radio" name="order_by" id="order_by_institute" value="order_by_institute">By Institute</label>

      </div>
      <div class="text-end col-md-6 mb-3">

        <label class=" me-3" for="order_by_upcoming"><input class="me-1" type="radio" name="order_by" id="order_by_upcoming" value="order_by_upcoming">Upcoming</label>
        <label class=" me-3" for="order_by_running"><input class="me-1" type="radio" name="order_by" id="order_by_running" value="order_by_running">On Going</label>
        <label class=" me-3" for="order_by_previous"><input class="me-1" type="radio" name="order_by" id="order_by_previous" value="order_by_previous">Completed</label>

      </div>
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6"></div>
          <div class="col-md-3">
              <label for="">From</label>
              <input type="date" class="form-control">
          </div>
          <div class="col-md-3">
              <label for="">To</label>
              <input type="date" class="form-control">
          </div>
        </div>
      </div>
      <div id="training_list">
        @forelse($trainings as $key => $val)
          <div class="col-md-12">
            <p>
              <strong>({{$key+1}}) </strong>
              <a href="{{route('institute.trainings.details',$val->id)}}">{{ $val->title}}</a>
              <span><strong> From : </strong> {{ $val->start_date }}
                <strong>To : </strong> {{ $val->end_date }}</span>
            </p>
          </div>
          <hr>
        @empty
          <span>Not available</span>
        @endforelse
      </div>
      <div class="d-none" id="institute_list">
        @forelse($institutes as $key => $val)
          <div class="col-md-12">
            <p>
              <strong>({{$key+1}}) </strong>
              <a href="{{ route('institute.wise.trainings',$val->id) }}">{{ $val->name . ' ('.$val->trainings_count.')'}}</a>
            </p>
          </div>
          <hr>
        @empty
          <span>Not available</span>
        @endforelse
      </div>

      <div class="d-none" id="upcoming_list">
        @forelse($upcomings as $key => $val)
          <div class="col-md-12">
            <p>
              <strong>({{$key+1}}) </strong>
              <a href="{{route('institute.trainings.details',$val->id)}}">{{ $val->title}}</a>
              <spna><strong> From : </strong> {{ $val->start_date }}
                <strong>To : </strong> {{ $val->end_date }}</spna>
            </p>
          </div>
          <hr>
        @empty
          <span>Not available</span>
        @endforelse
      </div>

      <div class="d-none" id="running_list">
        @forelse($runnings as $key => $val)
          <div class="col-md-12">
            <p>
              <strong>({{$key+1}}) </strong>
              <a href="{{route('institute.trainings.details',$val->id)}}">{{ $val->title}}</a>
              <spna><strong> From : </strong> {{ $val->start_date }}
                <strong>To : </strong> {{ $val->end_date }}</spna>
            </p>
          </div>
          <hr>
        @empty
          <span>Not available</span>
        @endforelse
      </div>

      <div class="d-none" id="previous_list">
        @forelse($previouses as $key => $val)
          <div class="col-md-12">
            <p>
              <strong>({{$key+1}}) </strong>
              <a href="{{route('institute.trainings.details',$val->id)}}">{{ $val->title}}</a>
              <spna><strong> From : </strong> {{ $val->start_date }}
                <strong>To : </strong> {{ $val->end_date }}</spna>
            </p>
          </div>
          <hr>
        @empty
          <span>Not available</span>
        @endforelse
      </div>


    </div>

  </div>
@endsection

@section('script')

  <script>
    $(document).ready(function () {
      $(document).on('change', 'input[name="order_by"]', function (e) {
        var get_data = $('input[name="order_by"]:checked').val();
        if (get_data == 'order_by_institute') {
          $('#institute_list').removeClass('d-none')
          $('#upcoming_list').addClass('d-none')
          $('#running_list').addClass('d-none')
          $('#previous_list').addClass('d-none')
          $('#training_list').addClass('d-none')
        }
        if (get_data == 'order_by_upcoming') {
          $('#institute_list').addClass('d-none')
          $('#upcoming_list').removeClass('d-none')
          $('#running_list').addClass('d-none')
          $('#previous_list').addClass('d-none')
          $('#training_list').addClass('d-none')
        }
        if (get_data == 'order_by_running') {
          $('#institute_list').addClass('d-none')
          $('#upcoming_list').addClass('d-none')
          $('#running_list').removeClass('d-none')
          $('#previous_list').addClass('d-none')
          $('#training_list').addClass('d-none')
        }
        if (get_data == 'order_by_previous') {
          $('#institute_list').addClass('d-none')
          $('#upcoming_list').addClass('d-none')
          $('#running_list').addClass('d-none')
          $('#previous_list').removeClass('d-none')
          $('#training_list').addClass('d-none')
        }
        if (get_data == 'order_by_training') {
          $('#institute_list').addClass('d-none')
          $('#upcoming_list').addClass('d-none')
          $('#running_list').addClass('d-none')
          $('#previous_list').addClass('d-none')
          $('#training_list').removeClass('d-none')
        }
      });
    });
  </script>
@endsection



