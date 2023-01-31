@extends('layout.site')

@section('content')
    <div class="container mx-auto mt-5">
        <div class="d-flex justify-content-center">
            <img height="300px"  width="500px" src="{{asset('assets/frontend/img/error/e403g3.gif')}}" alt="">
        </div>
        <div class="mt-5">
            <h1 class="error-404-text">403 !!! <span class="text-dark">Forbidden ! Server Acess Denied</span></h1>
        </div>
    </div>
@endsection