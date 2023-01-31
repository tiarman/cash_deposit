@extends('layout.site')

@section('stylesheet')
  <style>
    @media only print {
      .card-header img {
        height: 60px;
      }
    }
  </style>
@endsection

@section('content')
  <div id="trainingDetails" class="container">
    <div class="row " style="margin-top:50px">

      <div class="col-12">
        <div class="card" style="border: none">
          <div class="card-body">
            <section class="panel">
              <header class="panel-heading border-bottom mb-4 text-center">
                <h2 class="panel-title">Training Information</h2>
              </header>


              <div class="panel-body">
                @if(session()->has('status'))
                  {!! session()->get('status') !!}
                @endif
                <div class="card">
                  <div class="card-header text-center">
                    <div class="row ">
                      <div class="col-sm-3 my-auto">
                        @if($training->institute->photo)
                          <img height="80px" src="{{$training->institute->photo}}" alt="bd flag">
                        @endif
                      </div>
                      <div class="col-sm-6">
                        <h4 class="">{{ $training?->institute?->name  }}</h4>
                        <p>{{ $training->institute?->instituteHead?->name_en }}</p>
                        <p>{{ $training->institute?->instituteHead?->email }}</p>
                        <p>{{ $training->institute?->instituteHead?->phone }}</p>
                      </div>
                      <div class="col-sm-3 my-auto">
                        <img height="80px" src="{{asset('assets/text-logo.png')}}" alt="govt logo">
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <ul>
                      <li><strong>Title : </strong> {{ $training->title  }}</li>
                      <li>
                        <strong>Participant Type: </strong>
                        @foreach($training->participants as $type)
                          <span class="bg bg-success mr-2 text-white">{{$type->name}}</span>
                        @endforeach
                      </li>
                      <li><strong>Type: </strong>{{ $training->type?->name }}</li>
                      <li><strong>Start at : </strong> {{ \App\Helper\CustomHelper::makeDateFormat($training->start_date)  }}</li>
                      <li><strong>End at : </strong> {{ \App\Helper\CustomHelper::makeDateFormat($training->end_date)  }}</li>
                      <li><strong>Institute Phone : </strong> {{ $training->institute?->phone  }}</li>
                      <li><strong>Institute Email : </strong> {{ $training->institute?->email   }}</li>
                      <li><strong>Participant : </strong> {{ $training->participate_limit }}</li>
                    </ul>
                    <div class="row">
                      <div class="col-md-12">{!! $training->description !!}</div>
                      <div class="col-md-12 text-center">
                        @if(\App\Models\TrainingMember::where('user_id',auth()->id())->where('training_id',$training->id)->exists())
                          <button class="btn btn-success">Already Applied</button>
                        @elseif($training->participate_limit ==! null && $training->members_count >= $training->participate_limit)
                          <button class="btn btn-danger" disabled>Training is full</button>
                        @else
                          <a id="apply-button" class="btn btn-primary" href="{{ route('institute.trainings.store',$training->id) }}">Apply Now</a>
                        @endif
                        <span class="btn btn-warning" onclick="printDiv('trainingDetails', 'Training Details')">Print</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('script')

@endsection
