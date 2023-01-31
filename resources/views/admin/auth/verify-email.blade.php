@extends('layout.auth')
@section('content')
    <div class="card ">
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-center"><a href="{{ route('home') }}" class="logo logo-admin">
{{--                        <img src="{{ asset('assets/text-logo.png') }}" height="80" alt="logo">--}}
                    </a></div>
            </div>
            <div class="pl-3 pr-3 pb-3">
                <div class="row">
                    <div class="col-12 text-center">
                        @if(\Illuminate\Support\Facades\Session::has('email'))
                            <h6 class="m-2">Dear user, a verification email sent to <strong>{{ \Illuminate\Support\Facades\Session::get('email') }}</strong>. Please click the verification link sent to your email.</h6>
                        @else
                        <h6 class="m-2">Please verify your email with bellow link:</h6>
                        @endif
                        <hr>
                        @if(session()->has('message'))
                            <h6 class="text-success">{!! session()->get('message') !!}</h6>
                        @endif
                    </div>
                </div>


                <form class="form-horizontal" action="{{ url('/email/verification-notification') }}" method="post">
                    @csrf
                    <div class="form-group row m-t-20">
                        <div class="col-sm-12 text-right">
                            <button class="btn btn-success w-md waves-effect waves-light" type="submit" name="verify">@if(\Illuminate\Support\Facades\Session::has('email')) Email Sent @else Send Email @endif</button>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
