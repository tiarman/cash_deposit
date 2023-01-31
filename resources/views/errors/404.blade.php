@extends('layout.site')

@section('content')
    <div class="container mx-auto mt-5">
        <div class="d-flex justify-content-center">
            <img height="300px"  width="500px" src="{{asset('assets/frontend/img/error/e404g3.gif')}}" alt="">
        </div>
        <div class="mt-5">
            <h1 class="error-404-text">404 !!! <span class="text-dark">Sorry Page Not Found</span></h1>
        </div>
    </div>
@endsection