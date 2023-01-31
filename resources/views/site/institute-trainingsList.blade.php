@extends('layout.site')

@section('stylesheet')

@endsection

@section('content')

  <div class="container" data-aos="fade-up">

    <div class="section-title mt-5">
      <h4 style="text-align: center">{{ $institute->name }} Training List</h4>
      <div>
        <p>
          <strong>Head of Institute:</strong> {{ $institute->instituteHead?->name_en }}</p>
        <p>
          <strong>code :</strong>{{ $institute->code }}</p>
        <p>
          <strong>phone :</strong>
          <a href="tel:{{ $institute->phone }}">{{ $institute->phone }}</a></p>
        <p>
          <strong>email :</strong>
          <a href="mailto:{{ $institute->email }}">{{ $institute->email }}</a></p>
        <p>
          <strong>website :</strong>
          <a href="{{ $institute->website }}">{{ $institute->website }}</a></p>
        <p>
          <strong>address :</strong>{{ $institute->division?->name }}, {{ $institute->district?->name }}, {{ $institute->address }}</p>
      </div>
    </div>
    <hr>

    <div class="row">
      <div id="training_list">
        @forelse($datas as $key => $val)
          <div class="col-md-12">
            <p>
              <strong>({{$key+1}}) </strong>
              <a href="{{route('institute.trainings.details',$val->id)}}">{{Str::words($val->title, 10, '...')}}</a>
              <span><strong> From : </strong> {{ $val->start_date }}
                <strong>To : </strong> {{ $val->end_date }}</span>
            </p>
          </div>
          <hr>
        @empty
        @endforelse
      </div>


    </div>

  </div>
@endsection



