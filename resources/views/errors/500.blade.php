@extends('layout.site')

@section('content')
    <div class="container mx-auto mt-5">
        <div class="d-flex justify-content-center">
            <img height="300px"  width="500px" src="{{asset('assets/frontend/img/error/e500g2.gif')}}" alt="">
        </div>
        <div class="mt-5" style="margin-bottom: 100px">
            <h1 class="error-404-text">500 !!! <span class="text-dark">Sorry Internal Server Error</span></h1>
        </div>
    </div>
@endsection
