@extends('layout.site')

@section('content')
    <div class="container mx-auto" style="margin-top: 100px; margin-bottom: 200px">
        <div class="d-flex justify-content-center">
            <img height="350px"  width="500px" src="{{asset('assets/frontend/img/404.png')}}" alt="">
        </div>
        <div class="mt-5 text-center">
            <h1 class="error-404-text">404 !!! <span class="text-dark">Sorry Page Not Found</span></h1>
        </div>
    </div>
@endsection
