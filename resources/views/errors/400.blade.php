@extends('layout.site')

@section('content')
    <div class="container mx-auto mt-5">
        <div class="d-flex justify-content-center">
            <img height="300px"  width="500px" src="{{asset('assets/frontend/img/error/e400.webp')}}" alt="">
        </div>
        <div class="mt-5">
            <h1 class="error-404-text">400 !!! <span class="text-dark">You've sent bad request</span></h1>
        </div>
    </div>
@endsection