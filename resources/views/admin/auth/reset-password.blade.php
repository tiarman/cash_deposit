@extends('layout.auth')
@section('content')
    <div class="card ">
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-center"><a href="{{ route('home') }}" class="logo logo-admin">
                        <img src="{{ asset('assets/text-logo.png') }}" height="80" alt="logo">
                    </a></div>
            </div>
            <div class="pl-3 pr-3 pb-3">
                <div class="row">
                    <div class="col-12 text-center">
                        <h6 class="m-2">Please Reset your password:</h6>
                        <hr>
                        @if(session()->has('message'))
                            <h6 class="text-success">{!! session()->get('message') !!}</h6>
                        @endif
                    </div>
                </div>


                <form class="form-horizontal" action="{{ route('password.reset.store',request('token')) }}" method="POST">
                    @csrf
                    <input type="hidden" name="email" value="{{ request('email') }}">
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="d-flex">
                            <input type="password" name="password" id="password" placeholder="Enter Your Password" autocomplete="off"
                                   class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" required>
                            <span class="mt-1 "><i class="fa fa-regular fa-key icon login-icon"></i></span>
                        </div>

                        <span class="spin"></span>
                        @error('password')
                        <strong class="text-danger">{{ $errors->first('password') }}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                        <div class="d-flex">
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Enter Your Password" autocomplete="off"
                                   class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" required>
                            <span class="mt-1 "><i class="fa fa-regular fa-key icon login-icon"></i></span>
                        </div>

                        <span class="spin"></span>
                        @error('password_confirmation')
                        <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                        @enderror
                    </div>
                    <div class="form-group row m-t-20">
                        <div class="col-sm-12 text-right">
                            <button class="btn btn-success w-md waves-effect waves-light" type="submit" name="verify" >Submit</button>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
